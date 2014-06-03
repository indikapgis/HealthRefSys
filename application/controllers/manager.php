<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Manager extends CI_Controller {
    
   function __construct() {
        parent::__construct();
        $this->is_logged_in();
        $this->file_path = realpath((APPPATH) . '/../uploads');

    }

   function index() {
        $data['page_title'] = "© ABC Company - Manager";
        $data['page_heading'] = "Manage Events - Search Events";
        $data['main_content'] = 'manager/index';
        $this->load->model('event_model');
     
        if($this->input->post('is_search') == 1){
            $data['events'] = $this->event_model->find_events();
        } else {
              
            $data['events'] = $this->event_model->get_all_event();
        }

        $this->load->view('layout', $data);
    }
      
   function users() {
        $data['page_title'] = "© ABC Company - Manage Users";
        $data['page_heading'] = "Manage Users - Employee List";
        $data['main_content'] = 'manager/users';
        $this->load->model('employee_model');
        $data['employees'] = $this->employee_model->get_employees();
        $this->load->view('layout', $data);
    }
    
   function is_logged_in() {

        $is_logged_in = $this->session->userdata('is_logged_in');
        if ((!isset($is_logged_in) || $is_logged_in != TRUE) || $this->session->userdata('user_level') == 4) {
            $this->session->set_flashdata('return_url', current_url());
            redirect('user/login');
        }
    }

   function delete() {
        $this->load->model('employee_model');
        $this->employee_model->delete_employee($this->uri->segment(3));
        $this->session->set_flashdata('msg', 'Employee has been deleted.');
        redirect('manager/users');
    }

   function edit() {
        if ($this->input->post('is_update') == 1) {            
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Full Name', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
            $this->form_validation->set_rules('password2', 'Password Confarmation', 'trim|required|matches[password]');
            $this->form_validation->set_rules('accesslevel', 'Access Level', 'trim|required');
            $this->form_validation->set_rules('emailaddress', 'Email Address', 'trim|required|valid_email');

            if ($this->form_validation->run() == TRUE) {
                $this->load->model('employee_model');
                if ($query = $this->employee_model->update_employee()) {
                    $this->session->set_flashdata('msg', 'Employee has been Updated.');
                    redirect('manager/users');
                }
            }
        }

        $data['page_title'] = "© ABC Company - Manage Users";
        $data['page_heading'] = "Manage Users - Employee Edit";

        $this->load->model('office_location_model');
        $data['officelocation'] = $this->office_location_model->get_office_location();
        $this->load->model('employee_model');
        $data['main_content'] = 'manager/edit';
        $data['employee'] = $this->employee_model->get_employee($this->uri->segment(3));
        $this->load->view('layout', $data);
    }

   function new_employee() {
        $data['page_title'] = "© ABC Company - Manage Users";
        $data['page_heading'] = "Manage Users - Add New Employee";
        
        $this->load->model('office_location_model');
        $data['officelocation'] = $this->office_location_model->get_office_location();

        if ($this->input->post('is_submit') == 1) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Full Name', 'trim|required');
            $this->form_validation->set_rules('username', 'User Name', 'trim|required|min_length[4]|callback_check_username');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
            $this->form_validation->set_rules('password2', 'Password Confarmation', 'trim|required|matches[password]');
            $this->form_validation->set_rules('accesslevel', 'Access Level', 'trim|required');
            $this->form_validation->set_rules('emailaddress', 'Email Address', 'trim|required|valid_email');

            if ($this->form_validation->run() == TRUE) {
                $this->load->model('employee_model');
                if ($query = $this->employee_model->create_user()) {
                    $this->session->set_flashdata('msg', 'Employee has been Added.');
                    redirect('manager/users');
                }
            }
        }

        $data['main_content'] = 'manager/new_employee';
        $this->load->view('layout', $data);
    }

   function check_username($username) {

        if ($username != "") {
            $this->load->model('employee_model');
            if ($this->employee_model->check_username()) {
                $this->form_validation->set_message('check_username', 'The %s is already exist.');
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

   function physician() {
        $data['page_title'] = "© ABC Company - Manage physician";
        $data['page_heading'] = "Manage Physicians - Physician List";
        $data['main_content'] = 'manager/physician';
        $this->load->model('physician_model');
        $data['physicians'] = $this->physician_model->get_all_physician();
        $this->load->view('layout', $data);
    }

   function physicians() {
        $data['page_title'] = "© ABC Company - Manager";
        $data['page_heading'] = "Manage Physicians - Search Physicians";
        $data['main_content'] = 'manager/physician';
        $this->load->model('physician_model');
        
        if($this->input->post('is_search') == 1){
            $data['physicians'] = $this->physician_model->find_physicians();
        } else {
            $data['physicians'] = $this->physician_model->get_all_physician();
        }

        $this->load->view('layout', $data);
    }

   function events() {
        $data['page_title'] = "© ABC Company - Manager";
        $data['page_heading'] = "Manage Events - Search Events";
        $data['main_content'] = 'manager/index';
        $this->load->model('event_model');
        
        if($this->input->post('is_search') == 1){
            $data['events'] = $this->event_model->find_events();
        } else {
              
            $data['events'] = $this->event_model->get_all_events();
        }

        $this->load->view('layout', $data);
    }
    
   function view_physician() {
        $data['page_heading'] = "View Physician";
        $data['main_content'] = 'manager/view_physician';
        $this->load->model('physician_model');
        $data['physician'] = $this->physician_model->get_physician($this->uri->segment(3));
        $this->load->view('layout', $data);
    }

   function set_status() {
        $this->load->model('physician_model');
        $this->physician_model->set_physician_status($this->uri->segment(3),$this->uri->segment(4));
        $this->session->set_flashdata('msg', 'Physician has been Updated.');
        redirect('manager/physician');
    }

   function set_opera_code() {
        $new_opera_code = "OPERAS".rand(1001,9999);
        $this->load->model('physician_model');
        $this->physician_model->update_new_physician_status($this->uri->segment(3),$this->uri->segment(4), $this->uri->segment($new_opera_code));
        $this->session->set_flashdata('msg', 'Physician has been Updated.');
        redirect('manager/physician');

    }

   function check_opera_code($new_opera_code) {
        if ($new_opera_code != "") {
            $this->load->model('physician_model');
            if ($this->physician_model->check_opera_code()) {
                $this->form_validation->set_message('check_opera_code', 'The %s is already exist.');
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

   function create_event() {
        $data['page_title'] = "© ABC Company - Create Event";
        $data['page_heading'] = "Manage Events - Create Event";

        $data['main_content'] = 'manager/create_event';
        $this->load->view('layout', $data);
    }      
   
   function patients() {
        $data['page_title'] = "© ABC Company - Manager";
        $data['page_heading'] = "Manage Patients - Patients List";
        $data['main_content'] = 'manager/patients';
        $this->load->model('patients_model');
        
        if($this->input->post('is_search') == 1){
            $data['patients'] = $this->patients_model->find_patients();
        } else {
            $data['patients'] = $this->patients_model->get_all_patients();
        }

        $this->load->view('layout', $data);
    }
   
   function view_patient() {
        $data['page_heading'] = "View Patient";
        $data['main_content'] = 'manager/view_patient';
        $this->load->model('patients_model');
        $data['patient'] = $this->patients_model->get_patient($this->uri->segment(3));
        $this->load->view('layout', $data);
    }
 
   function view_event() {
       
        $data['page_title'] = "Â© ABC Company - Manager";
        $this->load->model('event_model');
        if (strlen($this->uri->segment(3))<>30) {
            if (strcmp(substr($this->uri->segment(3),0,6),"INFREQ") == 0) {
                  $data['page_heading'] = "Local Events - Event Detail";
                  $data['main_content'] = 'manager/view_local_event';
                  $data['events'] = $this->event_model->get_infreq_from_event($this->uri->segment(3));
             }
            Else  if (strcmp(substr($this->uri->segment(3),0,6),"PATRPT") == 0) {
                           
                  $data['page_heading'] = "Patient Reports - Event Detail";
                  $data['main_content'] = 'manager/view_patrpt_events';
                  $this->load->model('patient_report_model');
                  $data['attach_docs'] = $this->patient_report_model->get_patreports_by_referraleventnumber($this->uri->segment(3));
                  $data['events'] = $this->event_model->get_patrpt_from_event($this->uri->segment(3));
             }             
             else {
             $data['page_heading'] = "Cancel / Reschedule Events - Event Detail";
             $data['main_content'] = 'manager/view_local_event';
             $data['events'] = $this->event_model->get_only_from_event($this->uri->segment(3));
             }
        } 
        else {
           
            $data['page_heading'] = "Curent Events - Event Detail"; 
            $data['main_content'] = 'manager/view_event';
            $this->load->model('patients_model');
            $this->load->model('physician_doc_model');
            $this->load->model('patient_report_model');
            $data['events'] = $this->event_model->get_event($this->uri->segment(3));
            $data['attach_docs'] = $this->physician_doc_model->get_docs_by_referraleventnumber($this->uri->segment(3));
            $data['attach_reports'] = $this->patient_report_model->get_reports_by_referraleventnumber($this->uri->segment(3));
            } 
      
        $this->load->view('layout', $data);
    }

   function update_event() {    
             $physiciannote      = $this->input->post('physiciannote');
             $strrefno = $this->input->post('referenceno');
             $demail = $this->input->post('demail');
             $demail1 = $this->input->post('demail1');
 
                            $dname = $this->input->post('dname');
                            $pname = $this->input->post('first_name').' '.$this->input->post('last_name');
                            $contacts = $this->input->post('Home_Phone') .' / '. $this->input->post('Cell').' / '.$this->input->post('Office_Phone');
                      //Addedd by Manjula
                            $eventnumber = $this->input->post('eventnumber');
                            $prioritynumber = $this->input->post('prioritynumber');
                            $patientname = $this->input->post('patientname');
                            $rdoctor = $this->input->post('requesteddoctor');
                            $rdaddress = $this->input->post('addressline');
                             
                            $preferreddoctorid = $this->input->post('preferreddoctorid');
                            $clinicalhistory = $this->input->post('clinicalhistory');
                           
                            $chartnumber = $this->input->post('chartnumber');
                          
                      
                           
                               $config['upload_path'] = $this->file_path;
                               $config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx|rtf';
                               $config['max_size'] = '1000';
                               $config['max_width'] = '1024';
                               $config['max_height'] = '768';

                              $this->load->library('image_lib');
                              $this->load->library('upload', $config);
                              $this->upload->do_upload('test');
                              $data['error'] = $this->upload->display_errors();
                              $image_data = $this->upload->data();
                              $upload_file_name = $image_data['file_name'];
                             
                              if($upload_file_name != ''){
                                $this->load->model('patient_report_model');
                                $quary = $this->patient_report_model->insert_attach_reports($upload_file_name, $this->input->post('physicianid'), $this->input->post('patientid'));
                                                            
                                }
                              

                                               
                           if (isset($attachdoc1)) 
                             {$attachdoc1 = "No Files Attached..."; } 
                       
                       //********************** End October 1st *************      
                           $notesforocc   = $this->input->post('notesforocc');       
                         
                            
                         //   echo  $physiciannote; echo die;
                            $disease_notes = $this->input->post('other1');
                            $eventstatusid = $this->input->post('eventstatusid'); 
                            if ($eventstatusid == 1) 
                                {$eventstatus = "Request Received"; }
                            if ($eventstatusid == 2) 
                                {$eventstatus = "Re-Scheduled"; }
                            if ($eventstatusid == 3) 
                                {$eventstatus = "In Progress"; }
                            if ($eventstatusid == 4) 
                                {$eventstatus = "Request Completed"; }
                            if ($eventstatusid == 5) 
                                {$eventstatus = "Cancel By User"; }    
                            if ($eventstatusid == 6) 
                                {$eventstatus = "Terminated"; }    
                             
                           // $dob = $this->input->post('dob');  
                            $dob =  date('Y-m-d', $this->input->post('dob'));
                       //     echo $dob; echo die;
                            $officeid = $this->input->post('officeid');
                            if ($officeid==1)
                                {$office = 'Toronto Office'; }
                            if ($officeid==2)
                                {$office = 'Guyana Office'; }    
                            $phyfaxnumber = $this->input->post('phyfaxnumber');
                            
                            $occ_doctor = $this->input->post('clinic_doctor');
                            $cos = $this->input->post('osbestcorrected');
                            $cod = $this->input->post('odbestcorrected');
                            $ros = $this->input->post('osrefrection');
                            $rod = $this->input->post('odrefrection');
                            $iopid = $this->input->post('iopod');
                            $iopis = $this->input->post('iopos');
                       //Retinal Disease
                        
                            if ($this->input->post('chkrddiabetes1')== 1)
                               { $chkrddiabetes = "Retinal Diabetes"; }
                            if ($this->input->post('chkrdarmd1')== 1)
                               { $chkrdarmd  = "ARMD"; }
                            if ($this->input->post('chkrdretinaldisease1')== 1)
                               { $chkrdretinaldisease = "Retinal Disease"; }
                            if ($this->input->post('chkrdvascular1')== 1)
                               { $chkrdvascular  = "Vascular"; }
                        //Glucoma
                            if ($this->input->post('chkgchighiop1')== 1)
                               { $chkgchighiop = "High IOP"; }
                            if ($this->input->post('chkgcfieldloss1')== 1)
                               { $chkgcfieldloss  = "Field Loss"; }
                            if ($this->input->post('chkgcdiskcuppling1')== 1)
                               { $chkgcdiskcuppling = "Disc Cupping"; }
                            if ($this->input->post('chkgcnarrowangles1')== 1)
                               { $chkgcnarrowangles  = "Narrow Angles"; }
                       //Cataract
                            if ($this->input->post('chkctrighteye1')== 1)
                               { $chkctrighteye = "Right Eye"; }
                            if ($this->input->post('chkctlefteye1')== 1)
                               { $chkctlefteye  = "Left Eye"; }
                            if ($this->input->post('chkctclearlens1')== 1)
                               { $chkctclearlens = "Clear Lens"; }
                            if ($this->input->post('chkctioc1')== 1)
                               { $chkctioc  = "Speciality IOC"; }
                       //Plastics
                           if ($this->input->post('chkpleyelid1')== 1)
                               { $chkpleyelid = "Eyelid"; }
                            if ($this->input->post('chkplorba1')== 1)
                               { $chkplorba  = "Orbit"; }
                            if ($this->input->post('chkpltearduct1')== 1)
                               { $chkpltearduct = "Tear Duct"; }
                            if ($this->input->post('chkplcosmetic1')== 1)
                               { $chkplcosmetic  = "Cosmetic"; }
                        
                            if ($preferreddoctorid == 1)
                            { $doc_name = 'Dr.  Dan Deangelis';}
                            elseif ($preferreddoctorid == 2)
                            { $doc_name = 'Dr.  David Yan';}
                            elseif ($preferreddoctorid == 3)
                            { $doc_name = 'Dr.  Fareed Ali';}
                            elseif ($preferreddoctorid == 4)
                            { $doc_name = 'Dr.  Narendra Armogen';}
                            else { $doc_name = 'No Doctor is Assigned';}

             
              $this->load->model('event_model');
              
              if(strtoupper($this->input->post("delete")) == 'DELETE'){
                $this->load->model('event_model');
                $this->event_model->delete_local_event($this->uri->segment(3));
                $this->session->set_flashdata('msg', 'Event has been Deleted');
                redirect('manager/index');

              } 
              if ($this->input->post('print') == 'Print'){
                            $query = $this->event_model->update_event();
                                       

                            $htmlMessage1 = '
                                 <hr width=100%>
                                <b>Event Number : </b>'. $eventnumber.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                              
                                <b> Patient Name : </b>'.$patientname.'<br /><br />
                                <b>Requested Doctor :</b>'.$rdoctor.'  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                <b>Requested Doctors Office :</b>'.$rdaddress.'     <br /><br />
                                   
                                <b>Status : </b>'.$eventstatus.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <b>Assigned Doctor : </b>'.$doc_name.'   <br /><br />  
                               
                                <b>DOB :</b>'. $dob.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                <b>Physicians Fax Number : </b>'.$phyfaxnumber.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  <b>Priority : </b>' . $prioritynumber.' &nbsp;&nbsp;&nbsp;&nbsp;      <br />
                                <hr width=100%><br />
                                <b> Clinical History : </b>'.$clinicalhistory.'  <br /><br />
                                <b> Notes For OCC : </b>'.$notesforocc.' <br /><br />
                                <b> Notes To Doctor : </b>'.$physiciannote.'  <br /><br />
                               
                                <b><u> Results - Eye Examination </u></b>
                                <p><b> Corrected OD:  20/</b>'.$cod.' &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   <b>Corrected  OS: 20/</b>'.$cos.' &nbsp;&nbsp; 
                                <p><b>Refraction OD: </b>'.$rod.' &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <b>Refraction OS:</b> '.$ros.' &nbsp;&nbsp; 
                                <p><b>IOP ID: </b>'.$iopid.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;  <b> IOP IS: </b>'.$iopis.'</p> 
                                <p><b><u>Results - Disease Information </u></b></p>
                                <b>Retinal Disease :</b>
                                '.$chkrddiabetes.'&nbsp;&nbsp; '.$chkrdarmd.' &nbsp;&nbsp; '.$chkrdretinaldisease.' &nbsp;&nbsp; '.$chkrdvascular.' <br />
                                <b>Glaucoma :</b>
                                '.$chkgchighiop.'&nbsp;&nbsp; '.$chkgcfieldloss.' &nbsp;&nbsp; '.$chkgcdiskcuppling.' &nbsp;&nbsp; '.$chkgcnarrowangles.'  <br />
                                <b>Cataract: </b>
                                 '.$chkctrighteye.'&nbsp;&nbsp; '.$chkctlefteye.' &nbsp;&nbsp; '.$chkctclearlens.' &nbsp;&nbsp; '.$chkctioc.' <br />
                                <b>Plastics :</b>
                                 '.$chkpleyelid.'&nbsp;&nbsp; '.$chkplorba.' &nbsp;&nbsp; '.$chkpltearduct.' &nbsp;&nbsp; '.$chkplcosmetic .' <br /><br />
                                <b>Disease Notes: </b>'.$disease_notes.' <br /><br /></p>  <hr width=100%> ';
                               

                            $data['body_massage'] = $htmlMessage1;
                            
                            $htmlMessage1 = $this->load->view('includes/event_print_template' , $data, TRUE);
                         
                            echo $htmlMessage1; die;
             } 
                  
                    if(isset($_POST['chksendemail']) == 'Yes') {   
                    
                            $this->load->library('email');
                            $pname = $this->input->post('first_name').' '.$this->input->post('last_name');
                            $physiciannote      = $this->input->post('physiciannote');
                            $contacts = $this->input->post('Home_Phone') .' / '. $this->input->post('Cell').' / '.$this->input->post('Office_Phone');
                     
                     
                     
                           $marketingmsg1 = 'ABC  ';
                           $marketingmsg2 = 'TEST';
                           $strref = 'Please use Reference No: '.$strrefno.', if you have concerns regarding this request / appointment';
                           
                           
                            $referral_email_template_new_patients = '<p> Dear Dr. '.$rdoctor.'  
                             <p>Thanks for your referral.  Please see summary below regarding your request.<br />
                             
                             <hr width=100%> 
                                <b> Referred Doctor: </b>'.$doc_name.'<br /><br />   
                                <b>Referral Number :</b> '.$eventnumber.' <br /><br />
                                <b>Patient Name : </b> '. $patientname .'   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br />    
                                
                              
                               
                               <br /> 
                               <b>Notes :</b> '.$physiciannote.'&nbsp;&nbsp;  <br />  <br />  
                              <label align="right"> '.$strref.' </label>  <br />  <br />      
                             
                               
                               </p>  <hr width=100%> ';  
                           
                              

                            $this->email->from('somaweera.b@gmail.com', 'ABC Company');
                            $this->email->to($demail);
                    
                                           
               
                            $this->email->subject('Your Reference No: '.$strrefno.'');
                            $data['body_massage'] = $referral_email_template_new_patients;
                            $referral_email_template_new_patients = $this->load->view('includes/email_template' , $data, TRUE);
                            $this->email->message($referral_email_template_new_patients);
                            $result = $this->email->send();
                            $query = $this->event_model->update_event();
                            $this->session->set_flashdata('msg', 'Referral has been updated.');
                      //      redirect('manager/index');
                            
                }
                   
                  
                     if (isset($_POST['chksendemailalt']) == 'Yes') {   
                   
                            $this->load->library('email');
                            $pname = $this->input->post('first_name').' '.$this->input->post('last_name');
                            $physiciannote      = $this->input->post('physiciannote');
                            $contacts = $this->input->post('Home_Phone') .' / '. $this->input->post('Cell').' / '.$this->input->post('Office_Phone');
                     
                                          
                           $marketingmsg1 = 'TEST  ';
                           $marketingmsg2 = 'TEST1.';
                           $strref = 'Please use Reference No: '.$strrefno.', if you have concerns regarding this request / appointment';
                           
               //if you need the name of the uploaded file get from $upload_file_name            
                            $referral_email_template_new_patients = '<p> Dear Dr. '.$rdoctor.'  
                              <p>Thanks for your referral.  Please see summary below regarding your request.<br />
                               
                             <hr width=100%> 
                                <b> Referred Doctor: </b>'.$doc_name.'<br /><br />   
                                <b>Referral Number :</b> '.$eventnumber.' <br /><br />
                                <b>Patient Name : </b> '. $patientname .'   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br />    
                                
                              
                               
                               <br /> 
                               <b>Notes :</b> '.$physiciannote.'&nbsp;&nbsp;  <br />  <br />  
                               <label align="right"> '.$strref.' </label>  <br />  <br />         
                             
                               
                               </p>  <hr width=100%> ';  
                           
                              

                            $this->email->from('somaweera.b@gmail.com', 'ABC Company');
                            $this->email->to($demail1);
                    
                           
                      
                    //        $this->email->bcc('somaweera.b@gmail.com');
                            $this->email->subject('Your Reference No: '.$strrefno.'');
                            $data['body_massage'] = $referral_email_template_new_patients;
                            $referral_email_template_new_patients = $this->load->view('includes/email_template' , $data, TRUE);
                            $this->email->message($referral_email_template_new_patients);
                            $result = $this->email->send();
                            $query = $this->event_model->update_event();
                            $this->session->set_flashdata('msg', 'Referral has been updated.');
                       //     redirect('manager/index');
                            
                }
                 
                    
                if ($query = $this->event_model->update_event()) {
                    $this->session->set_flashdata('msg', 'Event has been Saved.');
                    redirect('manager/index');
                 }
                 
                 
             
   }  
  
   
   function update_local_event() {    
            
              $this->load->model('event_model');
         //     echo $this->input->post('demail'); echo $this->input->post('demail1');;   die;
                            $strrefno = $this->input->post('referenceno');
                            $demail = $this->input->post('demail');
                            $demail1 = $this->input->post('demail1');
                            $dname = $this->input->post('dname');
                            $pname = $this->input->post('first_name').' '.$this->input->post('last_name');
                            $contacts = $this->input->post('Home_Phone') .' / '. $this->input->post('Cell').' / '.$this->input->post('Office_Phone');
                      //Addedd by Manjula
                            $eventnumber = $this->input->post('eventnumber');
                            $prioritynumber = $this->input->post('prioritynumber');
                            $patientname = $this->input->post('patientname');
                            $rdoctor = $this->input->post('requesteddoctor');
                            $rdaddress = $this->input->post('addressline');
                          
                            $preferreddoctorid = $this->input->post('preferreddoctorid');
                            $clinicalhistory = $this->input->post('submittedsummary');
                           
                            $physiciannote      = $this->input->post('physiciannote');
                            $notesforocc   = $this->input->post('notesforocc');       
                           
                            $disease_notes = $this->input->post('other1');
                            $eventstatusid = $this->input->post('eventstatusid'); 
                            if ($eventstatusid == 1) 
                                {$eventstatus = "Request Received"; }
                            if ($eventstatusid == 2) 
                                {$eventstatus = "Re-Scheduled"; }
                            if ($eventstatusid == 3) 
                                {$eventstatus = "In Progress"; }
                            if ($eventstatusid == 4) 
                                {$eventstatus = "Request Completed"; }
                            if ($eventstatusid == 5) 
                                {$eventstatus = "Cancel By User"; }    
                            if ($eventstatusid == 6) 
                                {$eventstatus = "Terminated"; }    
                                 
                            $officeid = $this->input->post('officeid');
                            if ($officeid==1)
                                {$office = 'Toronto Office'; }
                            if ($officeid==2)
                                {$office = 'Ottawa Office'; }    
                            $phyfaxnumber = $this->input->post('phyfaxnumber');
                            
                            $occ_doctor = $this->input->post('clinic_doctor');
                            
                       //Retinal Disease
                        
                           
                            if ($preferreddoctorid == 1)
                            { $doc_name = 'Dr.  A';}
                            elseif ($preferreddoctorid == 2)
                            { $doc_name = 'Dr.  B';}
                            elseif ($preferreddoctorid == 3)
                            { $doc_name = 'Dr.  C';}
                            elseif ($preferreddoctorid == 4)
                            { $doc_name = 'Dr.  D';}
                            else { $doc_name = 'No Doctor is Assigned';}

                        
              if(strtoupper($this->input->post("delete")) == 'DELETE'){
                $this->load->model('event_model');
                $this->event_model->delete_local_event($this->uri->segment(3));
                $this->session->set_flashdata('msg', 'Event has been Deleted');
                redirect('manager/index');
               
              } else if ($this->input->post('print') == 'Print'){
                  
                            
                            $htmlMessage1 = '
                                 <hr width=100%>
                                <b>Event Number : </b>'. $eventnumber.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                              
                                <b> Patient Name : </b>'.$patientname.'<br /><br />
                                <b>Requested Doctor :</b>'.$rdoctor.'  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                <b>Requested Doctors Office :</b>'.$rdaddress.'     <br /><br />
                               
                                <b>Status : </b>'.$eventstatus.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <b>Assigned Doctor : </b>'.$doc_name.'   <br /><br />  
                               
                                <b>Job Assigned To :</b>'. $office.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                <b>Physicians Fax Number : </b>'.$phyfaxnumber.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  <b>Priority : </b>' . $prioritynumber.'       <br />
                                <hr width=100%><br />
                                <b> Clinical History / Physician Requested Notes : </b>'.$clinicalhistory.'  <br /><br />
                                <b> Notes From Physician : </b>'.$notesforocc.' <br /><br />
                                <b> Notes To Doctor : </b>'.$physiciannote.'  <br /><br />
                             
                                 ';
                               

                            $data['body_massage'] = $htmlMessage1;
                            
                            $htmlMessage1 = $this->load->view('includes/event_info_print' , $data, TRUE);
                         
                            echo $htmlMessage1; die;
             } 
             
               if(isset($_POST['chksendemail']) == 'Yes') {   
                    
                            $this->load->library('email');
                            $pname = $this->input->post('first_name').' '.$this->input->post('last_name');
                            $physiciannote      = $this->input->post('physiciannote');
                            $contacts = $this->input->post('Home_Phone') .' / '. $this->input->post('Cell').' / '.$this->input->post('Office_Phone');
                     
                     
                     
                           $marketingmsg1 = 'ABC  ';
                           $marketingmsg2 = 'TEST';
                           $strref = 'Please use Reference No: '.$strrefno.', if you have concerns regarding this request / appointment';
                           
                           
                            $referral_email_template_new_patients = '<p> Dear Dr. '.$rdoctor.'  
                             <p>Thanks for your referral.  Please see summary below regarding your request.<br />
                             <label align="right">'.$marketingmsg1.'</label> <br />
                             <label align="right">'.$marketingmsg2.'</label>    
                             <hr width=100%> 
                                <b> Referred Doctor: </b>'.$doc_name.'<br /><br />   
                                <b>Referral Number :</b> '.$eventnumber.' <br /><br />
                                <b>Patient Name : </b> '. $patientname .'   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br />    
                                
                              
                               
                               <br /> 
                               <b>Notes :</b> '.$physiciannote.'&nbsp;&nbsp;  <br />  <br />  
                              <label align="right"> '.$strref.' </label>  <br />  <br />      
                            
                               
                               </p>  <hr width=100%> ';  
                           
                              

                            $this->email->from('somaweera.b@gmail.com', 'ABC Company');
                            $this->email->to($demail);
                    
                                           
               
                            $this->email->subject('Your Reference No: '.$strrefno.'');
                            $data['body_massage'] = $referral_email_template_new_patients;
                            $referral_email_template_new_patients = $this->load->view('includes/email_template' , $data, TRUE);
                            $this->email->message($referral_email_template_new_patients);
                            $result = $this->email->send();
                            $query = $this->event_model->update_event();
                            $this->session->set_flashdata('msg', 'Referral has been updated.');
                      //      redirect('manager/index');
                            
                }
                   
                  
                     if (isset($_POST['chksendemailalt']) == 'Yes') {   
                   
                            $this->load->library('email');
                            $pname = $this->input->post('first_name').' '.$this->input->post('last_name');
                            $physiciannote      = $this->input->post('physiciannote');
                            $contacts = $this->input->post('Home_Phone') .' / '. $this->input->post('Cell').' / '.$this->input->post('Office_Phone');
                     
                                          
                           $marketingmsg1 = 'ABC  ';
                           $marketingmsg2 = 'TEST';
                           $strref = 'Please use Reference No: '.$strrefno.', if you have concerns regarding this request / appointment';
                           
                           
                            $referral_email_template_new_patients = '<p> Dear Dr. '.$rdoctor.'  
                              <p>Thanks for your referral.  Please see summary below regarding your request.<br />
                             <label align="right">'.$marketingmsg1.'</label> <br />
                             <label align="right">'.$marketingmsg2.'</label>    
                             <hr width=100%> 
                                <b> Referred Doctor: </b>'.$doc_name.'<br /><br />   
                                <b>Referral Number :</b> '.$eventnumber.' <br /><br />
                                <b>Patient Name : </b> '. $patientname .'   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br />    
                                
                              
                               
                               <br /> 
                               <b>Notes :</b> '.$physiciannote.'&nbsp;&nbsp;  <br />  <br />  
                               <label align="right"> '.$strref.' </label>  <br />  <br />         
                             
                               
                               </p>  <hr width=100%> ';  
                           
                              

                            $this->email->from('somaweera.b@gmail.com', 'ABC Company');
                            $this->email->to($demail1);
                    
                           
                      
                    //        $this->email->bcc('somaweera.b@gmail.com');
                             $this->email->subject('Your Reference No: '.$strrefno.'');
                            $data['body_massage'] = $referral_email_template_new_patients;
                            $referral_email_template_new_patients = $this->load->view('includes/email_template' , $data, TRUE);
                            $this->email->message($referral_email_template_new_patients);
                            $result = $this->email->send();
                             $query = $this->event_model->update_event();
                            $this->session->set_flashdata('msg', 'Referral has been updated.');
                       //     redirect('manager/index');
                            
                }
             
             
                  
                  
                    
                if ($query = $this->event_model->update_event()) {
                    $this->session->set_flashdata('msg', 'Event has been Saved.');
                    redirect('manager/index');
                 }
                 
                 
              
   }  
  
   
   
   function find_user() {
        $data['page_title'] = "© ABC Company - Manager";
        $data['page_heading'] = "Manage Users - Users List";
        $data['main_content'] = 'manager/users';
        $this->load->model('employee_model');
        
        if($this->input->post('is_search') == 1){
            
            $data['employees'] = $this->employee_model->find_employees();
        } else {
            $data['employees'] = $this->employee_model->get_employees();
        }

        $this->load->view('layout', $data);
    }

    function attach_doc() {
        if($this->input->post('submit') == 'UPLOAD DOCUMENT'){
            $config['upload_path'] = $this->file_path;
            $config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx|rtf';
            $config['max_size'] = '1000';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';

            $this->load->library('image_lib');
            $this->load->library('upload', $config);
            $this->upload->do_upload('userfile1');
            $data['error'] = $this->upload->display_errors();
            $image_data = $this->upload->data();
            $upload_file_name = $image_data['file_name'];
            $demail = $this->input->post('demail');
            $patientname = $this->input->post('pname');
            if($upload_file_name != ''){
                $this->load->model('physician_doc_model');
                $quary = $this->physician_doc_model->insert_attach_doc($upload_file_name, $this->input->post('pid'));
                
               
                $this->load->library('email');
                $pname = $this->input->post('firstname').' '.$this->input->post('lastname');
                $marketingmsg1 = 'ABC  ';
                $marketingmsg2 = 'TEST...';
                $note =' The following report is now available on-line.  <a href ="http://www.test.dev"> www.test.dev </a> and click on DOWNLOADS to view this report ';
                $referral_email_template_new_patients = '<p> Dear Dr. '.$pname.' <br />  <br />  
                <label align="right">'.$marketingmsg1.'</label> <br />
                <label align="right">'.$marketingmsg2.'</label>    
                <hr width=100%> 
                
                <b label align="left"></b> '.$note.'&nbsp;&nbsp;  <br />  <br />  
                <b label align="left">Pateint Name :</b> '.$patientname.'&nbsp;&nbsp;  <br />  <br />      
                <b label align="left">Name of the Uploaded Document :</b> '.$upload_file_name.'&nbsp;&nbsp;  <br />  <br />  
                </p>  <hr width=100%> ';  
                
                $this->email->from('somaweera.b@gmail.com', 'ABC Company');
                $this->email->to($demail);
                 //        $this->email->bcc('somaweera.b@gmail.com');
                $this->email->subject('ABC Company: ');
       //         $this->email->attach($this->input->post('userfile1'));
                $data['body_massage'] = $referral_email_template_new_patients;
                $referral_email_template_new_patients = $this->load->view('includes/email_template' , $data, TRUE);
                $this->email->message($referral_email_template_new_patients);
                $result = $this->email->send();
                $this->session->set_flashdata('msg', 'File has been Uploaded.');  
                redirect('manager/physician');
            }
        }

        $data['page_heading'] = "Attach Documents - Physician";
        $data['main_content'] = 'manager/attach_doc';
        $this->load->model('physician_model');
        $data['physician'] = $this->physician_model->get_physician($this->uri->segment(3));
        $data['physician_id'] = $this->uri->segment(3);
        $this->load->view('layout', $data);
    }
    

  function print_view_event(){
        $data['page_title'] = "© ABC Company - Manager - Print";
        $data['page_heading'] = "Event - New Event";
        $data['main_content'] = 'manager/print_event_view';

        $this->load->view('layout', $data);
    }
  
function view_officeuser() {
        $data['page_title'] = "© ABC Company - Manage Office Users";
        $data['page_heading'] = "Physician - Office User List";
        $data['main_content'] = 'manager/view_officeuser';
        $this->load->model('office_user_model');
        $data['officeusers'] = $this->office_user_model->get_officeuser();
        $this->load->view('layout', $data);
    }

function set_officeuser_status() {
        $this->load->model('office_user_model');
        $this->office_user_model->set_officeuser_status($this->uri->segment(3),$this->uri->segment(4));
        $this->session->set_flashdata('msg', 'Office user has been Updated.');
        redirect('manager/physician');
    }

function view_preports(){
        $this->load->model('patient_report_model');
        $data['page_title'] = "© ABC Company - Patient Report Uploads";
        $data['page_heading'] = "Patient Reports - All Uploads";
        $data['main_content'] = 'manager/view_preports';
        
        if($this->input->post('is_search') == 1){            
           $data['downloads'] = $this->patient_report_model->find_mpatient_reports();
        } else {
            $data['downloads'] = $this->patient_report_model->get_all_patient_reports();
        }
       
        $this->load->view('layout', $data);
    }  
    
 function update_patrpt_event() {    
            
              $this->load->model('event_model');
         //     echo $this->input->post('demail'); echo $this->input->post('demail1');;   die;
                            $strrefno = $this->input->post('referenceno');
                            $demail = $this->input->post('demail');
                            $demail1 = $this->input->post('demail1');
                            $dname = $this->input->post('dname');
                            $pname = $this->input->post('first_name').' '.$this->input->post('last_name');
                          
                      //Addedd by Manjula
                            $eventnumber = $this->input->post('eventnumber');
                            $prioritynumber = $this->input->post('prioritynumber');
                            $patientname = $this->input->post('patientname');
                            $rdoctor = $this->input->post('requesteddoctor');
                          
                          
                          
                            $clinicalhistory = $this->input->post('submittedsummary');
                           
                            $physiciannote      = $this->input->post('physiciannote');
                            $notesforocc   = $this->input->post('notesforocc');       
                           
                            $disease_notes = $this->input->post('other1');
                            $eventstatusid = $this->input->post('eventstatusid'); 
                            if ($eventstatusid == 1) 
                                {$eventstatus = "Request Received"; }
                            if ($eventstatusid == 2) 
                                {$eventstatus = "Re-Scheduled"; }
                            if ($eventstatusid == 3) 
                                {$eventstatus = "In Progress"; }
                            if ($eventstatusid == 4) 
                                {$eventstatus = "Request Completed"; }
                            if ($eventstatusid == 5) 
                                {$eventstatus = "Cancel By User"; }    
                            if ($eventstatusid == 6) 
                                {$eventstatus = "Terminated"; }    
                                 
                            
                            $phyfaxnumber = $this->input->post('phyfaxnumber');
                            
                            

                        
              if(strtoupper($this->input->post("delete")) == 'DELETE'){
                $this->load->model('event_model');
                $this->event_model->delete_local_event($this->uri->segment(3));
                $this->session->set_flashdata('msg', 'Event has been Deleted');
                redirect('manager/index');
               
              } else if ($this->input->post('print') == 'Print'){
                  
                            
                            $htmlMessage1 = '
                                 <hr width=100%>
                                <b>Event Number : </b>'. $eventnumber.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                              
                                <b> Patient Name : </b>'.$patientname.'<br /><br />
                                <b>Requested Doctor :</b>'.$rdoctor.'  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                <b>Requested Doctors Office :</b>'.$rdaddress.'     <br /><br />
                               
                                <b>Status : </b>'.$eventstatus.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <b>Assigned Doctor : </b>'.$doc_name.'   <br /><br />  
                               
                                <b>Job Assigned To :</b>'. $office.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                <b>Physicians Fax Number : </b>'.$phyfaxnumber.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  <b>Priority : </b>' . $prioritynumber.'       <br />
                                <hr width=100%><br />
                                <b> Clinical History / Physician Requested Notes : </b>'.$clinicalhistory.'  <br /><br />
                                <b> Notes From Physician : </b>'.$notesforocc.' <br /><br />
                                <b> Notes To Doctor : </b>'.$physiciannote.'  <br /><br />
                             
                                 ';
                               

                            $data['body_massage'] = $htmlMessage1;
                            
                            $htmlMessage1 = $this->load->view('includes/event_info_print' , $data, TRUE);
                         
                            echo $htmlMessage1; die;
             } 
             
               if(isset($_POST['chksendemail']) == 'Yes') {   
                    
                            $this->load->library('email');
                            $pname = $this->input->post('first_name').' '.$this->input->post('last_name');
                            $physiciannote      = $this->input->post('physiciannote');
                            $contacts = $this->input->post('Home_Phone') .' / '. $this->input->post('Cell').' / '.$this->input->post('Office_Phone');
                     
                     
                     
                           $marketingmsg1 = 'ABC  ';
                           $marketingmsg2 = 'TEST';
                           $strref = 'Please use Reference No: '.$strrefno.', if you have concerns regarding this request / appointment';
                           
                           
                            $referral_email_template_new_patients = '<p> Dear Dr. '.$rdoctor.'  
                             <p>Thanks for your referral.  Please see summary below regarding your request.<br />
                             <label align="right">'.$marketingmsg1.'</label> <br />
                             <label align="right">'.$marketingmsg2.'</label>    
                             <hr width=100%> 
                                <b> Referred Doctor: </b>'.$doc_name.'<br /><br />   
                                <b>Referral Number :</b> '.$eventnumber.' <br /><br />
                                <b>Patient Name : </b> '. $patientname .'   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br />    
                                
                              
                               
                               <br /> 
                               <b>Notes :</b> '.$physiciannote.'&nbsp;&nbsp;  <br />  <br />  
                              <label align="right"> '.$strref.' </label>  <br />  <br />      
                            
                               
                               </p>  <hr width=100%> ';  
                           
                              

                            $this->email->from('somaweera.b@gmail.com', 'ABC Company');
                            $this->email->to($demail);
                    
                                           
               
                            $this->email->subject('Your Reference No: '.$strrefno.'');
                            $data['body_massage'] = $referral_email_template_new_patients;
                            $referral_email_template_new_patients = $this->load->view('includes/email_template' , $data, TRUE);
                            $this->email->message($referral_email_template_new_patients);
                            $result = $this->email->send();
                            $query = $this->event_model->update_event();
                            $this->session->set_flashdata('msg', 'Referral has been updated.');
                      //      redirect('manager/index');
                            
                }
                   
                  
                     if (isset($_POST['chksendemailalt']) == 'Yes') {   
                   
                            $this->load->library('email');
                            $pname = $this->input->post('first_name').' '.$this->input->post('last_name');
                            $physiciannote      = $this->input->post('physiciannote');
                            $contacts = $this->input->post('Home_Phone') .' / '. $this->input->post('Cell').' / '.$this->input->post('Office_Phone');
                     
                                          
                           $marketingmsg1 = 'TEST  ';
                           $marketingmsg2 = 'ABC';
                           $strref = 'Please use Reference No: '.$strrefno.', if you have concerns regarding this request / appointment';
                           
                           
                            $referral_email_template_new_patients = '<p> Dear Dr. '.$rdoctor.'  
                              <p>Thanks for your referral.  Please see summary below regarding your request.<br />
                             <label align="right">'.$marketingmsg1.'</label> <br />
                             <label align="right">'.$marketingmsg2.'</label>    
                             <hr width=100%> 
                                <b> Referred Doctor: </b>'.$doc_name.'<br /><br />   
                                <b>Referral Number :</b> '.$eventnumber.' <br /><br />
                                <b>Patient Name : </b> '. $patientname .'   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br />    
                                
                              
                               
                               <br /> 
                               <b>Notes :</b> '.$physiciannote.'&nbsp;&nbsp;  <br />  <br />  
                               <label align="right"> '.$strref.' </label>  <br />  <br />         
                             
                               
                               </p>  <hr width=100%> ';  
                           
                              

                            $this->email->from('somaweera.b@gmail.com', 'ABC Company');
                            $this->email->to($demail1);
                    
                           
                      
                    //        $this->email->bcc('somaweera.b@gmail.com');
                             $this->email->subject('Your Reference No: '.$strrefno.'');
                            $data['body_massage'] = $referral_email_template_new_patients;
                            $referral_email_template_new_patients = $this->load->view('includes/email_template' , $data, TRUE);
                            $this->email->message($referral_email_template_new_patients);
                            $result = $this->email->send();
                             $query = $this->event_model->update_event();
                            $this->session->set_flashdata('msg', 'Referral has been updated.');
                       //     redirect('manager/index');
                            
                }
             
             
                  
                  
                    
                if ($query = $this->event_model->update_event()) {
                    $this->session->set_flashdata('msg', 'Event has been Saved.');
                    redirect('manager/index');
                 }
                 
                 
              
   }  
  
       
}
