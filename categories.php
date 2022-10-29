<?php include('partials-front/menu.php');?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
             <?php
             //Display all the categories that are active
             //sql query
             $sql="SELECT * FROM tbl_category WHERE active='Yes'";
             //Execute the Query
             $res=mysqli_query($conn,$sql);
             //count rows
             $count=mysqli_num_rows($res);
             //check whether categories are available or not
             if($count>0){
                while($row=mysqli_fetch_assoc($res)){
                    //Get the values
                    $id=$row['id'];
                    $title=$row['title'];
                    $image_name=$row['image_name'];
                    ?>
                    <?php
                }

             }else{
               echo"<div class='error'>Category not found</div>";

             }
             ?>
            <a href="category-foods.html">
            <div class="box-3 float-container">
                <?php
                if($image_name=""){
                    //Image not available
                  echo "<div class='error'>Image Not found</div>";

                }else{
                    ?>
<img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>" class="img-responsive img-curve">
<?php


                    //Image Available

                }



                   ?>
                
                
            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


   <?php include('partials-front/footer.php');?>