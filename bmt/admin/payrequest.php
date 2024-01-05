<?PHP
require_once("./include/membersite_config.php");
if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("login.php");
    exit;
}
general_connection($username,$password,$general_database);
mysql_query('SET NAMES \'utf8\'');

if(isset($_GET['view']) && is_numeric($_GET['view']))
{
	$result = mysql_query("SELECT * FROM `ebanking_mellat` WHERE `id`='".$_GET['view']."'");
	$row=mysql_fetch_array($result);
	$Vazeiyat_Kharid=$row['VazeiyatKharid'];
}
function VazeiyatKharid($Vazeiyat_Kharid)
{
	$Vazeiyat_Kharid=$Vazeiyat_Kharid;
	if($Vazeiyat_Kharid=="0")
	{
		$Massage_result="پرداخت با موفقیت انجام شده است";
	}
	elseif($Vazeiyat_Kharid=="11")
	{
		$Massage_result="شماره کارت نامعتبر بوده است";
	}
	elseif($Vazeiyat_Kharid=="12")
	{
		$Massage_result="موجودی کافی نبوده است";
	}
	elseif($Vazeiyat_Kharid=="13")
	{
		$Massage_result="رمز نادرست بوده است";
	}
	elseif($Vazeiyat_Kharid=="14")
	{
		$Massage_result="تعداد دفعات وارد کردن رمز بیش از حد مجاز بوده است";
	}
	elseif($Vazeiyat_Kharid=="15")
	{
		$Massage_result="کارت نامعتبر بوده است";
	}
	elseif($Vazeiyat_Kharid=="16")
	{
		$Massage_result="دفعات برداشت وجه بیش از حد مجاز بوده است";
	}
	elseif($Vazeiyat_Kharid=="17")
	{
		$Massage_result="کاربر از انجام تراکنش منصرف شده بوده است";
	}
	elseif($Vazeiyat_Kharid=="18")
	{
		$Massage_result="تاریخ انقضاء کارت گذشته بوده است";
	}
	elseif($Vazeiyat_Kharid=="19")
	{
		$Massage_result="مبلغ برداشت وجه بیش از حد مجاز بوده است";
	}
	elseif($Vazeiyat_Kharid=="21")
	{
		$Massage_result="پذیرنده نامعتبر بوده است";
	}
	elseif($Vazeiyat_Kharid=="23")
	{
		$Massage_result="خطای امنیتی رخ داده بوده است";
	}
	elseif($Vazeiyat_Kharid=="24")
	{
		$Massage_result="اطلاعات کاربری پذیرنده نامعتبر بوده است";
	}
	elseif($Vazeiyat_Kharid=="25")
	{
		$Massage_result="مبلغ نامعتبر بوده است";
	}
	elseif($Vazeiyat_Kharid=="31")
	{
		$Massage_result="پاسخ نا معتبر بوده است";
	}
	elseif($Vazeiyat_Kharid=="32")
	{
		$Massage_result="فرمت اطلاعات وارد شده صحیح نبوده است";
	}
	elseif($Vazeiyat_Kharid=="33")
	{
		$Massage_result="حساب نامعتبر بوده است";
	}
	elseif($Vazeiyat_Kharid=="34")
	{
		$Massage_result="خطای سیستمی رخ داده بوده است";
	}
	elseif($Vazeiyat_Kharid=="35")
	{
		$Massage_result="تاریخ نامعتبر ارسال شده بوده است";
	}
	elseif($Vazeiyat_Kharid=="41")
	{
		$Massage_result="شماره درخواست تکراری بوده است";
	}
	elseif($Vazeiyat_Kharid=="42")
	{
		$Massage_result="تراکنش Sale یافته بوده است";
	}
	elseif($Vazeiyat_Kharid=="43")
	{
		$Massage_result="قبلا درخواست Verify داده شده بوده است";
	}
	elseif($Vazeiyat_Kharid=="44")
	{
		$Massage_result="درخواست Verify یافت نشده بوده است";
	}
	elseif($Vazeiyat_Kharid=="45")
	{
		$Massage_result="تراکنش Settle شده بوده است";
	}
	elseif($Vazeiyat_Kharid=="46")
	{
		$Massage_result="تراکنش Settle نشده بوده است";
	}
	elseif($Vazeiyat_Kharid=="47")
	{
		$Massage_result="تراکنش Settle یافت نشد";
	}
	elseif($Vazeiyat_Kharid=="48")
	{
		$Massage_result="تراکنش Reverse شده است";
	}
	elseif($Vazeiyat_Kharid=="49")
	{
		$Massage_result="تراکنش Refund یافت نشده";
	}
	elseif($Vazeiyat_Kharid=="51")
	{
		$Massage_result="تراکنش تکراری است";
	}
	elseif($Vazeiyat_Kharid=="54")
	{
		$Massage_result="تراکنش مرجع موجود نیست";
	}
	elseif($Vazeiyat_Kharid=="55")
	{
		$Massage_result="تراکنش نامعتبر است";
	}
	elseif($Vazeiyat_Kharid=="61")
	{
		$Massage_result="خطا در واریز";
	}
	elseif($Vazeiyat_Kharid=="111")
	{
		$Massage_result="صادر کننده کارت نامعتبر است";
	}
	elseif($Vazeiyat_Kharid=="112")
	{
		$Massage_result="خطای سوییچ صادر کننده کارت<";
	}
	elseif($Vazeiyat_Kharid=="113")
	{
		$Massage_result="پاسخی از صادر کننده کارت صادر نشد";
	}
	elseif($Vazeiyat_Kharid=="114")
	{
		$Massage_result="صادر کننده کارت مجاز به انجام این تراکنش نیست";
	}
	elseif($Vazeiyat_Kharid=="412")
	{
		$Massage_result="شناسه قبض نادرست است";
	}
	elseif($Vazeiyat_Kharid=="413")
	{
		$Massage_result="شناسه پرداخت نادرست است";
	}
	elseif($Vazeiyat_Kharid=="414")
	{
		$Massage_result="سازمان صادر كننده قبض نامعتبر است";
	}
	elseif($Vazeiyat_Kharid=="415")
	{
		$Massage_result="زمان جلسه كاري به پايان رسيده است";
	}
	elseif($Vazeiyat_Kharid=="416")
	{
		$Massage_result="خطا در ثبت اطلاعات";
	}
	elseif($Vazeiyat_Kharid=="417")
	{
		$Massage_result="شناسه پرداخت كننده نامعتبر است";
	}
	elseif($Vazeiyat_Kharid=="418")
	{
		$Massage_result="اشكال در تعريف اطلاعات مشتري";
	}
	elseif($Vazeiyat_Kharid=="419")
	{
		$Massage_result="تعداد دفعات ورود اطلاعات از حد مجاز گذشته است";
	}
	elseif($Vazeiyat_Kharid=="421")
	{
		$Massage_result="IP نا معتر است";
	}
	else

	{
		$Massage_result="پرداخت ناموفق بو ده است";
	}
	return $Vazeiyat_Kharid=$Massage_result;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title>An Access Controlled Page</title>
      <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css">
      <link href="style/style_multipage.css" rel="stylesheet" type="text/css"/>
      <script type="text/javascript">
var request = createRequestObject();
var dataReturn='';
var ajaxTimeout='';
var enterChecker=false;
function createRequestObject()
{
	var ro;
	var browser = navigator.appName;
	if(browser == 'Microsoft Internet Explorer')
	{
		ro = new ActiveXObject('Microsoft.XMLHTTP');
	}
	else
	{
		ro = new XMLHttpRequest();
	}
	return ro;
	}
	function makeRequest (url, fun)
	{
		enterChecker=false;
		request.open('get', url);
		request.onreadystatechange = function()
		{
			handleResponse(fun);
		}
		try
		{
			request.send(null);
			}
			catch(err)
			{
				alert('Error occured: '+err);
				showHidePreloader(false);
			}
		}
		function makePostRequest(url, params, fun)
		{
			request.open('POST', url, true);
			//Send the proper header information along with the request
			request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
			request.setRequestHeader('Content-length', params.length);
			request.setRequestHeader('Connection', 'close');
			request.onreadystatechange = function()
			{
				//Call a function when the state changes.
				if(request.readyState == 4 && request.status == 500)
				{
					dataReturn=request.responseText;
					if(fun!='')
					ajaxTimeout=setTimeout(fun+'()', 500);
				}
			}
			try
			{
				request.send(params);
			}
			catch(err)
			{
				alert('Error occured: '+err);
				showHidePreloader(false);
			}
		}
		function handleResponse(fun)
		{
			if(request.readyState < 4)
			{
				ajaxTimeout=setTimeout('handleResponse(\''+fun+'\')',10);
			}
			else
			if(request.readyState == 4 && !enterChecker)
			{
				enterChecker=true; var response = request.responseText; dataReturn=response;
				if(fun!='')
				ajaxTimeout=setTimeout(fun+'()', 5000);
			}
		}
		function stopAjax()
		{
			clearTimeout('ajaxTimeout');
			ajaxTimeout='';
		}
		function showContent()
		{
			showHidePreloader(false);
			document.getElementById('resultDiv').innerHTML=dataReturn;
		}
		function showHidePreloader(show)
		{
			if(show) document.getElementById('preloader').style.display='block';
			else
			document.getElementById('preloader').style.display='none';
		}
</script>
</head>
<style>
#preloader
{
	display:none;
}
</style>
<body>
    <?php
	if(isset($_GET['check_paybal'])=='check')
	{
		if($Vazeiyat_Kharid=="0")
		{
			echo '<div class="headinput BTitrBold"><p style="color:#063">'.VazeiyatKharid($Vazeiyat_Kharid).'</p></div>';
		}
		else
		{
			echo '<div class="headinput BTitrBold"><p style="color:#F00">'.VazeiyatKharid($Vazeiyat_Kharid).'</p></div>';
		}
	}
	?>
</body>
</html>
