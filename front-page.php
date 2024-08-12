<?php
get_header();
?>
<div id="primary" class="site-main pt-3">
    <div class="container">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <!-- <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            </div> -->
            <div class="carousel-inner rounded-3">
                <div class="carousel-item active">
                    <img src="<?php echo get_template_directory_uri() . '/images/slide-1.jpg'; ?>" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="<?php echo get_template_directory_uri() . '/images/slide-2.jpg'; ?>" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</div>

<!-- section popular product -->
<section class="container pt4">
    <div class="product__row-heading text-center">
        <h2>Popular Products</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
    </div>

    <div class="product__row-content">
        <?php echo do_shortcode('[products limit="4" columns="4"]') ?>
    </div>
</section>

<!-- section category product -->
<section class="container pt4">
    <div class="product__row-heading text-center">
        <h2>Categories</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
    </div>

    <div class="category__col">
        <div class="row">
            <div class="col-md-4 col-12 p-3"> 
                <div href="#" class="category__col-content position-relative">
                    <a href="">
                        <img class="w-100 rounded-3" src="<?php echo get_theme_file_uri( ) . '/images/toys.jpg' ?>" alt="">
                        <h2 class="position-absolute w-100 start=0 bottom-0 text-center text-white bg-primary-opacity-8 mb-0 pt-2 pb-2 border-25">Toys</h2>
                    </a>
                </div>
            </div>
            <div class="col-md-4 col-12 p-3">
                <div href="#" class="category__col-content position-relative">
                    <a href="">
                        <img class="w-100 rounded-3" src="<?php echo get_theme_file_uri( ) . '/images/food.jpg' ?>" alt="">
                        <h2 class="position-absolute w-100 start=0 bottom-0 text-center text-white bg-primary-opacity-8 mb-0 pt-2 pb-2 border-25">Food</h2>
                    </a>
                </div>
            </div>
            <div class="col-md-4 col-12 p-3">
                <div href="#" class="category__col-content position-relative">
                    <a href="">
                        <img class="w-100 rounded-3" src="<?php echo get_theme_file_uri( ) . '/images/care.jpg' ?>" alt="">
                        <h2 class="position-absolute w-100 start=0 bottom-0 text-center text-white bg-primary-opacity-8 mb-0 pt-2 pb-2 border-25">Care</h2>
                    </a>
                </div>
            </div>
        </div>
        <div class="row pt-4">
            <div class="col-md-4 col-12 p-3"> 
                <div href="#" class="category__col-content position-relative">
                    <a href="">
                        <img class="w-100 rounded-3" src="<?php echo get_theme_file_uri( ) . '/images/accessories.jpg' ?>" alt="">
                        <h2 class="position-absolute w-100 start=0 bottom-0 text-center text-white bg-primary-opacity-8 mb-0 pt-2 pb-2 border-25">Accessories</h2>
                    </a>
                </div>
            </div>
            <div class="col-md-8 col-12 p-3">
                <div href="#" class="category__col-content position-relative">
                    <a href="">
                        <img class="w-100 rounded-3" src="<?php echo get_theme_file_uri( ) . '/images/special-offers.jpg' ?>" alt="">
                        <h2 class="position-absolute w-100 start=0 bottom-0 text-center text-white bg-primary-opacity-8 mb-0 pt-2 pb-2 border-25">Special Offers</h2>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- special offers -->
<section class="container pt4">
    <div class="product__row-heading text-center">
        <h2>Special offers</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
    </div>

    <div class="product__row-content">
        <?php echo do_shortcode('[products limit="4" columns="4"]') ?>
    </div>
</section>
<?php
get_footer();
?>