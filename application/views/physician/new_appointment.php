<style>
    div form { border:none; padding:50px;}
    div form label { width:130px; height:25px; margin:15px 0; display:block; float:left; text-transform:uppercase;}
    div form div a { text-transform:none; font-size:11px; display:block;}
    div form .txt { width:230px; border:#999999 1px solid; border-width:1px 0 0 1px; margin:10px 0; padding:5px;}
    div form .submit {  height:auto; padding:5px 20px; font-weight:bold; background:#4a2910; color:#d2cac4; border:none; display:block; float:left; margin:20px 15px 0 130px;}
    div form div.a {margin:20px 0 0 130px;}
    div form .submit{margin:20px 15px 0 30px;}
</style>

<?php $this->load->view('includes/physician_menu'); ?>
<div class="line"></div>
<div>
    <table width="50%" border ="0"> 
    <tr> <td align="center"><div align="right" class="page_hedding"><?=$page_heading; ?></div></td></tr>
    </table>
    <div class="loginpanel">
        <div class="signup">
         <!--  <form action="<?//php echo base_url(); ?>physician/new_appointment/<?//php echo $this->uri->segment(3); ?>" method="POST"> -->
         <!--   <form action="<?//php echo base_url(); ?>physician/new_appointment" method="POST"> -->
              <form action="<?php echo base_url(); ?>physician/save_ref_existing_patients" method="POST"> 
              <fieldset>   
                    Patient Name &nbsp<input STYLE="background-color: #dddddd; color: #1e1e1e; width:170px;" type ="label" value="<?= $patient->firstname ?>&nbsp;<?= $patient->lastname ?>" name ="patient_name" readonly="readonly" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type ="hidden" value="<?= $patient->dateofbirth ?>" name ="dob"  >
                    <input type ="hidden" value="<?= $patient->healthcard ?>" name ="health_card"  >
                    <input type ="hidden" value="<?= $patient->ver ?>" name ="ver"  > 
                    <input type ="hidden" value="<?= $patient->lastname ?>" name ="last_name" >
                    <input type ="hidden" value="<?= $patient->firstname ?>" name ="first_name" >
                    <input type ="hidden" value="<?= $patient->idpatient ?>" name ="id_patient"  >
                    <input type ="hidden" value="<?= $patient->addressline1 ?>" name ="addressline1" >
                    <input type ="hidden" value="<?= $patient->addressline2 ?>" name ="addressline2" >
                    <input type ="hidden" value="<?= $patient->city ?>" name ="city"  >
                    <input type ="hidden" value="<?= $patient->city ?>" name ="state"  >
                    <input type ="hidden" value="<?= $patient->postalzip ?>" name ="postalzip"  >
                    <input type ="hidden" value="<?= $patient->homephone ?>" name ="homephone"  ></input>
                    <input type ="hidden" value="<?= $patient->cellphone ?>" name ="cellphone"  >
                    <input type ="hidden" value="<?= $patient->officephone ?>" name ="officephone"  >
                    <input type ="hidden" value="<?= $patient->emailaddress ?>" name ="emailaddress"  ></input>
                    <input type ="hidden" value="<?= $patient->agreedtocontactalternate ?>" name ="agreedtocontactalternate"  >
                    <input type ="hidden" value="<?= $patient->alternatecontactname ?>" name ="alternatecontactname"  >
                    <input type ="hidden" value="<?= $patient->alternatecontactphone ?>" name="alternatecontactphone"  ></input>
                    <input type ="hidden" value="<?= $patient->contactrelationid ?>" name ="contactrelationid"  >
                    <input type ="hidden" value="1" name ="isexists"  >  
                  </fieldset>     
            <fieldset>
                    <span>I would prefer previously seen doctor for my patient (select one) </span>
                    <br/>
                    <br/>
                 <table width="50%" border="1"> 
                 <tr><td> Dr. A</td><td> <input value ="1" type="radio" name="previous_doctor" <?php echo set_radio('previous_doctor'); ?>  /> </td> </tr>
                 <tr><td>Dr. B</td><td> <input value ="2" type="radio" name="previous_doctor" <?php echo set_radio('previous_doctor'); ?>  /> </td> </tr>
                 <tr><td>Dr. C</td><td> <input value ="3" type="radio" name="previous_doctor" <?php echo set_radio('previous_doctor'); ?>  /> </td> </tr>
                 <tr><td>Dr. D</td><td> <input value ="4" type="radio" name="previous_doctor" <?php echo set_radio('previous_doctor'); ?>  /> </td> </tr>
                 </table>
                 
     
                    <div class="clear"></div>
                    <input type="submit" value="New Appointment" class="submit"/>
                    <div class="clear"></div>
                    <hr>
                    <span>I would prefer to see a different doctor</span>
                    <br/>
                    <input type="hidden" value="0" name="doctors" >
                    <br/>
                    <select name="doctors" class="txt">
                        <option name ="doctors" value="0">Select Physician</option>
                        <?php foreach($clinic_doctors as $k => $doctor){?>
                            <option name="doctors" value="<?= $doctor->idclinicdoctor?>" ><?= $doctor->name?></option>
                        <?php }?>
                    </select>
                   
                     <div class="clear"></div>
                   
                     <input type="submit" value="Create New Referral" class="submit"  />
                    <a href="<?= base_url()?>physician/index/>" <input type="button" class="submit" value ="Cancel" />Cancel</a>

                </fieldset>
            </form>
        </div>
    </div>
</div>
<div class="footer">Indika & Thara. All Right reserved  </div>
