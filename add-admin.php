<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br /><br />

            <?php
                if(isset($_SESSION['add']))//checking weather the session is set or not
                {
                    echo $_SESSION['add'];//display the session message is set
                    unset($_SESSION['add']);//remove session message
                    
                }
            ?>

            <form action="" method="POST">

                <table class="tbl-30">
                    <tr>
                        <td>Full Name: </td>
                        <td>
                            <input type="text" name="full_name" placeholder="Enter Your Name">
                        </td>
                    </tr>
                    <tr>
                        <td>UserName:</td>
                        <td>
                            <input type="text" name="username" placeholder="Your User Name">
                        </td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td>
                            <input type="password" name="password" placeholder="Your password">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                        </td>
                    </tr>
                </table>


            </form>
</div>
</div>



<?php include('partials/footer.php'); ?>


<?php 

    //process the value from the form and submit it in the database
    //check weather the submit button is clicked or not 
    if(isset($_POST['submit']))
    {
        //Button clicked
        //echo "Button Clicked";
        //1.Get the data from the form
        $full_name= $_POST['full_name'];
        $username= $_POST['username'];
        $password= md5($_POST['password']);// password encryption with md5

        //2.sql query to save the data into databse
        $sql = "INSERT INTO tbl_admin SET 
        full_name='$full_name',
        username='$username',
        password='$password'
          ";
        
        
      //3. Executing query and saving data into database
       $res = mysqli_query($conn, $sql) or die(mysqli_error());

      //4. check weather the data is inserted or not and diaplay appropriate message
      if($res == TRUE)
      {
        //data inserted
        //echo "data inserted";
        //create a session variable to diaplay message
        $_SESSION['add'] = "<div class='success'>Admin Added Succesfully</div>";
        //redirect page to Manage Admin
        header("location:".SITEURL.'admin/manage-admin.php');

      }
      else
      {
        //failed to insert data
        //echo "failed to insert data";
         //create a session variable to diaplay message
         $_SESSION['add'] = "<div class='error'>Failed to add admin<div> ";
         //redirect page to ADD Admin
         header("location:".SITEURL.'admin/add-admin.php');
 
      }
    
    }
    
?>