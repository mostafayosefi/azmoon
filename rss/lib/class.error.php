<?php
// بررسی نوع مقدار ارسالی از سمت بانک و نمایش پیغام مطابق با آن
function VazeiyatKharid()
{
	$Vazeiyat_Kharid=mysql_real_escape_string($_POST['ResCode']);
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
		$Massage_result=">پذیرنده نامعتبر است";
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