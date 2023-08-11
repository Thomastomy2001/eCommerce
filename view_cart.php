<?php include "controller/cart.php"; ?>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <link href="css/custom.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
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
<div class="text-center">
    <h2>
        CART PAGE
    </h2>
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
                    <h5><?php echo $total_price; ?></h5>
            <!-- Add logic here to calculate and display the item total -->
        </td>

    </tr>
    </tbody>
</table>
<div style="padding-left: 80%;">
    <?php $disable = !isset( $_SESSION['cart']['cart_item'])&& empty( $_SESSION['cart']['cart_item']) ? "pointer-events: none;" : "" ; ?>
    <a class="btn btn-primary" href="view_checkout.php" style=" <?php echo $disable; ?>">PROCEED TO CHECKOUT</a>
</div>
</body>
</html>