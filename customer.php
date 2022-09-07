<?php
require_once('product_function.php');
// Set Variables for featured products
$featuredProductsNames = array();
$featuredProducts = readFeaturedProducts();
$featuredProductsCount = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer</title>
    <link type="text/css" rel="stylesheet" href="product.css">
</head>
<body>
    <?php
        require_once('header.php');
    ?>
    
    <div class="product-header">
        <h1>All Products</h1>
    </div>
    <form method="get" action="customer2.php" id="filter">
        Name <input type="text" name="name">
        Min Price <input type="number" name="min_price">
        Max Price <input type="number" name="max_price">
        <input type="submit" name="act" value="Filter" >
    </form>
    <div class="all_products">
        <?php
            $file_name = "products.csv";

            $fp = fopen($file_name,'r');
            // 
            $first = fgetcsv($fp, 1000,",");
            $products= [];

            while($row = fgetcsv($fp, 1000,",")) {
                
                $product =[];
                $product = $row;
                if(isset($_GET['min_price']) && is_numeric($_GET['min_price'])) {
                    if ($product['4'] < $_GET['min_price']) {
                        continue;  
                    }
                } 

                if(isset($_GET['max_price']) && is_numeric($_GET['max_price'])) {
                    if($product['4'] > $_GET['max_price']) {
                    continue;  
                    }
                } 

                if(isset($_GET['name']) && !empty($_GET['name'])) {
                    if(strpos($product['3'], $_GET['name']) ===false) {
                    continue;  
                    }
                }
                $products[] = $product;
            }
        ?>

        <?php
            // Loop through the csv array
            foreach ($products as $rec)
            {?>
            <div class='each_product'>
                <img class='image' src='<?=$rec[2]?>' alt = 'logo'>
                <h3><?=$rec[3] ?></h3>
                <h3><?=$rec[4] ?></h3>
                <h3><?=$rec[5] ?></h3>
            </div>
        <?php } ?>
    </div>
    
    <?php
        require_once('footer.php');
    ?>
</body>
</html>
