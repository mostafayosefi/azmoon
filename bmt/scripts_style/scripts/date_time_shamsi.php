<?php

/*	F	*/
function shamsidate($format2,$timestamp2='',$none2='',$time_zone2='Asia/Tehran',$tr_num22='en'){

 $T_sec2=0;/* <= رفع خطاي زمان سرور ، با اعداد '+' و '-' بر حسب ثانيه */

 if($time_zone2!='local')date_default_timezone_set(($time_zone2=='')?'Asia/Tehran':$time_zone2);
 $ts2=($timestamp2=='' or $timestamp2=='now')?time()+$T_sec2:tr_num2($timestamp2)+$T_sec2;
 $date2=explode('_',date('H_i_j_n_O_P_s_w_Y',$ts2));
 list($sh_y,$sh_m,$sh_d)=gregorian_to_shamsi($date2[8],$date2[3],$date2[2]);
 $doy2=($sh_m<7)?(($sh_m-1)*31)+$sh_d-1:(($sh_m-7)*30)+$sh_d+185;
 $kab2=($sh_y%33%4-1==(int)($sh_y%33*.05))?1:0;
 $sl2=strlen($format2);
 $out2='';
 for($i2=0; $i2<$sl2; $i2++){
  $sub2=substr($format2,$i2,1);
  if($sub2=='\\'){
	$out2.=substr($format2,++$i2,1);
	continue;
  }
  switch($sub2){

	case'C':case'E':case'R':case'x':case'X':
	$out2.='نسخه ی جدید : http://www.hassas-computer.com';
	break;

	case'B':case'e':case'g':
	case'G':case'h':case'I':
	case'T':case'u':case'Z':
	$out2.=date($sub2,$ts2);
	break;

	case'a':
	$out2.=$date2[0].':'.$date2[1].':'.$date2[6];
	break;
	
	case'b':
	$out2.=($date2[0]<12)?'AM':'PM';
	break;

	case'c':
	$out2.=$sh_y.'/'.$sh_m.'/'.$sh_d.' ،'.$date2[0].':'.$date2[1].':'.$date2[6].' '.$date2[5];
	break;
	
	case'd':
	$out2.=$date2[0];
	break;
	
	case'H':
	$out2.=$date2[0];
	break;
	
	case'i':
	$out2.=$date2[1];
	break;

	case'j':
	$out2.=$sh_d;
	break;
	
	case's':
	$out2.=$date2[6];
	break;

	case'n':
	$out2.=$sh_m;
	break;

	case'y':
	$out2.=substr($sh_y,2,2);
	break;

	default:$out2.=$sub2;
  }
 }
 return($tr_num22!='en')?tr_num2($out2,'fa','.'):$out2;
}

/*	F	*/
function shamsicheckdate($shm,$shd,$shy){
 $shm=tr_num2($shm); $shd=tr_num2($shd); $shy=tr_num2($shy);
 $l_d2=($shm==12)?(($shy%33%4-1==(int)($shy%33*.05))?30:29):31-(int)($shm/6.5);
 return($shm>0 and $shd>0 and $shy>0 and $shm<13 and $shd<=$l_d2)?true:false;
}

/*	F	*/
function tr_num2($str2,$mod2='en',$mf2='٫'){
 $num2_a=array('0','1','2','3','4','5','6','7','8','9','.');
 $key2_a=array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹',$mf2);
 return($mod2=='fa')?str_replace($num2_a,$key2_a,$str2):str_replace($key2_a,$num2_a,$str2);
}

/*	F	*/
function gregorian_to_shamsi($g_y,$g_m,$g_d,$mod2=''){
	$g_y=tr_num2($g_y); $g_m=tr_num2($g_m); $g_d=tr_num2($g_d);/* <= :اين سطر ، جزء تابع اصلي نيست */
 $d_42=$g_y%4;
 $g_a2=array(0,0,31,59,90,120,151,181,212,243,273,304,334);
 $doy2_g=$g_a2[(int)$g_m]+$g_d;
 if($d_42==0 and $g_m>2)$doy2_g++;
 $d_33=(int)((($g_y-16)%132)*.0305);
 $a2=($d_33==3 or $d_33<($d_42-1) or $d_42==0)?286:287;
 $b2=(($d_33==1 or $d_33==2) and ($d_33==$d_42 or $d_42==1))?78:(($d_33==3 and $d_42==0)?80:79);
 if((int)(($g_y-10)/63)==30){$a2--;$b2++;}
 if($doy2_g>$b2){
  $shy=$g_y-621; $doy2_sh=$doy2_g-$b2;
 }else{
  $shy=$g_y-622; $doy2_sh=$doy2_g+$a2;
 }
 if($doy2_sh<187){
  $shm=(int)(($doy2_sh-1)/31); $shd=$doy2_sh-(31*$shm++);
 }else{
  $shm=(int)(($doy2_sh-187)/30); $shd=$doy2_sh-186-($shm*30); $shm+=7;
 }
 return($mod2=='')?array($shy,$shm,$shd):$shy.$mod2.$shm.$mod2.$shd;
}

/*	F	*/
function shamsi_to_gregorian($sh_y,$sh_m,$sh_d,$mod2=''){
	$g_y=tr_num2($sh_y); $sh_m=tr_num2($sh_m); $sh_d=tr_num2($sh_d);/* <= :اين سطر ، جزء تابع اصلي نيست */
 $d_42=($sh_y+1)%4;
 $doy2_sh=($sh_m<7)?(($sh_m-1)*31)+$sh_d:(($sh_m-7)*30)+$sh_d+186;
 $d_33=(int)((($sh_y-55)%132)*.0305);
 $a2=($d_33!=3 and $d_42<=$d_33)?287:286;
 $b2=(($d_33==1 or $d_33==2) and ($d_33==$d_42 or $d_42==1))?78:(($d_33==3 and $d_42==0)?80:79);
 if((int)(($sh_y-19)/63)==20){$a2--;$b2++;}
 if($doy2_sh<=$a2){
  $gy2=$sh_y+621; $gd2=$doy2_sh+$b2;
 }else{
  $gy2=$sh_y+622; $gd2=$doy2_sh-$a2;
 }
 foreach(array(0,31,($gy2%4==0)?29:28,31,30,31,30,31,31,30,31,30,31) as $gm2=>$v2){
  if($gd2<=$v2)break;
  $gd2-=$v2;
 }
 return($mod2=='')?array($gy2,$gm2,$gd2):$gy2.$mod2.$gm2.$mod2.$gd2;
}

// Yesterday Today Tomorrow
$hours = shamsidate('H');
$minutes = shamsidate('i');
$seconds = shamsidate('s');
$time = "".$hours.":".$minutes.":".$seconds."";
$day=shamsidate('j');
$month = shamsidate('n');
$year = shamsidate('y');
if($day >= 0 && $day <= 9)
{
	$D="0".$day."";
}
else
{
	$D=$day;
}
if($month >= 0 && $month <= 9)
{
	$M="0".$month."";
}
else
{
	$M=$month;
}
if(substr($year,0,1)=='0')
{
	$Y="14".$year."";
}
else
{
	$Y="13".$year."";
}
$join_today="".$Y."/".$M."/".$D."";