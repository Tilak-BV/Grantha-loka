
<?php

session_start();

require_once ('./php/CreateDb.php');
require_once ('./php/component.php');


// create instance of Createdb class
$database = new CreateDb("Productdb", "Producttb");

if (isset($_POST['add'])){
    /// print_r($_POST['product_id']);
    if(isset($_SESSION['cart'])){

        $item_array_id = array_column($_SESSION['cart'], "product_id");

        if(in_array($_POST['product_id'], $item_array_id)){
            echo "<script>alert('Product is already added in the cart..!')</script>";
            echo "<script>window.location = 'shop1.php'</script>";
        }else{

            $count = count($_SESSION['cart']);
            $item_array = array(
                'product_id' => $_POST['product_id']
            );

            $_SESSION['cart'][$count] = $item_array;
        }

    }else{

        $item_array = array(
                'product_id' => $_POST['product_id']
        );

        // Create new session variable
        $_SESSION['cart'][0] = $item_array;
        print_r($_SESSION['cart']);
    }
}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shopping</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
         @import url('https://fonts.googleapis.com/css2?family=Salsa&display=swap');
        *{
            font-family: 'Salsa', cursive;
        }
        img{
            max-width: 100%;
            height:auto;
        }

        .fa-star, .fa-star-half{
        color: yellowgreen;
        padding: 3% 0;
        }
        #cart_count {
            text-align: center;
            padding: 0 0.9rem 0.1rem 0.9rem;
            border-radius: 3rem;
        }
        .banner{
            position: relative;
            height: 350px;
            width: 100%;
            left: 0px;
            background: url(img/png_20230626_081251_0000.png);
            background-size: cover;
            background-position-y: -125px;
        }
        .contain{
            background: black;
            box-sizing: border-box;
            color: #fff;
            position: relative;
            padding: 30px 20px;
            margin-top: 0px;
        }

.contain ul,li,a{
    list-style: none;
    text-decoration: none;
    color: #fff;
    cursor: pointer;
}
.contain div{
    display: inline-block;
    width: 350px;
}

.contain .name{
    padding: 5px 40px;      
}
.name h2,li,h3{
    margin-bottom: 10px;
}
.name span{
    color: aqua;
    top: 35px;
    margin-left: 5px;
}
.name h3{
    font-size: 14px;
    font-style: oblique;
    color: #b5b3b3;
    padding-top: 15px;
}
.links li {
    position: absolute;
    display: grid;
    grid-template-columns: auto auto auto auto;
    gap: 10px;
    top: 80px;
    left: 60px;
}

.details{
    position: absolute;
    font-size: 1rem;
    top: 40px;
    right: 450px;
}
.details li{
    font-size: 18px;
    margin-bottom: 15px;
}
.details span{
    top:3px;
    margin-left: 10px;

}
.about{
    position: absolute;
    top: 30px;
    right: 100px;
}
.about p{
    margin: 10px 0;
    font-size: 14px;
}
.about li {
    position: absolute;
    display: grid;
    grid-template-columns: auto auto auto auto auto;
    gap: 10px;
    top: 135px;
    left: 0px;  
}
.about .icons{
    margin-right: 35px; 
    margin-top: -2px;
}
.uil{
    color: #fff;
    display:flex;
    font-size: 24px;
    position: absolute;
} 
.uil:hover{
    color: #f43343;
    margin-top: -4px;
}
    </style>

</head>
<body>


<?php require_once ("./php/header.php"); ?>
<div class="banner">
            
</div>
<div class="container top-80">
       
        <div class="row text-center py-5">
            <?php
                $result = $database->getData();
                while ($row = mysqli_fetch_assoc($result)){
                    component($row['product_name'], $row['product_price'], $row['product_image'], $row['id']);
                }
            ?>
        </div>
</div>
<footer>
        <div class="contain">
            <div class="name">
                <h2>Grantha <span>Loka</span> </h2>
                <div class="links">
                    <ul>
                        <li>
                            <a href="index.html">Home |</a>
                            <a href="collections.html">Collections |</a>
                            <a href="shop1.php">Shop |</a>
                            <a href="review.html">Reviews </a>
                        </li>
                    </ul>
                </div>
                <h3>Copyright 2023 <b>Grantha Loka.</b> All rights resevered. </h3>
            </div>
            <div class="details">
                <ul>
                    <li>J.P Nagar <span>Bengaluru</span></li>
                    <li>+91 7337887531</li>
                    <li>xyz@gmail.com</li>
                </ul>
            </div>
            <div class="about">
                <h2>About Us</h2>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Odio ullam dicta harum beatae tempora deleniti
                    quo quod expedita <a href="about.html" style="font-size: 18px; text-decoration: underline; color: cyan;">Read More</a>
                </p>
                <ul>
                    <li>
                        <a href="">Follow Us</a>
                        <a href="" class="icons"><i class="uil uil-facebook"></i></a>
                        <a href="" class="icons"><i class="uil uil-instagram"></i></a>
                        <a href="" class="icons"><i class="uil uil-linkedin"></i></a>
                        <a href="" class="icons"><i class="uil uil-twitter-alt"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>





<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>