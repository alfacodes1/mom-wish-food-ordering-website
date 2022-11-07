<?php
include("header.php");
$cat_dish = "";
$cat_dish_arr = array();
if (isset($_GET['cat_dish'])) {
    $cat_dish = $_GET['cat_dish'];
    $cat_dish_arr = array_filter(explode(',', $cat_dish));
}

?>

<div class="breadcrumb-area gray-bg">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a <?php echo FRONT_SITE_PATH ?>href="home">Home</a></li>
            </ul>
        </div>
    </div>
</div>

<?php
if ($website_close == 0) {
    echo '<div style="text-align: center; margin-top: 50px;"><h3>';
    echo $website_close_msg;
    echo '</h3></div>';
}
?>

<div class="shop-page-area pt-100 pb-100">
    <div class="container">
        <div class="row flex-row-reverse">
            <div class="col-lg-9">
                <?php
                $cat_id = 0;
                $product_sql = "select * from dish where status='1' ";
                if ($cat_dish != '') {
                    $product_sql .= " and category_id in ($cat_dish) ";
                }
                $product_sql .= " order by dish desc";
                //print_r($product_sql);die;
                $product_res = mysqli_query($con, $product_sql);
                $product_count = mysqli_num_rows($product_res);
                //print_r($product_res);die;
                ?>
                <div class="grid-list-product-wrapper">
                    <div class="product-grid product-view pb-20">
                        <?php if ($product_count > 0) {


                        ?>
                            <div class="row">

                                <?php while ($product_row = mysqli_fetch_assoc($product_res)) {

                                ?>

                                    <div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                                        <div class="product-wrapper">
                                            <div class="product-img">
                                                <a href="product-details.html">
                                                    <img src="<?php echo SITE_DISH_IMAGE . $product_row['image'] ?>" alt="">
                                                </a>
                                            </div>
                                            <div class="product-content" id="dish_detail">
                                                <h4>
                                                    <?php //veg non veg icons
                                                    if ($product_row['type'] == 'veg') {
                                                        echo "<img src='assets/img/icon-img/veg.jpg'>";
                                                    } else {
                                                        echo "<img src='assets/img/icon-img/non-veg.jpg'>";
                                                    }
                                                    ?>
                                                    <a href="javascript:void(0)"><?php echo $product_row['dish'];
                                                                                    getRatingByDishId($product_row['id']); ?> </a>
                                                </h4>
                                                <?php
                                                $dish_attr_res = mysqli_query($con, "select * from dish_details where status='1' and dish_id='" . $product_row['id'] . "' order by price asc");

                                                ?>
                                                <div class="product-price-wrapper">
                                                    <?php
                                                    while ($dish_attr_row = mysqli_fetch_assoc($dish_attr_res)) {
                                                        //print_r($dish_attr_row);
                                                        if ($website_close == 0) {
                                                            echo "<input type='radio' class='dish_radio' name='radio_" . $product_row['id'] . "' id='radio_" . $product_row['id'] . "' value='" . $dish_attr_row['id'] . "'>";
                                                        }
                                                        echo $dish_attr_row['attribute'];
                                                        echo "&nbsp;";
                                                        echo "<span class='price'>Rs." . $dish_attr_row['price'] . "</span>";
                                                        $added_msg = "";
                                                    }
                                                    /*if(array_key_exists($dish_attr_row['id'],$cartArr)){
                                                        $added_qty=getUserFullCart($dish_attr_row['id']);
                                                        $added_msg="(Added -$added_qty)";
                                                    }
                                                     echo " <span class='cart_already_added' id='shop_added_msg_".$dish_attr_row['id']."'>".$added_msg."<?span>";
                                                     echo "&nbsp;&nbsp;&nbsp;";*/
                                                    ?>
                                                </div>
                                                <?php if ($website_close == 0) { ?>
                                                    <div class="product-price-wrapper">
                                                        <select class="select" id="qty<?php echo $product_row['id'] ?>">
                                                            <option value="0">Qty</option>
                                                            <?php
                                                            for ($i = 1; $i <= 10; $i++) {
                                                                echo "<option>$i</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                        <i class="fa fa-cart-plus cart_icon" aria-hidden="true" onclick="add_to_cart('<?php echo $product_row['id'] ?>','add')"></i>
                                                    </div>
                                                <?php } else {
                                                ?>
                                                    <div class="product-price-wrapper">
                                                        <strong><?php echo $website_close_msg ?></strong>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } else {
                            echo "No dish found";
                        } ?>
                    </div>

                </div>
            </div>
            <?php
            $cat_res = mysqli_query($con, "select * from category where status=1 order by order_number desc")
            ?>
            <div class="col-lg-3">
                <div class="shop-sidebar-wrapper gray-bg-7 shop-sidebar-mrg">
                    <div class="shop-widget">
                        <h4 class="shop-sidebar-title">Categories</h4>
                        <div class="shop-catigory">
                            <ul id="faq" class="category_list">
                                <li><a href="<?php echo FRONT_SITE_PATH ?>home"><u>clear</u></a></li>
                                <?php
                                while ($cat_row = mysqli_fetch_assoc($cat_res)) {
                                    $class = "selected";
                                    if ($cat_id == $cat_row['id']) {
                                        $class = "active";
                                    }
                                    $is_checked = "";
                                    if (in_array($cat_row['id'], $cat_dish_arr)) {
                                        $is_checked = "checked='checked'";
                                    }
                                    echo "<li><input id='_cat_dish_{$cat_row['id']}' $is_checked onclick=set_checkbox('" . $cat_row['id'] . "') type='checkbox' class='cat_checkbox' name='cat_arr[]' value='" . $cat_row['id'] . "'/>" . $cat_row['category'] . "</li>";
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<form method="get" id="frmCatDish">
    <input type="hidden" name="cat_dish" id="cat_dish" value='<?php echo $cat_dish ?>'>
</form>

<?PHP
include("footer.php");
?>