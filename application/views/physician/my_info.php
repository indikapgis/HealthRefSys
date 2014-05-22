<style>
    div form { border:none; padding:50px;}
    div form label { width:130px; height:25px; margin:15px 0; display:block; float:left; text-transform:uppercase;}
    div form div a { text-transform:none; font-size:11px; display:block;}
    div form .txt { width:230px; border:#999999 1px solid; border-width:1px 0 0 1px; margin:10px 0; padding:5px;}
    div form .submit {  height:auto; padding:5px 20px; font-weight:bold; background:#4a2910; color:#d2cac4; border:none; display:block; float:left; margin:20px 15px 0 130px;}
    div form div.a {margin:20px 0 0 130px;}
    div form .submit{margin:20px 15px 0 30px;}
</style>

<link rel="stylesheet" href="<?php echo base_url(); ?>css/style_table_p.css" type="text/css" />
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-latest.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-for-table.js"></script>

<script type="text/javascript">
$(function() {
        $("#tablesorter-demo").tablesorter({sortList:[[0,0]], widgets: ['zebra']});
        $("#options").tablesorter({sortList: [[0,0]], headers: { 3:{sorter: false}, 4:{sorter: false}}});
});
</script>

<?php $this->load->view('includes/physician_menu'); ?>
<div class="line"></div>
<div align="center"><? if($this->session->flashdata('msg') != '') { ?><h4 class="alert_success"><?=$this->session->flashdata('msg')?></h4> <? } ?></div>
<div align="center" class="page_hedding"><?=$page_heading; ?></div>
<b style="float: right; padding-right: 150px;"><a href="<?php echo base_url(); ?>physician/add_office_user" style="color: #000;">Add New User</a></b> 
<div class="loginpanel" align="center">

   <div class="signup">
   <form action="<?php echo base_url(); ?>physician/update_myinfo/<?php echo $this->uri->segment(3); ?>" id="myinfo"  method="POST">
          <fieldset>
              <label>First Name *</label>
              <input type="text" name="first_name" value="<?=$physician->firstname; ?>" class="txt" />
               <?=form_error('first_name', '<div class="login_error">', '</div>')?>
               <div class="clear"></div>

                    <label>Last Name *</label>
                    <input type="text" name="last_name" value="<?=$physician->lastname ?>" class="txt" />
                    <?=form_error('last_name', '<div class="login_error">', '</div>')?>
                    <div class="clear"></div>

                    <label>Direct Line *</label>
                    <input type="text" name="direct_line" value="<?=$physician->personalphone ?>" class="txt" />
                    <?=form_error('direct_line', '<div class="login_error">', '</div>')?>
                    <div class="clear"></div>

                    <label>Preferred Email  *</label>
                    <input type="text" name="email" value="<?=$physician->privateemail ?>" class="txt" />
                    <?=form_error('email', '<div class="login_error">', '</div>')?>
                    <div class="clear"></div>

                    <label>Secretary's Name </label>
                    <input type="text" name="secretary_name" value="<?=$physician->secretaryname ?>" class="txt" />
                    <?=form_error('secretary_name', '<div class="login_error">', '</div>')?>
                    <div class="clear"></div>

                    <label>Physician Number  *</label>
                    <input type="text" name="physician_number" value="<?=$physician->physiciannumber ?>" class="txt" />
                    <?=form_error('physician_number', '<div class="login_error">', '</div>')?>
                    <div class="clear"></div>

                    <label>Password</label>
                    <input type="password" name="password"  class="txt" />
                     <div class="clear"></div>
                     
                    <label>Re-Type Password</label>
                    <input type="password" name="confirm_password" class="txt" />
                    <?=form_error('password', '<div class="login_error">', '</div>')?>
                    <div class="clear"></div>

                    <label>Physician Type *</label>
                    <select name="physician_type" class="txt">
                        <option value="o">Select Type</option>
                        <?php foreach($physician_model->get_physician_types() as $key => $type){?>
                        <option value="<?=$key?>"  <?= ($physician->physiciantype == $key) ? 'selected=/"selected/"' : ''; ?>><?= $type?></option>
                        <?php }?>
                    </select>
                    <?=form_error('physician_type', '<div class="login_error">', '</div>')?>
                    <div class="clear"></div>

                    <label>Business Phone</label>
                    <input type="text" name="business_phone" value="<?=$physician->businessphone ?>" onblur="alert(this.id)" class="txt" />
                    <?=form_error('business_phone', '<div class="login_error">', '</div>')?>
                 
                    <div class="clear"></div>
                    
                    <label>Business Fax</label>
                    <input type="text" name="business_fax" value="<?=$physician->businessfax ?>" class="txt" />
                    <?=form_error('business_fax', '<div class="login_error">', '</div>')?>
                    <div class="clear"></div>

                    <a href="<?= base_url(); ?>physician/manage_office">Add New Office</a>
                    <br/>
                     <div class="clear"></div>
                     
                    <?php if(count($physician_model->get_physician_address()->get_all_address()) > 0) {?>
                    <div class="contant">
                        <table id="tablesorter-demo" class="tablesorter" border="0" cellpadding="0" cellspacing="1">
                            <thead>
                                <tr>
                                    <th class="header">Address Line</th>
                                    <th class="header">City</th>
                                    <th class="header">Postal</th>
                                    <th class="header">&nbsp;</th>
                                    <th class="header">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($physician_model->get_physician_address()->get_all_address() as $office){?>
                                <tr>
                                    <td><?=$office->addressline1?></td>
                                    <td><?=$office->city?></td>
                                    <td><?=$office->state?></td>
                                    <td><a href="<?= base_url()?>physician/manage_office/<?= $office->idphysicanaddress?>" >Edit</a></td>
                                    <td><a href="<?= base_url()?>physician/delete_office/<?= $office->idphysicanaddress?>" id="delete_office" >Delete</a></td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                    <?php }?>
                    <div class="clear"></div>
                    <table>
                    <input type="hidden" name="idphysician" value="<?=$physician->idphysician?>"/>
                    <tr><td><input type="submit" class="submit" value="Save" name="submit" />&nbsp;</td>
        <!--            <td><a href="<?= base_url()?>physician/index/>" <input type="button" class="submit" value ="Cancel" />Cancel</a></td></tr>!-->
                    </table>
                </fieldset>
            </form>
        </div>
    </div>
<div class="footer">Indika & Thara </div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#delete_office').click(function(){
            msg = "Are you sure you want to delete?"
            if(confirm(msg)){
                return true;
            }else{
                return false;
            }
        });
    });
</script>
