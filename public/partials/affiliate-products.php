<div id="product_wrapper">
    <ul class="aff_products_items">
        <?php
        $args = array(
            'post_type' => 'products',
            'post_status' => 'publish',
            'posts_per_page' => '-1',
            'order' => 'ASC',
            'orderby' => 'date'
        );
        
        $postslist = new WP_Query( $args );

        if ( $postslist->have_posts() ) :
            while ( $postslist->have_posts() ) : $postslist->the_post();
                ?>
                <li class="aff_product">
                    <div class="product_img">
                        <?php echo the_post_thumbnail( 'product_thumbnail' ) ?>
                    </div>
                    <div class="product_info">
                        <a href="<?php echo get_the_permalink(  ) ?>" class="product_title"><?php echo the_title(  ) ?></a>
                        <div class="reviews">
                            <?php
                            $ratings = get_post_meta(get_the_ID(), 'product_rating', true);
                            echo get_product_ratings($ratings);
                            ?>
                        </div>
                        <?php
                        $links = get_post_meta(get_the_ID(), 'affiliate_links', true);
                        $links = ((is_array($links)) ? array_values($links): []);
                        $minArr = array_column($links, 'current_price');
                        $minprice = ((sizeof($minArr) > 0) ? min($minArr): 0);
                        ?>
                        <p class="price">$<?php echo $minprice ?></p>

                        <a href="<?php echo get_the_permalink(  ) ?>" class="view_product">View product</a>
                    </div>
                </li>
                <?php
            endwhile;  
            wp_reset_postdata();
        endif;
    ?>
    </ul>
</div>