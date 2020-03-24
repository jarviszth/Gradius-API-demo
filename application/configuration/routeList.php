<?php
return array(
    /* Test Contronller*/
    array("methodType" => "GET", "url" => "test", "controller" => "Test", "action"  => "index", "permission" => null),
    /*
    |--------------------------------------------------------------------------
    | Dash Board Controller
    |--------------------------------------------------------------------------
    */
    array("methodType" => "GET", "url" => "dashboard", "controller" => "DashBoard", "action"  => "index", "permission"  => null),
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    */
    array("methodType" => "GET", "url" => "login", "controller" => "Login", "action"  => "index", "permission"  => null),
    array("methodType" => "POST", "url" => "login", "controller" => "Login", "action"  => "loginAction", "permission"  => null),
    array("methodType" => "GET", "url" => "logout", "controller" => "Login", "action"  => "logoutAction", "permission"  => null),
    /*
    |--------------------------------------------------------------------------
    | AppTable Controller
    |--------------------------------------------------------------------------
    */
    array("methodType" => "GET", "url" => "apptablelist", "controller" => "AppTable", "action"  => "crudList", "permission"  => null),
    array("methodType" => "GET", "url" => "apptableadd", "controller" => "AppTable", "action"  => "crudAdd", "permission"  => null),
    array("methodType" => "POST", "url" => "apptableadd", "controller" => "AppTable", "action"  => "crudAddProcess", "permission"  => null),
    array("methodType" => "GET", "url" => "apptabledelete", "controller" => "AppTable", "action"  => "crudDelete", "permission"  => null),
    array("methodType" => "GET", "url" => "apptableedit", "controller" => "AppTable", "action"  => "crudEdit", "permission"  => null),
    array("methodType" => "POST", "url" => "apptableedit", "controller" => "AppTable", "action"  => "crudEditProcess", "permission"  => null),
    /*
    |--------------------------------------------------------------------------
    | AppPermissionController Controller
    |--------------------------------------------------------------------------
    */
    array("methodType" => "GET", "url" => "apppermissionlist", "controller" => "AppPermission", "action"  => "crudList", "permission"  => null),
    array("methodType" => "GET", "url" => "apppermissionadd", "controller" => "AppPermission", "action"  => "crudAdd", "permission"  => null),
    array("methodType" => "POST", "url" => "apppermissionadd", "controller" => "AppPermission", "action"  => "crudAddProcess", "permission"  => null),
    array("methodType" => "GET", "url" => "apppermissiondelete", "controller" => "AppPermission", "action"  => "crudDelete", "permission"  => null),
    array("methodType" => "GET", "url" => "apppermissionedit", "controller" => "AppPermission", "action"  => "crudEdit", "permission"  => null),
    array("methodType" => "POST", "url" => "apppermissionedit", "controller" => "AppPermission", "action"  => "crudEditProcess", "permission"  => null),
    /*
    |--------------------------------------------------------------------------
    | AppUserRole Controller
    |--------------------------------------------------------------------------
    */
    array("methodType" => "GET", "url" => "appuserrolelist", "controller" => "AppUserRole", "action"  => "crudList", "permission"  => null),
    array("methodType" => "GET", "url" => "appuserroleadd", "controller" => "AppUserRole", "action"  => "crudAdd", "permission"  => null),
    array("methodType" => "POST", "url" => "appuserroleadd", "controller" => "AppUserRole", "action"  => "crudAddProcess", "permission"  => null),
    array("methodType" => "GET", "url" => "appuserroledelete", "controller" => "AppUserRole", "action"  => "crudDelete", "permission"  => null),
    array("methodType" => "GET", "url" => "appuserroleedit", "controller" => "AppUserRole", "action"  => "crudEdit", "permission"  => null),
    array("methodType" => "POST", "url" => "appuserroleedit", "controller" => "AppUserRole", "action"  => "crudEditProcess", "permission"  => null),
    array("methodType" => "GET", "url" => "appuserrolepermission", "controller" => "AppUserRole", "action"  => "rolePermission", "permission"  => null),
    array("methodType" => "POST", "url" => "appuserrolepermission", "controller" => "AppUserRole", "action"  => "rolePermissionProcess", "permission"  => null),
    /*
    |--------------------------------------------------------------------------
    | AppUser Controller
    |--------------------------------------------------------------------------
    */
    array("methodType" => "GET", "url" => "appuserlist", "controller" => "AppUser", "action"  => "crudList", "permission"  => null),
    array("methodType" => "GET", "url" => "appuserview", "controller" => "AppUser", "action"  => "crudView", "permission"  => null),
    array("methodType" => "GET", "url" => "appuseradd", "controller" => "AppUser", "action"  => "crudAdd", "permission"  => null),
    array("methodType" => "POST", "url" => "appuseradd", "controller" => "AppUser", "action"  => "crudAddProcess", "permission"  => null),
    array("methodType" => "GET", "url" => "appuseredit", "controller" => "AppUser", "action"  => "crudEdit", "permission"  => null),
    array("methodType" => "POST", "url" => "appuseredit", "controller" => "AppUser", "action"  => "crudEditProcess", "permission"  => null),
    array("methodType" => "GET", "url" => "appuserchangepwd", "controller" => "AppUser", "action"  => "changePassForm", "permission"  => null),
    array("methodType" => "POST", "url" => "appuserchangepwd", "controller" => "AppUser", "action"  => "changePassProcess", "permission"  => null),
    array("methodType" => "GET", "url" => "appuserdelete", "controller" => "AppUser", "action"  => "crudDelete", "permission"  => null),
    /*
    |--------------------------------------------------------------------------
    | AppGeography Controller
    |--------------------------------------------------------------------------
    */
    array("methodType" => "GET", "url" => "appgeographylist", "controller" => "AppGeography", "action"  => "crudList", "permission"  => null),
    array("methodType" => "GET", "url" => "appgeographyadd", "controller" => "AppGeography", "action"  => "crudAdd", "permission"  => null),
    array("methodType" => "POST", "url" => "appgeographyadd", "controller" => "AppGeography", "action"  => "crudAddProcess", "permission"  => null),
    array("methodType" => "GET", "url" => "appgeographydelete", "controller" => "AppGeography", "action"  => "crudDelete", "permission"  => null),
    array("methodType" => "GET", "url" => "appgeographyedit", "controller" => "AppGeography", "action"  => "crudEdit", "permission"  => null),
    array("methodType" => "POST", "url" => "appgeographyedit", "controller" => "AppGeography", "action"  => "crudEditProcess", "permission"  => null),
    /*
    |--------------------------------------------------------------------------
    | AppProvince Controller
    |--------------------------------------------------------------------------
    */
    array("methodType" => "GET", "url" => "appprovincelist", "controller" => "AppProvince", "action"  => "crudList", "permission"  => null),
    array("methodType" => "GET", "url" => "appprovinceadd", "controller" => "AppProvince", "action"  => "crudAdd", "permission"  => null),
    array("methodType" => "POST", "url" => "appprovinceadd", "controller" => "AppProvince", "action"  => "crudAddProcess", "permission"  => null),
    array("methodType" => "GET", "url" => "appprovincedelete", "controller" => "AppProvince", "action"  => "crudDelete", "permission"  => null),
    array("methodType" => "GET", "url" => "appprovinceedit", "controller" => "AppProvince", "action"  => "crudEdit", "permission"  => null),
    array("methodType" => "POST", "url" => "appprovinceedit", "controller" => "AppProvince", "action"  => "crudEditProcess", "permission"  => null),
    /*
    |--------------------------------------------------------------------------
    | AppAmphur Controller
    |--------------------------------------------------------------------------
    */
    array("methodType" => "GET", "url" => "appamphurlist", "controller" => "AppAmphur", "action"  => "crudList", "permission"  => null),
    array("methodType" => "GET", "url" => "appamphuradd", "controller" => "AppAmphur", "action"  => "crudAdd", "permission"  => null),
    array("methodType" => "POST", "url" => "appamphuradd", "controller" => "AppAmphur", "action"  => "crudAddProcess", "permission"  => null),
    array("methodType" => "GET", "url" => "appamphurdelete", "controller" => "AppAmphur", "action"  => "crudDelete", "permission"  => null),
    array("methodType" => "GET", "url" => "appamphuredit", "controller" => "AppAmphur", "action"  => "crudEdit", "permission"  => null),
    array("methodType" => "POST", "url" => "appamphuredit", "controller" => "AppAmphur", "action"  => "crudEditProcess", "permission"  => null),
    /*
    |--------------------------------------------------------------------------
    | AppDistrict Controller
    |--------------------------------------------------------------------------
    */
    array("methodType" => "GET", "url" => "appdistrictlist", "controller" => "AppDistrict", "action"  => "crudList", "permission"  => null),
    array("methodType" => "GET", "url" => "appdistrictadd", "controller" => "AppDistrict", "action"  => "crudAdd", "permission"  => null),
    array("methodType" => "POST", "url" => "appdistrictadd", "controller" => "AppDistrict", "action"  => "crudAddProcess", "permission"  => null),
    array("methodType" => "GET", "url" => "appdistrictdelete", "controller" => "AppDistrict", "action"  => "crudDelete", "permission"  => null),
    array("methodType" => "GET", "url" => "appdistrictedit", "controller" => "AppDistrict", "action"  => "crudEdit", "permission"  => null),
    array("methodType" => "POST", "url" => "appdistrictedit", "controller" => "AppDistrict", "action"  => "crudEditProcess", "permission"  => null),



    //Application Route

    /*
    |--------------------------------------------------------------------------
    | ProductType Controller
    |--------------------------------------------------------------------------
    */
    array("methodType" => "GET", "url" => "producttypelist", "controller" => "ProductType", "action"  => "crudList", "permission"  => null),
    array("methodType" => "GET", "url" => "producttypeadd", "controller" => "ProductType", "action"  => "crudAdd", "permission"  => null),
    array("methodType" => "POST", "url" => "producttypeadd", "controller" => "ProductType", "action"  => "crudAddProcess", "permission"  => null),
    array("methodType" => "GET", "url" => "producttypedelete", "controller" => "ProductType", "action"  => "crudDelete", "permission"  => null),
    array("methodType" => "GET", "url" => "producttypeedit", "controller" => "ProductType", "action"  => "crudEdit", "permission"  => null),
    array("methodType" => "POST", "url" => "producttypeedit", "controller" => "ProductType", "action"  => "crudEditProcess", "permission"  => null),
    /*
    |--------------------------------------------------------------------------
    | ProductUnit Controller
    |--------------------------------------------------------------------------
    */
    array("methodType" => "GET", "url" => "list", "controller" => "ProductUnit", "action"  => "crudList", "permission"  => null),
    array("methodType" => "GET", "url" => "add", "controller" => "ProductUnit", "action"  => "crudAdd", "permission"  => null),
    array("methodType" => "POST", "url" => "add", "controller" => "ProductUnit", "action"  => "crudAddProcess", "permission"  => null),
    array("methodType" => "GET", "url" => "delete", "controller" => "ProductUnit", "action"  => "crudDelete", "permission"  => null),
    array("methodType" => "GET", "url" => "edit", "controller" => "ProductUnit", "action"  => "crudEdit", "permission"  => null),
    array("methodType" => "POST", "url" => "edit", "controller" => "ProductUnit", "action"  => "crudEditProcess", "permission"  => null),
    /*
    |--------------------------------------------------------------------------
    | Products Controller
    |--------------------------------------------------------------------------
    */
    array("methodType" => "GET", "url" => "productslist", "controller" => "Products", "action"  => "crudList", "permission"  => null),
    array("methodType" => "GET", "url" => "productsadd", "controller" => "Products", "action"  => "crudAdd", "permission"  => null),
    array("methodType" => "POST", "url" => "productsadd", "controller" => "Products", "action"  => "crudAddProcess", "permission"  => null),
    array("methodType" => "GET", "url" => "productsdelete", "controller" => "Products", "action"  => "crudDelete", "permission"  => null),
    array("methodType" => "GET", "url" => "productsedit", "controller" => "Products", "action"  => "crudEdit", "permission"  => null),
    array("methodType" => "POST", "url" => "productsedit", "controller" => "Products", "action"  => "crudEditProcess", "permission"  => null),
    /*
    |--------------------------------------------------------------------------
    | Student Controller
    |--------------------------------------------------------------------------
    */
    array("methodType" => "GET", "url" => "studentlist", "controller" => "Student", "action"  => "crudList", "permission"  => null),
    array("methodType" => "GET", "url" => "studentadd", "controller" => "Student", "action"  => "crudAdd", "permission"  => null),
    array("methodType" => "POST", "url" => "studentadd", "controller" => "Student", "action"  => "crudAddProcess", "permission"  => null),
    array("methodType" => "GET", "url" => "studentdelete", "controller" => "Student", "action"  => "crudDelete", "permission"  => null),
    array("methodType" => "GET", "url" => "studentedit", "controller" => "Student", "action"  => "crudEdit", "permission"  => null),
    array("methodType" => "POST", "url" => "studentedit", "controller" => "Student", "action"  => "crudEditProcess", "permission"  => null),
    array("methodType" => "GET", "url" => "topupmoney", "controller" => "Student", "action"  => "studentTopupMoney", "permission"  => null),
    /*
    |--------------------------------------------------------------------------
    | ProductsSales Controller
    |--------------------------------------------------------------------------
    */
    array("methodType" => "GET", "url" => "productssaleslist", "controller" => "ProductsSales", "action"  => "crudList", "permission"  => null),
    array("methodType" => "GET", "url" => "productssalesadd", "controller" => "ProductsSales", "action"  => "crudAdd", "permission"  => null),
    array("methodType" => "POST", "url" => "productssalesadd", "controller" => "ProductsSales", "action"  => "crudAddProcess", "permission"  => null),
    array("methodType" => "GET", "url" => "productssalesdelete", "controller" => "ProductsSales", "action"  => "crudDelete", "permission"  => null),
    array("methodType" => "GET", "url" => "productssalesedit", "controller" => "ProductsSales", "action"  => "crudEdit", "permission"  => null),
    array("methodType" => "POST", "url" => "productssalesedit", "controller" => "ProductsSales", "action"  => "crudEditProcess", "permission"  => null),
    array("methodType" => "GET", "url" => "possales", "controller" => "ProductsSales", "action"  => "loadPosPage", "permission"  => null),
    /*
    |--------------------------------------------------------------------------
    | Ajax
    |--------------------------------------------------------------------------
    */
    array("methodType" => "POST", "url" => "ajaxprovinceonchangeamphur", "controller" => "AppAmphur", "action"  => "onChangeAmphurByProvince", "permission"  => null),
    array("methodType" => "POST", "url" => "ajaxamphuronchangedistrict", "controller" => "AppDistrict", "action"  => "onChangeDistrictByAmphur", "permission"  => null),
    array("methodType" => "POST", "url" => "ajaxtopupsearchstudent", "controller" => "Student", "action"  => "ajaxTopupSearchStudent", "permission"  => null),
    array("methodType" => "POST", "url" => "ajaxtopupsave", "controller" => "Student", "action"  => "ajaxTopupSave", "permission"  => null),
    array("methodType" => "POST", "url" => "ajaxadditemtosales", "controller" => "ProductsSales", "action"  => "ajaxAddItemToSales", "permission"  => null),
    array("methodType" => "POST", "url" => "ajaxadditemtosalescancleall", "controller" => "ProductsSales", "action"  => "ajaxAddItemToSalesCancleAll", "permission"  => null),



    /* Public */
    /*
    |--------------------------------------------------------------------------
    | Home Controller
    |--------------------------------------------------------------------------
    */
    array("methodType" => "GET", "url" => "home", "controller" => "Home", "action"  => "index", "permission"  => null),
);