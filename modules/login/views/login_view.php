<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
if (isset($this->session->userdata['logged_in']))
{

    header("location: " . current_url() . "/user_login_process");
}
?>
<?php
if (isset($logout_message))
{
    echo "<div class='message'>";
    echo $logout_message;
    echo "</div>";
}
?>
<?php
if (isset($message_display))
{
    echo "<div class='message'>";
    echo $message_display;
    echo "</div>";
}
?>
<div id="main">
    <div id="login">
        <h2>Login Form</h2>
        <hr/>
        <?php echo form_open('login/user_login_process'); ?>
        <?php
        echo "<div class='error_msg'>";
        if (isset($error_message))
        {
            echo $error_message;
        }
        echo validation_errors();
        echo "</div>";
        ?>
        <label>UserName :</label>
        <input type="text" name="username" id="name" placeholder="username"/><br /><br />
        <label>Password :</label>
        <input type="password" name="password" id="password" placeholder="**********"/><br/><br />
        <input type="submit" value=" Login " name="submit"/><br />
        <a href="<?php echo site_url(); ?>/login/user_registration_show">Sign Up</a>
        <?php echo form_close(); ?>
    </div>
</div>