<?php
/**
 * Template Name: Homepage
 */

//set queries
$gs_regions = $wpdb->get_results("SELECT id, region FROM gs_course_regions");
$gs_types = $wpdb->get_results("SELECT id, type FROM gs_course_types");
?>

<script>
// populate objects with php query results
var gs_reg = <?php echo json_encode($gs_regions); ?>;
var gs_type = <?php echo json_encode($gs_types); ?>;
 
// create options for query elements
function display_region_options(item) {
	for(k = 0; k < item.length; k++) {
		document.write('<option value="'+item[k]['id']+'">'+item[k]['region']+'</option>');
	}
}	
// create options for query elements
function display_type_options(item) {
	for(k = 0; k < item.length; k++) {
		document.write('<option value="'+item[k]['id']+'">'+item[k]['type']+'</option>');
	}
}
</script>

<?php get_header(); ?>

<style>
	#gs-search-form {
		width: 75%;
		margin-right: auto;
		margin-left: auto;
	}
	#gs-search-form-container {
		display: inline-block;
		width: 100%;
	}
	.gs-query-box {
		display: inline-block;
		width: 37%;
	}
	.gs-submit-box {
		display: inline-block;
		width: 25%;
	}
	#gs-search-button {
		border: 1px solid #0065bd; /* blue */
		background-color: #0065bd; /* blue */
		color: #fff;
		padding: 15px 30px;
		width: 100%;
	}

	@media only screen and (max-width: 360px) {
		
		#gs-search-form {
			width: 100%;
		}
		.gs-query-box, .gs-submit-box {
			display: block;
			width: 100%;
		}
		#gs-search-button {
			margin-top: 5px;
		}
	}
</style>
<div class="mh-layout">
    <?php
    while ( have_posts() ) : the_post();

        get_template_part( 'templates/content', 'page' );

        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;

    endwhile;
    ?>
</div>
<?php get_footer();
