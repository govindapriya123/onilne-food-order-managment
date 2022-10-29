<?php
//include constants.php file here
include('../config/constants.php');

//get the id of admin to be deleated
$id = $_GET['id'];

//create sql query to delete admin
$sql= "DELETE FROM tbl_admin WHERE id=$id";

//execute the query
$res=mysqli_query($conn,$sql);

//check weather the query executed succesfully or not
if($res==TRUE)
{
    //Query executed succesfully and Admin Deleated
    //echo "Admin Deleated";
    //create session variable to diaplay message
    $_SESSION['delete'] = "<div class='success'> Admin Deleated Succesfully</div>";
    //redirect to manage admin page
    header('location:'.SITEURL.'admin/manage-admin.php');
}
else    
{
    //Failed to delete admin
    //echo"Failed to delete Admin";
    $_SESSION['delete'] = "<div class='error'>Failed to delete admin. try again later<div>";
    header('location:'.SITEURL.'admin/manage-admin.php');
}
//redirect to manage admin page with message the message can be either success or error
?>