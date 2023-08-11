<?php
 include  "connection.php";

 $connection = new connection();
 $products = $connection->getProduct();

?>
<!DOCTYPE html>
<html>

<head>
  <title>
Giftos
  </title>
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
  <div class="container">
      <div class="heading_container heading_center">
          <h2>
              Latest Products
          </h2>
      </div>
      <div class="row">
          <?php foreach ($products as $product) : ?>
          <div class="col-md-3 text-center" >
              <div class="box">
                      <div class="img-box">
                          <img src="images/<?php echo $product['image']; ?>" style="width: 100%;" alt="">
                      </div>
                      <div class="detail-box">
                          <h6 class="product_name">
                              <?php echo $product['product_name']; ?>
                          </h6>
                          <h6>
                              Price
                              <span class="product_price">
                               ₹ <?php echo $product['price']; ?>
                              </span>
                          </h6>
                      </div>
                      <div class="add_to_cart">
                          <button class="cart_button" data-product-id="<?php echo $product['id'] ?>">add cart</button>
                      </div>
              </div>
          </div>
          <?php endforeach; ?>
      </div>
  </div>

</body>
</html>
<script>
$(document).ready(function(){
    $('.cart_button').click(function(e){
        var productId = $(this).data("product-id");
        e.preventDefault();
        $.ajax({
        url:'controller/cart.php',
        method:'post',
        data:{ product_id: productId, action: 'add' },
        success:function (response){
           alert(response);
        },
       error:function(){
            alert('error to add a product in cart');

        }
      });
    });
});
</script>