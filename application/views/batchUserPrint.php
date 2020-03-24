<?php
use application\util\DateUtils as DateUtils;

echo "    <link href=\"".__RESOURCES."/assets/plugins/boostrapv3/css/bootstrap.min.css\" rel=\"stylesheet\" type=\"text/css\" />";
echo "    <link href=\"".__RESOURCES."/assets/plugins/font-awesome/css/font-awesome.css\" rel=\"stylesheet\" type=\"text/css\" />";


$batchUserList = (isset($_V_DATA_TO_VIEW['batch_user_list'])) ? $_V_DATA_TO_VIEW['batch_user_list'] : array();
$batch = (isset($_V_DATA_TO_VIEW['batch'])) ? $_V_DATA_TO_VIEW['batch'] : array();
$groupValueTime = (isset($_V_DATA_TO_VIEW['group_value_time'])) ? $_V_DATA_TO_VIEW['group_value_time'] : "";

?>
<html>
<head>
    <title><?=$batch->getBatchName()?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style type="text/css">

        #head {
            font-weight: bold;
            font-size: 20px;
            color: #333;
        }
        #body_card {
            font-size: 14px;
            font-weight: 400;
            color: #444;
            padding: 10px;
        }
    </style>

</head>
<body style="background-color: #ffffff;">


        <?php

            if(!empty($batchUserList)){
                foreach ($batchUserList as $batchUser){

                  ?>

                    <table border="0"  align="center" width="300"   bgcolor="">
                        <tr>
                            <td>
                                <div id="head" >GRadius
                                <div id="body_card">
                                        <p><b>ชื่อผู้ใช้:</b> <?=$batchUser->getUserName()?></p>
                                        <p><b>รหัสผ่าน:</b> <?=$batchUser->getPassword()?></p>
                                        <p><b>เวลาการใช้งาน:</b> <?php
                                            if(!empty($groupValueTime)){
                                                echo DateUtils::secToHour($groupValueTime)."&nbsp;ชั่วโมง";
                                            }else{
                                                echo "ไม่จำกัด";
                                            }


                                            ?>
                                        </p>
                                        <p><b>วันหมดอายุ:</b> <?=DateUtils::getThaiDate($batchUser->getExpiredDate(), true);?></p>

                                        <p> <?=$batch->getBatchName()?></p>
                                        <p> <?=$batch->getDescriptions()?></p>
                                        <p>------------------------------------------------------</p>
                                </div>
                            </td>
                        </tr>
                    </table>
                   <?php
                }
            }

        ?>


<script language="javascript">
    window.print();
</script>
</body>
</html>