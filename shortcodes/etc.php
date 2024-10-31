<?php


defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


//[oxsn_list_pages_by_taxonomy post_type="" taxonomy_type="" taxonomy_id="" exclude="" exclude_tree="" class=""]
if ( ! function_exists ( 'oxsn_list_pages_by_taxonomy_shortcode' ) ) {

	add_shortcode('oxsn_list_pages_by_taxonomy', 'oxsn_list_pages_by_taxonomy_shortcode');
	function oxsn_list_pages_by_taxonomy_shortcode( $atts, $content = null ) {
		$content = shortcode_unautop(trim($content));
		$a = shortcode_atts( array(
			'class' => '',
			'post_type' => 'page',
			'taxonomy_type' => '',
			'taxonomy_id' => '',
			'exclude' => '',
			'exclude_tree' => '',
		), $atts );

		$list_pages_by_taxonomy_class = esc_attr($a['class']);

		$list_pages_by_taxonomy_taxonomy_type = esc_attr($a['taxonomy_type']);
		$list_pages_by_taxonomy_taxonomy_type = strtolower($list_pages_by_taxonomy_taxonomy_type);

		$list_pages_by_taxonomy_taxonomy_id = esc_attr($a['taxonomy_id']);
		$list_pages_by_taxonomy_taxonomy_id = strtolower($list_pages_by_taxonomy_taxonomy_id);

		$list_pages_by_taxonomy_exclude = esc_attr($a['exclude']);
		$list_pages_by_taxonomy_exclude = strtolower($list_pages_by_taxonomy_exclude);

		$list_pages_by_taxonomy_exclude_tree = esc_attr($a['exclude_tree']);
		$list_pages_by_taxonomy_exclude_tree = strtolower($list_pages_by_taxonomy_exclude_tree);

		$list_pages_by_taxonomy_post_type = esc_attr($a['post_type']);
		$list_pages_by_taxonomy_post_type = strtolower($list_pages_by_taxonomy_post_type);
		
		$args = array(
			'posts_per_page' => -1,
			'post_type' => $list_pages_by_taxonomy_post_type,
			'orderby'    => 'menu_order',
			'hide_empty' => 0,
			'exclude' => $list_pages_by_taxonomy_exclude,
			'exclude_tree' => $list_pages_by_taxonomy_exclude_tree,
			'tax_query' => array(
				array(
					'taxonomy' => $list_pages_by_taxonomy_taxonomy_type,
					'field'    => 'term_id',
					'terms'    => $list_pages_by_taxonomy_taxonomy_id,
				),
			),
		);
		$query = new WP_Query( $args );

		$taxonomy_slug = get_term( $list_pages_by_taxonomy_taxonomy_id, $taxonomy );
		$taxonomy_name = $taxonomy_slug->name;

		$currentPage = get_the_ID();

		$output .=
		'<h4 class="oxsn_list_pages_by_taxonomy_title">' . $taxonomy_name . '</h4>' .
		'<ul class="oxsn_list_pages_by_taxonomy ' . $list_pages_by_taxonomy_class . '">';

		while ( $query->have_posts() ) : $query->the_post();

			$listedID = get_the_ID();

			if ( $currentPage == $listedID ) : 
				$currentClass = 'current_page_item';
			else :
				$currentClass = '';
			endif; 

			$output .=
			'<li class="' . $currentClass . '" id="post-' . get_the_ID() . '">' .
				'<a href="' .  get_permalink() .  '">' . get_the_title() .'</a>' .
			'</li>';

		endwhile;

		$output .= 
		'</ul>';

		wp_reset_postdata();

		return $output;

	}

}


?>