<?php
    //include constants file
    include('../config/constants.php');
    //echo "delete page"
    //check weather the id and image_value is set or not
    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        //get the value and delete 
        //echo "get value and delete";
        $id= $_GET['id'];
        $image_name=$_GET['image_name'];

        //remove the physical image file if available
        if($image_name!="")
        {
            //image is available so remove image
            $path="../images/category/".$image_name;
            //remove the image
            $remove=unlink($path);
            //if failed to remove image then add an error message and stop the process
            if($remove==FALSE)
            {
                //set the session message then redirect to manage category page and then stop the process
                $_SESSION['remove']="<div class='error'>Failed to remove category image</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
                die();
            }
        }


        //delete datafrom database
        //sql query delete data from database
        $sql="DELETE FROM tbl_category WHERE id=$id";

        //execute the query
        $res=mysqli_query($conn,$sql);
        //check weather the data is deleated from database or not
        if($res==TRUE)
        {
            //SET success message and redirect
            $_SESSION['delete']= "<div class='success'>Category deleated successfully</div>";
            //redirect to manage category
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            //SET Fail message and redirect
            $_SESSION['delete']= "<div class='error'>Failed to delete category</div>";
            //redirect to manage category
            header('location:'.SITEURL.'admin/manage-category.php');
        }
    }
    else
    {
        //redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');

    }
 ?>