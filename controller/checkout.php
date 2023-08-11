<?php
//require "controller/cart.php";
include  "./connection.php";
include "cart.php";

error_reporting(E_ALL);
ini_set('display_errors', '1');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] == 'submit') {
        $data = $_POST['form_data'];
        $cart_item = $_SESSION['cart']['cart_item'];
        $connection =  new connection();
        $result = $connection->storeDate($data,$cart_item);
        if($result){
            $response =" thank for placing order";
            session_destroy();
        }else{
            $response =" issue to place the order.please try again";
        }
        echo $response;
    }

}