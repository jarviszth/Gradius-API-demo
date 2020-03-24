<?php
/**
 * Created by PhpStorm.
 * User: Bekaku
 * Date: 29/12/2015
 * Time: 6:22 PM
 */

namespace application\controller;

use application\core\AppController as BaseController;
use application\util\DateUtils as DateUtils;
use application\util\FilterUtils as FilterUtil;
class DashBoardController extends BaseController
{
    private $INDEX_VIEW = 'backend/index';
    private $SOLAR_POWER_HOUSE_VIEW = 'powerHouseDetail';
    public function __construct($databaseConnection){
        $this->setDbConn($databaseConnection);
    }
    public function index(){

        $this->loadView($this->INDEX_VIEW, $this->pushDataToView);
    }
    public function jsonSolarIndex(){
        

        //top bar
        $return["today_val"] = "5555.00";
        $return["today_val"] = "5555.00";
        $return["after_cod"] = "1111.55";
        $return["performance_ratio"] = "11.00";
        $return["output_power_mw"] = "11.00";
        $return["output_power_percentage"] = "11.00";

        //Solar Plant 6MW
        $dateNow = DateUtils::getDateNow(true);
        $return["date_time"] = DateUtils::getThaiDate($dateNow,true,true);

        //OUTPUT POWER PLANT
        $return["power_real"] = "56";
        $return["power_calculator"] = "70";

        //POWER OUTPUT INVERTER
        $return["power_output_inverter_total"] = "9.999";
        $return["power_output_inverter_1"] = "111.0";
        $return["power_output_inverter_2"] = "111.0";
        $return["power_output_inverter_3"] = "111.0";
        $return["power_output_inverter_4"] = "111.0";
        $return["power_output_inverter_5"] = "111.0";
        $return["power_output_inverter_6"] = "111.0";

        //WEATER STATION
        $return["weater_solar_meter1"] = "11.00";
        $return["weater_solar_meter2"] = "11.00";
        $return["weater_solar_meter3"] = "99999999999.00";
        $return["weater_ambient_temp1"] = "11.00";
        $return["weater_ambient_temp2"] = "11.00";
        $return["weater_wind_speed1"] = "11.00";
        $return["weater_wind_speed2"] = "11.00";
        $return["weater_solar_temp1"] = "11.00";
        $return["weater_solar_temp2"] = "11.00";

        //RMU CIRCUIT STATION
        $return["rmuplant0"] = "1";
        $return["rmuplant1"] = "1";
        $return["rmuplant2"] = "1";
        $return["rmuplant3"] = "1";
        $return["rmuplant4"] = "1";
        $return["rmuplant5"] = "1";
        $return["rmuplant6"] = "1";



        echo json_encode($return);
//        $this->loadView($this->SOLAR_INDEX_VIEW, $this->pushDataToView);
    }
    public function powerHouseDetail(){

        $powerhouse = FilterUtil::filterGetInt('powerhouse');
        $this->pushDataToView['powerhouseNo'] = $powerhouse;
        $this->loadView($this->SOLAR_POWER_HOUSE_VIEW, $this->pushDataToView);
    }



    /*
     * json example
     *  php side
     *  $return["today_val"] = "5555.00";
        $return["after_cod"] = "1111.55";
        $return["performance_ratio"] = "11.00";
        $return["output_power_mw"] = "11.00";
        $return["output_power_percentage"] = "11.00";
        echo json_encode($return);


        client side
            $.ajax({
            type: "POST",
            dataType: "json",
            url: "ajaxindexsolarmonitor", //Relative or absolute path to response.php file
            success: function(feedback) {

                $("#today_val_id").html(feedback["today_val"]);
                $("#after_cod_id").html(feedback["after_cod"]);
                $("#performance_ratio_id").html(feedback["performance_ratio"]);
                $("#output_power_mw_id").html(feedback["output_power_mw"]);
                $("#output_power_percentage_id").html(feedback["output_power_percentage"]);
            }
        });



     */

}