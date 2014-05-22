<style>
    div form { border:none; padding:50px;}
    div form label { width:130px; height:25px; margin:15px 0; display:block; float:left; text-transform:uppercase;}
    div form div a { text-transform:none; font-size:11px; display:block;}
    div form .txt { width:230px; border:#999999 1px solid; border-width:1px 0 0 1px; margin:10px 0; padding:5px;}
    div form .submit {  height:auto; padding:5px 20px; font-weight:bold; background:#4a2910; color:#d2cac4; border:none; display:block; float:left; margin:20px 15px 10px 100px;}
    div form div.a {margin:20px 0 0 130px;}
    div form .submit{margin:20px 15px 10px 30px;}
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
<div style="margin-left:400px;" class="page_hedding"><?=$page_heading; ?></div>

<div class="loginpanel">

    <div class="signup">
        <form action="<?php echo base_url(); ?>physician/save_inforequest/<?php echo $this->uri->segment(3); ?>"  method="POST">
            <fieldset>
                <label>Patient Name</label>
                <input type="text" name="first_name" value="<?= $patient->firstname . ' ' . $patient->lastname; ?>" class="txt" readonly="readonly"/>
                <div class="clear"></div>

                <label>Date Of Birth </label>
                <input type="text" name="date_of_birth" value="<?= $patient->dateofbirth; ?>" class="txt" readonly="readonly" />
                <div class="clear"></div>

                <label>Health Card </label>
                <input type="text" name="health_card" value="<?= $patient->healthcard; ?>" class="txt" readonly="readonly" />
                <div class="clear"></div>

                <label>Version </label>
                <input type="text" name="ver" value="<?=$patient->ver ?>" class="txt" readonly="readonly" />
                <div class="clear"></div>
                
                <label>Select Office  </label>
                <select name="office" class="txt">
                    <option value="0">Select Office</option>
                    <?php foreach($offices as $office){?>
                        <?php $address = $office->addressline1 . '' . $office->addressline2 . ''. $office->city . ' |' . $office->postalzip?>
                        <option value="<?= $office->idphysicanaddress?>" ><?= $address ?></option>
                    <?php }?>
                </select>
                <div class="clear"></div>
                
                <label>Note *</label>
                <textarea name="note" class="txt"></textarea>
                <?=form_error('note', '<div class="login_error">', '</div>')?>
                <div class="clear"></div>

                <div class="contant">
        <? if(!isset($patient_notes)): ?>
                        <h5>No Patient Notes</h5>
        <?  else : ?>
                    <table id="tablesorter-demo" class="tablesorter" border="1" cellpadding="0" cellspacing="1">
                        <thead>
                           
                            <tr>
                                <th class="header">Description</th>
                                <th class="header">Created By</th>
                                <th class="header">Created Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php foreach ($patient_notes as $patient_note){?>
                                <tr>
                                    <td><?=$patient_note->medicalnote?></td>
                                    <td><?=$patient_note->username?></td>
                                    <td><?=$patient_note->createddate?></td>
                                </tr>
                            <?php }?>
                        </tbody>
                    </table>
                 
                </div>
                 <div class="clear"></div>
                <input type="hidden" name="username" value="<?=$patient_note->username;?>" /> 
                <input type="hidden" name="medicalnote" value="<?=$patient_note->medicalnote?>"/>
                <input type="hidden" name="operacode" value="<?=$physician->operacode?>" />
                <? endif; ?>
               <table>
               <tr>
                   <td>&nbsp;&nbsp;&nbsp; </td>
                   <td>&nbsp;&nbsp; </td>
                   <td>&nbsp;&nbsp;&nbsp; </td>
                   <td><input type="submit" class="submit"  value="Save" name="submit" />&nbsp;</td>
                   <td>&nbsp;&nbsp;&nbsp; </td>
                   <td>&nbsp;&nbsp; </td>
                   <td>&nbsp;&nbsp; </td>
                   <td>&nbsp;&nbsp; </td>
                   <td>  <a href="<?= base_url()?>physician/index/>" <input type="button" class="submit" value ="Cancel" />CANCEL</a></td>
               </tr>
               </table>
            </fieldset>
        </form>
    </div>
</div>
<div class="footer">Indika & Thara </div>
<script type="text/javascript">
    $('cmd_cancel').click(function(){
        alert("dddd");

    });
   


</script>
