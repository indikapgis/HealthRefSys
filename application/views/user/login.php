<?php ?>

<div id="body">

    <div class="header"><img src="<?php echo base_url(); ?>images/logo.png" /></div>
    <div class="loginpanel">
        <div class="login">
            <form action="<?php echo base_url(); ?>user/login" method="POST">
                <label> User name </label>
                <input type="text" name="username" class="txt" />                
                <div class="clear"></div>
                <label> Password </label>
                <input type="password" name="password" class="txt" />
                <div class="clear"></div>
                <?=validation_errors('<div class="login_error">', '</div>')?>
                <input type="hidden" name="is_submit" value="1" />
                <input type="submit" class="submit" value="LOGIN" />
                <div class="a">
                    <a href="<?php echo base_url(); ?>user/signup">New User</a>
                    <a href="<?php echo base_url(); ?>user/forgot_password">Forgot Password</a>
                </div>
            </form>
        </div>
       <div class="banner"><img src="<?php echo base_url(); ?>images/login_baner.jpg" /></div><div class="clear"></div> 
    </div>
    <div class="footer">
    <div align="left" style="float:left; color:#333;">82 Dalegrove Cr., Toronto ON, M9B 6A9. &nbsp; &nbsp; &nbsp; Tel - 905-399-7015 &nbsp; | &nbsp; Mobile - 647-291-7015 &nbsp; &nbsp; &nbsp; E-mail: healthrefsys.b@gmail.com
  
    </div>
    © Indika & Thara. All Rights Reserved. </div>

</div>