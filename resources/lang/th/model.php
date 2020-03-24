<?php
return array(
    /*
    |--------------------------------------------------------------------------
    | app_user
    |--------------------------------------------------------------------------
    */
    'model_app_user' => 'ผู้ใช้ระบบ',
    'model_appuser_username' => 'ชื่อผู้ใช้',
    'model_appuser_email' => 'อีเมล์',
    'model_appuser_password' => 'รหัสผ่าน',
    'model_appuser_confirmpwd' => 'ยืนยันรหัสผ่าน',
    'model_appuser_password_change' => 'แก้ไขรหัสผ่าน',
    /*
    |--------------------------------------------------------------------------
    | app_table
    |--------------------------------------------------------------------------
    */
    'model_app_table' => 'ตารางของระบบ',
    'model_app_table_app_table_name' => 'ชื่อตาราง',
    'model_app_table_description' => 'รายละเอียด',
    /*
    |--------------------------------------------------------------------------
    | app_user_role
    |--------------------------------------------------------------------------
    */
    'model_app_user_role' => 'กลุ่มผู้ใช้งาน',
    'model_app_user_role_name' => 'ชื่อกลุ่ม',
    'model_app_user_role_description' => 'รายละเอียด',
    /*
    |--------------------------------------------------------------------------
    | app_permission
    |--------------------------------------------------------------------------
    */
    'model_app_permission' => 'สิทธิ์การใช้งาน',
    'model_app_permission_name' => 'ชื่อสิทธิ์',
    'model_app_permission_description' => 'รายละเอียด',
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

    'model_cnf_radius' => 'ตั้งค่า Radius Server',
    'model_cnf_radius_ip_radius' => 'IP radius server',
    'model_cnf_radius_secrete_redius' => 'Shared secret',
    'app_setting_radius_server' => 'ตั้งค่า Radius Server',
    'app_setting_radius_client' => 'ตั้งค่า Radius Client',

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


    'model_username_role' => 'กฏการตั้งชื่อผู้ใช้',
    'model_username_role_name_lenght' => 'ความยาวของชื่อผู้ใช้อย่างน้อย',
    'model_username_role_mix_no' => 'ผสมตัวเลขและตัวอักษร',
    'model_username_role_special_char' => 'ผสมอักขระพิเศษ',

    'model_pass_role' => 'กฏการตั้งรหัสผ่าน',
    'model_pass_role_pass_lenght' => 'ความยาวของรหัสผ่านอย่างน้อย',
    'model_pass_role_mix_no' => 'ผสมตัวเลขและตัวอักษร',
    'model_pass_role_special_char' => 'ผสมอักขระพิเศษ',

    'model_attribute_all' => 'Radius Attribute',
    'model_attribute_all_attribute' => 'ชื่อ Attribute',
    'model_attribute_all_df_value' => 'ค่าเริ่มต้น',
    'model_attribute_all_attribute_name' => 'รายละเอียด',
    'model_attribute_all_type_value' => 'ชนิด Attribute',
    'model_attribute_all_type_checkreply' => 'ประเภท Attribute',

    'model_radgroup_detail' => 'Price Plan',
    'model_radgroup_detail_title' => 'จัดการกลุ่ม',
    'model_radgroup_detail_attribute_manage' => 'จัดการ Attribute',
    'model_radgroup_detail_groupname' => 'Plan Name',
    'model_radgroup_detail_group_detail' => 'รายละเอียด',
    'model_radgroup_detail_start_ip' => 'Ip เริ่มต้น',
    'model_radgroup_detail_end_id' => 'Ip สิ้นสุด',
    'model_radgroup_detail_created_date' => 'สร้างเมื่อ',

    'model_radgroupcheckreply_attribute' => 'Module',
    'model_radgroupcheckreply_op' => 'Op',
    'model_radgroupcheckreply_value' => 'Value',

    'model_help_type_text' => 'กรุณาพิมพ์ตัวหนังสือ',
    'model_help_type_number' => 'กรุณาพิมพ์เฉพาะตัวเลข',
    'model_help_type_second' => 'กรุณาพิมพ์ตัวเลขให้อยู่ในรูปแบบ วัน:ชั่วโมง:นาที เช่น 01:24:59 (หนึ่งวัน:ยี่สิบสี่ชั่วโมง:ห้าสิบเก้านาที)',
    'model_help_type_date' => 'กรุณาเลือกวันที่',
    'model_help_type_null' => 'กรุณาเลือก Module ก่อน',
    'model_help_type_null_value' => 'กรุณากำหนดค่าที่ช่อง Value',

    'model_account' => 'ผู้ใช้งาน',
    'model_account_maunal' => 'รายชื่อผู้ใช้',
    'model_account_batch' => 'Batch',
    'model_account_excel' => 'Excel Loader',
    'model_account_excel_template' => 'คลิกที่นี่เพื่อดาวน์โหลด Excel Template',
    'model_account_excel_choose' => 'เลือกไฟล์ Excel',
    'model_account_excel_choose_null' => 'กรุณาเลือกไฟล์ Excel ที่มีนามสกุล .xlsx',
    'model_account_excel_choose_wrong' => 'รูปแบบไฟล์ Excel ไม่ถูกต้อง',
    'model_account_excel_allrec' => 'จำนวนทั้งหมด',
    'model_account_excel_allrec_add' => 'เพิ่มสำเร็จ',
    'model_account_excel_allrec_fail' => 'ไม่สามารถเพิ่มได้',
    'model_account_excel_advice' => 'คำแนะนำ',
    'model_account_img_name' => 'รูป',
    'model_account_user_name' => 'ชื่อผู้ใช้',
    'model_account_name' => 'ชื่อ',
    'model_account_fullname' => 'ชื่อ-สกุล',
    'model_account_lastname' => 'สกุล',
    'model_account_radusergroup_detail' => 'Price Plan',
    'model_account_id_card' => 'เลขบัตรประชาชน',
    'model_account_email' => 'อีเมล์',
    'model_account_phonenumber' => 'โทรศัพท์',
    'model_account_status' => 'สถานะ',
    'model_account_all' => 'ผู้ใช้ทั้งหมด',
    'model_account_online' => 'ออนไลน์',
    'model_account_offline' => 'ออฟไลน์',

    'model_account_group_user' => 'รายชื่อผู้ใช้ในกลุ่มนี้',


    'model_msg_welcome' => 'ยินดีต้อนรับเข้าสู่ระบบจัดการ Radius',
    'model_msg_systemname' => 'ระบบจัดการ Radius',
    'model_log_list' => 'Logs',
    'model_maintenances' => 'Maintenances',





    /* 
    |-------------------------------------------------------------------------- 
    | batch 
    |-------------------------------------------------------------------------- 
    */ 
    'model_batch' => 'Batch',
    'model_batch_id' => 'id', 
    'model_batch_batch_name' => 'ชื่อ Batch',
    'model_batch_description' => 'รายละเอียด',
    'model_batch_volume' => 'จำนวนผู้ใช้',
    'model_batch_create_date' => 'วันที่สร้าง',
    'model_batch_active' => 'สถานะ',
    'model_batch_radusergroup_detail' => 'กลุ่ม',
    'model_batch_created_user' => 'created_user', 
    'model_batch_created_date' => 'created_date', 
    'model_batch_updated_user' => 'updated_user', 
    'model_batch_updated_date' => 'updated_date', 

    /* 
    |-------------------------------------------------------------------------- 
    | batch_user 
    |-------------------------------------------------------------------------- 
    */ 
    'model_batch_user' => 'ผู้ใช้ Batch',
    'model_batch_user_id' => 'id', 
    'model_batch_user_batch' => 'Batch',
    'model_batch_user_account' => 'ชื่อผู้ใช้',
    'model_batch_user_user_name' => 'ชื่อผู้ใช้',
    'model_batch_user_password' => 'รหัสผ่าน',
    'model_batch_user_start_date' => 'วันที่เริ่มใช้งาน',
    'model_batch_user_expired_date' => 'วันที่หมดอายุ', 
    'model_batch_user_status' => 'สถานะ',
    'model_batch_user_rate_limit' => 'rate_limit', 
    'model_batch_user_created_user' => 'created_user', 
    'model_batch_user_created_date' => 'created_date', 
    'model_batch_user_updated_user' => 'updated_user', 
    'model_batch_user_updated_date' => 'updated_date', 
);