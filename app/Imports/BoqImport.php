<?php

namespace App\Imports;

use App\Http\Controllers\BoqController;
use App\Http\Controllers\MasterDataController;
use Illuminate\Http\Request;
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
            $no = explode('.',$row['no']);
            //check if no > 1
            if(count($no) > 1){
                $this->addBoqChild($row['name'], 0, $row['unit'], $row['currency'], $row['qty'], $row['price'], $parentID, $this->contractorID, $this->projectID, $this->createdByID);
            }else{
                $url = "/api/InsertDataBoq";
                $contractorID = $this->contractorID;
                $sendData['itemName'] = $row['name'];
                $sendData['Created_By'] = $this->createdByID;
                $sendData['level'] = 0;
                $sendData['parentlevel'] = 0;
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

            return  $responseBody;
        } else {
            return  json_encode($responseBody);
        }
    
    }
}
