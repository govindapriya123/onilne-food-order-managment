<?php include('partials-front/menu.php');?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
        <?php
//check whether id is passed or not
if(isset($_GET['category_id'])){
    //Category iD is set and get the id
    $category_id=$_GET['category_id'];
    $sql="SELECT title from tbl_category where id=$category_id";
    //Execute the Query
    $res=mysqli_query($conn,$sql);
    //Get the value from database
    $row=mysqli_fetch_assoc($res);
    //Get the title
    $category_title=$row['title'];



}
else{
    //category not passed
    //redirect to home page
    header('location:'.SITEURL);


}
?>
            
            <h2>Foods on <a href="#" class="text-white">"<?php $category_title?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
           $sql2="SELECT * FROM tbl_food WHERe category_id=$category_id";
           $res2=mysqli_query($conn,$sql2);
           $count2=mysqli_num_rows($res2);
           if($count2>0){
            //Food is Available
            While($row=mysqli_fetch_assoc($res2)){
                $title=$row2['title'];
                $price=$row['price'];
                $description=$row['description'];
                $image_name=$row2['image_name'];
                ?>
                <?php
                if($image_name==""){
                    //Image Not Available
                    echo"<div class='error'>Image Not available</div>";
                }else{
                    ?>
                  <img src="<?php echo SITEURL;?>category-foods.php?category_id=<?php echo $id?>"  class="img-responsive img-curve">
                  <?php 
                }


?>
                

                <div class="food-menu-desc">
                    <h4><?php echo $title;?></h4>
                    <p class="food-price"><?php echo $price;?></p>
                    <p class="food-detail">
                       <?php echo $description;?>
                    </p>
                    <br>

                    <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>
           <?php
            }


        }

           else{

           }


?>
            
           

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

   <?php include('partials-front/footer.php');?>