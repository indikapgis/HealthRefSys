<div id="body">

    <div class="header"><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>images/logo.png" border="0" /></a></div>
    <div class="loginpanel">
        <div style="float: right; width: 230px; padding-right: 120px;">
     <?php echo base_url(); ?>
        </div>
        <div class="signup">
            <form action="<?php echo base_url(); ?>user/signup" method="POST">
                <fieldset>
                    <legend>Create New Account</legend>
                <label>User Name *</label>
                <input type="text" name="username" value="<?=set_value('username')?>" class="txt" />
                <?=form_error('username', '<div class="login_error">', '</div>')?>
                <div class="clear"></div>
                <label>Password *</label>
                <input type="password" name="password"  class="txt" />
                <?=form_error('password', '<div class="login_error">', '</div>')?>
                <div class="clear"></div>
                <label>Re-Type Password *</label>
                <input type="password" name="password2" class="txt" />
                <?=form_error('password2', '<div class="login_error">', '</div>')?>
                <div class="clear"></div>
                <label>First Name *</label>
                <input type="text" name="first_name" value="<?=set_value('first_name')?>" class="txt" />   
                <?=form_error('first_name', '<div class="login_error">', '</div>')?>
                <div class="clear"></div>
                <label>Last Name *</label>
                <input type="text" name="last_name" value="<?=set_value('last_name')?>" class="txt" />
                <?=form_error('last_name', '<div class="login_error">', '</div>')?>
                <div class="clear"></div>
                <label>Direct Line *</label>
                <input type="text" name="direct_line" value="<?=set_value('direct_line')?>" class="txt" />
                <?=form_error('direct_line', '<div class="login_error">', '</div>')?>
                <div class="clear"></div>
                <label>Preferred Email *</label>
                <input type="text" name="email" value="<?=set_value('email')?>" class="txt" />
                <?=form_error('email', '<div class="login_error">', '</div>')?>
                <div class="clear"></div>
                <label>Secretary's Name</label>
                <input type="text" name="secretary_name" value="<?=set_value('secretary_name')?>" class="txt" />
                <div class="clear"></div>
                <label>Physician Number *</label>
                <input type="text" name="physician_number" value="<?=set_value('physician_number')?>" class="txt" />
                <?=form_error('physician_number', '<div class="login_error">', '</div>')?>
                <div class="clear"></div>
                <label>Physician Type *</label>
                <select name="physician_type" class="txt">
                    <option value="-1" selected="selected">Please Select</option>
                    <option value="familydoctor">Family Doctor</option>
                    <option value="ophthalmologist">Ophthalmologist</option>
                    <option value="optometrist">Optometrist</option>
                    <option value="endocrinologist">Endocrinologist</option>
                    <option value="md">MD</option>
                </select>
                <div class="clear"></div>
                <label>Business Phone</label>
                <input type="text" name="business_phone" value="<?=set_value('business_phone')?>" class="txt" />
                <div class="clear"></div>
                <label>Business Fax</label>
                <input type="text" name="business_fax" value="<?=set_value('business_fax')?>" class="txt" />
                <div class="clear"></div>
                <input type="hidden" name="is_submit" value="1" />
                <input type="submit" class="submit" value="REGISTER" /> <a style="text-decoration: none;" href="<?php echo base_url(); ?>" class="submit">CANCEL</a>
                </fieldset>
            </form>
        </div>
        <div class="clear"></div>
    </div>
    <div class="footer">© Indika & Thara. All Rights Reserved. </div>

</div>