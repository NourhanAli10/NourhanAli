<?php
$title = "product_details";
include "structure/header.php";
include "structure/nav.php";
include "structure/breadcrumb.php";

use App\database\models\Product;

$productModel = new product;
$productModel->setId($_GET['id']);
$productResult = $productModel->getProduct();
if ($productResult->num_rows == 1) {
    $product = $productResult->fetch_object();
} else {
    header('location:error/404.php');
    die;
}

?>



<!-- Product Deatils Area Start -->
<div class="product-details pt-100 pb-95">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="product-details-img">

                    <img class="zoompro" src="assets/img/product/<?= $product->image ?>" data-zoom-image="assets/img/product/<?= $product->image ?>" alt="zoom" />


                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="product-details-content">
                    <h4><?= $product->name_en ?></h4>
                    <div class="rating-review">
                        <div class="pro-dec-rating">
                            <i class="ion-android-star-outline theme-star"></i>
                            <i class="ion-android-star-outline theme-star"></i>
                            <i class="ion-android-star-outline theme-star"></i>
                            <i class="ion-android-star-outline theme-star"></i>
                            <i class="ion-android-star-outline"></i>
                        </div>
                        <div class="pro-dec-review">
                            <ul>
                                <li>32 Reviews </li>
                                <li> Add Your Reviews</li>
                            </ul>
                        </div>
                    </div>
                    <span><?= $product->price ?> EGP </span>
                    <div class="in-stock">

                        <?php if ($product->quantity ==  0) {


                            $message = "<p class=' text-danger ' role='alert ' >Out of stock</p>";
                        } elseif ($product->quantity > 0 && $product->quantity <=  5) {

                            $message = "<p class=' text-warning ' role='alert ' >In stock ({$product->quantity}) left</p>";
                        } else {

                            $message = "<p class=' text-success ' role='alert ' >In stock </p>";
                        }


                        ?>
                        <p>Available: <span><?= $message ?> </span></p>
                    </div>
                    <p>Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. </p>
                    <div class="pro-dec-feature">
                        <ul>
                            <li><input type="checkbox"> Protection Plan: <span> 2 year $4.99</span></li>
                            <li><input type="checkbox"> Remote Holder: <span> $9.99</span></li>
                            <li><input type="checkbox"> Koral Alexa Voice Remote Case: <span> Red $16.99</span></li>
                            <li><input type="checkbox"> Amazon Basics HD Antenna: <span>25 Mile $14.99</span></li>
                        </ul>
                    </div>
                    <div class="quality-add-to-cart">
                        <?php if ($product->quantity != 0) { ?>
                            <div class="quality">
                                <span>Qty:</span>
                                <select class="form-control">
                                <?php for ($counter = 1; $counter <= $product->quantity; $counter++) {
                                    echo "<option value='{$counter}'>{$counter}</option>";
                                }
                            } ?>
                                </select>
                            </div>
                            <div class="shop-list-cart-wishlist">
                                <?php if ($product->quantity != 0) { ?>
                                    <a title="Add To Cart" href="#">
                                        <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                                    </a>
                                <?php } ?>
                                <a title="Wishlist" href="#">
                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                </a>
                            </div>
                    </div>
                    <div class="pro-dec-categories">
                        <ul>
                            <li class="categories-title">Categories:</li>
                            <li><a href="shop.php?category=<?= $product->category_id ?>"><?= $product->category_name_en ?>,</a>
                            </li>
                            <li><a href="shop.php?subcategory=<?= $product->subcategory_id ?>"><?= $product->subcategory_name_en ?>,</a>
                            </li>
                            <li><a href="shop.php?brand=<?= $product->brand_id ?>"><?= $product->brand_name_en ?></a>
                            </li>
                        </ul>
                    </div>
                    <div class="pro-dec-social">
                        <ul>
                            <li><a class="tweet" href="#"><i class="ion-social-twitter"></i> Tweet</a></li>
                            <li><a class="share" href="#"><i class="ion-social-facebook"></i> Share</a></li>
                            <li><a class="google" href="#"><i class="ion-social-googleplus-outline"></i> Google+</a></li>
                            <li><a class="pinterest" href="#"><i class="ion-social-pinterest"></i> Pinterest</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Product Deatils Area End -->
<div class="description-review-area pb-70">
    <div class="container">
        <div class="description-review-wrapper">
            <div class="description-review-topbar nav text-center">
                <a class="active" data-toggle="tab" href="#des-details1">Description</a>

                <a data-toggle="tab" href="#des-details3">Review</a>
            </div>
            <div class="tab-content description-review-bottom">
                <div id="des-details1" class="tab-pane active">
                    <div class="product-description-wrapper">
                        <p><?= $product->details_en ?> </p>

                    </div>
                </div>

                <div id="des-details3" class="tab-pane">
                    <div class="rattings-wrapper">
                        <!-- loop -->
                        <?php
                        $reviewsResult =  $productModel->getReviews();
                        if ($reviewsResult->num_rows >= 1) {
                            foreach ($reviewsResult->fetch_all(MYSQLI_ASSOC) as $review) {
                        ?>
                                <div class="sin-rattings">
                                    <div class="star-author-all">
                                        <div class="ratting-star f-left">
                                            <?php for ($counter = 1; $counter <= $review['rate']; $counter++) { ?>
                                                <i class="ion-star theme-color"></i>
                                            <?php } ?>
                                            <?php for ($counter = 1; $counter <= 5 - $review['rate']; $counter++) { ?>
                                                <i class="ion-android-star-outline"></i>
                                            <?php } ?>
                                            <span>(<?= $review['rate'] ?>)</span>
                                        </div>
                                        <div class="ratting-author f-right">
                                            <h3><?= $review['full_name'] ?></h3>
                                            <span><?= $review['created_at'] ?></span>
                                        </div>
                                    </div>
                                    <p> <?= $review['comment'] ?> </p>
                            <?php
                            }
                        } else {
                            echo "<div class='alert alert-warning text-center'> No reviews yet </div>";
                        }
                            ?>
                                </div>


                    </div>




                    <?php if (isset($_SESSION['user'])) { ?>
                        <div class="ratting-form-wrapper">
                            <h3>Add your Comments :</h3>
                            <div class="ratting-form">
                                <form method="POST">
                                    <div class="rating-stars">
                                        <input type="radio" name="rating" value="0" id="rs0" checked><label for="rs0"></label>
                                        <input type="radio" name="rating" value="1" id="rs1"><label for="rs1"></label>
                                        <input type="radio" name="rating" value="2" id="rs2"><label for="rs2"></label>
                                        <input type="radio" name="rating" value="3" id="rs3"><label for="rs3"></label>
                                        <input type="radio" name="rating" value="4" id="rs4"><label for="rs4"></label>
                                        <input type="radio" name="rating" value="5" id="rs5"><label for="rs5"></label>
                                        <!-- <span class="rating-counter"></span> -->
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="rating-form-style form-submit">
                                                <textarea name="comment" placeholder="Comment"></textarea>

                                                <div>
                                                    <button type="submit" class="btn btn-success mt-2"> Add review</button>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<style>
    .rating-stars {
        display: block;
        /* width: 50vmin; */
        /* padding: 1.75vmin 10vmin 2vmin 3vmin; */
        background: linear-gradient(90deg, #ffffff90 40vmin, #fff0 40vmin 100%);
        border-radius: 5vmin;
        position: relative;
        width: 40%;
        margin: auto;
    }

    /* .rating-counter {
	font-size: 5.5vmin;
    font-family: Arial, Helvetica, serif;
    color: #9aacc6;
    width: 10vmin;
    text-align: center;
    background: #0006;
    position: absolute;
    top: 0;
    right: 0;
    height: 100%;
    border-radius: 0 5vmin 5vmin 0;
    line-height: 10vmin;
}

.rating-counter:before {
	content: "0";
	transition: all 0.25s ease 0s;	
} */



    input {
        display: none;
    }

    label {
        width: 5vmin;
        height: 5vmin;
        background: #000b;
        display: inline-flex;
        cursor: pointer;
        margin: 0.5vmin 0.65vmin;
        transition: all 1s ease 0s;
        clip-path: polygon(50% 0%, 66% 32%, 100% 38%, 78% 64%, 83% 100%, 50% 83%, 17% 100%, 22% 64%, 0 38%, 34% 32%);
        width: 45px;
        height: 40px
    }

    label[for=rs0] {
        display: none;
    }

    label:before {
        width: 90%;
        height: 90%;
        content: "";
        background: orange;
        z-index: -1;
        display: block;
        margin-left: 5%;
        margin-top: 5%;
        clip-path: polygon(50% 0%, 66% 32%, 100% 38%, 78% 64%, 83% 100%, 50% 83%, 17% 100%, 22% 64%, 0 38%, 34% 32%);
        background: linear-gradient(90deg, yellow, orange 30% 50%, #184580 50%, 70%, #173a75 100%);
        background-size: 205% 100%;
        background-position: 0 0;
    }

    label:hover:before {
        transition: all 0.25s ease 0s;
    }

    input:checked+label~label:before {
        background-position: 100% 0;
        transition: all 0.25s ease 0s;
    }

    input:checked+label~label:hover:before {
        background-position: 0% 0
    }





    #rs1:checked~.rating-counter:before {
        content: "1";
    }

    #rs2:checked~.rating-counter:before {
        content: "2";
    }

    #rs3:checked~.rating-counter:before {
        content: "3";
    }

    #rs4:checked~.rating-counter:before {
        content: "4";
    }

    #rs5:checked~.rating-counter:before {
        content: "5";
    }

    label+input:checked~.rating-counter:before {
        color: #ffab00 !important;
        transition: all 0.25s ease 0s;
    }





    label:hover~.rating-counter:before {
        color: #9aacc6 !important;
        transition: all 0.5s ease 0s;
        animation: pulse 1s ease 0s infinite;
    }

    @keyframes pulse {
        50% {
            font-size: 6.25vmin;
        }
    }

    label[for=rs1]:hover~.rating-counter:before {
        content: "1" !important;
    }

    label[for=rs2]:hover~.rating-counter:before {
        content: "2" !important;
    }

    label[for=rs3]:hover~.rating-counter:before {
        content: "3" !important;
    }

    label[for=rs4]:hover~.rating-counter:before {
        content: "4" !important;
    }

    label[for=rs5]:hover~.rating-counter:before {
        content: "5" !important;
    }


    input:checked:hover~.rating-counter:before {
        animation: none !important;
        color: #ffab00 !important;
    }
</style>

<?php
include "structure/footer.php";
include "structure/scripts.php";
?>