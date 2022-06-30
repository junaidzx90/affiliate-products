<?php
get_header(  );

?>
<?php
$links = get_post_meta(get_the_ID(), 'affiliate_links', true);
$links = ((is_array($links)) ? array_values($links): []);
$minArr = array_column($links, 'current_price');
$minprice = ((sizeof($minArr) > 0) ? min($minArr): 0);
$ind = array_search($minprice, array_column($links, 'current_price'));
$lowest_link = $links[$ind];
?>
<div id="product_wrapper">
    <div class="product_head">
        <h1><?php echo the_title(  ) ?></h1>
    </div>

    <div class="product_container">
        <div class="product_view">
            <!-- Slider -->
            <div class="product_slider">
                <div id="slider_container">
                    <div class="slider_left">
                        <div id="slider">
                            <div class="slider_inner">
                                <?php
                                $gallleries = get_post_meta(get_post()->ID, 'product_galleries', true);
                                if(is_array($gallleries)){
                                    foreach($gallleries as $gallery){
                                        echo '<div class="carousel-item" data-url="'.wp_get_attachment_image_url( intval($gallery), 'thumbnail' ).'" style="background-image: url('.wp_get_attachment_image_url( intval($gallery), 'large' ).')"></div>';
                                    }
                                }
                                ?>
                            </div>
                            
                            <div class="closeFullscreen"> <span>+</span> </div>
                            
                            <div class="zoom_wrapper zoom">
                                <div class="zoom_btn zoom">
                                    <svg class="zoom" xmlns="http://www.w3.org/2000/svg" style="width:28px;height:28px" viewBox="0 0 24 24"><path fill="currentColor" d="M13 10h-3v3h-2v-3h-3v-2h3v-3h2v3h3v2zm8.172 14l-7.387-7.387c-1.388.874-3.024 1.387-4.785 1.387-4.971 0-9-4.029-9-9s4.029-9 9-9 9 4.029 9 9c0 1.761-.514 3.398-1.387 4.785l7.387 7.387-2.828 2.828zm-12.172-8c3.859 0 7-3.14 7-7s-3.141-7-7-7-7 3.14-7 7 3.141 7 7 7z"></path></svg>
                                </div>
                            </div>
                            
                            <div class="slider_prev nextprevbtn">
                                <span class="icon-left-open"></span>
                            </div>
                            <div class="slider_next nextprevbtn">
                                <span class="icon-right-open"></span>
                            </div>
                        </div>

                        <div class="bottom_info">
                            <div class="afflink">
                                <div class="editor_rating">
                                    <p>Editor rating:</p>
                                    <?php
                                    $ratings = get_post_meta(get_the_ID(), 'product_rating', true);
                                    echo get_product_ratings($ratings);
                                    ?>
                                </div>
                                <del class="wdtd maxprice">$<?php echo $lowest_link['original_price'] ?></del>
                                <strong class="wdtd lowestprice">$<?php echo $lowest_link['current_price'] ?></strong>
                                <a target="_blank" href="<?php echo $lowest_link['affiliate_link'] ?>" class="wdtd affiliate_link">See it</a>
                            </div>
                        </div>

                    </div>
                    <div id="slider_list" class="slider_list">
                        <ul class="thumbnails"></ul>
                    </div>
                </div>
            </div>

            <!-- Contents -->
            <div class="product_content">
                <?php echo the_content(  ) ?>
            </div>
        </div>
        <div class="product_sidebar">
            <div class="sideWidget">
                <div class="wdhead">
                    <h3>Where to buy</h3>
                </div>
                <div class="wdlowest_price">
                    <p>Lowest price</p>
                    <strong>$<?php echo $minprice ?></strong>
                </div>

                <div class="afflinks">
                    <ul class="links">
                        <li class="cat_filter">
                            <div class="wdbutton_wrapper">
                                <button data-filter="menitem" class="product_filter_btn menfilter active">Men</button>
                                <button data-filter="womenitem" class="product_filter_btn womenfilter">Women</button>
                            </div>
                        </li>
                        <?php
                        $filterItems = [];
                        if(is_array($links)){
                            foreach($links as $link){
                                if($link['category'] === 'men'){
                                    $filterItems['men'][] = $link;
                                }
                                if($link['category'] === 'women'){
                                    $filterItems['women'][] = $link;
                                }
                            }
                        }

                        if(sizeof($filterItems) > 0){
                            $menItems = $filterItems['men'];
                            $womenItems = $filterItems['women'];
                            ?>
                            <div class="filterbox menitem active">
                                <?php
                                foreach($menItems as $mitem){
                                    ?>
                                    <li class="afflink">
                                        <a class="wdtd link_logo" target="_blank" href="<?php echo $mitem['affiliate_link'] ?>"><img width="100px" src="<?php echo $mitem['logo'] ?>"></a>
                                        <del class="wdtd maxprice">$<?php echo $mitem['original_price'] ?></del>
                                        <strong class="wdtd lowestprice">$<?php echo $mitem['current_price'] ?></strong>
                                        <a target="_blank" href="<?php echo $mitem['affiliate_link'] ?>" class="wdtd affiliate_link">See it</a>
                                    </li>
                                    <?php
                                }
                                ?>
                            </div>
                            <?php
                            ?>
                            <div class="filterbox womenitem">
                                <?php
                                foreach($womenItems as $witem){
                                    ?>
                                   <li class="afflink">
                                        <a class="wdtd link_logo" target="_blank" href="<?php echo $witem['affiliate_link'] ?>"><img width="100px" src="<?php echo $witem['logo'] ?>"></a>
                                        <del class="wdtd maxprice">$<?php echo $witem['original_price'] ?></del>
                                        <strong class="wdtd lowestprice">$<?php echo $witem['current_price'] ?></strong>
                                        <a target="_blank" href="<?php echo $witem['affiliate_link'] ?>" class="wdtd affiliate_link">See it</a>
                                    </li>
                                    <?php
                                }
                                ?>
                            </div>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer(  );
?>