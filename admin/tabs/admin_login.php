<?php
function admin_login() { ?>
<div class="footer-wrapper">
<div class="footer-content" align="center">
<div class="footer-line">
<div class="span60 desktop-only">
    <h1>Welcome Admin <br /> Manage everything from one place!</h1>
</div>
<div class="float-clear"></div>
<div class="span35">
    <form class="login-form" method="post" action="?">
        <div class="form-header">Admin Login</div>
        <div class="form-content">
            <div class="input-wrapper">
                <input type="text" name="admin_username" placeholder="Admin username">
            </div>
            <div class="input-wrapper">
                <input type="password" name="admin_password" placeholder="Admin password">
            </div>
            <button>Log In</button>
            <input type="hidden" name="admin_login" value="1">
            <input type="hidden" name="keep_blank" value="">
        </div>
    </form>
</div>



</div>
</div>
</div>
<div style="margin: 0 auto;">
</div>
<div class="float-clear"></div>
<?php }
?>