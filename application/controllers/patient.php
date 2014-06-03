<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Patient extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->is_logged_in();
    }

    function index() {

        $data['page_title'] = "© ABC Company - Login";
        $data['page_heading'] = "";
        $data['main_content'] = 'user/login';
        $this->load->view('layout', $data);
    }

    function is_logged_in() {

        $is_logged_in = $this->session->userdata('is_logged_in');
        if ((!isset($is_logged_in) || $is_logged_in != TRUE) || $this->session->userdata('user_level') == 4) {
            $this->session->set_flashdata('return_url', current_url());
            redirect('user/login');
        }
    }

    function delete_patient(){
        $this->load->model('patients_model');
        $this->patients_model->delete_patient($this->uri->segment(3));
        $this->session->set_flashdata('msg', 'Patient has been deleted.');
        redirect('manager/patients');
    }

    function edit_patient() {
        if ($this->input->post('is_update') == 1) { 
            $this->load->model('patients_model');
            if ($query = $this->patients_model->update_patient_chart_number()) {
                $this->session->set_flashdata('msg', 'Patient has been Updated.');
                redirect('manager/patients');
            }
        }

        $data['page_heading'] = "Manage Patient - Patient Edit";
        $this->load->model('patients_model');
        $data['main_content'] = 'manager/edit_patient';
        $data['patient'] = $this->patients_model->get_patient_edit($this->uri->segment(3));
        $this->load->view('layout', $data);
    }

    function patient_add_note() {
        if ($this->input->post('is_update') == 1) {
            $this->load->model('patients_model');
            if ($query = $this->patients_model->update_patient_note()) {
                $this->session->set_flashdata('msg', 'Patient Note has been Updated.');
                redirect('manager/patients');
            }
        }

        $data['page_heading'] = "Manage Patient - Patient Add Note";
        $this->load->model('patients_model');
        $data['main_content'] = 'manager/patient_add_note';
        $data['patient'] = $this->patients_model->get_patient_edit($this->uri->segment(3));
        $data['patient_notes'] = $this->patients_model->get_patient_note($this->uri->segment(3));
        $this->load->view('layout', $data);
    }
/*
    function patient_attach_doc() {
        $data['page_heading'] = "Manage Patient - Patient Report Upload";
        $data['main_content'] = 'manager/patient_attach_doc';
        $this->load->view('layout', $data);
    }

 */   

    function view_patient_data() {
        $data['page_heading'] = "View Patient";
        $data['main_content'] = 'manager/view_patient';
               
        $this->load->model('patients_model');
        $data['patient'] = $this->patients_model->get_patient($this->uri->segment(3));
        $this->load->view('layout', $data);
    }
    
    function attach_report() {
        if($this->input->post('submit') == 'ADD REPORT'){
        
           $config['upload_path'] = 'uploads/';
           $config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx|rtf';
            
            $config['max_size'] = '1000';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
           
            $to_email = $this->input->post('phpemail');
       //    echo 'e Mail Testing';  echo $this->input->post('to_email;'); echo $to_email; die;
            $pfname = $this->input->post('pfname');                        
            $plname = $this->input->post('plname');
            $dfname = $this->input->post('phfname');                        
            $dlname = $this->input->post('phlname');
            $pfullname = $this->input->post('plname') . ' ' . $this->input->post('pfname'); 
         
            $this->load->library('image_lib');
            $this->load->library('upload', $config);
            $this->upload->do_upload('userfile1');
            $data['error'] = $this->upload->display_errors();
            $image_data = $this->upload->data();
            $upload_file_name = $image_data['file_name'];
       
            if($upload_file_name != ''){
                
                $this->load->model('patient_report_model');
                $quary = $this->patient_report_model->insert_attach_reports($upload_file_name, $this->input->post('pid'),$this->input->post('patientid'),$pfullname);
             
                $this->load->library('email');

                ////// this mail send to Physician  ////
            //   $to_email = $user->privateemail;
               $htmlMessage = '<p>Dear Dr. '.$dfname.' '.$dlname.' </p>
                               <p>We have uploded the reports of the following patient into ABC<br /><br />
                                Patient Name : '.$plname.' '.$pfname.' <br />
                                  
                               <p>  please login to <a href=http://www.test.dev>TEST </a> and check the report. </p>    
                                  If you have any question or concern please e-mail:somaweera.b@gmail.com or call at 416-246-9605. <br /><br />
                                  Sincerely,<br />ABC Administator.<br /><br /></p>';

                $this->email->from('somaweera.b@gmail.com', 'ABC Company'); //  this should be official email. ex- info@retinamd.ca
                $this->email->to($to_email);
                $this->email->subject('Patient Reports ');
                $data['body_massage'] = $htmlMessage;
                $htmlMessage = $this->load->view('includes/patient_report' , $data, TRUE);
              
                $this->email->message($htmlMessage);
                 
                $result = $this->email->send();
              
                $this->session->set_flashdata('msg', 'Report has been Uploaded.');
                redirect('manager/patients');
            }
        }

        $data['page_heading'] = "Attach Reports - Physician";
        $data['main_content'] = 'manager/attach_report';
        $this->load->model('patients_model');
        $data['patient'] = $this->patients_model->get_patient($this->uri->segment(3));
      //  $data['patient_notes'] = $this->patients_model->get_patient_note($this->uri->segment(3));
        $data['physician_id'] = $this->uri->segment(3);
       
        $this->load->view('layout', $data);
    }
}
?>
