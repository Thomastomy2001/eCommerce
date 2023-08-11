<?php
include "controller/cart.php";
?>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <link href="css/style.css" rel="stylesheet" />
    <link href="css/custom.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <!-- responsive style -->
</head>
<body>
<nav class="navbar navbar-expand-lg custom_nav-container ">
    <div class="collapse navbar-collapse innerpage_navbar" id="navbarSupportedContent">
        <ul class="navbar-nav  ">
            <li class="nav-item active">
                <a class="nav-link" href="view_shop.php">
                    SHOP
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="view_cart.php">
                    cart
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="view_checkout.php">
                    checkout
                </a>
            </li>
        </ul>
    </div>
</nav>
<div class="container">
    <h2 class="text-center my-4">Checkout</h2>
    <form method="post">
        <div class="row">
            <div class="col-md-6">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control mb-3" required>
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control mb-3" required>
                <label for="address" class="form-label">Address</label>
                <input type="text" name="address" id="address" class="form-control mb-3" required>
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control mb-3" required>
            </div>
        </div>

        <table class="table table-bordered text-center ">
            <thead>
            <tr>
                <th>CART ITEM</th>
                <th>ITEM QUANTITY</th>
                <th>ITEM TOTAL</th>
            </tr>
            </thead>
            <tbody>
            <?php $total_price = 0 ; ?>
            <?php if(isset($_SESSION['cart']['cart_item']) && !empty($_SESSION['cart']['cart_item'])): ?>
            <?php foreach ($_SESSION['cart']['cart_item'] as $cartItem): ?>
                <tr>
                    <td>
                        <div class="media">
                            <img src="images/<?php echo $cartItem[0]['image']; ?>" class="mr-3" alt="Product Image">
                            <div class="media-body">
                                <h5 class="mt-0"><?php echo $cartItem[0]['product_name']; ?></h5>
                            </div>
                        </div>
                    </td>

                    <td class="align-middle">
                        <?php foreach ($_SESSION['cart']['quantity']  as $id => $quantity ): ?>
                            <?php if($id == $cartItem[0]['id'] ): ?>
                                <h5><?php echo $quantity; ?></h5>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </td>
                    <td class="align-middle">
                        <?php foreach ($_SESSION['cart']['quantity']  as $id => $quantity ): ?>
                            <?php if($id == $cartItem[0]['id'] ): ?>
                                <h5><?php echo $quantity*$cartItem[0]['price']; ?></h5>
                                <?php $total_price +=  $quantity*$cartItem[0]['price']; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <!-- Add logic here to calculate and display the item total -->
                    </td>

                </tr>
            <?php endforeach; ?>
            <?php endif; ?>
            <tr>
                <td class="text-left" colspan="2">
                    <h5>total:</h5>
                    <!-- Add logic here to calculate and display the item total -->
                </td>
                <td class="align-middle ">
                    <?php if(!empty($total_price)) : ?>
                     <?php   $_SESSION['cart']['cart_total'] = $total_price; ?>
                    <h5><?php echo $total_price; ?></h5>
                    <?php endif; ?>
                </td>

            </tr>
            </tbody>
        </table>
        <?php $disable = !isset( $_SESSION['cart']['cart_item'])&& empty( $_SESSION['cart']['cart_item']) ? "disabled" : "" ; ?>
        <button  class="checkout_button btn btn-primary" <?php echo $disable ?>>Submit</button>
    </form>
</div>
</body>
</html>
<script>
    $(document).ready(function(){
        $('.checkout_button').click(function(e){
            e.preventDefault();
            var formData = {
                name: $('#name').val(),
                email: $('#email').val(),
                address: $('#address').val(),
                phone: $('#phone').val()
            };
            console.log(formData);
            $.ajax({
                url:'controller/checkout.php',
                method:'post',
                data:{ form_data: formData, action: 'submit' },
                success:function (response){
                    alert(response);
                    window.location.href = "view_shop.php";
                },
                error:function(){
                    alert('error to add a product in cart');

                }
            });
        });
    });
</script>