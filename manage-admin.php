<?php include('partials/menu.php');?>
        <!--main section-->
        <div class="main-content">
            <div class="wrapper">
            <h1>Manage Admin</h1>

            <br />

            <?php
                if (isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];//Displaying session message
                    unset ($_SESSION['add']);//Removing session message
                } 

                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];//Dislpaying session message
                    unset($_SESSION['delete']);//REmoving Session Message
                }

                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];//Displaying session message
                    unset($_SESSION['update']);//Removing session message
                }

                if(isset($_SESSION['user-not-found']))
                {
                    echo $_SESSION['user-not-found'];//Displaying session message
                    unset($_SESSION['user-not-found']);//removing session message
                }

                if(isset($_SESSION['pwd-not-match']))
                {
                    echo $_SESSION['pwd-not-match'];//Diaplaying session message
                    unset($_SESSION['pwd-not-match']);//removing session message
                }

                if(isset($_SESSION['change-pwd']))
                {
                    echo $_SESSION['change-pwd'];//Diaplaying session message
                    unset($_SESSION['change-pwd']);//removing session message
                }

                

            ?>

            <br /><br />

            <!-- Button To Add Admin -->
            <a href="add-admin.php" class="btn-primary">Add Admin</a>

            <br /><br /><br />
             <table class="tab-full">
                <tr >
                    <th>S.N.</th>
                    <th>Full name</th>
                    <th>User Name</th>
                    <th>Actions</th>
                </tr>
                <?php
                //Query to get all admin
                $sql="select * FROM tbl_admin";
                //execute the query
                $res= mysqli_query($conn, $sql);

                //check weather the query is executed or not 
                if($res==TRUE)
                {
                    //count rows to check weather we have data in database or not
                    $count = mysqli_num_rows($res); //function to get all the rows in database

                    $sn=1;//create variable and assignthe value 

                    //check the number of rows
                    if($count>0)
                    {
                        //we have data in database
                        while($rows=mysqli_fetch_assoc($res))
                        {
                            //using while loop to get all the data from the database 
                            //while loop will run as long as we have data in database
                            //get individual data
                            $id= $rows['id'];
                            $full_name=$rows['full_name'];
                            $username=$rows['username'];

                            //Display the values in our table
                            ?>
                                <tr>
                                    <td><?php echo $sn++;?></td>
                                    <td><?php echo $full_name;?></td>
                                    <td><?php echo $username;?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id;?>" class="btn-primary">change password</a>
                                        <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id;?>" class="btn-secondary">update admin</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id;?>" class="btn-danger">Delete Admin </a>
                                    </td>
                                </tr>
                            <?php


                        }
                    }
                    else
                    {
                        //we do not have data in databse
                    }
                }
                ?>
                

             </table>

</div> 
</div>

        <!--main section ends-->
        
        
<?php include('partials/footer.php');?>
    </body>

</html>