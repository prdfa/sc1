<?php
function add_admin() {
global $config;
?>
<form class="content-container" method="post" action="?tab1=add_admin">
    <div class="content-header">Add Admin Login</div>
    <div class="content-wrapper">
        <label>Login credentials for Admin</label>
    </div>
    <div class="content-wrapper">
        <div class="label float-left">Username</div>
        <div class="input float-left">
            <input type="text" name="admin_username" value="">
            <div class="info">Admin's username. Can contain alphabets A-Z, numbers 0-9 and underscores (_) only.</div>
        </div>
        <div class="float-clear"></div>
    </div>
    <div class="content-wrapper">
        <div class="label float-left">Password</div>
        <div class="input float-left">
            <input type="text" name="admin_password">
            <div class="info">Admin's password</div>
        </div>
        <div class="float-clear"></div>
    </div>
    <div class="button-wrapper">
        <input type="submit" name="save_btn" value="Add Admin">
    </div>
    <input type="hidden" name="keep_blank" value="">
    <input type="hidden" name="insert_admin" value="1">
</form>
<?php } ?>