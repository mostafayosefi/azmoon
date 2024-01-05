<?php
				
public function addadminm(){ 

if (Session::has('signadmin')){ if (Session::get('activeadmin')==1){  if (Session::get('accessadmin_ticketprofessor')==1) {
	
	return view('admin/addadmin');
	  
}else if(Session::get('accessadmin_ticketprofessor')==0){return redirect('admin/accessadmin'); }}else if (Session::get('activeadmin')==0){  return redirect('admin/activition'); }}else if (empty(Session::has('signadmin'))){   return redirect('admin/sign-in');}

}




  }	
else{ return redirect('admin/sign-in'); } 


Session::set('accessadmin_admin', $accessadmins->accessadmin_admin);
	Session::set('accessadmin_professor', $accessadmins->accessadmin_professor);	
	
	Session::set('accessadmin_student', $accessadmins->accessadmin_student);
	Session::set('accessadmin_level', $accessadmins->accessadmin_level);	
	
	Session::set('accessadmin_period', $accessadmins->accessadmin_period);
	Session::set('accessadmin_lesson', $accessadmins->accessadmin_lesson);	
	
	Session::set('accessadmin_clas', $accessadmins->accessadmin_clas);
	Session::set('accessadmin_tuition', $accessadmins->accessadmin_tuition);	
	
	Session::set('accessadmin_page', $accessadmins->accessadmin_page);
	Session::set('accessadmin_new', $accessadmins->accessadmin_new);	
	
	Session::set('accessadmin_question', $accessadmins->accessadmin_question);
	Session::set('accessadmin_edvence', $accessadmins->accessadmin_edvence);	
	
	Session::set('accessadmin_groupstudent', $accessadmins->accessadmin_groupstudent);
	
	Session::set('accessadmin_ticketprofessor', $accessadmins->accessadmin_ticketprofessor);
	Session::set('accessadmin_ticketstudent', $accessadmins->accessadmin_ticketstudent);







	if (Session::has('signprofessor')){ 
		if (Session::get('activeprofessor')==1){ 
		
		
}	else if (Session::get('activeprofessor')==0){    return redirect('professor/activition'); }
else if (empty(Session::has('signprofessor'))){   return redirect('professor/sign-in'); } }
	



	if (Session::has('signstudent')){ 
		if (Session::get('activestudent')==1){ 
		
		
}	else if (Session::get('activestudent')==0){    return redirect('student/activition'); }
else if (empty(Session::has('signstudent'))){   return redirect('student/sign-in'); } }
	