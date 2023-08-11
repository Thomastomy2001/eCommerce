<?php
include  "../connection.php";

session_start();

// Track user activity by updating last activity time
if (isset($_SESSION['last_activity'])) {
    $_SESSION['last_activity'] = time();
}

// Check if the session should be expired
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 600)) {
    // Logout user and remove session data
    session_unset();
    session_destroy();
    // Redirect user to the login page
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] == 'add') {
        addcart($_POST['product_id']);
        $html = "this cart item added sucessfully";
        echo $html;
        exit;
    }
}
 function getCartItem($productId){
     if (!isset($_SESSION['cart'])) {
         $_SESSION['cart']['cart_item'] = [];
     }
    if (isset($productId)) {
            $connection = new connection();
            $_SESSION['cart']['cart_item'][] = $connection->getCartProduct($productId);
    }
}
function addcart($productId)
{
    //session_destroy();exit;
    //  $productId = isset($_POST['product_id']);

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart']['product_id']) && in_array($productId,array_values($_SESSION['cart']['product_id']))) {
        $_SESSION['cart']['quantity'][$productId]++;

    }else{
        $_SESSION['cart']['product_id'][] = $productId;
        $_SESSION['cart']['quantity'][$productId] = 1;
        getCartItem($productId);

    }

}




;