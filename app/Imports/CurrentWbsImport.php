<?php

namespace App\Imports;

use App\Http\Controllers\CurrentWbsController;
use App\Http\Controllers\MasterDataController;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CurrentWbsImport implements ToCollection, WithHeadingRow
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
        $currentWbsController = new CurrentWbsController;
        $masterDataController = new MasterDataController;
        $parentIDCurrent=null;

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


                $requestWbsCurrentParent = new Request([
                        'parentItem' => $row['name'],
                        'parentLevel' => 0,
                        'contractorID' => $this->contractorID
                    ]);
               
                $responseBodyCurrent = json_decode($currentWbsController->addCurrentWbsParent($requestWbsCurrentParent));
                $parentIDCurrent = $responseBodyCurrent->last_insert_id;
            }
        }
    }
}
