<?php get_header(); ?>

<?php
if(get_post_meta($post->ID, 'pyre_slider_layer', true) != 0) {
?>
    <div id="slider-output">
    	<?php echo do_shortcode('[layerslider id="'.get_post_meta($post->ID, 'pyre_slider_layer', true).'"]'); ?>
    </div>
<?php
}
?>
            <div class="content-wrap">
                <div class="container clearfix">
                <?php
					if(get_post_meta($post->ID, 'pyre_en_sidebar', true) == 'yes'){
						$class = 'postcontent half_sidebar clearfix';

						if(get_post_meta($post->ID, 'pyre_sidebar_pos', true) == 'left' && $data['sidebar_position'] != 'Left') {
							$content_css = 'style="margin-right: 0; float: right; margin-left: 30px;"';
							$sidebar_css = 'style="float: left; clear: left;"';
						}
						elseif(get_post_meta($post->ID, 'pyre_sidebar_pos', true) == 'right' && $data['sidebar_position'] != 'Right') {
							$content_css = 'style="margin-left: 0; float: left; margin-right: 30px;"';
							$sidebar_css = 'style="float: right; clear: right;"';
						}
						$sidebar = true;
					}
					else{
						$class = 'no_sidebar col_full';
						$sidebar = false;
						$content_css = '';
					}
				?>

                    <div class="<?php echo $class; ?> default_page nobottommargin" <?php echo $content_css; ?>>

                    	<div class="entry_title"><h2><?php the_title(); ?></h2></div>

                    <!-- ============================================
                        Page Content Start
                    ============================================= -->
                        <?php while(have_posts()): the_post(); ?>
                          <div class="content-image"><img src="<?php echo get_the_post_thumbnail_url() ?>" alt="" /></div>
                            <?php the_content(); ?>
            				<?php
                            wp_link_pages( array(
                                'before'      => '<div class="pagination_pages clearfix"><span class="page-links-title">' . __( 'Pages:', 'Nimva' ) . '</span>',
                                'after'       => '</div>',
                                'link_before' => '<span class="navigation">',
                                'link_after'  => '</span>',
                                ) );
                            ?>
                        <?php endwhile; ?>

                    <!-- ============================================
                        Page Content End
                    ============================================= -->
                		<?php
						if($data['default_comments']):
						?>
							<div id="comments" class="clearfix">
								<?php comments_template('', true); ?>
							</div>
						<?php
						endif;
						?>

                    </div>

                    <?php
					if($sidebar){
					?>
                        <div class="sidebar col_last nobottommargin clearfix" <?php echo $sidebar_css; ?>>

                            <div class="sidebar-widgets-wrap clearfix <?php echo ($data['sticky_sidebar'] == 1 ? 'theiaStickySidebar' : '' ); ?>">
                                <?php
                                if ( !function_exists( 'generated_dynamic_sidebar' ) || !generated_dynamic_sidebar() ):
                                endif;
                                ?>
                            </div>

                        </div>
                    <?php
					}
					?>
                </div>

            </div>

<?php get_footer(); ?>
