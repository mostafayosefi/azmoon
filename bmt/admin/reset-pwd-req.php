<?PHP
require_once("./include/membersite_config.php");

$emailsent = false;
if(isset($_POST['submitted']))
{
   if($fgmembersite->EmailResetPasswordLink())
   {
        $fgmembersite->RedirectToURL("reset-pwd-link-sent.html");
        exit;
   }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title>درخواست تغییر رمز عبور</title>
      <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css" />
      <script type='text/javascript' src='scripts/gen_validatorv31.js'></script>
</head>
<body>
<div style="margin:0 auto;margin-top:20px;width:480px; border:1px dotted #F0F; padding:10px 14px 5px 14px; box-shadow: 0px 1px 20px #F96; -moz-border-radius: 8px; -webkit-border-radius: 8px; border-radius: 8px;">
<!-- Form Code Start -->
<div id='fg_membersite'>
<form id='resetreq' action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Reset Password</legend>

<input type='hidden' name='submitted' id='submitted' value='1'/>

<div class='short_explanation'>* موارد ستاره دار اجباری می باشد</div>

<div><span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
<div class='container'>
    <label for='username' >آدرس ایمیل*:</label><br/>
    <input type='text' name='email' id='email' value='<?php echo $fgmembersite->SafeDisplay('email') ?>' maxlength="50" /><br/>
    <span id='resetreq_email_errorloc' class='error'></span>
</div>
<div class='short_explanation'>یک ایمیل حاوی رمز عبور برای شما ارسال می گردد.</div>
<div class='container'>
    <input class="BTitrBold" type='submit' name='Submit' value='ارسال' />
</div>

</fieldset>
</form>
<!-- client-side Form Validations:
Uses the excellent form validation script from JavaScript-coder.com-->

<script type='text/javascript'>
// <![CDATA[

    var frmvalidator  = new Validator("resetreq");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();

    frmvalidator.addValidation("email","req","Please provide the email address used to sign-up");
    frmvalidator.addValidation("email","email","Please provide the email address used to sign-up");

// ]]>
</script>

</div>
<!--
Form Code End (see html-form-guide.com for more info.)
-->
</div>
</body>
</html>