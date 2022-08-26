<?php 
// Product Details 
// Minimum amount is $0.50 US 
$productName = "book"; 
$productID = "price_1LaHpgSDChRBwbLfypWEIWDk"; 
$productPrice = 10; 
$currency = "USD"; 
$stripeAmount=round($productprice*100,2);

// Stripe API configuration  
define('STRIPE_API_KEY', 'sk_test_51LaCWfSDChRBwbLfWBwRH8HZJ9rL4Cg6IIIclAri0CoxhlsPNszoiseqJYPoGjDVTXR6w7GhetNFUZPtWRgdmz6800wty03TEY'); 
define('STRIPE_PUBLISHABLE_KEY','pk_test_51LaCWfSDChRBwbLf660qQW7OjZMgImZfT0S8d4zUEzxQ2cSoA1Jp1gDKKU3IPhAT51NHFAeiQ1KuOtw3zwT6j1T500lD2APZM0'); 
define('STRIPE_SUCCESS_URL', 'http://localhost/vijay/in-progress/stripe/success.php'); 
define('STRIPE_CANCEL_URL', 'http://localhost/vijay/in-progress/cancle.php'); 

// Database configuration  
define('DB_HOST', 'localhost'); 
define('DB_USERNAME', 'admin'); 
define('DB_PASSWORD', 'Ane21092011!'); 
define('DB_NAME', 'Stripe');