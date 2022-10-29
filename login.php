<?php include('../config/constants.php'); ?>  

<html>
    <head>
        <title>Login food ordering system</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
             <br><br>

            <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }

            ?>
            <br><br>

            <!-- Login form starts here-->
            <form action="" method="POST" class="text-center">
            username:<br>
            <input type="text" name="username" placeholder="ENTER USERNAME"><br><br>
            password:<br>
            <input type="password" name="password" placeholder="ENTER PASSWORD"><br><br>

            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>

            </form>
            <!--Login form ends here-->


            <p class="text-center">created by <a href="www.gp.com">Govindapriya</a></p>
        </div>


    </body>
</html>

<?php


        //check weather the submit button is clicked or not
        if(isset($_POST['submit']))
        {
            //process for login
            //1.get the data from login form
            $username= ($_POST['username']);
            $password= (md5($_POST['password']));

            //2.SQL to check weather the user name and password ecist or not
            $sql= "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

            //3.Execute the query
            $res= mysqli_query($conn, $sql);
            

            //4.count rows to check weather the user exists or not  
            $count= mysqli_num_rows($res);

            if($count==1)
            {
                //user available and login success
                $_SESSION['login']="<div class='success'>Login succesful</div>";
                $_SESSION['user']= $username;// To check weather the user is logged in or not and logout will unset it
                //redirect to home page/dashboard
                header('location:'.SITEURL.'admin/');
                
            }
            else
            {
                //user not available and login fail
                $_SESSION['login']="<div class='error text-center'>user name or password did not match</div>";
                //redirect to home page/dashboard
                header('location:'.SITEURL.'admin/login.php');
            }
        }
?>