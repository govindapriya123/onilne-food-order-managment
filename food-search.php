<?php include('partials-front/menu.php');?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php
            $search=mysqli_real_escape_string($conn,$_POST['search']);


?>
            
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search;?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
    <?php 
    if(isset($_SESSION['order'])){
echo $_SESSION['order'];
unset($_SESSION['order']);
    }else{

    }
?>


    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
             <?php
             //Get the Search Keyboard

             //SQL Query to Get foods based on search Keyboard
             $sql=mysqli_query($conn,$res);
             //SQL query to Get foods based
             $sql="SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR descrption LIKE '%search%'";
             $res=mysqli_query($conn,$res);
             $count=mysqli_fetch_assoc($res);
             if($count>0){
                while($row=mysqli_fetch_assoc($res)){
                    //Get the details
                    $id=$row['id'];
                    $title=$row['title'];
                    $price=$row['price'];
                    $description=$row['description'];
                    $image_name=$row['image_name'];
                    ?>
                    <div class="food-menu-box">
                <div class="food-menu-img">
                    <?php
                   if($image_name==""){
                      echo "<div class='error'>Image Not available";
                   }
                   else{
                    ?>
        <img src="<?php echo SITEURL;?>images/Food/<?php echo $image_name;?>"  class="img-responsive img-curve">
                    <?php

                   }
                }

?>
                   
                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $title;?></h4>
                    <p class="food-price"><?php $price;?></p>
                    <p class="food-detail">
                        <?php $description;?>
                    </p>
                    <br>

                    <a href="#" class="btn btn-primary">Order Now</a>
                </div>
            </div>
<?php
                }

             
             else{
                ?>
                echo"<div class='error'>Food Not Found</div>";
                <?php
             }
            
            
             ?>
            
            
            

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php');?>