<?php include('partials-front/menu.php');?>

<?php 
   //check whether food id is set or not
   if(isset($_GET['food_id'])){
    //Get the food id and details of selected food
    $food_id=$_GET['food_id'];
    //Get the details of the selected food
    $sql="SELECT * FROM tbl_food WHERE id=$food_id";
    //Execute the query
    $res=mysqli_query($conn,$res);
    $count=mysqli_num_rows($res);
    //check whether data is available or not
    if($count==1){
        //We have data is available or not
        //Get the data from database
        $row=mysqli_fetch_assoc($res);
        $title=$row['title'];
        $price=$row['price'];
        $image_name=$row['image_name'];




    }else{
        //Food not available
        header('location:'.SITEURL);
    }

   } else{

    header('location:'.SITEURL);
   }  


      ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="#" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php 
                        //Check whether the image is available or not
                        if($image_name==""){
                          //Image not available
                          echo"<div class='error'>Image Not Available</div>";
                        }
                        else{
                            //Image is Available
                            ?>
                            <img src="<?php echo SITEURL;?>images/Food/<?php $image_name;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                    <?php
                        

                        }

                        ?>
                        <img src="images/menu-pizza.jpg" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title?></h3>
                        <input type="hidden" name="food" value="<?php echo $title:?>">
                        <p class="food-price"><?php echo $price;?></p>
                        <input type="hidden" name="price" value="<?php echo $price;?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>
            <?php
            //check whether submit button is clicked
            if(isset($_POST['submit'])){
                //Get all the details from the form
                $food=$_POST['food'];
                $price=$_POST['price'];
                $qty=$_POST['qty'];
                $total=$price*$qty;
                $order_date=date("Y-m-d h:i:sa");
                $status="Ordered";
                $customer_name=$_POST['full_name'];
                $customer_contact=$_POST['contact'];
                $customer_email=$_POST['email'];
                $customer_address=$_POST['address'];
                //Save the order in DB
                //Create SQL to save data
                $sql2="INSERT INTO tbl_order SET
                food='$food',
                price='$price',
                qty='$qty',
                total=$total,
                order_date='$order_date',
                status='$status',
                customer_name='$customer_name',
                customer_contact='$customer_contact',
                customer_email='$customer_email',
                customer_address='$customer_address'";
                //Execute the Query
                $res2=mysqli_query($conn,$res2);
                if($res2==true){
                //Query executed and Order saved
                $_SESSION['order']="<div class='success'text-center>Ordered succesfully</div>";
                header('location:'.SITEURL);
                }else{
                    $_SESSION['order']="<div class='error' text-center>Failed to Order Food</div>";
                    header('location:'.SITEURL);

                }

            }


?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

<?php include('partials-front/footer.php');?>