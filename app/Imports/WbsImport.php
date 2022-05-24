<?php

namespace App\Imports;

use App\Http\Controllers\BaselineWbsController;
use App\Http\Controllers\MasterDataController;
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
        $parentID=null;
        $parentChildID=null;
        foreach($collection as $row){
            //conver number to string
            $row['no'] = (string)$row['no'];
            //check if no > 1
            if(strlen($row['no']) > 1){
                $responseBody = $this->addWbsChild($row['name'], 0, $row['unit'], $row['currency'], $row['qty'], $row['price'], $this->transformDate($row['startdate']), $this->transformDate($row['enddate']), $parentID, $this->contractorID, $this->projectID, $this->createdByID, 1);
            }else{
                $url = "/api/InsertDataWbs";
                $sendData['itemName'] = $row['name'];
                $sendData['Created_By'] = $this->createdByID;
                $sendData['level'] = 0;
                $sendData['parentlevel'] = 0;
                $sendData['ProjectID'] = $this->projectID;
                $sendData['contractorID'] = $this->contractorID;
                $responseBody = json_decode($baselineWbsController->insertData($url, $sendData));
                $parentID = $responseBody->last_insert_id;
            }
        }
    }

    public function addWbsChild($name, $parentlevel, $unit, $currency, $qty, $price, $startDate, $endDate, $parentID, $contractorID, $ProjectID, $createdByID, $childLevel){
        $baselineWbsController = new BaselineWbsController;
        $masterDataController = new MasterDataController;
        $level = $childLevel;

        // find Unit ID
        $unitData = $masterDataController->getOrInsertUnitBySymbol($unit);
        $unitID = $unitData->id;

        // find Currency ID
        $currencyData = $masterDataController->getOrInsertCurrencyByName($currency);
        $currencyID = $currencyData->id;
       
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
