<?php
session_start();
//session_destroy();
if (isset($_SESSION['user'])){
$product_name = $_POST['PName'];
$product_price = $_POST['PPrice'];
$product_quantity = $_POST['PQuantity'];
if (isset($_POST['addcart'])){
     
     $_SESSION['cart'][] = array('productName' =>  $product_name, 
     'productPrice' => $product_price,
     'productQuantity' => $product_quantity);
     header("location:viewcart.php"); 

}
//remove product
if (isset($_POST['remove'])){
     foreach($_SESSION['cart']as $key =>$value){
          if($value['productName']=== $_POST['item']){
               unset($_SESSION['cart'][$key]);
              $_SESSION['cart'] = array_values($_SESSION['cart']);
               header('location:viewcart.php');
          
        }
    }
  }    
 //update product
 if (isset($_POST['update'])){
     foreach($_SESSION['cart']as $key =>$value){
          if($value['productName'] === $_POST['item']){
               if ($product_quantity > 0 && filter_var($product_quantity, FILTER_VALIDATE_INT)){
             $_SESSION['cart'][$key] = array('productName' =>  $product_name, 
            'productPrice' => $product_price,
           'productQuantity' => $product_quantity);
          }elseif($product_quantity==0){
               unset($_SESSION['cart'][$key]);
          }else {   
               echo "
               <script>
               alert ('Invalid Input');
               window.location.href='viewcart.php';
               </script>
               ";
              }
           header("location:viewcart.php");
          }
    }
  }   

}else{
      header("location:form/login.php");
      }

 ?>  
 
          
          