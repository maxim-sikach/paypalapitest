<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>Shop</title>
</head>
<body>
 <?php
   $Good = array
                 (
                'id' => 1,
                'name' => "newproduct 1",
                'price' => "19.99",
                'src_img' => "images/1.jpg",
                'currency' => "USD"
                ); 
 ?>
<div class="item ">
    <img src="images/1.jpg width="300" height="150"/><br>
    Name: <?php $Good['id']; ?> 
    Price: '.$row['price'].'<br>
    <a href="checkout.php?id='.$row['id'].'" class="btn btn-warning">BUY</a><br>
</div>




<?php
echo "<h2>Hello!!!</h2>";
?>

</body>
</html>