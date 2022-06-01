<?php

namespace App\Imports;

use App\Http\Controllers\BaselineWbsController;
use App\Http\Controllers\CurrentWbsController;
use App\Http\Controllers\MasterDataController;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use stdClass;


class WbsImport implements ToCollection, WithHeadingRow
{
    public function __construct($projectID, $contractorID, $createdByID){
        $this->projectID = $projectID;
        $this->contractorID = $contractorID;
        $this->createdByID = $createdByID;
    }
    
    /**
     * Transform a date value into a Carbon object.
     *
     * @return \Carbon\Carbon|null
     */
    public function transformDate($value, $format = 'Y-m-d')
    {
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value))->format('Y-m-d');
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value)->format('Y-m-d');
        }
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $baselineWbsController = new BaselineWbsController;
        $currentWbsController = new CurrentWbsController;
        $masterDataController = new MasterDataController;
        $parentID=null;
        $parentIDCurrent=null;
        $parentChildID=null;
        foreach($collection as $row){
            //conver number to string
            $row['no'] = (string)$row['no'];
            $no = explode('.',$row['no']);
            //check if no > 1
            if(count($no) > 1){
                // find Unit ID
                $unitData = $masterDataController->getOrInsertUnitBySymbol($row['unit']);
                $unitID = $unitData->id;

                // find Currency ID
                $currencyData = $masterDataController->getOrInsertCurrencyByName($row['currency']);
                $currencyID = $currencyData->id;

                $startDate = $this->transformDate($row['startdate']);
                $endDate = $this->transformDate($row['enddate']);

                $responseBody = $this->addWbsChild($row['name'], 0, $unitID, $currencyID, $row['qty'], $row['price'], $startDate, $endDate, $parentID, $this->contractorID, $this->projectID, $this->createdByID, 1);
                $requestWbsCurrentChild = new Request([
                    'childItem' => $row['name'],
                    'childLevel' => 1,
                    'parentLvl' => 0,
                    'unitTypechild' => $unitID,
                    'childQty' => $row['qty'],
                    'currencyTypechild' => $currencyID,
                    'childAmount' => $row['price'],
                    'parentID' => $parentIDCurrent,
                    'contractorID' => $this->contractorID,
                    'startDate' => $startDate,
                    'endDate' => $endDate,

                ]);
                $responseBodyCurrentChild = $currentWbsController->addCurrentWbsChild($requestWbsCurrentChild);
            }else{

                $url = "/api/InsertDataWbs";
                $requestWbsCurrentParent = new Request([
                        'parentItem' => $row['name'],
                        'parentLevel' => 0,
                        'contractorID' => $this->contractorID
                    ]);
               
                $sendData['itemName'] = $row['name'];
                $sendData['Created_By'] = $this->createdByID;
                $sendData['level'] = 0;
                $sendData['parentlevel'] = 0;
                $sendData['ProjectID'] = $this->projectID;
                $sendData['contractorID'] = $this->contractorID;
                $responseBody = json_decode($baselineWbsController->insertData($url, $sendData));
                $responseBodyCurrent = json_decode($currentWbsController->addCurrentWbsParent($requestWbsCurrentParent));
                $parentID = $responseBody->last_insert_id;
                $parentIDCurrent = $responseBodyCurrent->last_insert_id;
            }
        }
    }

    public function addWbsChild($name, $parentlevel, $unitID, $currencyID, $qty, $price, $startDate, $endDate, $parentID, $contractorID, $ProjectID, $createdByID, $childLevel){
        $baselineWbsController = new BaselineWbsController;
        $level = $childLevel;

        $childQty = $qty;
        $childAmount = $price;
        $AllWeight = 0;

        $urlWeight = "/api/getWeightWbs/" . $ProjectID . '/' . $contractorID;
        $responseBodyWeight = json_decode($baselineWbsController->getData($urlWeight));
        if ($responseBodyWeight != null) {
            $AllWeight = $responseBodyWeight[0]->All_TOTAL;
            $weight = (($childQty * $childAmount) / $AllWeight) * 100;
        }else{
            $weight = 100;
        }
            


        $url = "/api/InsertDataWbs";

        $sendData['itemName'] = $name;
        $sendData['parentItem'] = $parentID;
        $sendData['hasChild'] = '';
        $sendData['qty'] = $childQty;
        $sendData['price'] = $childAmount;
        $sendData['amount'] =  $childQty * $childAmount;
        $sendData['weight'] = $weight;
        $sendData['startDate'] = $startDate;
        $sendData['endDate'] = $endDate;
        $sendData['ProjectID'] = $ProjectID;
        $sendData['unitID'] = $unitID;
        $sendData['contractorID'] = $contractorID;
        $sendData['CurrencyID'] = $currencyID;
        $sendData['Created_By'] = $createdByID;
        $sendData['level'] = $level;
        $sendData['parentlevel'] = $parentlevel;
        $responseBody = $baselineWbsController->insertData($url, $sendData);
        $responseBody = json_decode($responseBody);
        if ($responseBody->last_insert_id != null) {
            $url = "/api/UpdateWbs/" . $parentID;
            // $sendData2['hasChild'] = $responseBody->last_insert_id;
            $sendData2['hasChild'] = 'Y';
            $responseBodyUpdate = $baselineWbsController->updateData($url, $sendData2);

            $urlWeight = "/api/getWeightWbs/" . $ProjectID . '/' . $contractorID;
            $responseBodyWeight = json_decode($baselineWbsController->getData($urlWeight));
            if ($responseBodyWeight != null) {
                for ($i = 0; $i < count($responseBodyWeight); $i++) {
                    $url = "/api/UpdateWbs/" . $responseBodyWeight[$i]->parentID;
                    $sendDataWeight['weight'] = $responseBodyWeight[$i]->ParentWeight;
                    $baselineWbsController->updateData($url, $sendDataWeight);
                }
            }
            return  $responseBody;
        } else {
            return  json_encode($responseBody);
        }
    }
}
