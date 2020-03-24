<?php
/**
 * Created by PhpStorm.
 * User: Bekaku
 * Date: 29/12/2015
 * Time: 6:22 PM
 */

namespace application\controller;

use application\core\AppController as BaseController;
use application\util\AppUtil;
use application\util\ControllerUtil;
use application\util\FilterUtils;
use application\util\MessageUtils;
use application\util\UploadUtil;

class AdminController extends BaseController
{
    public function __construct($databaseConnection){
        $this->setDbConn($databaseConnection);
    }
    public function index(){
        echoln('Welcome to Admin Controller');
    }
    public function maintenances(){
        $path = __UPLOAD_PATH_FILES.'/db/';
        $fileArray=array();
        if ($handle = opendir($path)) {

            while (false !== ($entry = readdir($handle))) {

                if ($entry != "." && $entry != "..") {
                    array_push($fileArray,$entry);
                }
            }

            closedir($handle);
        }
        rsort($fileArray);
        $this->pushDataToView['file_array'] = $fileArray;
        $this->loadView("maintenances", $this->pushDataToView);
    }
    public function maintenancesDbBackup(){

       // $this->doBackup();
        $productionOs = MessageUtils::getConfig('production_os');
        if($productionOs=='windows'){
            $this->osWindowsBackup();
        }else{
            $this->osLinuxBackup();
        }
        //$this->loadView("maintenances", $this->pushDataToView);
    }
    private function osWindowsBackup(){
//        $this->pushDataToView['mysql_config'] = MessageUtils::getConfig('mysql');
//        $this->loadView("backend/backupDbWindows", $this->pushDataToView);

        ob_start();
        $mysqlConfig =  MessageUtils::getConfig('mysql');
        $dbhost = $mysqlConfig['host'];
        $dbname = $mysqlConfig['database'];
        $dbuser = $mysqlConfig['username'];
        $dbpass = $mysqlConfig['password'];
        $dbport = $mysqlConfig['port'];

        $backupFile = $dbname.date("Y-m-d-H-i-s") . '.sql';
        # Use system functions: MySQLdump & GZIP to generate compressed backup file
        if(!AppUtil::isEmpty($dbpass)) {
            $command = "mysqldump -P " . $dbport . " -u" . $dbuser . " -p" . $dbpass . " -h" . $dbhost . " " . $dbname . " >$backupFile";
        }else{
            $command = "mysqldump -P " . $dbport . " -u" . $dbuser . " -h" . $dbhost . " " . $dbname . " >$backupFile";
        }
        system($command);
        # Start the download process
        $len = filesize($backupFile);
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Type: application/gzip");
        header("Content-Disposition: attachment; filename=$backupFile;");
        header("Content-Transfer-Encoding: binary");
        header("Content-Length: ".$len);
        @readfile($backupFile);
        # Delete the temporary backup file from server
        unlink($backupFile);
        /*$backupFile = $dbname . date("Y-m-d-H-i-s") . '.sql';
        //$command = "mysqldump -h $dbhost -u $dbuser -p $dbpass $dbname> $backupFile";
        $command = "mysqldump -uroot -hlocalhost radius2>$backupFile";
        system($command);*/
//        $success ="Export database Success!!!";
    }
    private function osLinuxBackup(){

        $mysqlConfig = MessageUtils::getConfig('mysql');
        $dbhost = $mysqlConfig['host'];
        $dbname = $mysqlConfig['database'];
        $dbuser = $mysqlConfig['username'];
        $dbpass = $mysqlConfig['password'];
        $dbport = $mysqlConfig['port'];

        $path = __UPLOAD_PATH_FILES.'/db/';

        $backupFile = $dbname.'_'.date("Y-m-d-H-i-s") . '.sql';
        //Export the database and output the status to the page
        if(!AppUtil::isEmpty($dbpass)) {
            $command = 'mysqldump -P ' . $dbport . ' -h' . $dbhost . ' -u' . $dbuser . ' -p' . $dbpass . ' ' . $dbname . ' > ' . $path . $backupFile;
        }else{
            $command = 'mysqldump -P ' . $dbport . ' -h' . $dbhost . ' -u' . $dbuser . ' ' . $dbname . ' > ' . $path . $backupFile;
        }
        //echo $command;
        @exec($command,$output=array(),$worked);
        switch($worked){
            case 0:
                echo 'Backup Sucessfully';
                //                header( 'Location: '.'../../../?m=maintenances&resault=ok' ) ;
                break;
            case 1:
                echo 'There was a warning during the export of '
                         .$dbname .'
                         ~/' .$backupFile ;
                break;
            case 2:
                echo 'There was an error during export. Please check your values: 
                                   MySQL Database Name: ' .$dbname .'
                                   MySQL User Name: ' .$dbuser .'
                                   MySQL Password: NOTSHOWN 
                                   MySQL Host Name: ' .$dbhost .'';
                break;
        }
    }

    public function maintenancesDbDownload()
    {
        $fileName = FilterUtils::filterGetString('_db');
        $path =  __UPLOAD_PATH_FILES.'/db/'.$fileName;
        UploadUtil::downloadFileFromPath($path);
    }
    public function maintenancesDbDelete()
    {
        $fileName = FilterUtils::filterGetString('_db');
        $path =  __UPLOAD_PATH_FILES.'/db/'.$fileName;
        AppUtil::doDelfileFromPath($path);
//        v_goto(_BASEURL.'maintenances');
    }
    public function maintenancesDbRestoreForm(){
        $this->loadView("backend/backupDbRestore", $this->pushDataToView);
    }
    public function maintenancesDbRestoreProcess(){

        $isOk = true;
        if(!is_uploaded_file($_FILES['f1']['tmp_name'])){
            $isOk = false;
            ControllerUtil::setErrorMessage("กรุณาเลือกไฟล์ SQL ");
        }else{
            $isFileExcelTemp = $_FILES['f1']['name'];
            $isFileExcelTemp = explode(".", $isFileExcelTemp);
            $isFileExcelTemp = $isFileExcelTemp[1];
            if($isFileExcelTemp !="SQL" && $isFileExcelTemp !="sql" ){
                $isOk = false;
                ControllerUtil::setErrorMessage("ไฟล์ที่เลือกไม่ใช่ sql กรุณาตรวจสอบ ");
            }
        }

        if($isOk){
            $mysqlConfig = MessageUtils::getConfig('mysql');
            $dbhost = $mysqlConfig['host'];
            $dbname = $mysqlConfig['database'];
            $dbuser = $mysqlConfig['username'];
            $dbpass = $mysqlConfig['password'];
            $dbport = $mysqlConfig['port'];

            if(!AppUtil::isEmpty($dbpass)){
                $command = "mysql -u".$dbuser." -p".$dbpass." -h".$dbhost." -P".$dbport." ".$dbname."<".$_FILES['f1']['tmp_name'];
            }else{
                $command = "mysql -u".$dbuser." -h".$dbhost." -P".$dbport." ".$dbname."<".$_FILES['f1']['tmp_name'];
            }


            system($command);
            ControllerUtil::setSuccessMessage("Restore ฐานข้อมูลสำเร็จ");
        }

        $this->loadView("backend/backupDbRestore", $this->pushDataToView);
    }
    /* radius test from php 
     * $output = exec('radtest visa 123456 localhost 1812 testing123');
	    echo $output;
     */
    public function stopFreeRadius(){
        $command = 'service freeradius stop';
        @exec($command);
    }
    public function startFreeRadius(){
        $command = 'service freeradius start';
        @exec($command);
    }
    public function reStartFreeRadius(){
        $command = 'service freeradius restart';
        @exec($command);
    }
}