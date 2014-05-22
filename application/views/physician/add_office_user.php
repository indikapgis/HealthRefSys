<style>
    form { border:none; padding:50px;}
    form label { width:150px; height:25px; margin:15px 0; display:block; float:center; }
    form div a { text-transform:none; font-size:11px; display:block;}
    form .txt { width:200px; border:#999999 1px solid; border-width:1px 0 0 1px; margin:10px 0; padding:4px;}
    form .submit { height:auto; padding:5px 20px; font-weight:bold; background:#4a2910; color:#d2cac4; border:none; display:block; float:left; margin:20px 15px 0 130px;}
    form div.a {margin:20px 0 0 130px;}
</style>

<?php $this->load->view('includes/physician_menu'); ?>
<!-- -->

<table width ="80%" align="center" border="0">
<tr> <td align="center">    
<div align="center" class="page_hedding"><?=$page_heading; ?></div> </td> 
</tr>
</table>
<div align="center"><? if($this->session->flashdata('msg') != '') { ?><h4 class="alert_success"><?=$this->session->flashdata('msg')?></h4> <? } ?></div>

<div class="loginpanel">

        <div class="">
            <form action="<?php echo base_url(); ?>physician/add_office_user" method="POST">
             <!--   <fieldset> -->
               <table width ="80%" border ="1">
               <tr>    
                <td align="center"><label>Full Name *</label></td>
                <td align="left"><input align="right" type="text" name="fullname" value="<?=set_value('fullname')?>" class="txt" /></td>
                <?=form_error('name', '<div class="login_error">', '</div>')?>
               </tr> 
               <tr>    
                <div class="clear"></div>
                <td align="center"><label>User Name *</label></td>
                <td align="left"><input type="text" name="username" value="<?=set_value('username')?>" class="txt" /></td>
                <?=form_error('username', '<div class="login_error">', '</div>')?>
                </tr>
                <tr>
                <div class="clear"></div>
                
                <td align="center"><label>Password *</label></td>
                <td align="left"><input type="password" name="password"  class="txt" /></td>
                <?=form_error('password', '<div class="login_error">', '</div>')?>
                </tr> 
                <tr>
                <div class="clear"></div>
                <td align="center"><label>Re-Type Password *</label></td>
                <td align="left"><input type="password" name="password2" class="txt" /></td>
                <?=form_error('password2', '<div class="login_error">', '</div>')?>
                </tr> 
                <tr>
                <div class="clear"></div>
                <td align="center"><label>Access Level *</label></td>
                <td align="left"><select name="accesslevel" class="txt">
                  <!--  <option value="-1" selected="selected">Please Select</option> -->
                    <option value="1">1 - (Full Access)</option>
                    <option value="2">2 - (View Only)</option>
                </select></td>
               </tr>
               <!--    <div class="clear"></div>
             <label>Office Location *</label>-->
                <?//php echo form_dropdown('officelocation', $officelocation, set_value('officelocation'), 'class="txt"'); ?>
               <tr> 
               <div class="clear"></div>
                <td align="center"><label>Email Address *</label></td>
               <td align="left"> <input type="text" name="officeemailaddress" value="<?=set_value('officeemailaddress')?>" class="txt" /></td>
                <?=form_error('officeemailaddress', '<div class="login_error">', '</div>')?>
               </tr>
              
                <div class="clear"></div>
               
                
               <input type="hidden" name="is_submit" value="1" />
               <tr>   
                <div class="clear"></div>   
                 <td align="center"><input align="right" type="submit" class="submit" value="Add New User" /></td>
                <td align="left"><a href="<?= base_url()?>physician/myinfo" <input type="button" class="submit" value ="" />Cancel</a></td>
                </tr>
              <!--  </fieldset> -->
             </table> 
            </form>
        </div>
        <div class="clear"></div>
    </div>
<div class="footer">© Indika & Thara  </div>
