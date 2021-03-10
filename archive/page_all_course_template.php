<?php
/**
 * Template Name: All Courses Page
 */
// create alterative content layout using the following functions
// +12 results and mobile
function plus12 ($gs_gsdsr, $url, $img_path) {
	echo <<<EOT
		<table id="gs-allCourse">
			<thead>
				<tr>
					<th colspan="2">COURSE</th>
					<th class="gs-switch">REGION</th>
					<th>TYPE</th>
					<th>LENGTH</th>
					<th class="center">PAR</th>
				</tr>
			</thead>
			<tbody>
EOT;
	foreach ($gs_gsdsr as $gsdsr) :
		$format_yrds = number_format($gsdsr->length) ;
		echo <<<EOT
				<tr>
					<td class="gs-link gs-img center">
						<a href="{$url}?courseID={$gsdsr->id}">
EOT;
		if($gsdsr->img_logo != null ) :
				echo '<img class="gs-imgLogo" src="'.$img_path.$gsdsr->img_logo.'" alt="course logo" />'.PHP_EOL;
		else :
				echo '<img class="gs-imgLogo" src="'.$img_path.'2020/05/gs-icon240-e1590336869748.png" alt="course logo" />'.PHP_EOL;
		endif;
		echo <<<EOT
						</a>
					</td>
					<td class="gs-link"><a href="{$url}?courseID={$gsdsr->id}">{$gsdsr->name}</a></td>
					<td class="gs-switch">{$gsdsr->region}</td>
					<td>{$gsdsr->type}</td>
					<td>{$format_yrds} yrds</td>
					<td class="center">{$gsdsr->par}</td>
				</tr>
EOT;
	endforeach;
	echo <<<EOT
			</tbody>
		</table>
EOT;
}

//12 results
function less_than12($gs_gsdsr, $url, $img_path) {
	echo <<<EOT
		<table id="gs-allCourse12">
			<tbody>
EOT;
	foreach ($gs_gsdsr as $gsdsr) :
		echo <<<EOT
				<tr><td class="gs-link gs-img"><a href{$url}?courseID=<{$gsdsr->id}">
					<img class="gs-imgLogo" src="{$img_path}{$gsdsr->img_logo}" alt="course logo" /></a></td></tr>
				<tr><td class="gs-link"><a href="{$url}?courseID={$gsdsr->id}">{$gsdsr->name}</a></td></tr>
				<tr><td class="gs-switch">{$gsdsr->region}</td></tr>
				<tr><td>{$gsdsr->type}</td></tr>
				<tr><td>{number_format($gsdsr->length)} yrds</td></tr>
				<tr><td class="center">{$gsdsr->par}</td></tr>
EOT;
	endforeach;
	echo <<<EOT
			</tbody>
		</table>
EOT;
}

// set data query gs_courses table - course details
$gs_query = 'SELECT c.id, c.name, c.address, cr.region, ct.type, c.length, c.par, c.description, c.wkday_rnd, c.wkday_day, c.wkend_rnd, c.wkend_day, c.special_offers, c.img_logo FROM gs_courses AS c INNER JOIN gs_course_types AS ct ON c.type = ct.id INNER JOIN gs_course_regions AS cr ON c.region = cr.id';

//
$nf_region_query = 'SELECT region FROM gs_course_regions WHERE id ='.$_GET['region'].'';
$nf_type_guery = 'SELECT type FROM gs_course_types WHERE id ='.$_GET['type'].'';

// if $_GET exists 
if(isset($_GET)) :
	$count = 1;
	// set $gs_search_query string
	foreach($_GET as $name => $value) :
	
		// change html characters to unicode equivilant
		$gs_search_query = htmlspecialchars($value);
		// makes sure nobody uses SQL injection
		$gs_search_query = esc_sql($gs_search_query);
	
		// edit query to display search query selections if not null, 
		// else display 'all'
		if($gs_search_query != null) {
			if($count > 1) {
				$gs_query .= ' AND c.'.$name.' = '.$gs_search_query;
			} else {
				$gs_query .= ' WHERE c.'.$name.' = '.$gs_search_query;
			}
			$count++;	
		}
	endforeach;
	
	$gs_query .= ' AND c.switch = false ORDER BY ';
	// group by region order name
	if($_GET['region'] == null) {
		$gs_query .= 'region, ';
	}
	$gs_query .= 'name ASC';
	// echo $gs_query;
	$gs_gsdsr = $wpdb->get_results("".$gs_query."");
	
	// set url paths
	$url = 'https://www.golfscotland.net/courses/';
	$img_path = 'https://www.golfscotland.net/wp-content/uploads/';
	$video_path = 'https://www.youtube.com/embed/';

// open link to wp database
global $wpdb;

get_header();

get_template_part( 'templates/top-title' );
?>

<!-- <div class="mh-layout mh-top-title-offset"> 

<?php /*
	while ( have_posts() ) : the_post();
		get_template_part( 'templates/content', 'page' );
		if ( comments_open() || get_comments_number() ) :
			comments_template();
    endif;
  endwhile; */
?>
</div> -->

<style>
#gs-wrapper {
	margin: 32px;
}
h1, h2, h3, h4 {
	color: #0065bd; /* blue */
}
.gs-link a:link, .gs-link a:visited {
	text-decoration: none;
	color: #0065bd; /* blue */ 
}
.gs-link a:hover {
	color: #000; /* black */;
}

table#gs-allCourse {
	width: 100%;
}
table#gs-allCourse12 {
	width: 25%;
}
table, th, td {
	border: none;
}
table#gs-allCourse tr:nth-child(odd) {
	background-color: #eee; /* lightgrey */ 
}
table#gs-allCourse tr:nth-child(even) {
	background-color: #fff; /* white */ 
}
table#gs-allCourse th {
	background-color: #0065bd; /* blue */
	color: white;
}
th {
	height: 50px; 
	font-size: 14pt;
}
td {
	font-size: 12pt;
}
td.center {
	text-align: center;
}
td.gs-img {
	width: 135px;
}

.gs-imgLogo {
	height: 50px; 
	border: none;
}
.gs-blue {
	color: #0065bd; /* blue */
}

@media only screen and (max-width: 480px) {
	#gs-wrapper {
	margin: 10px;
	}
	h2 {
		font-size: 20pt;
	}
	th {
		height: 50px; font-size: 8pt;
	}
	td {
		font-size: 8pt;
	}
	th.gs-switch, td.gs-switch {
		display: none;
	}
}
</style>

<div id="gs-wrapper">
	<section id="gs-content" class="clearfix">
		<h2>List of Courses Found:</h2>
<?php
	if((count($gs_gsdsr)) == 0) {
		echo '<p>Sorry no course of that type found in this region.</p>';
	} else /*if(count($gs_gsdsr) < 25)*/ {
		plus12($gs_gsdsr, $url, $img_path);
/*	} else {
		echo "less than 12 items"; */
		// display layout for 12 or less search results
		// less_than12($gs_gsdsr, $url, $img_path); 
	}
?>
	</section><!-- end #gs-content -->
	<section id="gs-sidebar">
	
	</section>
</div><!-- end #gs-wrapper -->

<?php get_footer(); ?>

<?php
else :

endif;
?>