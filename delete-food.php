<?php include('../config/constants.php');
 if(isset($_GET['id'])&&isset($_GET['image_name'])){
  //1.Get ID and Image Name
  $id=$_GET['id'];
  $image_name=$_GET['image_name'];
  //2.Remove the image if Available
  //check whether image is available or not delete only if available
  if($image_name!=""){
    //it has image and need to remove from folder
    //Get the image path
    $path="../images/food/".$image_name;
    //Remove image file from folder
    $remove=unlink($path);
    //check whether image is removed or not
    if($remove==false){
        //failed to remove image
        $_SESSION['upload']="<div class='error'>Failed to remove image</div>";
        //Redirect to manage food
        header('location:'.SITEURL.'admin/manage-food.php');
        die();
    }


  }
  //3.Delete food from database
  $sql="DELETE FROM tbl_food where id=$id";
  //Execute the query
  $res=mysqli_query($conn,$sql);
  if($res==true){
    $_SESSION['delete']="<div class='success'>Food deleted</div>";
    header('location:'.SITEURL.'admin/manage-food.php');
  }else{
      $_SESSION['delete']="<div class='error'>Food deletion failed</div>";
      header('location'.SITEURL.'admin/manage-food.php');
  }
    

 }
 else{
     $_SESSION['unauthorize']="<divclass='error'>Unauthorized access</div>";
     header('location:'.SITEURL.'admin/manage-food.php');

 }


?>