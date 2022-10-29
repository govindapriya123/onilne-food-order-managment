<?php include('partials/menu.php');?>

<?php 
    //check weather is is set or not
    if(isset($_GET['id']))
    {
        //get all the details
        $id=$_GET['id'];
        //sql query to get the selected food
        $sql2="SELECT * FROM tbl_food WHERE id=$id";
        //execute the query
        $res2=mysqli_query($conn,$sql2);
        //get the value based on query executed
        $row2=mysqli_fetch_assoc($res2);
        //get the individual values of selected food
        $title=$row2['title'];
        $description=$row2['description'];
        $price=$row2['price'];
        $current_image=$row2['image_name'];
        $current_category=$row2['category_id'];
        $featured=$row2['featured'];
        $active=$row2['active'];

    }
    else
    {
        //redirect to magnage food
        header('location:'.SITEURL.'admin/manage-food.php');
    }
?>

<div class="main-content">
    <div class="wrapper">
        <h1>update food </h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class='tbl-30'>
                <tr>
                    <td>title</td>
                    <td>
                        <input type='text' name='title' value='<?php echo $title;?>' placeholder='food title goes here'>
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea  name='description' cols='30' rows='5'><?php echo $description; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td>
                        <input type='number' name='price' value=<?php echo $price; ?>>
                    </td>
                </tr>
                <tr>
                    <td>Current image</td>
                    <td>
                        <?php
                        if($current_image=="")
                        {
                            //image not available
                            echo "<div class='error'>Image not available</div>";
                        }
                        else
                        {
                            //image available
                            ?>
                            <img src="<?Php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="100px">
                            <?php

                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Select new image</td>
                    <td>
                        <input type='file' name='image'>
                    </td>
                </tr>
                <tr>
                    <td>Category</td>
                    <td>
                        <select name="category" >
                            <?php
                            $sql="SELECT * FROM tbl_category WHERE active='Yes'";
                            //execute the query
                            $res=mysqli_query($conn,$sql);
                            //countb the rows
                            $count=mysqli_num_rows($res);
                            //check weather tyhe category is available or not
                            if($count>0)
                            {
                                //category available
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    $category_title=$row['title'];
                                    $category_id=$row['id'];
                                    //echo "<option value='$category_id'>$category_title</option>";
                                    ?>
                                    <option <?php if($current_category==$category_id){echo "selected";} ?>value="<?php echo $category_id;?>"><?php echo $category_title;?></option>
                                    <?php
                                }
                            }
                            else
                            {
                                //category not available
                                echo "<option value='0'>Category not available</option>";
                            }
                            ?>
                            
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>featured</td>
                    <td>
                        <input <?php if($featured=='Yes'){ echo "checked";} ?> type='radio' name='featured' value='Yes'> Yes
                        <input <?php if($featured=='No'){echo "checked";} ?> type='radio' name='featured' value='No'> No
                    </td>
                </tr>
                <tr>
                    <td>active</td>
                    <td>
                        <input <?php if($active=='Yes'){echo "checked";} ?> type='radio' name='active' value='Yes'> Yes
                        <input <?php if($active=='No'){echo "checked";} ?> type='radio' name='active' value='No'> No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name='id' value='<?php echo $id;?>'>
                        <input type='hidden' name='current_image' value='<?php echo $current_image;?>'>
                        
                        <input type='submit' name='submit' value='update-food' class='btn-secondary'>
                    </td>
                </tr>
            </table>
        </form>
        <?php 
            if(isset($_POST['submit']))
            {
                //echo "button clicked";
                //get all the details from the form
                $id=$_POST['id'];
                $title=$_POST['title'];
                $description=$_POST['description'];
                $price=$_POST['price'];
                $current_image=$_POST['current_image'];
                $category=$_POST['category'];
                $featured=$_POST['featured'];
                $active=$_POST['active'];
                //uplod the image if selected
                //check weather upload button is clicked or not
                if(isset($_FILES['image']['name']))
                {
                    //upload button is clicked
                    $image_name=$_FILES['image']['name'];//new image name

                    //check weather the file is available or not
                    if($image_name!="")
                    {
                        //image is available
                        //rename the image
                        $ext=end(explode('.',$image_name));
                        $image_name="Food-Name-".rand(0000,9999).'.'.$ext; 

                        //get the source path and destination path
                        $src_path=$_FILES['image']['tmp_name'];//source path 
                        $dest_path="../images/food/".$image_name;//destination path
                        //uplod the image
                        $upload=move_uploaded_file($src_path,$dest_path);

                        //check weather the image is uploaded or not
                        if($upload==false)
                        {
                            //failed to upload 
                            $_SESSION['upload']="<div class='error'> Failed to upload new image</div>";
                            header('location:'.SITEURL.'admin/manage-food.php');
                            //stop the process
                            die();

                        }
                        //reomve the image if the image is uploaded and current image exists
                        //remove current image if avilable
                        if($current_image!="")
                        {
                            //current image is available 
                            //remove the image
                            $remove_path="../images/food/".$current_image;
                            $remove =unlink($remove_path);

                            //check weather the image is removed or not
                            if($remove==false)
                            {
                                //failed to remove curent image
                                $_SESSION['remove-failed']="<div class='error'>failed to remove current image</div>";
                                //redirect to manage food
                                header('location:'.SITEURL.'admin/manage-food.php');
                                die();
                            }
                        }
                    }
                    else
                    {
                        $image_name=$current_image;
                    }
                }
                else
                {
                    $image_name=$current_image;
                }
                
                //update the food in databse and redirect to manage food with session message
                $sql3="UPDATE tbl_food SET
                    title='$title',
                    description='$description',
                    price=$price,
                    image_name='$image_name',
                    category_id='$category',
                    featured='$featured',
                    active='$active'
                    WHERE id=$id
                    ";
                //eceute the sql query
                $res3=mysqli_query($conn,$sql3);
                if($res3==true)
                {
                    //query executed and food upddates
                    $_SESSION['update']="<div class='success'>Food updated succesfully</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else
                {
                    $_SESSION['update']="<div class='error'>Failed to upload food</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                    //failed to uplod the food
                }
            }
        ?>
    </div>
</div>

<?php include('partials/footer.php');?>
