<?php
add_action('wp_ajax_nopriv_ajax_load_more', 'ajax_load_more');
add_action('wp_ajax_ajax_load_more', 'ajax_load_more');

if (!function_exists('ajax_load_more')) {
  function ajax_load_more() {
    $args = json_decode( stripslashes( $_POST['query'] ), true );
  	$args['paged'] = $_POST['page'] + 1;
  	$args['post_status'] = 'publish';

  	query_posts( $args );

  	if( have_posts() ) :
  		while( have_posts() ): the_post();
        get_template_part('template-parts/content');
  		endwhile;

  	endif;
  	die;
  }
}

?>