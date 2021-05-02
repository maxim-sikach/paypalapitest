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
 
<?php  $Good = array
                 (
                'id' => 1,
                'name' => "newproduct 1",
                'price' => "19.99",
                'image' => "images/1.jpg",
                'currency' => "USD"
                ); 

echo ' 
<style type="text/css">html, body {height: 100%; background:#2d9783;}</style>
<div class="container h-100 d-flex justify-content-center">
    <div class="h-100 row align-items-center">
        <div class="col">
            <h1><center>Newproduct #1</center></h1>
            <center><img src="'.$Good['image'].'" width="300" height="300"/></center><br>
            <h2><center>Name: '.$Good['name'].'</center></h2><br>
            <h2><center>Price: '.$Good['price'].'</center></h2><br>
            <center><a href="checkout.php?id='.$Good['id'].'" class="btn btn-warning">BUY</a></center><br>
        </div>
    </div>
</div>            
'; ?>
</body>
</html>