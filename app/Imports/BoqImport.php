<?php

namespace App\Imports;

use App\Http\Controllers\BoqController;
use App\Http\Controllers\MasterDataController;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use stdClass;

class BoqImport implements ToCollection, WithHeadingRow
{
    public function __construct($projectID, $contractorID, $createdByID){
        $this->projectID = $projectID;
        $this->contractorID = $contractorID;
        $this->createdByID = $createdByID;
    }
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $boqController = new BoqController;
        $parentID=null;
        foreach($collection as $row){
            //conver number to string
            $row['no'] = (string)$row['no'];
            //check if no > 1
            if(strlen($row['no']) > 1){
                $parentNo = substr($row['no'], 0, 1);
                $childNo = substr($row['no'], 2, 1);
                $this->addBoqChild($row['name'], 0, $row['unit'], $row['currency'], $row['qty'], $row['price'], $parentID, $this->contractorID, $this->projectID, $this->createdByID);
            }else{
                $url = "/api/InsertDataBoq";
                $level = 0;
                $contractorID = $this->contractorID;
                $sendData['itemName'] = $row['name'];
                $sendData['Created_By'] = $this->createdByID;
                $sendData['level'] = 0;
                $sendData['parentlevel'] = $level;
                $sendData['ProjectID'] = $this->projectID;
                $sendData['contractorID'] = $contractorID;
                $responseBody = json_decode($boqController->insertData($url, $sendData));
                $parentID = $responseBody->last_insert_id;
            }
        }
    }

    public function addBoqChild($name, $parentlevel, $unit, $currency, $qty, $price, $parentID, $contractorID, $ProjectID, $createdByID){
        $boqController = new BoqController;
        $masterDataController = new MasterDataController;
        $level = 1;
        
        // find Unit ID
        $unitData = $masterDataController->getOrInsertUnitBySymbol($unit);
        $unitID = $unitData->id;

        // find Currency ID
        $currencyData = $masterDataController->getOrInsertCurrencyByName($currency);
        $currencyID = $currencyData->id;


        $childQty = $qty;
        $childAmount = $price;
        $AllWeight = 0;
        $parentWeight = 0;

        $urlWeight = "/api/getWeightBoq/" . $ProjectID . '/' . $contractorID;
        $responseBodyWeight = json_decode($boqController->getData($urlWeight));
        if ($responseBodyWeight != null) {
            $AllWeight = $responseBodyWeight[0]->All_TOTAL;
            $weight = (($childQty * $childAmount) / ($AllWeight + ($childQty * $childAmount))) * 100;
        } else {
            $weight = 100;
        }

        $url = "/api/InsertDataBoq";

        $sendData['itemName'] = $name;
        $sendData['parentItem'] = $parentID;
        $sendData['hasChild'] = '';
        $sendData['qty'] = $childQty;
        $sendData['price'] = $childAmount;
        $sendData['amount'] =  $childQty * $childAmount;
        $sendData['weight'] = $weight;
        $sendData['ProjectID'] = $ProjectID;
        $sendData['unitID'] = $unitID;
        $sendData['contractorID'] = $contractorID;
        $sendData['CurrencyID'] = $currencyID;
        $sendData['Created_By'] = $createdByID;
        $sendData['level'] = $level;
        $sendData['parentlevel'] = $parentlevel;
        $responseBody = $boqController->insertData($url, $sendData);
        $responseBody = json_decode($responseBody);
        if ($responseBody->last_insert_id != null) {
            $url = "/api/UpdateBoq/" . $parentID;
            // $sendData2['hasChild'] = $responseBody->last_insert_id;
            $sendData2['hasChild'] = 'Y';
            $responseBody = $boqController->updateData($url, $sendData2);

            $urlWeight = "/api/getWeightBoq/" . $ProjectID . '/' . $contractorID;
            $responseBodyWeight = json_decode($boqController->getData($urlWeight));
            if ($responseBodyWeight != null) {
                for ($i = 0; $i < count($responseBodyWeight); $i++) {
                    $url = "/api/UpdateBoq/" . $responseBodyWeight[$i]->parentID;
                    $sendDataWeight['weight'] = $responseBodyWeight[$i]->ParentWeight;
                    $boqController->updateData($url, $sendDataWeight);
                    $url = "/api/DataBoqchild/" . $responseBodyWeight[$i]->parentID;
                    $responseBodyChild = json_decode($boqController->getData($url));
                    for ($j = 0; $j < count($responseBodyChild); $j++) {
                        $url = "/api/UpdateBoq/" . $responseBodyChild[$j]->id;
                        $sendDataWeight['weight'] = ($responseBodyChild[$j]->amount / $responseBodyWeight[$i]->All_TOTAL)*100;
                        $boqController->updateData($url, $sendDataWeight);
                    }
                }
            }
            return  $responseBody;
        } else {
            return  json_encode($responseBody);
        }
    
    }
}
