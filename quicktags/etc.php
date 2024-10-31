<?php


defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


if ( ! function_exists ( 'oxsn_list_pages_by_taxonomy_quicktags' ) ) {

	add_action( 'admin_print_footer_scripts', 'oxsn_list_pages_by_taxonomy_quicktags' );
	function oxsn_list_pages_by_taxonomy_quicktags() {

		if ( wp_script_is( 'quicktags' ) ) {

		?>

			<script type="text/javascript">
				QTags.addButton( 'oxsn_list_pages_by_taxonomy_quicktag', '[oxsn_list_pages_by_taxonomy]', '[oxsn_list_pages_by_taxonomy post_type="page" taxonomy_type="category" taxonomy_id="" class=""]', '[/oxsn_list_pages_by_taxonomy]', 'oxsn_list_pages_by_taxonomy', 'List Pages By Taxonomy', 201 );
			</script>

		<?php

		}

	}

}


?>