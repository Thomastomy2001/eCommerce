<?php
class connection{
    public function con(){
        return new mysqli('localhost','root','','ecommerce');
    }

    public function getProduct(){

        $con = $this->con();
        $query = "SELECT * FROM products";
        $value = mysqli_query($con, $query);
        $result = '';
        if($value){
            $result = mysqli_fetch_all($value,MYSQLI_ASSOC);
        }

        return $result;
    }

    public function getCartProduct($product_id){
        $result = '';
        if(!empty($product_id)) {
            $con = $this->con();
            $con = $this->con();
            $query = "SELECT * FROM products where id='$product_id'";
            $value = mysqli_query($con, $query);
            if ($value) {
                $result = mysqli_fetch_all($value, MYSQLI_ASSOC);
            }
        }
        return $result;
    }
    public function storeDate( $data,$cart_item){
        $result = '';
        if(!empty($data) && !empty($cart_item)) {
            $name = $data['name'];
            $email = $data['email'];
            $address = $data['address'];
            $phone = $data['phone'];
            $cart_items = json_encode($cart_item);
            $query = "INSERT INTO `orders`(`name`, `email`, `address`, `phone`, `cart_items`) VALUES ('$name','$email','$address','$phone','$cart_items') ";
            $result = mysqli_query($this->con(), $query);
        }
        return $result;
    }
}