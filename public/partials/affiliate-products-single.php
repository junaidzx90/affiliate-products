<?php
function get_product_content(){
    $links = get_post_meta(get_the_ID(), 'affiliate_links', true);
    $links = ((is_array($links)) ? array_values($links): []);
    $minArr = array_column($links, 'current_price');
    $minprice = ((sizeof($minArr) > 0) ? min($minArr): 0);
    $ind = array_search($minprice, array_column($links, 'current_price'));
    $lowest_link = [];
    if($ind){
        $lowest_link = $links[$ind];
    }
    

    $gallleries = get_post_meta(get_post()->ID, 'product_galleries', true);
    $htmlOutput = '';

    $htmlOutput .= '<div id="product_wrapper">';
    $htmlOutput .= '<div class="product_head">';
    $htmlOutput .= '<h1>'.get_the_title(  ).'</h1>';
    $htmlOutput .= '</div>';

    $htmlOutput .= '<div class="product_container">';
    $htmlOutput .= '<div class="product_view">';

    if($gallleries){
        $htmlOutput .= '<div class="product_slider">';
        $htmlOutput .= '<div id="slider_container">';
        $htmlOutput .= '<div class="slider_left">';
        $htmlOutput .= '<div id="slider">';
        $htmlOutput .= '<div class="slider_inner">';
        if(is_array($gallleries)){
            foreach($gallleries as $gallery){
                $htmlOutput .= '<div class="carousel-item" data-url="'.wp_get_attachment_image_url( intval($gallery), 'thumbnail' ).'" style="background-image: url('.wp_get_attachment_image_url( intval($gallery), 'large' ).')"></div>';
            }
        }
        $htmlOutput .= '</div>';

        $htmlOutput .= '<div class="closeFullscreen"> <span>+</span> </div>';
                                    
        $htmlOutput .= '<div class="zoom_wrapper zoom">';
        $htmlOutput .= '<div class="zoom_btn zoom">';
        $htmlOutput .= '<svg class="zoom" xmlns="http://www.w3.org/2000/svg" style="width:28px;height:28px" viewBox="0 0 24 24"><path fill="currentColor" d="M13 10h-3v3h-2v-3h-3v-2h3v-3h2v3h3v2zm8.172 14l-7.387-7.387c-1.388.874-3.024 1.387-4.785 1.387-4.971 0-9-4.029-9-9s4.029-9 9-9 9 4.029 9 9c0 1.761-.514 3.398-1.387 4.785l7.387 7.387-2.828 2.828zm-12.172-8c3.859 0 7-3.14 7-7s-3.141-7-7-7-7 3.14-7 7 3.141 7 7 7z"></path></svg>';
        $htmlOutput .= '</div>';
        $htmlOutput .= '</div>';
                    
        $htmlOutput .= '<div class="slider_prev nextprevbtn">';
        $htmlOutput .= '<span class="icon-left-open"></span>';
        $htmlOutput .= '</div>';
        $htmlOutput .= '<div class="slider_next nextprevbtn">';
        $htmlOutput .= '<span class="icon-right-open"></span>';
        $htmlOutput .= '</div>';
        $htmlOutput .= '</div>';

        $htmlOutput .= '<div class="bottom_info">';
        $htmlOutput .= '<div class="afflink">';
        $htmlOutput .= '<div class="editor_rating">';
        $htmlOutput .= '<p>Editor rating:</p>';
                        
        $ratings = get_post_meta(get_the_ID(), 'product_rating', true);
        $htmlOutput .= get_product_ratings($ratings);
                            
        $htmlOutput .= '</div>';
        $htmlOutput .= '<del class="wdtd maxprice">$'. ((array_key_exists('original_price', $lowest_link)) ? $lowest_link['original_price']: '').'</del>';
        $htmlOutput .= '<strong class="wdtd lowestprice">$'.((array_key_exists('current_price', $lowest_link)) ? $lowest_link['current_price']: '').'</strong>';
        $htmlOutput .= '<a target="_blank" href="'.((array_key_exists('affiliate_link', $lowest_link)) ? $lowest_link['affiliate_link']: '').'" class="wdtd affiliate_link">See it</a>';
        $htmlOutput .= '</div>';
        $htmlOutput .= '</div>';

        $htmlOutput .= '</div>';
        $htmlOutput .= '<div id="slider_list" class="slider_list">';
        $htmlOutput .= '<ul class="thumbnails"></ul>';
        $htmlOutput .= '</div>';
        $htmlOutput .= '</div>';
        $htmlOutput .= '</div>';
    }

    $htmlOutput .= '<div class="product_content">';
    $htmlOutput .= get_the_content(  );
    $htmlOutput .= '</div>';
    $htmlOutput .= '</div>';
    $htmlOutput .= '<div class="product_sidebar">';
    // Sidewidget
    $htmlOutput .= '<div class="sideWidget">';
    $htmlOutput .= '<div class="wdhead">';
    $htmlOutput .= '<h3>Where to buy</h3>';
    $htmlOutput .= '</div>';
    $htmlOutput .= '<div class="wdlowest_price">';
    $htmlOutput .= '<p>Lowest price</p>';
    $htmlOutput .= '<strong>$'.$minprice.'</strong>';
    $htmlOutput .= '</div>';

    $htmlOutput .= '<div class="afflinks">';
    $htmlOutput .= '<ul class="links">';
    $htmlOutput .= '<li class="cat_filter">';
    $htmlOutput .= '<div class="wdbutton_wrapper">';
    $htmlOutput .= '<button data-filter="menitem" class="product_filter_btn menfilter active">Men</button>';
    $htmlOutput .= '<button data-filter="womenitem" class="product_filter_btn womenfilter">Women</button>';
    $htmlOutput .= '</div>';
    $htmlOutput .= '</li>';

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
        
        $htmlOutput .= '<div class="filterbox menitem active">';
        foreach($menItems as $mitem){
            $htmlOutput .= '<li class="afflink">';
            $htmlOutput .= '<a class="wdtd link_logo" target="_blank" href="'.$mitem['affiliate_link'].'"><img width="100px" src="'.$mitem['logo'].'"></a>';
            $htmlOutput .= '<del class="wdtd maxprice">$'.$mitem['original_price'].'</del>';
            $htmlOutput .= '<strong class="wdtd lowestprice">$'.$mitem['current_price'].'</strong>';
            $htmlOutput .= '<a target="_blank" href="'.$mitem['affiliate_link'].'" class="wdtd affiliate_link">See it</a>';
            $htmlOutput .= '</li>';
        }
        $htmlOutput .= '</div>';
        $htmlOutput .= '<div class="filterbox womenitem">';
        foreach($womenItems as $witem){
            $htmlOutput .= '<li class="afflink">';
            $htmlOutput .= '<a class="wdtd link_logo" target="_blank" href="'.$witem['affiliate_link'].'"><img width="100px" src="'.$witem['logo'].'"></a>';
            $htmlOutput .= '<del class="wdtd maxprice">$'.$witem['original_price'].'</del>';
            $htmlOutput .= '<strong class="wdtd lowestprice">$'.$witem['current_price'].'</strong>';
            $htmlOutput .= '<a target="_blank" href="'.$witem['affiliate_link'].'" class="wdtd affiliate_link">See it</a>';
            $htmlOutput .= '</li>';
        }
        $htmlOutput .= '</div>';
    }
    $htmlOutput .= '</ul>';
    $htmlOutput .= '</div>';
    $htmlOutput .= '</div>';

    // Category
    $htmlOutput .= '<div class="ap_categories">';
    $htmlOutput .= 'Categories: ';
    $htmlOutput .= get_the_term_list( get_the_ID(), 'product_apcat', "", ',', "" );
    $htmlOutput .= '</div>';

    $htmlOutput .= '</div>';
    $htmlOutput .= '</div>';
    $htmlOutput .= '</div>';

    return $htmlOutput;
}