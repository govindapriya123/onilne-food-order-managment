<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper"> 
        <h1>Change Password</h1>
        <br><br>  
        
        <?php
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
        ?>
        
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current password: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current password">
                    </td>
                </tr>

                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="new password">
                    </td>
                </tr>

                <tr>
                    <td>Conform Password:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="confirm password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php 
        //check if the submit button is clicked or not 
        if(isset($_POST['submit']))
        {
            //echo "clicked";
            //1.Get the data from the form
            $id=$_POST['id'];
            $current_password=md5($_POST['current_password']);
            $new_password=md5($_POST['new_password']);
            $confirm_password=md5($_POST['confirm_password']);

            //2.Check weather the user with current id and password exist or not

            $sql="SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

            //execute the query
            $res= mysqli_query($conn, $sql);
            if($res==TRUE)
            {
                //check weather data is available or not 
                $count=mysqli_num_rows($res);
                if($count==1)
                {
                    //user exists and password can be changed
                    //echo "user found";
                    //Check weather the new password and confirm password match or not
                    if($new_password==$confirm_password)
                    {
                        //echo "password matched";
                        //update the password
                        $sql2= "UPDATE tbl_admin SET
                        password= '$new_password'
                        WHERE id=$id;
                        ";

                        //Execute The query
                        $res2=mysqli_query($conn,$sql2);

                        //Check weather the query executed or not
                        if($res2==TRUE)
                        {
                            //Display message
                            //redirect to manage admin page with success message
                            $_SESSION['change-pwd']="<div class='success'>Password changed succesfully.</div>";
                            //redirect the user
                            header('location:'.SITEURL.'admin/manage-admin.php');
                        }
                        else
                        {
                            //Display error message
                            $_SESSION['change-pwd']="<div class='error'>Failed to change password.</div>";
                            //redirect the user
                            header('location:'.SITEURL.'admin/manage-admin.php');


                        }


                    }
                    else
                    {
                        //we will redirected to manage admin with error message
                        $_SESSION['pwd-not-match']="<div class='error'>Password not matched</div>";
                        //redirect the user
                        header('location:'.SITEURL.'admin/manage-admin.php');

                    }
                }
                else
                {
                    //user does not exist set message and redirect
                    $_SESSION['user-not-found']="<div class='error'>user not found</div>";
                    //redirect the user 
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }


            //3.Check weather the new password and conform password match or  not


            //4.update Password if all the above is true
        }

?>

<?php include('partials/footer.php');?>