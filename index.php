<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
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
if(!isset($_GET['id']))
{ 
echo ' 
<style type="text/css">html, body {height: 100%; background:#2d9783;}</style>
<div class="container h-100 d-flex justify-content-center">
    <div class="h-100 row align-items-center">
        <div class="col">
            <h1><center>Newproduct #1</center></h1>
            <center><img src="'.$Good['image'].'" width="300" height="300"/></center><br>
            <h2><center>Name: '.$Good['name'].'</center></h2><br>
            <h2><center>Price: '.$Good['price'].'</center></h2><br>
            <center><a href="index.php?id='.$Good['id'].'" class="btn btn-warning">BUY</a></center>
        </div>
    </div>
</div>            
'; 
}
else 
{
    $sandbox = true;

    class PaypalExpress{ 
        public $paypalEnv       = $sandbox?'sandbox':'production'; 
        public $paypalURL       = $sandbox?'https://api.sandbox.paypal.com/v1/':'https://api.paypal.com/v1/'; 
        public $paypalClientID  = 'ARK5k8zOf4oayJzUyuDSU-e882ax972g7btKHtnf6t5AQQNexHz5_YlcO8rqdY6DkGSiqtM6oXOLHjhz'; 
        private $paypalSecret   = 'EDuGXLNshStb7katle99M3amjlDhJGd8t2trF8FYxv9uLhRk7xckejrwRHuB8DxHeFylvESbo1QjU2Qi'; 
         
        public function validate($paymentID, $paymentToken, $payerID, $productID){ 
            $ch = curl_init(); 
            curl_setopt($ch, CURLOPT_URL, $this->paypalURL.'oauth2/token'); 
            curl_setopt($ch, CURLOPT_HEADER, false); 
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
            curl_setopt($ch, CURLOPT_POST, true); 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
            curl_setopt($ch, CURLOPT_USERPWD, $this->paypalClientID.":".$this->paypalSecret); 
            curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials"); 
            $response = curl_exec($ch); 
            curl_close($ch); 
                                                        
            if(empty($response)){ 
                return false; 
            }else{ 
                /* echo $response.'<br></br>'; */
                $jsonData = json_decode($response); 
                $curl = curl_init($this->paypalURL.'payments/payment/'.$paymentID); 
                curl_setopt($curl, CURLOPT_POST, false); 
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); 
                curl_setopt($curl, CURLOPT_HEADER, false); 
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
                curl_setopt($curl, CURLOPT_HTTPHEADER, array( 
                    'Authorization: Bearer ' . $jsonData->access_token, 
                    'Accept: application/json', 
                    'Content-Type: application/xml' 
                )); 
                $response = curl_exec($curl); 
                curl_close($curl); 
                                                       /*  var_dump($jsonData); */
                // Transaction data 
                $result = json_decode($response); 
                /* echo '<br></br></br>'.$response.'</br></br>'; */
                return $result; 
            } 
         
        } 
    }
    $paypal = new PaypalExpress; 
    echo ' 
    <style type="text/css">html, body {height: 100%; background:#2d9783;}</style>
    <div class="container h-100 d-flex justify-content-center">
        <div class="h-100 row align-items-center">
            <div class="col">
                <h1><center>Newproduct #1</center></h1>
                <center><img src="'.$Good['image'].'" width="300" height="300"/></center><br>
                <h2><center>Name: '.$Good['name'].'</center></h2><br>
                <h2><center>Price: '.$Good['price'].'</center></h2><br>
                <center><div id="paypal-button"></div></center>
            </div>
        </div>
    </div>            
    '; 
} 
?>
<script>
paypal.Button.render({
    // Configure environment
    env: '<?php echo $paypal->paypalEnv; ?>',
    client: {
        sandbox: '<?php echo $paypal->paypalClientID; ?>',
        production: '<?php echo $paypal->paypalClientID; ?>'
    },
    // Customize button (optional)
    locale: 'en_US',
    style: {
        size: 'small',
        color: 'black',
        shape: 'pill',
    },
    // Set up a payment
    payment: function (data, actions) {
        return actions.payment.create({
            transactions: [{
                amount: {
                    total: '<?php echo $Good['price']; ?>',
                    currency: '<?php echo $Good['currency']; ?>'
                }
            }]
      });
    },
    // Execute the payment
    onAuthorize: function (data, actions) {
        return actions.payment.execute()
        .then(function () {
            // Show a confirmation message to the buyer
            //window.alert('Thank you for your purchase!');
            
            // Redirect to the payment process page
            window.location = "process.php?paymentID="+data.paymentID+"&token="+data.paymentToken+"&payerID="+data.payerID+"&pid=<?php echo $productData['id']; ?>";
        });
    }
}, '#paypal-button');
</script>
</body>
</html>