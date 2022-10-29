<?php
//authorization access controls
//check whether the user is logged in or not
if(!isset($_SESSION['user'])){
    //user is not logged in
    //redirect to login page with message
    $_SESSION['no-login-message']="<div class='error text-center'>please login to access admin panel</div>";
    //redirect to login page
    header('location:'.SITEURL.'admin/login.php');
}
?>