<meta charset="UTF-8">     
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


  <section id="container" class="">
      <!--header start-->
      <header class="header white-bg">
            <div class="sidebar-toggle-box">
                <div data-original-title="Toggle Navigation" data-placement="right" class="icon-reorder tooltips"></div>
            </div>
            <!--logo start-->
            <a href="#" class="logo">پرتال کانون <span>سردفتران کرمانشاه</span></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    <!-- نوتیفکیشن اسناد -->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="icon-file-alt"></i>
<span class="badge bg-success"><?php $posts_sql =  "SELECT * FROM document WHERE document_shm=0 ORDER BY document_id  desc limit 9999	"; $posts_result = mysql_query($posts_sql);
 $nsanad = mysql_num_rows($posts_result); echo $nsanad;  ?> </span>
                        </a>
                        <ul class="dropdown-menu extended tasks-bar">
                            <div class="notify-arrow notify-arrow-green"></div>
                            <li>
<p class="green">شما <?php echo $nsanad; ?> سند جدید دارید</p>
                            </li>
           
<?php $posts_sql =  "SELECT 
document.document_id  , document.document_organ , document.document_payment , document.document_clu  ,document_shm , document_shu , organ.organ_id , organ.organ_name FROM document inner JOIN organ ON document.document_organ=organ.organ_id  WHERE document_shm=0 ORDER BY document_id  desc limit 5	"; $posts_result = mysql_query($posts_sql);  while($posts_row = mysql_fetch_assoc($posts_result)) {  ?>                            
<li> <a href="obserdoc.php?id=<?php echo $posts_row['document_id']; ?>"> <span class="label label-success"><i class="icon-file-alt"></i></span><span>&nbsp;</span>
<?php echo $posts_row['organ_name'].'&nbsp;مبلغ&nbsp;'.$posts_row['document_clu'].'&nbsp;ريال'; ?></a> </li>
<?php } ?>
 <li class="external"> <a href="documents.php">نمایش  همه اسناد</a> </li>
                        </ul>
                    </li>
                    <!-- پایان اسناد-->
                    
                    
                    <!-- نوتیفکیشن پیامها-->
                    
                    <li id="header_inbox_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="icon-envelope-alt"></i>
                            <span class="badge bg-terques"><?php
 $posts_sql =  "SELECT * FROM email WHERE   `em_sht` = '0' && em_to = 'admin' ORDER BY em_id  desc limit 9999	"; $posts_result = mysql_query($posts_sql);
 $nemailt = mysql_num_rows($posts_result);                            
                            
                            
$posts_sql =  "SELECT * FROM email WHERE `em_flg` = '0'  &&  `em_sht` = '0' && em_to = 'admin' ORDER BY em_id  desc limit 9999	"; $posts_result = mysql_query($posts_sql);
 $nemail = mysql_num_rows($posts_result); echo $nemail;  ?></span>
                        </a>
                        <ul class="dropdown-menu extended inbox">
                            <div class="notify-arrow notify-arrow-payam"></div>
                            <li>
                                <p class="terques">شما <?php echo $nemail; ?> پیام جدید دارید</p>
                            </li>
                            

           
<?php $posts_sql =  "SELECT * FROM email WHERE `em_flg` = '0'  &&  `em_sht` = '0'  && em_to = 'admin'  ORDER BY em_id  desc limit 5	"; $posts_result = mysql_query($posts_sql);  while($posts_row = mysql_fetch_assoc($posts_result)) {  ?> 
                            
                            <li>
                                <a href="reademail.php?id= <?php echo $posts_row['em_id']; ?> ">
                                    <span class="photo"><img alt="avatar" src="img/avatar-mini3.jpg"></span>
                                    <span class="subject">
                                    <span class="from"><?php echo $posts_row['em_from']; ?>@knotary.ir</span>
                                  
                                    </span>
                                    <span class="message">
                                       <?php echo $posts_row['em_tit']; ?>
                                    </span>
                                </a>
                            </li>
 <?php } ?>                           
                            
                        
                        
                            <li>
                                <a href="email.php">نمایش تمامی پیام ها</a>
                            </li>
                        </ul>
                    </li>
                    <!-- پایان پیامها -->
                    
               
                    
                    
                                        <!-- نوتیفکیشن شکایات-->
                    <li id="header_notification_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                            <i class="icon-frown"></i>
                            <span class="badge bg-important">3</span>
                        </a>
                        <ul class="dropdown-menu extended notification">
                            <div class="notify-arrow notify-arrow-shekayat"></div>
                            <li>
                                <p class="red">شما 4 شکایت جدید دارید</p>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="label label-shekayat"><i class="icon-frown"></i></span><span>&nbsp;</span>
                                    اطلاعیه 1    </a>
                            </li>

                            <li>
                                <a href="#">
                                    <span class="label label-shekayat"><i class="icon-frown"></i></span><span>&nbsp;</span>
                                    اطلاعیه 2  </a>
                            </li>

                            <li>
                                <a href="#">
                                    <span class="label label-shekayat"><i class="icon-frown"></i></span><span>&nbsp;</span>
                                    شکایت 3  </a>
                            </li>

                            <li>
                                <a href="#">نمایش تمامی اطلاعیه ها</a>
                            </li>
                        </ul>
                    </li>
                    <!-- اتمام شکایات -->

                    
                    
                   
                    
                    
                    
                    <!-- نوتیفکیشن اطلاعیه ها-->
             <!--        <li id="header_notification_bar" class="dropdown">      -->
              <!--           <a data-toggle="dropdown" class="dropdown-toggle" href="#">      -->
 <!--    -->  
               <!--              <i class="icon-bell-alt"></i>      -->
              <!--               <span class="badge bg-elan">4</span>        -->
             <!--            </a>
            <!--             <ul class="dropdown-menu extended notification">           -->
             <!--                <div class="notify-arrow notify-arrow-elan"></div>         -->
              <!--               <li>         -->
             <!--                    <p class="elan">شما 4 اطلاعیه جدید دارید</p>       -->
            <!--                 </li>       -->
           <!--                  <li>       -->
           <!--                      <a href="#">       -->
             <!--                        <span class="label label-elan"><i class="icon-bell-alt"></i></span><span>&nbsp;</span>          -->
             <!--                        اطلاعیه 1    </a>         -->
             <!--                </li>          -->
 <!--         -->
          <!--                   <li>       -->
         <!--                        <a href="#">       
                                    <span class="label label-elan"><i class="icon-bell-alt"></i></span><span>&nbsp;</span>  -->
         <!--                            اطلاعیه 2  </a>       -->
         <!--                    </li>          -->
 <!--           -->
        <!--                     <li>           -->
       <!--                          <a href="#">   -->
       <!--                             <span class="label label-elan"><i class="icon-bell-alt"></i></span><span>&nbsp;</span>       -->
       <!--                              شکایت 3  </a>          -->
       <!--                      </li>      -->
      <!--                       <li>         -->
      <!--                           <a href="#">     -->
      <!--                               <span class="label label-elan"><i class="icon-bell-alt"></i></span><span>&nbsp;</span>       -->
      <!--                                جلسه کانون                 </a>        -->
      <!--                       </li>            -->                    

      <!--                       <li>        -->
   <!--                              <a href="#">نمایش تمامی اطلاعیه ها</a>         -->
    <!--                         </li>     
                        </ul>      -->
 <!--                    </li>     -->
                    <!-- پایان اطلاعیه ها-->
                    
                   
                    
                    
                                        <!-- نوتیفکیشن تیکت-->
                    <li id="header_notification_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                            <i class="icon-phone-sign"></i>
                            <span class="badge bg-tiket"><?php $posts_sql =  "SELECT 
tiktit.tikt_id ,  tiktit.tikt_tit ,  tiktit.tikt_des , tiktit.tikt_by ,  tiktit.tikt_date ,  tiktit.tikt_flg , tiktit.tikt_bak , tusers.user_id ,  tusers.name ,  tusers.family , tusers.user_user from  tiktit   inner JOIN tusers ON  tiktit.tikt_by = tusers.user_id  where tikt_flg  = 1 ORDER BY tikt_id  desc limit 9999"; $posts_result = mysql_query($posts_sql);
 $ntiket = mysql_num_rows($posts_result); echo $ntiket;  ?></span>
                        </a>
                        <ul class="dropdown-menu extended notification">
                            <div class="notify-arrow notify-arrow-tiket"></div>
                            <li>
                                <p class="tiket">شما <?php  echo $ntiket;  ?> تیکت جدید دارید</p>
                            </li>
                            
<?php $posts_sql =  "SELECT tiktit.tikt_id ,  tiktit.tikt_tit ,  tiktit.tikt_des , tiktit.tikt_by ,  tiktit.tikt_date ,  tiktit.tikt_flg , tiktit.tikt_bak , tusers.user_id ,  tusers.name ,  tusers.family , tusers.user_user , tusers.user_nd from  tiktit   inner JOIN tusers ON  tiktit.tikt_by = tusers.user_id  where tikt_flg  = 1 ORDER BY tikt_id  desc limit 5"; $posts_result = mysql_query($posts_sql);  while($posts_row = mysql_fetch_assoc($posts_result)) {  ?>                             
                            
                            
                            <li>
                                <a href="admintik.php?id= <?php echo $posts_row['tikt_id']; ?>">
                                    <span class="label label-tiket"><i class="icon-bolt"></i></span><span>&nbsp;</span>
<?php echo $posts_row['name'];  ?>      &nbsp; <?php echo $posts_row['family'];  ?> &nbsp;
                                 دفتر ثبت اسناد 
                                 <?php echo $posts_row['user_nd'];  ?>
                                 </a>

                            </li>

     <?php }  ?>

                            <li>
                                <a href="admintiklist.php">نمایش تمامی تیکت ها</a>
                            </li>
                        </ul>
                    </li>
                    <!-- پایان تیکت ها -->
                    
                
                    
                    
                </ul>
                <!--  notification end -->
            </div>
            <div class="top-nav ">
                <!--اطلاعات پروفایل-->
                <ul class="nav pull-left top-menu">
                                        <!-- پروفایل-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="img/avatar1_small.jpg">
                            <span class="username"> مدیریت سایت</span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <li><a href="#"><i class=" icon-suitcase"></i>پروفایل</a></li>
                            <li><a href="#"><i class="icon-lock"></i>تغییر رمز عبور</a></li>
                             <li><a href="singout.php"><i class="icon-key"></i> خروج</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!--search & user info end-->
            </div>
        </header>
      <!--header end-->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu">
                  <li class="active">
                      <a class="" href="admin.php">
                          <i class="icon-home"></i>
                          <span>صفحه اصلی</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="icon-dashboard"></i>
                          <span>امکانات سامانه</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
<li><a class="" href="recvfile.php">فایل های دریافتی   <span class="label label-danger pull-left mail-info">8</span></a></li>
<li><a class="" href="uploadfile.php">آپلود فایل</a></li>
<li><a class="" href="pishnahads.php"> نظرات و پیشنهادات  <span class="label label-danger pull-left mail-info"><?php $posts_sql =  "SELECT * FROM pish WHERE `pish_shm` = '0' && `pish_flg` = '1'    ORDER BY pish_id  desc limit 9999	"; $posts_result = mysql_query($posts_sql);
 $n = mysql_num_rows($posts_result); echo $n;  ?></span></a></li>
<li><a class="" href="kesuls.php">مشکلات گزارش شده   <span class="label label-danger pull-left mail-info"><?php $posts_sql =  "SELECT * FROM pish WHERE `pish_shm` = '0' && `pish_flg` = '2'    ORDER BY pish_id  desc limit 9999	"; $posts_result = mysql_query($posts_sql);
 $n = mysql_num_rows($posts_result); echo $n;  ?></span></a></li>
<li><a class="" href="#">آخرین تغییرات سامانه</a></li>
                      </ul>
                  </li>
                  
                     <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="icon-group"></i>
                          <span>کاربران</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                      
                      <li><a class="" href="#">مدیران  </a></li>
                      
                      
                          <li><a class="" href="users.php">دفاتر اسناد رسمی     <span class="label label-danger pull-left mail-info">2</span></a></li>
                          <li><a class="" href="daftaryars.php">دفتریاران   <span class="label label-danger pull-left mail-info">1</span></a></li>
                          <li><a class="" href="organs.php">ارگان ها   <span class="label label-danger pull-left mail-info">5</span></a></li>

                         
                      </ul>
                  </li>
               
                  
                  
                  <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="icon-envelope"></i>
                          <span>پیامها</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          
                          <li><a class="" href="email.php">پیامها </a></li>
                          <li><a class="" href="elanats.php">اطلاعیه ها   <span class="label label-danger pull-left mail-info">1</span></a></li>
                          <li><a class="" href="admintiklist.php">تیکت ها   <span class="label label-danger pull-left mail-info"><?php echo $ntiket; ?></span></a></li>

                         
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="icon-file-alt"></i>
                          <span>اسناد</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
<li><a class="" href="documents.php">اسناد دریافتی</a></li>
<li><a class="" href="documentswait.php">اسناد منتظر تائید   <span class="label label-danger pull-left mail-info"><?php echo $nsanad; ?></span></a></li>
                          <li><a class="" href="#">گزارش گیری از اسناد</a></li>
                          
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="icon-frown"></i>
                          <span>شکایات</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li><a class="" href="#">شکایات همکاران   <span class="label label-danger pull-left mail-info">2</span></a></li>
                          <li><a class="" href="#">شکایات اربابان رجوع  <span class="label label-danger pull-left mail-info">2</span> </a></li>
                           <li><a class="" href="#">شکایات مختومه</a></li>
                      </ul>
                  </li>
                  
                  <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="icon-phone"></i>
                          <span>دفتر تلفن</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li><a class="" href="#">گروه های مخاطبین</a></li>
                          <li><a class="" href="#">درج مخاطب جدید</a></li>
                          <li><a class="" href="#">مخاطبین موجود</a></li>
                          <li><a class="" href="#">شماره تماس های همکاران</a></li>
                          <li><a class="" href="#">تلفن های ضروری</a></li>
                      </ul>
                  </li>
                  
                  
                                 <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="icon-food"></i>
                          <span>امور رفاهی</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li><a class="" href="#">ایجاد مرکز جدید</a></li>
                          <li><a class="" href="#">مراکز طرف قرارداد</a></li>
                          <li><a class="" href="#">درخواست های رزرو   <span class="label label-danger pull-left mail-info">2</span></a></li>
                          <li><a class="" href="#">درخواست های ایجاد
                          <br> مرکز جدید <span class="label label-danger pull-left mail-info">2</span></a></li>
                          <li><a></a></li>
                      </ul>
                  </li> 
                  
                                      <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="icon-cog"></i>
                          <span>تنظیمات</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li><a class="" href="docsetting.php">اسناد</a></li>
                          <li><a class="" href="#">شکایات</a></li>
                          <li><a class="" href="tabnul.php">کاربران</a></li>
                      </ul>
                  </li> 
                  
             
                                         <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="icon-download-alt"></i>
                          <span>دانلود</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li><a class="" href="#">دانلود ها </a></li>
                      </ul>
                  </li> 
               
                  
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->  