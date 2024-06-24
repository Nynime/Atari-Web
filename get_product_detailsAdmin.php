<?php
include 'database_admin.php';

// Get the product ID from the URL
$productId = isset($_GET['product_id']) ? intval($_GET['product_id']) : 0;

// Fetch product details from the database
$selectQuery = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($selectQuery);
$stmt->bind_param("i", $productId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $product = $result->fetch_assoc();
} else {
    echo "Product not found.";
    exit;
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($product['product_name']); ?></title>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons'>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/vuetify@1.4.2/dist/vuetify.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="style_pi.css">
    <style>
        body { font-family: 'Roboto', sans-serif; }
        .product-summary { margin: 20px; }
        .product-title { font-size: 24px; font-weight: 500; }
        .user-ratings { margin-top: 10px; font-size: 14px; }
        .price { margin: 20px 0; font-size: 24px; color: #ff5252; }
        .product-details { margin-top: 20px; font-size: 16px; }
        .buy-product { margin-top: 30px; }
        .stock v-btn { margin-bottom: 20px; }
        .cart-btn { margin-right: 10px; }
        .socal-link { margin-top: 20px; }
        .socal-link li { display: inline; margin-right: 10px; }
        .socal-link a { color: #333; }
        .socal-link a:hover { color: #ff5252; }
    </style>
</head>
<body>
    <div id="app" class="body">
        <v-app id="inspire">
            <v-container grid-list-md text-xs-center>
                <v-layout row wrap>
                    <v-flex xs5>
                        <v-card>
                            <v-img id="product-img" src="<?php echo htmlspecialchars($product['image_url']); ?>" height="100%" class="grey darken-4"></v-img>
                        </v-card>
                    </v-flex>
                    <v-flex xs7 pl-5 class="d-flex text-xs-left">
                        <div class="product-summary">
                            <h2 class="product-title"><?php echo htmlspecialchars($product['product_name']); ?></h2>
                            <div class="user-ratings">
                                <div class="star-rating">
                                    <span style="width:<?php echo ($product['rating'] / 5) * 100; ?>%"></span>
                                </div>
                                <a href="#reviews" class="total-review" rel="nofollow">(<span class="count">100</span> customer review)</a>
                            </div>
                            <div class="price">
                                <h3><span>RM</span> <?php echo htmlspecialchars($product['price']); ?></h3>
                                <del>RM <?php echo htmlspecialchars($product['discounted_price']); ?></del>
                            </div>
                            <div class="product-details">
                                <h3>Product Details</h3>
                                <p><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
                            </div>
                            <div class="buy-product">
                                <div class="stock">
                                    <v-btn color="#4CAF50" dark><?php echo $product['availability'] ? 'IN STOCK' : 'OUT OF STOCK'; ?>
                                        <v-icon dark right>check_circle</v-icon>
                                    </v-btn>
                                </div>
                                <div class="product-qty">
                                    <div class="cart-btn">
                                        <form method="post" action="cart.php">
                                            <input type="hidden" name="item_id" value="<?php echo $product['id']; ?>">
                                            <button type="submit" class="v-btn cart-btn px-5" color="error">
                                                <i class="fa fa-shopping-cart"></i> ADD TO CART
                                            </button>
                                        </form>
                                        <v-btn class="cart-btn px-5" color="error"><a href="checkout-page.html">BUY NOW</a></v-btn>
                                    </div>
                                    <button><i class="fa fa-heart" aria-hidden="true"></i> ADD TO WISHLIST</button>
                                    <ul class="socal-link">
                                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-rss"></i></a></li>
                                        <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-app>
    </div>
    <script src='https://cdn.jsdelivr.net/npm/babel-polyfill/dist/polyfill.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/vue/dist/vue.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/vuetify@1.4.2/dist/vuetify.min.js'></script>
    <script src="script_pi.js"></script>

</body>
</html>
