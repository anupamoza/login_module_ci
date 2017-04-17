<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
if (isset($this->session->userdata['logged_in']))
{
    $username = ($this->session->userdata['logged_in']['username']);
    $email = ($this->session->userdata['logged_in']['email']);
} else
{
    header("location: login");
}
?>
<div id="profile">
    <?php
    echo "Hello <b id='welcome'><i>" . $username . "</i> !</b>";
    echo "<br/>";
    echo "<br/>";
    echo "Welcome to Admin Page";
    echo "<br/>";
    echo "<br/>";
    echo "Your Username is " . $username;
    echo "<br/>";
    echo "Your Email is " . $email;
    echo "<br/>";
    ?>
    <b id="logout"><a href="logout">Logout</a></b>
</div>
<br/>