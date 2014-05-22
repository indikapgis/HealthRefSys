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

<div>
    <div align="center" class="page_hedding"><?=$page_heading; ?></div>

    <div class="loginpanel" align="center">
        <div class="signup">
            <form action="<?php echo base_url(); ?>physician/save_office/pid/<?php echo $this->uri->segment(4); ?>" method="POST">
                <fieldset>
                    <label>Address Line1  *</label>
                    <input type="text" name="address_line1" class="txt" />
                    <?=form_error('address_line1', '<div class="login_error">', '</div>')?>

                    <div class="clear"></div>
                    <label>Address Line2</label>
                    <input type="text" name="address_line2" class="txt" />
                    <div class="clear"></div>

                    <label>City</label>
                    <input type="text" name="city" class="txt" />
                    <div class="clear"></div>

                    <label>State</label>
                    <select name="state" class="txt">
                        <option value="0">Select State</option>
                        <option value="Ontario">Ontario</option>
                    </select>
                    <div class="clear"></div>

                    <label>Postal/Zip</label>
                    <input type="text" name="postal_zip" class="txt" />
                    <div class="clear"></div>

                    <label>Primary Office Phone</label>
                    <input type="text" name="primary_office_phone" class="txt" />
                    <div class="clear"></div>

                    <label>Secondary Office Phone : </label>
                    <input type="text" name="secondary_office_phone : " class="txt" />
                    <div class="clear"></div>

                    <label>Fax Number 1</label>
                    <input type="text" name="fax_number1" class="txt" />
                    <div class="clear"></div>

                    <label>Fax Number 2</label>
                    <input type="text" name="fax_number1"  class="txt" />
                    <div class="clear"></div>

                    <label>Official Email Address</label>
                    <input type="text" name="office_email"  class="txt" />
                    <div class="clear"></div>

                    <input type="submit" class="submit" value="Save" name="submit"/>&nbsp;
                    <input type="button" class="submit" value ="Cancel" onClick="history.back()">

                </fieldset>
            </form>
        </div>
    </div>
</div>
