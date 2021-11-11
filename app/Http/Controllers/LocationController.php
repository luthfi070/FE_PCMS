<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Village;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getRegency($province_id=36){
        $province = Province::find($province_id);
        $regencies = $province->regencies;
        return json_encode($regencies);
    }

    public function getDistrict($regency_id){
        $regency = Regency::find($regency_id);
        $districts = $regency->districts;
        return json_encode($districts);
    }
    public function getVillage($district_id){
        $district = District::find($district_id);
        $villages = $district->villages;
        return json_encode($villages);
    }

    public function getDataLocation($village_id){
        $village = Village::find($village_id);
        $district = $village->district;
        $regency = $district->regency;
        
        return json_encode($village);
    }
}
