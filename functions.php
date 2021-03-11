<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'ciccarone-style', get_stylesheet_directory_uri() . '/style.css' );
}

function company_name() {
  return 'Rise Capital Funding';
}
add_shortcode('company_name', 'company_name');


function nv_page_title_breadcrumb() {
    global $data, $post;

    if( is_page() && !is_front_page() && !is_singular('creativo_portfolio') && get_post_meta($post->ID, 'pyre_page_title', true)!='hide' && $data['tb_pages_ds'] != '1'): ?>
    <?php
      $featured_image = get_the_post_thumbnail_url();
    ?>
        <?php if ($featured_image): ?>
          <div id="page-title" class="page-title__bg" style="background-image: url('<?php echo $featured_image ?>')">
        <?php else: ?>
          <div id="page-title">
        <?php endif; ?>


            <div class="page_title_inner">

                <div class="container clearfix">

                    <h2><?php the_title(); ?></h2>

                    <?php
                    if($data['en_breadcrumb']){
                        nimva_breadcrumb();
                    }
                    ?>

                    <?php if ($data['title_breadcrumb_right_side'] != 'Leave Empty'): ?>
                        <div class="searchtop-meta">
                            <?php
                            if($data['title_breadcrumb_right_side'] == 'Social Links') get_template_part('functions/template/social-links');
                            elseif($data['title_breadcrumb_right_side'] == 'Search Box') get_search_form();
                            else get_template_part('functions/template/contact-info');
                            ?>
                        </div>
                    <?php endif; ?>

                </div>

            </div>

        </div>

    <?php endif;

    $spb = false;
    if(class_exists('Woocommerce') && is_product() ) $spb = true;

    if ( is_singular('post') && get_post_meta($post->ID, 'pyre_page_title', true)!='hide' && $data['tb_posts_ds'] != '1') :
        ?>
        <div id="page-title">
            <div class="page_title_inner ">
                <div class="container clearfix">
                    <h2><?php the_title(); ?></h2>
                    <?php
                    if($data['en_breadcrumb']){
                        nimva_breadcrumb();
                    }
                    ?>
                    <?php if($data['blog_pn_nav']) { ?>
                        <div id="portfolio-navigation" class="clearfix">
                            <div class="port-nav-next">
                                <?php next_post_link('%link', '<i class="fa fa-angle-left"></i>'); ?>
                            </div>
                            <div class="port-nav-prev">
                                <?php previous_post_link('%link', '<i class="fa fa-angle-right"></i>'); ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php
    endif;

    if ( (is_single() || is_singular('creativo_portfolio') ) && !is_singular('post') && get_post_meta($post->ID, 'pyre_page_title', true)!='hide' && !$spb ) :
        ?>
        <div id="page-title">
            <div class="page_title_inner">
                <div class="container clearfix">
                    <h2><?php the_title(); ?></h2>
                    <?php
                    if($data['en_breadcrumb']){
                        nimva_breadcrumb();
                    }
                    ?>
                    <?php if($data['blog_pn_nav']) { ?>
                        <div id="portfolio-navigation" class="clearfix">
                            <div class="port-nav-next">
                                <?php next_post_link('%link', '<i class="fa fa-angle-left"></i>'); ?>
                            </div>
                            <div class="port-nav-prev">
                                <?php previous_post_link('%link', '<i class="fa fa-angle-right"></i>'); ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php
    endif;

    if( ( class_exists( 'Woocommerce' ) && is_woocommerce()  ) || ( is_tax( 'product_cat' ) ||  is_tax( 'product_tag' ) ) ) {
    ?>
        <div id="page-title">

            <div class="page_title_inner">

                <div class="container clearfix">

                    <h2>
                        <?php
                        if(!is_product()) woocommerce_page_title(true);
                        //else the_title();
                        ?>
                    </h2>
                    <?php
                    woocommerce_breadcrumb(array(
                        'wrap_before' => '<ul class="breadcrumbs">',
                        'wrap_after' => '</ul>',
                        'before' => '<li>',
                        'after' => '</li>',
                        'delimiter' => '',
                        'home'        => _x( '<i class="fa fa-home"></i>', 'breadcrumb', 'woocommerce' ),
                    ));
                    ?>

                    <?php if ($data['title_breadcrumb_right_side'] != 'Leave Empty'): ?>
                        <?php if( !is_product() ): ?>
                            <div class="searchtop-meta">
                                <?php
                                if($data['title_breadcrumb_right_side'] == 'Social Links') get_template_part('functions/template/social-links');
                                elseif($data['title_breadcrumb_right_side'] == 'Search Box') get_product_search_form();
                                else get_template_part('functions/template/contact-info');
                                ?>
                            </div>
                         <?php else: ?>
                            <div id="portfolio-navigation" class="clearfix">
                                <div class="port-nav-next">
                                    <?php next_post_link('%link', '<i class="fa fa-angle-left"></i>'); ?>
                                </div>
                                <div class="port-nav-prev">
                                    <?php previous_post_link('%link', '<i class="fa fa-angle-right"></i>'); ?>
                                </div>
                            </div>
                         <?php endif; ?>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    <?php
    }

    if(is_archive() && ( class_exists( 'Woocommerce' ) && !is_woocommerce() ) &&  !get_query_var('portfolio_category') && !get_query_var('faq_category')) {

    ?>
        <div id="page-title">
            <div class="page_title_inner">
                <div class="container clearfix">
                    <h2>
                        <?php if ( is_day() ) : ?>
                            <?php printf( __( 'Daily Archives: %s', 'twentyeleven' ), '<span>' . get_the_date() . '</span>' ); ?>
                        <?php elseif ( is_month() ) : ?>
                            <?php printf( __( 'Monthly Archives: %s', 'twentyeleven' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'twentyeleven' ) ) . '</span>' ); ?>
                        <?php elseif ( is_year() ) : ?>
                            <?php printf( __( 'Yearly Archives: %s', 'twentyeleven' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'twentyeleven' ) ) . '</span>' ); ?>
                        <?php elseif ( is_author() ) : ?>
                            <?php
                            if(have_posts() ) {
                                the_post();
                                ?>
                                <?php _e('Posts by: ','Nimva'); echo get_the_author(); ?>
                                <?php
                                rewind_posts();
                            }
                            ?>
                        <?php elseif ( is_tag() ) : ?>
                                <?php _e('Tags: ', 'Nimva'); single_cat_title(); ?>
                        <?php else : ?>
                            <?php _e('Category: ', 'Nimva'); single_cat_title(); ?>
                        <?php endif; ?>
                    </h2>
                    <?php
                    if($data['en_breadcrumb']){
                        nimva_breadcrumb();
                    }
                    ?>

                    <?php if ($data['title_breadcrumb_right_side'] != 'Leave Empty'): ?>
                        <div class="searchtop-meta">
                            <?php
                            if($data['title_breadcrumb_right_side'] == 'Social Links') get_template_part('functions/template/social-links');
                            elseif($data['title_breadcrumb_right_side'] == 'Search Box') get_search_form();
                            else get_template_part('functions/template/contact-info');
                            ?>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    <?php
    }

    if ( is_search() && ( class_exists( 'Woocommerce' ) && !is_woocommerce() ) ) {
    ?>
        <div id="page-title">
            <div class="page_title_inner">
                <div class="container clearfix">
                    <h2><?php echo _e('Search results for:', 'Nimva'); ?> <?php echo get_search_query(); ?></h2>
                    <?php
                    if($data['en_breadcrumb']){
                        nimva_breadcrumb();
                    }
                    ?>

                    <?php if ($data['title_breadcrumb_right_side'] != 'Leave Empty'): ?>
                        <div class="searchtop-meta">
                            <?php
                            if($data['title_breadcrumb_right_side'] == 'Social Links') get_template_part('functions/template/social-links');
                            elseif($data['title_breadcrumb_right_side'] == 'Search Box') get_search_form();
                            else get_template_part('functions/template/contact-info');
                            ?>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>

    <?php
    }

    if(get_query_var('portfolio_category') || get_query_var('faq_category')){
    ?>
        <div id="page-title">
            <div class="page_title_inner">
                <div class="container clearfix">
                    <h2><?php single_cat_title(); ?></h2>
                    <?php
                    if($data['en_breadcrumb']){
                        nimva_breadcrumb();
                    }
                    ?>
                    <?php if ($data['title_breadcrumb_right_side'] != 'Leave Empty'): ?>
                        <div class="searchtop-meta">
                            <?php
                            if($data['title_breadcrumb_right_side'] == 'Social Links') get_template_part('functions/template/social-links');
                            elseif($data['title_breadcrumb_right_side'] == 'Search Box') get_search_form();
                            else get_template_part('functions/template/contact-info');
                            ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php
    }

}


function pull_cards( $atts = [], $tag = '' ) {
  $atts = array_change_key_case( (array) $atts, CASE_LOWER );

  $wporg_atts = shortcode_atts(
      array(
          'category_id' => '102',
      ), $atts, $tag
  );


  // 102
  $args = array(
      'post_type'         =>  'page',
      'cat'          =>  $atts['category_id'],
      'posts_per_page'    =>  -1
  );

  $cards = new WP_Query($args);
  $ret = '';
  if ( $cards->have_posts() ) {
    $ret .= '<div class="fmtg-cards">';
    while ( $cards->have_posts() ) {
      $cards->the_post();
      $ret .= '<a class="fmtg-cards__item" href="'.get_the_permalink().'">';
        $ret .= '<div class="fmtg-cards__frame" style="background-image: url('.get_the_post_thumbnail_url().')">';
          $ret .= '<h2>'.get_the_title().'</h2>';
        $ret .= '</div>';
      $ret .= '</a>';
    }
    $ret .= '</div>';
  }
  return $ret;
}
add_shortcode('pull_cards', 'pull_cards');
