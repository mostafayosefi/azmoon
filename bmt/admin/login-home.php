<?PHP
require_once("./include/membersite_config.php");

if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("login.php");
    exit;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title>آسان پرداخت حساس کامپیوتر</title>
      <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css">
</head>
<body dir="rtl">
<div style="margin:0 auto;margin-top:20px;width:450px; border:1px dotted #F0F; padding:10px 14px 5px 14px; box-shadow: 0px 1px 20px #F96; -moz-border-radius: 8px; -webkit-border-radius: 8px; border-radius: 8px;">

<div id='fg_membersite_content'>
<span class="BTitrBold">بخش مدیریت</span>
<br />
<span class="BHoma" style="text-align:center">به آسان پرداخت حساس کامپیوتر خوش آمدید <?= $fgmembersite->UserFullName(); ?>!</span>
<br><br>
<div class="tools">
<p><a class="BNazanin" href='change-pwd.php'>تغییر رمز عبور</a></p>
<p><a class="BNazanin" href='access-controlled.php'>نمایش واریز ها</a></p>
</div>
<br>
<p><a class="exit BNazanin" href='logout.php'>خروج</a></p>
<br>
</div>
</div>
</body>
</html>
