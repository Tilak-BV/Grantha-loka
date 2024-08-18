<?php
session_start();
include ('./php/config.php');
if(isset($_POST['order_btn']))
{

   $name = $_POST['name'];
   $number = $_POST['number'];
   $email = $_POST['email'];
   $method = $_POST['method'];
   $flat = $_POST['flat'];
   $street = $_POST['street'];
   $city = $_POST['city'];
   $state = $_POST['state'];
   $country = $_POST['country'];
   $pin_code = $_POST['pin_code'];

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart`");
   $price_total = 0;
   if(mysqli_num_rows($cart_query) > 0)
   {
      while($product_item = mysqli_fetch_assoc($cart_query))
      {
         $product_name[] = $product_item['name'] .' ('. $product_item['quantity'] .') ';
         $product_price = number_format($product_item['price'] * $product_item['quantity']);
         $price_total += $product_price;
      };
   };

   $total_product = implode(', ',$product_name);
   $detail_query = mysqli_query($conn, "INSERT INTO `order`(name, number, email, method, flat, street, city, state, country, pin_code, total_products, total_price) VALUES('$name','$number','$email','$method','$flat','$street','$city','$state','$country','$pin_code','$total_product','$price_total')") or die('query failed');

   if($cart_query && $detail_query)
   {
      echo "
      <div class='order-message-container'>
      <div class='message-container'>
         <h3>Thank You For Shopping!</h3>
         <div class='order-detail'>
            <span>".$total_product."</span>
            <span class='total'> Total : ₹".$price_total."/-  </span>
         </div>
         <div class='customer-details'>
            <p> your name : <span>".$name."</span> </p>
            <p> your number : <span>".$number."</span> </p>
            <p> your email : <span>".$email."</span> </p>
            <p> your address : <span>".$flat.", ".$street.", ".$city.", ".$state.", ".$country." - ".$pin_code."</span> </p>
            <p> your payment mode : <span>".$method."</span> </p>
            <p style='text-decoration:underline;'><b>(* Pay When Product Arrives *)</b></p>
         </div>
            <a href='collections.html' class='btn'>Continue Shopping</a>
         </div>
      </div>
      ";
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
     <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap');

    :root{
   --blue:#2980b9;
   --red:tomato;
   --orange:orange;
   --black:#333;
   --white:#fff;
   --bg-color:#eee;
   --dark-bg:rgba(0,0,0,.7);
   --box-shadow:0 .5rem 1rem rgba(0,0,0,.1);
   --border:.1rem solid #999;
}

*{
   font-family: 'Poppins', sans-serif;
   margin:0; padding:0;
   box-sizing: border-box;
   outline: none; border:none;
   text-decoration: none;
   text-transform: capitalize;
}

html{
   font-size: 62.5%;
   overflow-x: hidden;
}

.container{
   max-width: 1200px;
   margin:0 auto;
   padding-bottom: 5rem; 
}

section{
   padding:2rem;
}

.heading{
   text-align: center;
   font-size: 3.5rem;
   text-transform: uppercase;
   color:#333;
   margin-bottom: 2rem;
}

.btn{
   display: block;
   width: 100%;
   text-align: center;
   background-color: #2980b9;
   color:var(--white);
   font-size: 1.7rem;
   padding:1.2rem 3rem;
   border-radius: .5rem;
   cursor: pointer;
   margin-top: 1rem;
}

.btn:hover{
   background-color: var(--black);
}
.checkout-form form{
   padding:2rem;
   border-radius: .5rem;
   background-color: var(--bg-color);
}

.checkout-form form .flex{
   display: flex;
   flex-wrap: wrap;
   gap:1.5rem;
}

.checkout-form form .flex .inputBox{
   flex:1 1 40rem;
}

.checkout-form form .flex .inputBox span{
   font-size: 2rem;
   color:var(--black);
}

.checkout-form form .flex .inputBox input,
.checkout-form form .flex .inputBox select{
   width: 100%;
   background-color: var(--white);
   font-size: 1.7rem;
   color:var(--black);
   border-radius: .5rem;
   margin:1rem 0;
   padding:1.2rem 1.4rem;
   text-transform: none;
   border:var(--border);
}

.display-order{
   max-width: 50rem;
   background-color: var(--white);
   border-radius: .5rem;
   text-align: center;
   padding:1.5rem;
   margin:0 auto;
   margin-bottom: 2rem;
   box-shadow: var(--box-shadow);
   border:var(--border);
}

.display-order span{
   display: inline-block;
   border-radius: .5rem;
   background-color: var(--bg-color);
   padding:.5rem 1.5rem;
   font-size: 2rem;
   color:var(--black);
   margin:.5rem;
}

.display-order span.grand-total{
   width: 100%;
   background-color: var(--red);
   color:var(--white);
   padding:1rem;
   margin-top: 1rem;
}

.order-message-container{
   position: fixed;
   top:0; left:0;
   height: 100vh;
   overflow-y: scroll;
   overflow-x: hidden;
   padding:2rem;
   display: flex;
   align-items: center;
   justify-content: center;
   z-index: 1100;
   background-color: var(--dark-bg);
   width: 100%;
}

.order-message-container::-webkit-scrollbar{
   width: 1rem;
}

.order-message-container::-webkit-scrollbar-track{
   background-color: var(--dark-bg);
}

.order-message-container::-webkit-scrollbar-thumb{
   background-color: var(--blue);
}

.order-message-container .message-container{
   width: 50rem;
   background-color: var(--white);
   border-radius: .5rem;
   padding:2rem;
   text-align: center;
}

.order-message-container .message-container h3{
   font-size: 2.5rem;
   color:var(--black);
}

.order-message-container .message-container .order-detail{
   background-color: var(--bg-color);
   border-radius: .5rem;
   padding:1rem;
   margin:1rem 0;
}

.order-message-container .message-container .order-detail span{
   background-color: var(--white);
   border-radius: .5rem;
   color:var(--black);
   font-size: 2rem;
   display: inline-block;
   padding:1rem 1.5rem;
   margin:1rem;
}

.order-message-container .message-container .order-detail span.total{
   display: block;
   background: var(--red);
   color:var(--white);
}

.order-message-container .message-container .customer-details{
   margin:1.5rem 0;
}

.order-message-container .message-container .customer-details p{
   padding:1rem 0;
   font-size: 2rem;
   color:var(--black);
}

.order-message-container .message-container .customer-details p span{
   color:#2980b9;
   padding:0 .5rem;
   text-transform: none;
}
   </style>

</head>
<body>

    <div class="container">

        <section class="checkout-form">
        
           <h1 class="heading">complete your order</h1>
        
           <form action="" method="post">

           <div class="display-order">
           <?php
$select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
$total = 0;
$grand_total = 0;
if(mysqli_num_rows($select_cart) > 0){
while($fetch_cart = mysqli_fetch_assoc($select_cart)){
$total_price = number_format($fetch_cart['price'] * $fetch_cart['quantity']);
$grand_total = $total += $total_price;
?>
<span><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
<?php
}
}else{
echo "<div class='display-order'><span>your cart is empty!</span></div>";
}
?>

<span class="grand-total"> grand total :  ₹<?= $grand_total; ?>/- </span>
</div>

      


            <div class="flex">
                <div class="inputBox">
                   <span>your name</span>
                   <input type="text" placeholder="enter your name" name="name" required>
                </div>
                <div class="inputBox">
                   <span>your number</span>
                   <input type="number" placeholder="enter your number" name="number" required>
                </div>
                <div class="inputBox">
                   <span>your email</span>
                   <input type="email" placeholder="enter your email" name="email" required>
                </div>
                <div class="inputBox">
                   <span>payment method</span>
                   <select name="method">
                     <option value="Select Any Method" selected>Select Any Method</option>
                      <option value="cash on delivery">cash on devlivery</option>
                      <option value="credit cart">credit cart</option>
                      <option value="paytm">paytm</option>
                      <option value="Googlepay">Google Pay</option>

                   </select>
                </div>
                <div class="inputBox">
                   <span>address line 1</span>
                   <input type="text" placeholder="e.g. flat no." name="flat" required>
                </div>
                <div class="inputBox">
                   <span>address line 2</span>
                   <input type="text" placeholder="e.g. street name" name="street" required>
                </div>
                <div class="inputBox">
                   <span>city</span>
                   <input type="text" placeholder="e.g. mumbai" name="city" required>
                </div>
                <div class="inputBox">
                   <span>state</span>
                   <input type="text" placeholder="e.g. maharashtra" name="state" required>
                </div>
                <div class="inputBox">
                   <span>country</span>
                   <input type="text" placeholder="e.g. india" name="country" required>
                </div>
                <div class="inputBox">
                   <span>pin code</span>
                   <input type="text" placeholder="e.g. 123456" name="pin_code" required>
                </div>
             </div>
             <input type="submit" value="order now" name="order_btn" class="btn">
          </form>
       
       </section>
       
       </div>
    
</body>
</html>
