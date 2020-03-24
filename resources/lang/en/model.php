<?php
return array(
    /*
    |--------------------------------------------------------------------------
    | app_user
    |--------------------------------------------------------------------------
    */
    'model_app_user' => 'User',
    'model_appuser_username' => 'User name',
    'model_appuser_email' => 'Email',
    'model_appuser_password' => 'password',
    'model_appuser_confirmpwd' => 'Confirm Password',
    'model_appuser_password_change' => 'Change Password',
    /*
    |--------------------------------------------------------------------------
    | app_table
    |--------------------------------------------------------------------------
    */
    'model_app_table' => 'App Table',
    'model_app_table_app_table_name' => 'Table Name',
    'model_app_table_description' => 'Detail',
    /*
    |--------------------------------------------------------------------------
    | app_user_role
    |--------------------------------------------------------------------------
    */
    'model_app_user_role' => 'User Group',
    'model_app_user_role_name' => 'User Group Name',
    'model_app_user_role_description' => 'Detail',
    /*
    |--------------------------------------------------------------------------
    | app_permission
    |--------------------------------------------------------------------------
    */
    'model_app_permission' => 'Permission',
    'model_app_permission_name' => 'Permission Name',
    'model_app_permission_description' => 'Detail',
    /*
    |--------------------------------------------------------------------------
    | app_geography
    |--------------------------------------------------------------------------
    */
    'model_app_geography' => 'ภาค',
    'model_app_geography_name' => 'ภาค',
    'model_app_geography_name_eng' => 'ภาค(English)',
    /*
    |--------------------------------------------------------------------------
    | app_province
    |--------------------------------------------------------------------------
    */
    'model_app_province' => 'จังหวัด',
    'model_app_province_code' => 'รหัส',
    'model_app_province_name' => 'จังหวัด',
    'model_app_province_name_eng' => 'จังหวัด(English)',
    'model_app_province_app_geography' => 'ภาค',
    /*
    |--------------------------------------------------------------------------
    | app_amphur
    |--------------------------------------------------------------------------
    */
    'model_app_amphur' => 'อำเภอ/เขต',
    'model_app_amphur_code' => 'รหัส',
    'model_app_amphur_name' => 'อำเภอ/เขต',
    'model_app_amphur_name_eng' => 'อำเภอ(English)',
    'model_app_amphur_app_province' => 'จังหวัด',
    /*
    |--------------------------------------------------------------------------
    | app_district
    |--------------------------------------------------------------------------
    */
    'model_app_district' => 'ตำบล/แขวง',
    'model_app_district_code' => 'รหัส',
    'model_app_district_name' => 'ตำบล/แขวง',
    'model_app_district_zipcode' => 'รหัสไปรษณีย์',
    'model_app_district_app_amphur' => 'อำเภอ/เขต',


    /*#################### Custom App Model Message ###################*/


    /*
    |--------------------------------------------------------------------------
    |
    |--------------------------------------------------------------------------
    */

    'model_cnf_radius' => 'Config Radius Server',
    'model_cnf_radius_ip_radius' => 'IP radius server',
    'model_cnf_radius_secrete_redius' => 'Shared secret',
    'app_setting_radius_server' => 'Config Radius Server',
    'app_setting_radius_client' => 'Config Radius Client',

    'model_nas' => 'Radius Client',
    'model_nas_nasname' => 'Client ip',
    'model_nas_shortname' => 'Client name',
    'model_nas_type' => 'Type',
    'model_nas_ports' => 'Ports',
    'model_nas_secret' => 'Secret key',
    'model_nas_server' => 'Server',
    'model_nas_community' => 'Comunity',
    'model_nas_description' => 'Description',
    'model_nas_nasname_hint' => 'ip address radius clients for example : 192.168.1.1',
    'model_nas_shortname_hint' => 'name radius clients for connect to radius server',
    'model_nas_type_hint' => 'type radius clients',
    'model_nas_ports_hint' => 'radius clients port authentication 1812',
    'model_nas_secret_hint' => 'shared secret radius clients ',
    'model_nas_server_hint' => 'Server',
    'model_nas_community_hint' => 'Comunity',
    'model_nas_description_hint' => 'Description',


    'model_username_role' => 'Username Rule',
    'model_username_role_name_lenght' => 'Username Length',
    'model_username_role_mix_no' => 'Number And Characters',
    'model_username_role_special_char' => 'Mix Extra Characters',

    'model_pass_role' => 'Password Rule',
    'model_pass_role_pass_lenght' => 'Password Length',
    'model_pass_role_mix_no' => 'Number And Characters',
    'model_pass_role_special_char' => 'Mix Extra Characters',

    'model_attribute_all' => 'Radius Attribute',
    'model_attribute_all_attribute' => 'Attribute Name',
    'model_attribute_all_df_value' => 'Default',
    'model_attribute_all_attribute_name' => 'Detail',
    'model_attribute_all_type_value' => 'Attribute Type',
    'model_attribute_all_type_checkreply' => 'Attribute Category',

    'model_radgroup_detail' => 'Price Plan',
    'model_radgroup_detail_title' => 'Manage Group',
    'model_radgroup_detail_attribute_manage' => 'Attribute Manage',
    'model_radgroup_detail_groupname' => 'Plan Name',
    'model_radgroup_detail_group_detail' => 'Detail',
    'model_radgroup_detail_start_ip' => 'Start Ip',
    'model_radgroup_detail_end_id' => 'End Ip',
    'model_radgroup_detail_created_date' => 'Created',

    'model_radgroupcheckreply_attribute' => 'Module',
    'model_radgroupcheckreply_op' => 'Op',
    'model_radgroupcheckreply_value' => 'Value',

    'model_help_type_text' => 'Please type in the text.',
    'model_help_type_number' => 'Please type only numbers.',
    'model_help_type_second' => 'Please enter the number in the format. Day: Hours: minutes like 01:24:59 (one day: twenty four hours: fifty-nine minutes)',
    'model_help_type_date' => 'Please select a date.',
    'model_help_type_null' => 'Please select a module first.',
    'model_help_type_null_value' => 'Please configure it in the Value field.',

    'model_account' => 'User',
    'model_account_maunal' => 'User list',
    'model_account_batch' => 'Batch',
    'model_account_excel' => 'Excel Loader',
    'model_account_excel_template' => 'Click here to download Excel Template.',
    'model_account_excel_choose' => 'Choose Excel',
    'model_account_excel_choose_null' => 'Please select an Excel file with .xlsx extension.',
    'model_account_excel_choose_wrong' => 'Invalid Excel file format.',
    'model_account_excel_allrec' => 'The total number',
    'model_account_excel_allrec_add' => 'Add Successfully',
    'model_account_excel_allrec_fail' => 'Can not add',
    'model_account_excel_advice' => 'Suggestion',
    'model_account_img_name' => 'Image',
    'model_account_user_name' => 'User Name',
    'model_account_name' => 'Name',
    'model_account_fullname' => 'Name-Surname',
    'model_account_lastname' => 'Surname',
    'model_account_radusergroup_detail' => 'Price Plan',
    'model_account_id_card' => 'ID Card',
    'model_account_email' => 'Email',
    'model_account_phonenumber' => 'Phone Number',
    'model_account_status' => 'Status',
    'model_account_all' => 'All User List',
    'model_account_online' => 'Online',
    'model_account_offline' => 'Offline',

    'model_account_group_user' => 'List of users in this group',


    'model_msg_welcome' => 'Welcome To Radius Management system',
    'model_msg_systemname' => 'Radius Management system',
    'model_log_list' => 'Logs',
    'model_maintenances' => 'Maintenances',


    /*
    |--------------------------------------------------------------------------
    | batch
    |--------------------------------------------------------------------------
    */
    'model_batch' => 'Account Batch',
    'model_batch_id' => 'id',
    'model_batch_batch_name' => 'Batch Name',
    'model_batch_description' => 'Description',
    'model_batch_volume' => 'Account Volume',
    'model_batch_create_date' => 'Created Date',
    'model_batch_active' => 'Status',
    'model_batch_radusergroup_detail' => 'Group',
    'model_batch_created_user' => 'created_user',
    'model_batch_created_date' => 'created_date',
    'model_batch_updated_user' => 'updated_user',
    'model_batch_updated_date' => 'updated_date',

    /*
   |--------------------------------------------------------------------------
   | batch_user
   |--------------------------------------------------------------------------
   */
    'model_batch_user' => 'Batch User',
    'model_batch_user_id' => 'id',
    'model_batch_user_batch' => 'Batch',
    'model_batch_user_account' => 'Account',
    'model_batch_user_user_name' => 'Username',
    'model_batch_user_password' => 'Password',
    'model_batch_user_start_date' => 'Start Date',
    'model_batch_user_expired_date' => 'Expired Date',
    'model_batch_user_status' => 'Status',
    'model_batch_user_rate_limit' => 'rate_limit',
    'model_batch_user_created_user' => 'created_user',
    'model_batch_user_created_date' => 'created_date',
    'model_batch_user_updated_user' => 'updated_user',
    'model_batch_user_updated_date' => 'updated_date',



);