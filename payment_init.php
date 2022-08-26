<?php 
 
// Include the configuration file 
require_once 'config.php'; 
 
// Include the Stripe PHP library 
require_once 'stripe-php/init.php'; 
// Set API key 
\Stripe\Stripe::setApiKey("sk_test_51LaCWfSDChRBwbLfWBwRH8HZJ9rL4Cg6IIIclAri0CoxhlsPNszoiseqJYPoGjDVTXR6w7GhetNFUZPtWRgdmz6800wty03TEY"); 
 
$response = array( 
    'status' => 0, 
    'error' => array( 
        'message' => 'Invalid Request!'    
    ) 
); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $input = file_get_contents('php://input'); 
    $request = json_decode($input);     
} 
 
if (json_last_error() !== JSON_ERROR_NONE) { 
    http_response_code(400); 
    echo json_encode($response); 
    exit; 
} 
 
if(!empty($request->createCheckoutSession)){ 
    // Convert product price to cent 
    $stripeAmount = round($productPrice*100, 2); 
 
    // Create new Checkout Session for the order 
    try { 
        $checkout_session = \Stripe\Checkout\Session::create([ 
            'line_items' => [[ 
              'price_data' => [ 
                    'product_data' => [ 
                        'name' => $productName, 
                        'metadata' => [ 
                            'pro_id' => $productID 
                        ] 
                    ], 
                    'unit_amount' => $stripeAmount, 
                    'currency' => $currency, 
                ], 
                'quantity' => 1, 
                'description' => $productName, 
            ]], 
            'mode' => 'payment', 
            'success_url' => STRIPE_SUCCESS_URL.'?session_id={CHECKOUT_SESSION_ID}', 
            'cancel_url' => STRIPE_CANCEL_URL, 
        ]); 
    } catch(Exception $e) {  
        $api_error = $e->getMessage();  
    } 
     
    if(empty($api_error) && $checkout_session){ 
        $response = array( 
            'status' => 1, 
            'message' => 'Checkout Session created successfully!', 
            'sessionId' => $checkout_session->id 
        ); 
    }else{ 
        $response = array( 
            'status' => 0, 
            'error' => array( 
                'message' => 'Checkout Session creation failed! '.$api_error    
            ) 
        ); 
    } 
} 
 
// Return response 
echo json_encode($response); 
 
?>