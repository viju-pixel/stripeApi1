<?php 
// Include configuration file  
include_once 'config.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Stripe payemnt</title>
   
    <script src="https://js.stripe.com/v3/"></script>
   
    <script>
var buyBtn=document.getElementbyId('payButton');
var responseContainer=document.getElementbyId('paymentResponse');
var createCheckoutSession=function(stripe){
    return fetch("stripe_charge.php",{
        method:"POST",
        headers:{
            "Content-type":"application/json",

        },
        body:json.stringfy({
            checkSesion:1,
        }),
    }).then(function(result){
        return result.json();
    });
};

var handleRequest=function(result){
if(result.error){
    responseContainer.innerHTML='<p>'+result.error.message+ '</p>';
}
buyBtn.disabled=false;
buyBtn.textContent='Buy Now';
};

var stripe=stripe('pk_test_51LaCWfSDChRBwbLf660qQW7OjZMgImZfT0S8d4zUEzxQ2cSoA1Jp1gDKKU3IPhAT51NHFAeiQ1KuOtw3zwT6j1T500lD2APZM0');
buyBtn.addEventListener("click",function(evt){
    buyBtn.disabled=true;
    buyBtn.textContent="please wait..";
    createCheckoutSession.then(function(data){
        if(data.sessionId){
            stripe.redirectToCheckout({
                sessionId:data.sessionid,

            }).then(handleRequest);
        }else{
            handleRequest(data);
        }
    });
});
    


</script>
 
</head>
<body>
    <div class="container">
        <div class="item">
    <!-- Display errors returned by checkout session -->
<div id="paymentResponse" class="hidden"></div>
	
    <!-- Product details -->
    <h2><?php echo $productName; ?></h2>
    <img src=""/>
    <p>stripe book.</p>
    <p>Price:<b>$<?php echo $productPrice.' '.strtoupper($currency); ?></b></p>
    
    <!-- Payment button -->
    <button class="stripe-button" id="payButton">
        <div class="spinner hidden" id="spinner"></div>
        <span id="buttonText">Pay Now</span>
    </button>
    </div>
    </div>
</body>
</html>