<?php ?>

<div id="body">

    <div class="loginpanel"> 
        <div class="login">
            <form action="<?php ; ?>user/login" method="POST">
                <label> User name </label>
                <input type="text" name="username" class="txt" />                
                <div class="clear"></div>
                <label> Password </label>
                <input type="password" name="password" class="txt" />
                <div class="clear"></div>
                <input type="hidden" name="is_submit" value="1" />
                <input type="submit" class="submit" value="LOGIN" />
                <div class="a">
                    <a href="<?php  ?>user/signup">New User</a>
                    <a href="">Forgot Password</a>
                </div> <!-- a -->
            </form>
        </div>
    </div>
    <div class="footer"> </div>
  </div>