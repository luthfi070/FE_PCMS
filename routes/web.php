<?php

use App\Http\Controllers\BoqController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', ['as' => 'login', function () {
    return view('project/project');
}])->middleware('auth');
Route::get('/home', ['as' => 'home', function () {
    return view('project/project');
}]);
Route::get('/logout', function () {
    session()->forget('UserID');
    session()->forget('PrivilegedStatus');
    session()->forget('ProjectID');
    session()->forget('ProjectName');
    return redirect()->route('index');
});
Route::get('/', function () {
    return view('login');
})->name('index');
Route::post('/auth', ['as' => 'auth', 'uses' => 'AuthController@CheckAuth']);
Route::post('/authGuest', ['as' => 'authGuest', 'uses' => 'AuthController@CheckAuthGuest']);

Route::middleware(['verify_auth'])->group(function () {

    Route::get('/2', function () {
        return view('footer');
    })->name('tod');
    Route::get('/project', function () {
        return view('project/project');
    })->name('project');
    Route::get('/addproject', function () {
        return view('project/add-project');
    });
    Route::get('/editproject/{id}', function ($id) {
        return view('project/edit-project', ['id' => $id]);
    });

    Route::middleware(['verify_project'])->group(function () {
        Route::get('/boq', function () {
            return view('boq/boq');
        });


        Route::get('/boqHistory', function () {
            return view('boq/history');
        });
        Route::get('/baseline', function () {
            return view('baseline_wbs/baseline');
        });
        Route::get('/mobilization', function () {
            return view('mobilization_consultant/mobilization');
        });
        Route::get('/equipment', function () {
            return view('contractor_equipment/contractor-equipment');
        });
        Route::get('/risk', function () {
            return view('risk_management/risk-management');
        });
        Route::get('/currentwbs', function () {
            return view('current_wbs/current-wbs');
        });
        Route::get('/actualprogress', function () {
            return view('project_progress/actual-progress');
        });

        Route::get('/performanceanalysis', function () {
            return view('project_progress/performance-analysis');
        });
        Route::get('/performanceanalysisreport', function () {
            return view('project_progress/performance-analysis-report');
        });
        Route::get('/performanceanalysisreportdetail/{id}', function ($id) {
            return view('project_progress/performance-analysis-report-detail', ['id' => $id]);
        });

        Route::get('/stationprogress', function () {
            return view('project_progress/station-progress');
        });

        Route::get('/visualprogress', function () {
            return view('project_progress/visual-progress');
        });

        Route::get('/actual-report', function () {
            return view('project_progress/actual-progress-report');
        });
        Route::get('/actual-report/{id}/{contractorID}', function ($id, $contractorID) {
            return view('project_progress/actual-progress-report-detail', ['docID' => $id, 'contractorID' => $contractorID]);
        });
        Route::get('/payment-certificate', function () {
            return view('payment_certificate/payment-certificate');
        });
        Route::get('/payment-certificate-report/{id}', function ($id) {
            return view('payment_certificate/payment-certificate-report', ['docID' => $id]);
        });
        Route::get('/payment-certificate-report-detail/{id}', function ($id) {
            return view('payment_certificate/payment-certificate-report-detail', ['id' => $id]);
        });
        Route::get('/issue-management', function () {
            return view('issue_management/issue-management');
        });
        Route::get('/monthly-meeting', function () {
            return view('monthly_meeting/monthly-meeting');
        });
        Route::get('/chat', function () {
            return view('chat/chat');
        })->name('chat');
        Route::get('/baseline-gantt/{id}', function ($id) {
            return view('baseline_wbs/baseline-gantt-chart', ['id' => $id]);
        });
    });
    Route::get('/business-type', function () {
        return view('user_management/master_data_management/business-type');
    });
    Route::get('/business-partner', function () {
        return view('user_management/master_data_management/business-partner');
    });
    Route::get('/position-category', function () {
        return view('user_management/master_data_management/position-category');
    });
    Route::get('/position', function () {
        return view('user_management/master_data_management/position');
    });
    Route::get('/human-resources', function () {
        return view('user_management/master_data_management/human-resources');
    });
    Route::get('/weather-conditions', function () {
        return view('user_management/master_data_management/weather-conditions');
    });
    Route::get('/country', function () {
        return view('user_management/master_data_management/country');
    });
    Route::get('/city', function () {
        return view('user_management/master_data_management/city');
    });
    Route::get('/currency', function () {
        return view('user_management/master_data_management/currency');
    });
    Route::get('/units', function () {
        return view('user_management/master_data_management/units');
    });
    Route::get('/manage-user', function () {
        return view('user_management/user_management/manage-user');
    });
    Route::get('/profile-group', function () {
        return view('user_management/user_management/profile-group');
    });


    Route::get('/setting', function () {
        return view('setting');
    });



    Route::group(array('prefix' => '', 'as' => 'MobilizationDate'), function () {
        Route::get('/getMobilizationDate', ['as' => 'getMobilizationDate', 'uses' => 'MobilizationDateController@getMobilizationDate']);
        Route::get('/getMobilizationDateByBusinessPartner', ['as' => 'getMobilizationDateByBusinessPartner', 'uses' => 'MobilizationDateController@getMobilizationDateByBusinessPartner']);
        Route::post('/InsertMobilizationDate', ['as' => 'InsertMobilizationDate', 'uses' => 'MobilizationDateController@InsertMobilizationDate']);
        Route::post('/DeleteMobilizationDate', ['as' => 'DeleteMobilizationDate', 'uses' => 'MobilizationDateController@DeleteMobilizationDate']);
        Route::post('/getMobilizationDateByid', ['as' => 'getMobilizationDateByid', 'uses' => 'MobilizationDateController@getMobilizationDateByid']);
        Route::post('/getMobilizationPositionCategory', ['as' => 'getMobilizationPositionCategory', 'uses' => 'MobilizationDateController@getMobilizationPositionCategory']);
        Route::post('/getMobilizationPosition', ['as' => 'getMobilizationPosition', 'uses' => 'MobilizationDateController@getMobilizationPosition']);
    });

    Route::group(array('prefix' => '', 'as' => 'ContractorEquipment'), function () {
        Route::post('/getContractorEquipment', ['as' => 'getContractorEquipment', 'uses' => 'ContractorEquipmentController@getContractorEquipment']);
        Route::post('/InsertContractorEquipment', ['as' => 'InsertContractorEquipment', 'uses' => 'ContractorEquipmentController@InsertContractorEquipment']);
        Route::post('/DeleteContractorEquipment', ['as' => 'DeleteContractorEquipment', 'uses' => 'ContractorEquipmentController@DeleteContractorEquipment']);
        Route::post('/getContractorEquipmentByid', ['as' => 'getContractorEquipmentByid', 'uses' => 'ContractorEquipmentController@getContractorEquipmentByid']);
        Route::post('/updateContractorEquipment', ['as' => 'updateContractorEquipment', 'uses' => 'ContractorEquipmentController@updateContractorEquipment']);
    });

    Route::group(array('prefix' => '', 'as' => 'RiskManagement'), function () {
        Route::get('/getRiskManagement', ['as' => 'getRiskManagement', 'uses' => 'RiskManagementController@getRiskManagement']);
        Route::post('/InsertRiskManagement', ['as' => 'InsertRiskManagement', 'uses' => 'RiskManagementController@InsertRiskManagement']);
        Route::post('/DeleteRiskManagement', ['as' => 'DeleteRiskManagement', 'uses' => 'RiskManagementController@DeleteRiskManagement']);
        Route::post('/getRiskManagementByid', ['as' => 'getRiskManagementByid', 'uses' => 'RiskManagementController@getRiskManagementByid']);
        Route::post('/updateRiskManagement', ['as' => 'updateRiskManagement', 'uses' => 'RiskManagementController@updateRiskManagement']);
    });

    Route::group(array('prefix' => '', 'as' => 'Project'), function () {
        Route::get('/getProject', ['as' => 'getProject', 'uses' => 'ProjectController@getProject']);
        Route::get('/getLastProjectID', ['as' => 'getLastProjectID', 'uses' => 'ProjectController@getLastProjectID']);
        Route::post('/InsertProject', ['as' => 'InsertProject', 'uses' => 'ProjectController@InsertProject']);
        Route::post('/getProjectByid', ['as' => 'getProjectByid', 'uses' => 'ProjectController@getProjectByid']);
        Route::post('/updateProjectSetDefault', ['as' => 'updateProjectSetDefault', 'uses' => 'ProjectController@updateProjectSetDefault']);
        Route::post('/updateProject', ['as' => 'updateProject', 'uses' => 'ProjectController@updateProject']);
        Route::post('/DeleteProject', ['as' => 'DeleteProject', 'uses' => 'ProjectController@deleteProject']);
        Route::post('/getprojectnumberByidproject', ['as' => 'getprojectnumberByidproject', 'uses' => 'ProjectController@getprojectnumberByidproject']);
        Route::post('/getprojectnumberByidprojectContractor', ['as' => 'getprojectnumberByidprojectContractor', 'uses' => 'ProjectController@getprojectnumberByidprojectContractor']);
        Route::post('/getLastProjectnumber', ['as' => 'getLastProjectnumber', 'uses' => 'ProjectController@getLastProjectnumber']);
        Route::post('/deleteProjectNumber', ['as' => 'deleteProjectNumber', 'uses' => 'ProjectController@deleteProjectNumber']);
        Route::post('/addProjectNumber', ['as' => 'addProjectNumber', 'uses' => 'ProjectController@addProjectNumber']);
        Route::post('/addProjectNumberContractor', ['as' => 'addProjectNumberContractor', 'uses' => 'ProjectController@addProjectNumberContractor']);
        Route::post('/ProjectIDConsultant', ['as' => 'ProjectIDConsultant', 'uses' => 'ProjectController@ProjectIDConsultant']);
        Route::post('/ProjectIDContractor', ['as' => 'ProjectIDContractor', 'uses' => 'ProjectController@ProjectIDContractor']);
    });


    Route::group(array('prefix' => '', 'as' => 'masterdata'), function () {
        Route::post('/getTypeByid', ['as' => 'getTypeByid', 'uses' => 'MasterDataController@getTypeByid']);
        Route::post('/updateType', ['as' => 'updateType', 'uses' => 'MasterDataController@updateType']);
        Route::post('/addType', ['as' => 'addType', 'uses' => 'MasterDataController@addType']);
        Route::get('/getType', ['as' => 'getType', 'uses' => 'MasterDataController@getType']);
        Route::post('/deleteType', ['as' => 'deleteType', 'uses' => 'MasterDataController@deleteType']);
        Route::get('/business-type', ['as' => 'business_type', 'uses' => 'MasterDataController@business_type']);
        Route::get('/getTypeBytype', ['as' => 'getTypeBytype', 'uses' => 'MasterDataController@getTypeBytype']);


        Route::post('/addBusinessPartner', ['as' => 'addBusinessPartner', 'uses' => 'MasterDataController@addBusinessPartner']);
        Route::get('/getBusinessPartner', ['as' => 'getBusinessPartner', 'uses' => 'MasterDataController@getBusinessPartner']);
        Route::post('/getBusinessPartnerByid', ['as' => 'getBusinessPartnerByid', 'uses' => 'MasterDataController@getBusinessPartnerByid']);
        Route::post('/updateBusinessPartner', ['as' => 'updateBusinessPartner', 'uses' => 'MasterDataController@updateBusinessPartner']);
        Route::post('/deleteBusinessPartner', ['as' => 'deleteBusinessPartner', 'uses' => 'MasterDataController@deleteBusinessPartner']);
        Route::get('/getPartnerBytype', ['as' => 'getPartnerBytype', 'uses' => 'MasterDataController@getPartnerBytype']);
        Route::get('/business-partner', function () {
            return view('user_management/master_data_management/business-partner');
        });

        Route::post('/addPositionCategory', ['as' => 'addPositionCategory', 'uses' => 'MasterDataController@addPositionCategory']);
        Route::get('/getPositionCategory', ['as' => 'getPositionCategory', 'uses' => 'MasterDataController@getPositionCategory']);
        Route::post('/getPositionCategoryByid', ['as' => 'getPositionCategoryByid', 'uses' => 'MasterDataController@getPositionCategoryByid']);
        Route::post('/updatePositionCategory', ['as' => 'updatePositionCategory', 'uses' => 'MasterDataController@updatePositionCategory']);
        Route::post('/deletePositionCategory', ['as' => 'deletePositionCategory', 'uses' => 'MasterDataController@deletePositionCategory']);
        Route::post('/getMobilizationDateByBusinessPartner', ['as' => 'getMobilizationDateByBusinessPartner', 'uses' => 'MasterDataController@getMobilizationDateByBusinessPartner']);
        Route::get('/position-category', function () {
            return view('user_management/master_data_management/position-category');
        });

        Route::post('/addPosition', ['as' => 'addPosition', 'uses' => 'MasterDataController@addPosition']);
        Route::get('/getPosition', ['as' => 'getPosition', 'uses' => 'MasterDataController@getPosition']);
        Route::post('/getPositionByid', ['as' => 'getPositionByid', 'uses' => 'MasterDataController@getPositionByid']);
        Route::post('/updatePosition', ['as' => 'updatePosition', 'uses' => 'MasterDataController@updatePosition']);
        Route::post('/deletePosition', ['as' => 'deletePosition', 'uses' => 'MasterDataController@deletePosition']);
        Route::post('/getPositionbyPersonil', ['as' => 'getPositionbyPersonil', 'uses' => 'MasterDataController@getPositionbyPersonil']);
        Route::get('/position', function () {
            return view('user_management/master_data_management/position');
        });

        Route::post('/addHumanResources', ['as' => 'addHumanResources', 'uses' => 'MasterDataController@addHumanResources']);
        Route::get('/getHumanResources', ['as' => 'getHumanResources', 'uses' => 'MasterDataController@getHumanResources']);
        Route::post('/getHumanResourcesByid', ['as' => 'getHumanResourcesByid', 'uses' => 'MasterDataController@getHumanResourcesByid']);
        Route::post('/updateHumanResources', ['as' => 'updateHumanResources', 'uses' => 'MasterDataController@updateHumanResources']);
        Route::post('/deleteHumanResources', ['as' => 'deleteHumanResources', 'uses' => 'MasterDataController@deleteHumanResources']);
        Route::post('/getHumanResourcesbypartner', ['as' => 'getHumanResourcesbypartner', 'uses' => 'MasterDataController@getHumanResourcesbypartner']);
        Route::get('/getHumanResourcesbypartnerProject', ['as' => 'getHumanResourcesbypartnerProject', 'uses' => 'MasterDataController@getHumanResourcesbypartnerProject']);
        Route::get('/human-resources', function () {
            return view('user_management/master_data_management/human-resources');
        });

        Route::post('/addWeather', ['as' => 'addUnit', 'uses' => 'MasterDataController@addWeather']);
        Route::get('/getWeather', ['as' => 'getUnit', 'uses' => 'MasterDataController@getWeather']);
        Route::post('/getWeatherByid', ['as' => 'getUnitByid', 'uses' => 'MasterDataController@getWeatherByid']);
        Route::post('/updateWeather', ['as' => 'updateUnit', 'uses' => 'MasterDataController@updateWeather']);
        Route::post('/deleteWeather', ['as' => 'deleteUnit', 'uses' => 'MasterDataController@deleteWeather']);
        Route::get('/weather-conditions', function () {
            return view('user_management/master_data_management/weather-conditions');
        });

        Route::post('/addCountry', ['as' => 'addCountry', 'uses' => 'MasterDataController@addCountry']);
        Route::get('/getCountry', ['as' => 'getCountry', 'uses' => 'MasterDataController@getCountry']);
        Route::post('/getCountryByid', ['as' => 'getCountryByid', 'uses' => 'MasterDataController@getCountryByid']);
        Route::post('/updateCountry', ['as' => 'updateCountry', 'uses' => 'MasterDataController@updateCountry']);
        Route::get('/addCountrySeeder', ['as' => 'addCountrySeeder', 'uses' => 'MasterDataController@addCountrySeeder']);
        Route::post('/deleteCountry', ['as' => 'deleteCountry', 'uses' => 'MasterDataController@deleteCountry']);
        Route::get('/getLastInputCountry', ['as' => 'getLastInputCountry', 'uses' => 'MasterDataController@getLastInputCountry']);
        Route::get('/country', function () {
            return view('user_management/master_data_management/country');
        });

        Route::post('/addCity', ['as' => 'addCity', 'uses' => 'MasterDataController@addCity']);
        Route::get('/getCity', ['as' => 'getCity', 'uses' => 'MasterDataController@getCity']);
        Route::post('/getCityByid', ['as' => 'getCityByid', 'uses' => 'MasterDataController@getCityByid']);
        Route::post('/getCityByCountryId', ['as' => 'getCityByCountryId', 'uses' => 'MasterDataController@getCityByCountryId']);
        Route::post('/updateCity', ['as' => 'updateCity', 'uses' => 'MasterDataController@updateCity']);
        Route::post('/deleteCity', ['as' => 'deleteCity', 'uses' => 'MasterDataController@deleteCity']);
        Route::get('/city', function () {
            return view('user_management/master_data_management/city');
        });

        Route::post('/addCurrency', ['as' => 'addCurrency', 'uses' => 'MasterDataController@addCurrency']);
        Route::get('/getCurrency', ['as' => 'getCurrency', 'uses' => 'MasterDataController@getCurrency']);
        Route::post('/getCurrencyByid', ['as' => 'getCurrencyByid', 'uses' => 'MasterDataController@getCurrencyByid']);
        Route::post('/updateCurrency', ['as' => 'updateCurrency', 'uses' => 'MasterDataController@updateCurrency']);
        Route::post('/deleteCurrency', ['as' => 'deleteCurrency', 'uses' => 'MasterDataController@deleteCurrency']);
        Route::get('/currency', function () {
            return view('user_management/master_data_management/currency');
        });

        Route::post('/addUnit', ['as' => 'addUnit', 'uses' => 'MasterDataController@addUnit']);
        Route::get('/getUnit', ['as' => 'getUnit', 'uses' => 'MasterDataController@getUnit']);
        Route::post('/getUnitByid', ['as' => 'getUnitByid', 'uses' => 'MasterDataController@getUnitByid']);
        Route::post('/updateUnit', ['as' => 'updateUnit', 'uses' => 'MasterDataController@updateUnit']);
        Route::post('/deleteUnit', ['as' => 'deleteUnit', 'uses' => 'MasterDataController@deleteUnit']);
        Route::get('/units', function () {
            return view('user_management/master_data_management/units');
        });
        Route::get('/manage-user', function () {
            return view('user_management/user_management/manage-user');
        });

        Route::get('/progress-report', function () {
            return view('project_progress/progress-report');
        });

        Route::get('/progress-report-detail/{id}/{contractorID}', function ($id, $contractorID) {
            return view('project_progress/progress-report-detail', ['docID' => $id, 'contractorID' => $contractorID]);
        });

        Route::post('/addPrivileged', ['as' => 'addPrivileged', 'uses' => 'UserManagementController@addPrivileged']);
        Route::get('/getPrivileged', ['as' => 'getPrivileged', 'uses' => 'UserManagementController@getPrivileged']);
        Route::post('/getPrivilegedByid', ['as' => 'getPrivilegedByid', 'uses' => 'UserManagementController@getPrivilegedByid']);
        Route::post('/updatePrivileged', ['as' => 'updatePrivileged', 'uses' => 'UserManagementController@updatePrivileged']);
        Route::post('/deletePrivileged', ['as' => 'deletePrivileged', 'uses' => 'UserManagementController@deletePrivileged']);

        Route::post('/addPrivilegedName', ['as' => 'addPrivilegedName', 'uses' => 'UserManagementController@addPrivilegedName']);
        Route::get('/getPrivilegedName', ['as' => 'getPrivilegedName', 'uses' => 'UserManagementController@getPrivilegedName']);
        Route::post('/getPrivilegedNameByid', ['as' => 'getPrivilegedNameByid', 'uses' => 'UserManagementController@getPrivilegedNameByid']);
        Route::post('/updatePrivilegedName', ['as' => 'updatePrivilegedName', 'uses' => 'UserManagementController@updatePrivilegedName']);
        Route::post('/deleteProfile', ['as' => 'deleteProfile', 'uses' => 'UserManagementController@deleteProfile']);
        Route::get('/profile-group', function () {
            return view('user_management/user_management/profile-group');
        });

        Route::post('/addUser', ['as' => 'addUser', 'uses' => 'UserManagementController@addUser']);
        Route::get('/getUser', ['as' => 'getUser', 'uses' => 'UserManagementController@getUser']);
        Route::post('/getUserByid', ['as' => 'getUserByid', 'uses' => 'UserManagementController@getUserByid']);
        Route::post('/updateUser', ['as' => 'updateUser', 'uses' => 'UserManagementController@updateUser']);
        Route::post('/updateUserPassword', ['as' => 'updateUserPassword', 'uses' => 'UserManagementController@updateUserPassword']);
        Route::post('/deleteUser', ['as' => 'deleteUser', 'uses' => 'UserManagementController@deleteUser']);
        Route::post('/getUserPrivilegedByid', ['as' => 'getUserPrivilegedByid', 'uses' => 'UserManagementController@getUserPrivilegedByid']);

        Route::post('/addBoqParent', ['as' => 'addBoqParent', 'uses' => 'BoqController@addBoqParent']);
        Route::post('/addBoqChild', ['as' => 'addBoqChild', 'uses' => 'BoqController@addBoqChild']);
        Route::post('/getBoq', ['as' => 'getBoq', 'uses' => 'BoqController@getBoq']);
        Route::post('/getBoqLevel', ['as' => 'getBoqLevel', 'uses' => 'BoqController@getBoqLevel']);
        Route::get('/getBoqHistory', ['as' => 'getBoq', 'uses' => 'BoqController@getBoqHistory']);
        Route::post('/getBoqHistoryDetail', ['as' => 'getBoqHistoryDetail', 'uses' => 'BoqController@getBoqHistoryDetail']);
        Route::post('/getBoqchild', ['as' => 'getBoqchild', 'uses' => 'BoqController@getBoqchild']);
        Route::post('/importBoq', ['as' => 'importBoq', 'uses' => 'BoqController@importBoq']);
        Route::post('/recalculateWeightBoq', ['as' => 'recalculateWeightBoq', 'uses'=> 'BoqController@recalculateWeightBoq']);


        Route::post('/addActualWbsParent', ['as' => 'addActualWbsParent', 'uses' => 'WbsController@addActualWbsParent']);
        Route::post('/addActualWbsChild', ['as' => 'addActualWbsChild', 'uses' => 'WbsController@addActualWbsChild']);
        Route::post('/getActualWbs', ['as' => 'getActualWbs', 'uses' => 'WbsController@getActualWbs']);
        Route::post('/getActualWbsDetail', ['as' => 'getActualWbsDetail', 'uses' => 'WbsController@getActualWbsDetail']);
        Route::post('/getActualWbschild', ['as' => 'getActualWbschild', 'uses' => 'WbsController@getActualWbschild']);
        Route::post('/getActualWbschildHistory', ['as' => 'getActualWbschildHistory', 'uses' => 'WbsController@getActualWbschildHistory']);
        Route::post('/getActualWbsByid', ['as' => 'getActualWbsByid', 'uses' => 'WbsController@getActualWbsByid']);
        // Route::post('/generateBoq', ['as' => 'generateBoq', 'uses' => 'WbsController@generateBoq']);
        Route::post('/updateActualWbs', ['as' => 'updateActualWbs', 'uses' => 'WbsController@updateActualWbs']);
        Route::post('/deleteActualWbs', ['as' => 'deleteActualWbs', 'uses' => 'WbsController@deleteActualWbs']);
        Route::post('/getDetailActualWbsChild', ['as' => 'getDetailActualWbsChild', 'uses' => 'WbsController@getDetailActualWbsChild']);
        Route::post('/submitProgress', ['as' => 'submitProgress', 'uses' => 'WbsController@submitProgress']);
        Route::post('/deleteActualReport', ['as' => 'deleteActualReport', 'uses' => 'WbsController@deleteActualReport']);

        Route::post('/getBoqchildHistory', ['as' => 'getBoqchildHistory', 'uses' => 'BoqController@getBoqchildHistory']);
        Route::post('/getBoqByid', ['as' => 'getBoqByid', 'uses' => 'BoqController@getBoqByid']);
        Route::post('/generateBoq', ['as' => 'generateBoq', 'uses' => 'BoqController@generateBoq']);
        Route::post('/updateBoq', ['as' => 'updateBoq', 'uses' => 'BoqController@updateBoq']);
        Route::post('/updateBoqParent', ['as' => 'updateBoqParent', 'uses' => 'BoqController@updateBoqParent']);
        Route::post('/updateBoqChild', ['as' => 'updateBoqChild', 'uses' => 'BoqController@updateBoqChild']);
        Route::post('/deleteBoq', ['as' => 'deleteBoq', 'uses' => 'BoqController@deleteBoq']);

        Route::post('/addWbsParent', ['as' => 'addWbsParent', 'uses' => 'BaselineWbsController@addWbsParent']);
        Route::post('/addWbsChild', ['as' => 'addWbsChild', 'uses' => 'BaselineWbsController@addWbsChild']);
        Route::post('/getWbs', ['as' => 'getWbs', 'uses' => 'BaselineWbsController@getWbs']);
        Route::post('/getWbsLevel', ['as' => 'getWbsLevel', 'uses' => 'BaselineWbsController@getWbsLevel']);
        Route::post('/getWbsGantt', ['as' => 'getWbsGantt', 'uses' => 'BaselineWbsController@getWbsGantt']);
        Route::get('/getWbsHistory', ['as' => 'getWbsHistory', 'uses' => 'BaselineWbsController@getWbsHistory']);
        Route::post('/getWbsHistoryDetail', ['as' => 'getWbsHistoryDetail', 'uses' => 'BaselineWbsController@getWbsHistoryDetail']);
        Route::post('/getWbschild', ['as' => 'getWbschild', 'uses' => 'BaselineWbsController@getWbschild']);
        Route::post('/getWbschildHistory', ['as' => 'getWbschildHistory', 'uses' => 'BaselineWbsController@getWbschildHistory']);
        Route::post('/getWbsByid', ['as' => 'getWbsByid', 'uses' => 'BaselineWbsController@getWbsByid']);
        Route::post('/generateWbs', ['as' => 'generateWbs', 'uses' => 'BaselineWbsController@generateWbs']);
        Route::post('/updateWbs', ['as' => 'updateWbs', 'uses' => 'BaselineWbsController@updateWbs']);
        Route::post('/updateWbsChildDate', ['as' => 'updateWbsChildDate', 'uses' => 'BaselineWbsController@updateWbsChildDate']);
        Route::post('/updateWbsParent', ['as' => 'updateWbsParent', 'uses' => 'BaselineWbsController@updateWbsParent']);
        Route::post('/updateWbsChild', ['as' => 'updateWbsChild', 'uses' => 'BaselineWbsController@updateWbsChild']);
        Route::post('/deleteWbs', ['as' => 'deleteWbs', 'uses' => 'BaselineWbsController@deleteWbs']);
        Route::post('/importBaselineWbs', ['as' => 'importBaselineWbs', 'uses'=> 'BaselineWbsController@importBaselineWbs']);
        Route::post('/recalculateWeightWbs', ['as' => 'recalculateWeightWbs', 'uses'=> 'BaselineWbsController@recalculateWeightWbs']);

        Route::post('/addCurrentWbsParent', ['as' => 'addCurrentWbsParent', 'uses' => 'CurrentWbsController@addCurrentWbsParent']);
        Route::post('/addCurrentWbsChild', ['as' => 'addCurrentWbsChild', 'uses' => 'CurrentWbsController@addCurrentWbsChild']);
        Route::post('/getCurrentWbs', ['as' => 'getCurrentWbs', 'uses' => 'CurrentWbsController@getCurrentWbs']);
        Route::post('/getCurrentRescheduleWbs', ['as' => 'getCurrentRescheduleWbs', 'uses' => 'CurrentWbsController@getCurrentRescheduleWbs']);
        Route::post('/getCurrentWbsLevel', ['as' => 'getCurrentWbsLevel', 'uses' => 'CurrentWbsController@getCurrentWbsLevel']);
        Route::post('/getCurrentWbsGantt', ['as' => 'getCurrentWbsGantt', 'uses' => 'CurrentWbsController@getCurrentWbsGantt']);
        Route::get('/getCurrentWbsHistory', ['as' => 'getCurrentWbsHistory', 'uses' => 'CurrentWbsController@getCurrentWbsHistory']);
        Route::post('/getCurrentWbsHistoryDetail', ['as' => 'getCurrentWbsHistoryDetail', 'uses' => 'CurrentWbsController@getCurrentWbsHistoryDetail']);
        Route::post('/getCurrentWbschild', ['as' => 'getCurrentWbschild', 'uses' => 'CurrentWbsController@getCurrentWbschild']);
        Route::post('/getCurrentWbschildHistory', ['as' => 'getCurrentWbschildHistory', 'uses' => 'CurrentWbsController@getCurrentWbschildHistory']);
        Route::post('/getCurrentWbsByid', ['as' => 'getCurrentWbsByid', 'uses' => 'CurrentWbsController@getCurrentWbsByid']);
        Route::post('/rescheduleCurrentWbs', ['as' => 'rescheduleCurrentWbs', 'uses' => 'CurrentWbsController@rescheduleCurrentWbs']);
        Route::post('/updateCurrentWbs', ['as' => 'updateCurrentWbs', 'uses' => 'CurrentWbsController@updateCurrentWbs']);
        Route::post('/updateCurrentWbsChildDate', ['as' => 'updateCurrentWbsChildDate', 'uses' => 'CurrentWbsController@updateCurrentWbsChildDate']);
        Route::post('/updateCurrentWbsChildCost', ['as' => 'updateCurrentWbsChildCost', 'uses' => 'CurrentWbsController@updateCurrentWbsChildCost']);
        Route::post('/updateCurrentWbsParent', ['as' => 'updateCurrentWbsParent', 'uses' => 'CurrentWbsController@updateCurrentWbsParent']);
        Route::post('/updateCurrentWbsChild', ['as' => 'updateCurrentWbsChild', 'uses' => 'CurrentWbsController@updateCurrentWbsChild']);
        Route::post('/deleteCurrentWbs', ['as' => 'deleteCurrentWbs', 'uses' => 'CurrentWbsController@deleteCurrentWbs']);
        Route::post('/recalculateWeightCurrentWbs', ['as' => 'recalculateWeightCurrentWbs', 'uses'=> 'CurrentWbsController@recalculateWeightCurrentWbs']);

        Route::get('/profile-group', function () {
            return view('user_management/user_management/profile-group');
        });

        Route::post('/getDocument', ['as' => 'getDocument', 'uses' => 'WbsController@getDocument']);
        Route::post('/getParentItem', ['as' => 'getParentItem', 'uses' => 'StationProgressController@getParentItem']);
        Route::post('/getChildItem', ['as' => 'getChildItem', 'uses' => 'StationProgressController@getChildItem']);
        Route::post('/addStation', ['as' => 'addStation', 'uses' => 'StationProgressController@addStation']);
        Route::post('/addSubItem', ['as' => 'addSubItem', 'uses' => 'StationProgressController@addSubItem']);
        Route::post('/getStationData', ['as' => 'getStationData', 'uses' => 'StationProgressController@getStationData']);
        Route::post('/getSubItem', ['as' => 'getSubItem', 'uses' => 'StationProgressController@getSubItem']);
        Route::post('/getSubItemTableRow', ['as' => 'getSubItemTableRow', 'uses' => 'StationProgressController@getSubItemTableRow']);
        Route::post('/getSubItemStation', ['as' => 'getSubItemStation', 'uses' => 'StationProgressController@getSubItemStation']);
        Route::post('/editCompletion', ['as' => 'editCompletion', 'uses' => 'StationProgressController@editCompletion']);
        Route::post('/editStation', ['as' => 'editStation', 'uses' => 'StationProgressController@editStation']);
        Route::post('/deleteSub', ['as' => 'deleteUser', 'uses' => 'StationProgressController@deleteSub']);
        Route::post('/deleteItem', ['as' => 'deleteItem', 'uses' => 'StationProgressController@deleteItem']);
        Route::post('/stationDetail', ['as' => 'stationDetail', 'uses' => 'StationProgressController@stationDetail']);
        Route::post('/getCompletion', ['as' => 'getCompletion', 'uses' => 'StationProgressController@getCompletion']);

        Route::post('/getOtherVisualProgress', ['as' => 'getOtherVisualProgress', 'uses' => 'VisualProgressController@getOtherVisualProgress']);
        Route::post('/getVisualProgress', ['as' => 'getVisualProgress', 'uses' => 'VisualProgressController@getVisualProgress']);
        Route::post('/getVisualProgressDetail', ['as' => 'getVisualProgressDetail', 'uses' => 'VisualProgressController@getVisualProgressDetail']);
        Route::post('/addVisualProgress', ['as' => 'addVisualProgress', 'uses' => 'VisualProgressController@addVisualProgress']);
        Route::post('/addVisualImage', ['as' => 'addVisualImage', 'uses' => 'VisualProgressController@addVisualImage']);
        Route::post('/deleteImage', ['as' => 'deleteImage', 'uses' => 'VisualProgressController@deleteImage']);
        Route::post('/deleteVisual', ['as' => 'deleteVisual', 'uses' => 'VisualProgressController@deleteVisual']);
        Route::post('/editVisualProgress', ['as' => 'editVisualProgress', 'uses' => 'VisualProgressController@editVisualProgress']);
        Route::post('/editOtherVisualProgress', ['as' => 'editOtherVisualProgress', 'uses' => 'VisualProgressController@editOtherVisualProgress']);

        Route::post('/getOtherVisualProgressDetail', ['as' => 'getOtherVisualProgressDetail', 'uses' => 'VisualProgressController@getOtherVisualProgressDetail']);
        Route::post('/addOtherVisualProgress', ['as' => 'addOtherVisualProgress', 'uses' => 'VisualProgressController@addOtherVisualProgress']);
        Route::post('/addOtherVisualImage', ['as' => 'addOtherVisualImage', 'uses' => 'VisualProgressController@addOtherVisualImage']);
        Route::post('/deleteOtherImage', ['as' => 'deleteOtherImage', 'uses' => 'VisualProgressController@deleteOtherImage']);
        Route::post('/deleteOtherVisual', ['as' => 'deleteOtherVisual', 'uses' => 'VisualProgressController@deleteOtherVisual']);

        Route::post('/getPerformanceList', ['as' => 'getPerformanceList', 'uses' => 'PerformanceAnalysisController@getPerformanceList']);
        Route::post('/getPerformance', ['as' => 'getPerformance', 'uses' => 'PerformanceAnalysisController@getPerformance']);
        Route::post('/saveReport', ['as' => 'saveReport', 'uses' => 'PerformanceAnalysisController@saveReport']);
        Route::post('/getPrivilegedPage', ['as' => 'getPrivilegedPage', 'uses' => 'AuthController@getPrivilegedPage']);
        Route::post('/getPerformanceDetail', ['as' => 'getPerformanceDetail', 'uses' => 'PerformanceAnalysisController@getPerformanceDetail']);

        Route::post('/getContractor', ['as' => 'getContractor', 'uses' => 'MasterDataController@getContractor']);
        Route::post('/getWbsGantt', ['as' => 'getWbsGantt', 'uses' => 'BaselineWbsController@getWbsGantt']);
        Route::post('/getBaselineChart', ['as' => 'getBaselineChart', 'uses' => 'BaselineWbsController@getBaselineChart']);
        Route::post('/getCurrentWbsGantt', ['as' => 'getCurrentWbsGantt', 'uses' => 'CurrentWbsController@getCurrentWbsGantt']);
        Route::post('/getCurrentWbsChart', ['as' => 'getCurrentWbsChart', 'uses' => 'CurrentWbsController@getCurrentWbsChart']);
        Route::post('/getCurrentWbsChartProgress', ['as' => 'getCurrentWbsChartProgress', 'uses' => 'CurrentWbsController@getCurrentWbsChartProgress']);

        //Weather Info
        Route::get('/weather-info', 'WeatherInfoController@index');
        Route::post('/addWeatherInfo', 'WeatherInfoController@postData');
        Route::get('/getWeatherInfo', 'WeatherInfoController@getData');
        Route::post('/editWeatherInfo', 'WeatherInfoController@findData');
        Route::post('/updateWeatherInfo', 'WeatherInfoController@updateData');
        Route::post('/deleteWeather', 'WeatherInfoController@deleteData');

        //Issue Management
        Route::post('/addIssue', 'IssueManagementController@postData');
        Route::post('/getIssue', 'IssueManagementController@getData');
        Route::post('/editIssue', 'IssueManagementController@findData');
        Route::post('/updateIssue', 'IssueManagementController@updateData');
        Route::post('/deleteIssue', 'IssueManagementController@deleteData');

        Route::post('/getProjectManagerOwner', 'ProjectController@getProjectManagerOwner');
        Route::post('/getProjectOwner', 'ProjectController@getProjectOwner');

        //progress report
        Route::post('/getProjectDetail', ['as' => 'getProjectDetail', 'uses' => 'ProgressReportController@getProjectDetail']);
        Route::post('/getWorkProgress', ['as' => 'getWorkProgress', 'uses' => 'ProgressReportController@getWorkProgress']);
        Route::post('/getProgressStatus', ['as' => 'getProgressStatus', 'uses' => 'ProgressReportController@getProgressStatus']);
        Route::post('/getIssueReport', ['as' => 'getIssueReport', 'uses' => 'ProgressReportController@getIssue']);
        Route::post('/getIssueChart', ['as' => 'getIssueChart', 'uses' => 'ProgressReportController@getIssueChart']);
        Route::post('/getRiskReport', ['as' => 'getRiskReport', 'uses' => 'ProgressReportController@getRiskReport']);
        //Route::post('/getActualWbsDetail', ['as' => 'getActualWbsDetail', 'uses' => 'ProgressReportController@getActualWbsDetail']);
        Route::post('/monitoringCurve', ['as' => 'monitoringCurve', 'uses' => 'ProgressReportController@monitoringCurve']);
        Route::post('/monitoringTable', ['as' => 'monitoringTable', 'uses' => 'ProgressReportController@monitoringTable']);
        Route::post('/monitoringTable2', ['as' => 'monitoringTable2', 'uses' => 'ProgressReportController@monitoringTable2']);
        //monthly meeting
        Route::post('/addMeeting', 'MonthlyMeetingController@postData');
        Route::get('/getMeeting', 'MonthlyMeetingController@getData');
        Route::post('/editMeeting', 'MonthlyMeetingController@findData');
        Route::post('/updateMeeting', 'MonthlyMeetingController@updateData');
        Route::post('/deleteMeeting', 'MonthlyMeetingController@deleteData');

        //payment Certificate
        Route::post('/getPaymentCertificate', ['as' => 'getPaymentCertificate', 'uses' => 'PaymentCertificateController@getPaymentCertificate']);
        Route::post('/getPaymentList', ['as' => 'getPaymentList', 'uses' => 'PaymentCertificateController@getPaymentList']);
        Route::post('/getPaymentNonVAT', ['as' => 'getPaymentNonVAT', 'uses' => 'PaymentCertificateController@getPaymentNonVAT']);
        Route::post('/getPaymentVAT', ['as' => 'getPaymentVAT', 'uses' => 'PaymentCertificateController@getPaymentVAT']);
        Route::post('/getCertificateTitle', ['as' => 'getCertificateTitle', 'uses' => 'PaymentCertificateController@getCertificateTitle']);
        Route::post('/getPaymentListDetail', ['as' => 'getPaymentVAT', 'uses' => 'PaymentCertificateController@getPaymentVAT']);
        Route::post('/addItemNonVat', ['as' => 'addItemNonVat', 'uses' => 'PaymentCertificateController@addItemNonVat']);
        Route::post('/addItemVat', ['as' => 'addItemVat', 'uses' => 'PaymentCertificateController@addItemVat']);
        Route::post('/deleteDeductionItem', ['as' => 'deleteDeductionItem', 'uses' => 'PaymentCertificateController@deleteDeductionItem']);
        Route::post('/addPayment', ['as' => 'addPayment', 'uses' => 'PaymentCertificateController@addPayment']);
    
    
    });
});
    // Location
    Route::get('/getRegency', 'LocationController@getRegency');
    Route::get('/getDistrict/{regency_id}', 'LocationController@getDistrict');
    Route::get('/getVillage/{district_id}', 'LocationController@getVillage');
    Route::get('/getDataLocation/{village_id}', 'LocationController@getDataLocation');
    Route::get('/getWbsParentDuration/{id}', ['as' => 'getWbsParentDuration', 'uses' => 'BaselineWbsController@getWbsParentDuration']);
