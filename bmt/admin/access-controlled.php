<?PHP
require_once("./include/membersite_config.php");
if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("login.php");
    exit;
}
general_connection($username,$password,$general_database);
mysql_query('SET NAMES \'utf8\'');
include_once 'pagination.php';
if(isset($_GET['del']) || isset($_GET['del_all']))
{
	if($_GET['del_all']=='Empty')
	{
		$DELETE=mysql_query("TRUNCATE `user_log`");
		echo "<br><h2>کل اطلاعات حذف گردید</h2><br><br>";
	}
	elseif(isset($_GET['del']) && is_numeric($_GET['del']))
	{
				$del=$_GET['del'];
				$DELETE=mysql_query("DELETE FROM `ebanking_mellat` WHERE `id`='$del'")or die(mysql_error());
	}
}

if(isset($_GET['view']) && is_numeric($_GET['view']))
{
	$result = mysql_query("SELECT * FROM `ebanking_mellat` WHERE `id`='".$_GET['view']."'");
	$row=mysql_fetch_array($result);
	$Vazeiyat_Kharid=$row['VazeiyatKharid'];
}
else
{
	$total = mysql_query("select count(*) as `total` from `ebanking_mellat`");
	$result = mysql_fetch_assoc($total);
	$paging = new Pagination(
		array(
			'items_per_page' => 12,
			'total_records' => $result['total'],
			'url_address' => '?page=',
			'current_page' => (isset($_GET['page']) ? $_GET['page'] : 1),
			)
		);
	$section = $paging->limit();
	$start = $section['start'];
	$limit = $section['limit'];
	$result = mysql_query("SELECT * FROM `ebanking_mellat` ORDER BY `id` DESC LIMIT $start, $limit");
}

function VazeiyatKharid($Vazeiyat_Kharid)
{
	$Vazeiyat_Kharid=$Vazeiyat_Kharid;
	if($Vazeiyat_Kharid=="0")
	{
		$Massage_result="پرداخت با موفقیت انجام شد";
	}
	elseif($Vazeiyat_Kharid=="11")
	{
		$Massage_result="شماره کارت نامعتبر است";
	}
	elseif($Vazeiyat_Kharid=="12")
	{
		$Massage_result="موجودی کافی نیست";
	}
	elseif($Vazeiyat_Kharid=="13")
	{
		$Massage_result="رمز نادرست است";
	}
	elseif($Vazeiyat_Kharid=="14")
	{
		$Massage_result="تعداد دفعات وارد کردن رمز بیش از حد مجاز است";
	}
	elseif($Vazeiyat_Kharid=="15")
	{
		$Massage_result="کارت نامعتبر است";
	}
	elseif($Vazeiyat_Kharid=="16")
	{
		$Massage_result="دفعات برداشت وجه بیش از حد مجاز است";
	}
	elseif($Vazeiyat_Kharid=="17")
	{
		$Massage_result="کاربر از انجام تراکنش منصرف شده است";
	}
	elseif($Vazeiyat_Kharid=="18")
	{
		$Massage_result="تاریخ انقضاء کارت گذشته است";
	}
	elseif($Vazeiyat_Kharid=="19")
	{
		$Massage_result="مبلغ برداشت وجه بیش از حد مجاز است";
	}
	elseif($Vazeiyat_Kharid=="21")
	{
		$Massage_result="پذیرنده نامعتبر است";
	}
	elseif($Vazeiyat_Kharid=="23")
	{
		$Massage_result="خطای امنیتی رخ داده است";
	}
	elseif($Vazeiyat_Kharid=="24")
	{
		$Massage_result="اطلاعات کاربری پذیرنده نامعتبر است";
	}
	elseif($Vazeiyat_Kharid=="25")
	{
		$Massage_result="مبلغ نامعتبر است";
	}
	elseif($Vazeiyat_Kharid=="31")
	{
		$Massage_result="پاسخ نا معتبر است";
	}
	elseif($Vazeiyat_Kharid=="32")
	{
		$Massage_result="فرمت اطلاعات وارد شده صحیح نیست";
	}
	elseif($Vazeiyat_Kharid=="33")
	{
		$Massage_result="حساب نامعتبر است";
	}
	elseif($Vazeiyat_Kharid=="34")
	{
		$Massage_result="خطای سیستمی";
	}
	elseif($Vazeiyat_Kharid=="35")
	{
		$Massage_result="تاریخ نامعتبر است";
	}
	elseif($Vazeiyat_Kharid=="41")
	{
		$Massage_result="شماره درخواست تکراری است";
	}
	elseif($Vazeiyat_Kharid=="42")
	{
		$Massage_result="تراکنش Sale یافته است";
	}
	elseif($Vazeiyat_Kharid=="43")
	{
		$Massage_result="قبلا درخواست Verify داده شده است";
	}
	elseif($Vazeiyat_Kharid=="44")
	{
		$Massage_result="درخواست Verify یافت نشد";
	}
	elseif($Vazeiyat_Kharid=="45")
	{
		$Massage_result="تراکنش Settle شده است";
	}
	elseif($Vazeiyat_Kharid=="46")
	{
		$Massage_result="تراکنش Settle نشده است";
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
		$Massage_result="پرداخت ناموفق";
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
<div class="main">
<p align="right" class="BHoma">
کاربر: <?= $fgmembersite->UserFullName() ?>
</p>
<?php if(isset($_GET['view']) && is_numeric($_GET['view'])) { ?>
<form name="form1" id="form1" method="post">
<div style="margin:0 auto;margin-top:20px;width:450px; border:1px dotted #F0F; padding:10px 14px 5px 14px; box-shadow: 0px 1px 20px #F96; -moz-border-radius: 8px; -webkit-border-radius: 8px; border-radius: 8px;">
  <div class="IP BHoma">IP: <?= $row['clint_ip'] ?></div>
  <div class="date BHoma">زمان: <span id="show_time_1"><?= $row ['date'] ?></span></div>
  <div class="specification">
    <div class="headline BHoma">نام و نام خانوادگی:</div>
    <div class="headinput"><input type="text" class="BHoma" name="name"id="name" value="<?= $row['name'] ?>"></div>
    
    <div class="headline BHoma">شماره همراه:</div>
    <div class="headinput"><input type="text" class="BHoma" name="mobile" id="mobile" style="direction:ltr;" value="<?= $row['mobile'] ?>"></div>
    
    <div class="headline BHoma">ایمیل:</div>
    <div class="headinput"><input type="text" class="BHoma" name="email" id="email" style="direction:ltr;" value="<?= $row['email'] ?>"></div>
    
    <div class="headline BHoma">توضیحات:</div>
    <div class="headinput"><textarea type="text" class="BHoma" name="details" id="details"><?= $row['details'] ?></textarea></div>
    
    <div class="gap"></div>
    
    <div class="headline BHoma">شناسه پرداخت:</div>
    <div class="headinput"><input type="text" class="BHoma" name="RefId" id="RefId" style="direction:ltr;" value="<?= $row['ShenasePardakht'] ?>"></div>
    
    <div class="headline BHoma">وضعیت پرداخت:</div>
    <div class="headinput BTitrBold">
    <?php
    if($Vazeiyat_Kharid=="0")
	{
		echo '<p style="color:#063">'.VazeiyatKharid($Vazeiyat_Kharid).'</p>';
	}
	else
	{
		echo '<p style="color:#F00">'.VazeiyatKharid($Vazeiyat_Kharid).'</p>';
	}
	?>
    </div>
    
    <div class="headline BHoma">شماره درخواست:</div>
    <div class="headinput"><input type="text"class="BHoma" name="ShomareDarkhast" id="ShomareDarkhast" style="direction:ltr;" value="<?= $row['ShomareDarkhast'] ?>"></div>
    <?php if($row['CodeMarjaeTarakonesh']=="0") { ?>
    <div class="headline BHoma">کد مرجع تراکنش:</div>
    <div class="headinput"><input type="text" class="BHoma" name="CodeMarjaeTarakonesh" id="CodeMarjaeTarakonesh" style="direction:ltr;" value="<?= $row['CodeMarjaeTarakonesh'] ?>"></div>
    <?php } ?>
    <div class="headline BHoma">مبلغ واریزی:</div>
    <div class="headinput BHoma"><?= number_format($row['price']) ?> ریال</div>
  </div>
    <input type="button" class="BTitrBold" onClick="showHidePreloader(true); makeRequest('payrequest.php?check_paybal=check&view=<?= $_GET['view'] ?>&param1=value1&param2=value2', 'showContent')" value="استعلام پرداخت" />
    <center>
    <div id="preloader"><img src="../image/ajax-loader.gif" /></div>
    </center>
    <br><br><br>
    <div id="resultDiv"></div>
    </center>
</div>
    <br>
    <p align="right">
    <a class="BTitrBold" style="text-decoration:none" href='access-controlled.php'>بازگشت</a>
    </p>
</form>
</div>

<?php } else { ?>
<h2 align="center" class="BTitrBold" style="font-size:24px">درخواست های انجام شده</h2>
<p>&nbsp;</p>
<table align="center" class="CForm_ViewItesmGrid CForm_corner-bottom BRoya" width="90%">
 <thead>
  <tr>
    <td class="BTitrBold" style="text-align:center" colspan="9">خلاصه</td>
  </tr>
 </thead>
 <thead class="BTitrBold" style="text-align:center">
  <tr>
    <td width="20">ردیف</td>
    <td>نام پرداخت کننده</td>
    <td>تلفن</td>
    <td>ایمیل</td>
    <td>مبلغ واریز</td>
    <td>توضیحات</td>
    <td>وضعیت</td>
    <td>مشاهده</td>
    <td>حذف</td>
  </tr>
 </thead>
<?php if(mysql_num_rows($result)>0) { ?>
<?php while($row=mysql_fetch_array($result)) { $Vazeiyat_Kharid=$row['VazeiyatKharid']?>
  <tr>
    <td><?= $row[0] ?></td>
    <td style="text-align:right"><?= $row['name'] ?></td>
    <td style="text-align:left"><?= $row['mobile'] ?></td>
    <td style="text-align:left"><?= $row['email'] ?></td>
    <td style="text-align:right"><?= number_format($row['price']) ?></td>
    <td style="text-align:right"><?= $row['details'] ?></td>
    <td <?php if($row['VazeiyatKharid']=='0'){ echo 'style="background-color:#E1FFE1"'; } elseif($row['VazeiyatKharid']=='') { echo 'style="background-color:#FFECEC"'; }?>><?= VazeiyatKharid($Vazeiyat_Kharid)  ?></td>
    <td><a href="?view=<?= $row[0] ?>" title="جزئیات بیشتر"><img src="../image/view.png" border="0" /></a></td>
    <td><a href="?del=<?= $row[0] ?>" title="حذف"><img src="../image/close.gif" border="0" /></a></td>
  </tr>
<?php } ?>
<tfoot><tr><td colspan="9">&nbsp;</td></tr></tfoot>
<?php } else { ?>
<tr>
    <td class="BTitrBold" colspan="9">اطلاعاتی وجود ندارد</td>
</tr>
<?php } ?>
</table>
<div style="margin:0px auto; padding:0px 160px 0px 0px; border:groove 0px #F00;">
<p><?= $paging->display() ?></p>
</div>
<br>
<p align="right">
<a class="BTitrBold" style="text-decoration:none" href='login-home.php'>بازگشت</a>
</p>
<?php } ?>
</div>
</body>
</html>
