<?php
require_once('./api_send_sms.php');
if (($result = Send_SMS('zaban724', 'mustafa724', '10006666601', '09384762155', 'Hello World!', 0, false)) === '0')
{
    echo 'SMS sent successfully.';
}
else if ($result !== '')
{
    echo "Error No: $result";
}
?>