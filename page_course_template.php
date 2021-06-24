<?php
/**
 * Template Name: Course Profile Page
 */
// set golf course id
if (isset($_GET)) :
	$golfCourseID = $_GET['courseID'];
else :
	$golfCourseID = 2;
endif;

function tick_cross($value) {
	if ($value == true) {
		$newValue = '<i class="fa fa-check fa-fw" style="color: green;"></i>';
	} else {
		$newValue = '<i class="fa fa-close fa-fw" style="color: red;"></i>';
	}
	return $newValue;
}

// set uri constants
$img_uri = 'https://www.golfscotland.net/wp-content/uploads/';
$video_uri = 'https://www.youtube.com/embed/';
$social_uri = [
	'https://www.facebook.com/',
	'https://twitter.com/',
	'https://www.instagram.com/',
	'https://www.youtube.com/channel/'
];

// open link to wp database
global $wpdb;

// data queries gs_courses table - course details
$gs_gsd = $wpdb->get_results("SELECT c.id, c.name, c.address, c.telephone, c.website, c.email, c.facebook, c.twitter, c.instagram, c.youtube, c.length, c.par, c.description, c.wkday_rnd, c.wkday_day, c.wkend_rnd, c.wkend_day, c.greenfee_note1, c.directions, c.course_lat, c.course_lng, c.special_offers, c.feature_switch, c.top_course, c.featured_course, c.img_logo, c.img_hdr, c.img_ftr, c.img_ad1, c.ad1_url, c.ad1_switch, c.video1, cr.region, ct.type FROM gs_courses AS c INNER JOIN gs_course_regions AS cr ON c.region = cr.id INNER JOIN gs_course_types AS ct ON c.type = ct.id WHERE c.id = ".$golfCourseID."");

// data queries gs_courses table - feature and facilities
$gs_gsff = $wpdb->get_results("SELECT id, trolly_hire, catering, club_hire, clubhouse, showers, changing_rooms, driving_range, proshop, putting_area, buggy_hire, tuition, conference_facilities, function_room, corporate_golf, society_golf, feature_note FROM gs_courses WHERE id = ".$golfCourseID."");

// data queries gs_courses table - videos
$gs_gsv = $wpdb->get_results("SELECT id, video1, video2, video3 FROM gs_courses WHERE id = ".$golfCourseID."");

// set variables
// if course logo not available use golf scotland icon
$gs_icon240 = '2020/05/gs-icon240-e1590336869748.png';

get_header();

get_template_part( 'templates/top-title' );
?>

<!--<div class="mh-layout mh-top-title-offset">

<?php /*
	while ( have_posts() ) : the_post();
		get_template_part( 'templates/content', 'page' );
		if ( comments_open() || get_comments_number() ) :
			comments_template();
    endif;
  endwhile; */
?>
</div> -->

<?php foreach ($gs_gsd as $gsd) : ?>
<style>
#gs-wrapper {
	margin: 0px 32px 0px 32px;
}
h1, h2, h3, h4 {
	color: #0065bd; /* blue */
}
h2 {
	font-weight: bold;
}
#gs-content a:link, #gs-content a:visited,
#gs-contactDetails a:link, #gs-contactDetails a:visited {
	text-decoration: underline;
	color: #0065bd; /* blue */
}
#gs-content a:hover, #gs-contactDetails a:hover {
	color: #000;
}
#gs-header {
	position: relative;
	background-color: #ccc; /* grey */
<?php if($gsd->img_hdr != null) : ?>
	background-image: url('<?php echo $img_uri.$gsd->img_hdr; ?>');
<?php else : ?>
	background-image: url('<?php echo $img_uri.'2020/05/golf_course1.jpg'; ?>');
<?php endif; ?>
	background-size: cover;
	background-position: left center;
	background-repeat: none;
	height: 240px;
	margin-bottom: 20px;
}
#gs-header, #gs-header h1, #gs-footer {
	color: white;
}
#gs-header h1 {
	margin: 120px 0px 0px 32px;
}
#gs-logo {
	position: absolute;
	top: 10px;
	left: 32px;
	height: 100px;
}
#gs-footer {
	background-color: #ccc; /* grey */
<?php if($gsd->img_ftr != null) : ?>
	background-image: url('<?php echo $img_uri.$gsd->img_ftr; ?>');
<?php else : ?>
	background-image: url('<?php echo $img_uri.'2020/05/golf_course1.jpg'; ?>');
<?php endif; ?>
	background-size: cover;
	background-position: left center;
	background-repeat: none;
	padding: 20px 32px;
	font-size: 14px;
}
#gs-footer a:link, #gs-footer a:visited {
	text-decoration: underline;
	color: #fff; /* white */
}
#gs-footer a:hover {
	color: palegoldenrod;
}
#gs-contactDetails {
	width: 100%;
}
#gs-contactItems, #gs-socialMedia {
	display: inline-block;
	margin-right: 32px;
}
.gs-contact {
	display: inline-block;
	width: 74px;
}
.gs-social {
	width: 50px;
}
#gs-address {
	margin-top: 10px;
	text-align: right;
}

#gs-content > div {
	margin-bottom: 20px;
}
#gs-weekday, #gs-weekend {
	display: inline-block;
	margin: 0px 32px 10px 0px;
}
.gs-ticket {
	display: inline-block;
	width: 120px;
}
table#gs-greenfees2 {
	width: 40%;
	font-size: 14pt;
	border: none;
}
table#gs-greenfees2 th {
	font-weight: bold;
	text-transform: capitalize;
	border: none;
}
table#gs-greenfees2 td {
	border: none;
}
table#gs-greenfees2 tr:nth-child(odd) {
	background-color: #fff; /* white */
}
table#gs-greenfees2 tr:nth-child(even) {
	background-color: #eee; /* lightgrey */
}
table#gs-greenfees2 th:nth-child(3), table#gs-greenfees2 th:nth-child(4), table#gs-greenfees2 th:nth-child(5),
table#gs-greenfees2 td:nth-child(3), table#gs-greenfees2 td:nth-child(4), table#gs-greenfees2 td:nth-child(5) {
	text-align: right;
}
table#gs-greenfees2 td:nth-child(3), table#gs-greenfees2 td:nth-child(4), table#gs-greenfees2 td:nth-child(5) {
	font-weight: bold;
	color:  #0065bd; /* blue */
}
#gs-key {
	background-color: #b2cadf; /* lightblue */
	padding: 20px;
}
#gs-map {
	border: 1px solid #0065bd; /* blue */
	margin:0;
	padding: 0;
  height: 400px;
	width: 100%;
}
#gs-advertBox {
	max-width: 100%;
	margin-top: 20px;
	margin-bottom: 20px;
}
.gs-advert {
	display: block;
	width: 50%;
	margin-left: auto;
	margin-right: auto;
}
.gs-featBox {
	display: inline-block;
	max-width: 320px;
}
.gs-featItem {
	display: inline-block;
	width: 50%;
}
.gs-featIcon {
	display: inline-block;
	text-align: center;
}
.gs-vid {
	margin-bottom: 10px;
}
.gs-blue {
color: #0065bd; /* blue */
}

@media only screen and (max-width: 480px) {

	#gs-wrapper, #gs-header h1 {
		margin-left: 8px;
		margin-right: 8px;
	}
	#gs-footer {
		padding-left: 8px;
		padding-right: 8px;
	}
	#gs-contactItems {
		width: 100%;
	}
	.gs-social {
		display: inline-block;
		margin-top: 20px;
	}
	#gs-logo {
		left: 8px;
	}
	#gs-header h1 {
		font-size: 28px;
	}
	table#gs-greenfees2 {
		width: 100%;
	}
	.gs-advert {
		width: 100%;
	}
	.gs-vid {
		display: block;
		margin-right: auto;
		margin-left: auto;
	}
}
</style>
<section id="gs-header">
<?php if($gsd->img_logo != null) : ?>
<img id="gs-logo" src="<?php echo $img_uri.$gsd->img_logo; ?>" alt="club logo" />
<?php else : ?>
<img id="gs-logo" src="<?php echo $img_uri.$gs_icon240; ?>" alt="GS logo" />
<?php endif; ?>
<h1><?php echo $gsd->name; ?></h1>
</section><!-- end #gs-header -->

<div id="gs-wrapper">
	<section id="gs-content">
		<h2>Course Details</h2>
		<h3>Stats:</h3>
		<div id="gs-stats">
			<b>Course Type:</b> <?php echo $gsd->type; ?>&nbsp;|&nbsp;
			<b>Length:</b> <?php echo number_format($gsd->length); ?> yrds&nbsp;|&nbsp;
			<b>Par:</b> <?php echo $gsd->par; ?>
		</div><!-- end #gs-stats-->

		<h3>Description:</h3>
		<div id="gs-description">
			<p><?php echo nl2br(html_entity_decode($gsd->description)); ?></p>
		</div><!-- end #gs-description-->

		<h3>Green Fees:</h3>
		<div id="gs-greenFees">
<?php if(($gsd->wkday_rnd != null) && ($gsd->wkday_day != null) && ($gsd->wkend_rnd != null) && ($gsd->wkend_day != null)) : ?>
	<div id="gs-weekday">
		<b>Weekday:</b><br />
		<span  class="gs-ticket">Round Ticket:</span>
<?php if($gsd->wkday_rnd != 0) : ?>
		<b class="gs-blue">&pound;<?php echo $gsd->wkday_rnd; ?></b><br />
<?php else : ?>
		<b class="gs-blue">n/a</b><br />
<?php endif; ?>
		<span  class="gs-ticket">Day Ticket:</span>
<?php if($gsd->wkday_day != 0) : ?>
		<b class="gs-blue">&pound;<?php echo $gsd->wkday_day; ?></b>
<?php else : ?>
		<b class="gs-blue">n/a</b>
<?php endif; ?>
	</div><!-- end #gs-weekday -->
	<div id="gs-weekend">
		<b>Weekend:</b><br />
		<span  class="gs-ticket">Round Ticket:</span>
<?php if($gsd->wkend_rnd != 0) : ?>
		<b class="gs-blue">&pound;<?php echo $gsd->wkend_rnd; ?></b><br />
<?php else : ?>
		<b class="gs-blue">n/a</b><br />
<?php endif; ?>
		<span  class="gs-ticket">Day Ticket:</span>
<?php if($gsd->wkend_day != 0) : ?>
		<b class="gs-blue">&pound;<?php echo $gsd->wkend_day; ?></b>
<?php else : ?>
		<b class="gs-blue">n/a</b>
<?php endif; ?>
	</div><!-- end #gs-weekend -->
<?php
	elseif($gsd->greenfee_note1 != null) :
		$table_rows = explode("\r", $gsd->greenfee_note1);
		$fees_table = '<table id="gs-greenfees2">'.PHP_EOL;
		$fees_table .= '<tr><th>'.str_replace(',', '</th><th>',$table_rows[0]).'</th></tr>'.PHP_EOL;
		for ($x = 1; $x < count($table_rows); $x++) :
			$trow = '<tr><td>'.str_replace(',', '</td><td>', $table_rows[$x]).'</td></tr>'.PHP_EOL;
			$fees_table .= $trow;
		endfor;
		$fees_table .= '</table>'.PHP_EOL;
		echo $fees_table;
?>
<?php endif; ?>
		</div><!-- end #gs-greenFees -->

		<h3>Directions:</h3>
		<div id="gs-directions">
			<?php echo nl2br(html_entity_decode($gsd->directions)); ?>
		</div><!-- end #gs-directions-->

		<!-- display google map -->
		<div id="gs-map">
			<noscript>
				The dynamic location map is not being displayed because JavaScript is deactivated for this browser.
			</noscript>
		</div><!-- end #gs-map-->

		<!-- Google Maps API -->
		<script>
			// initialise variables
			var map;

			// function to display map
			function initMap() {
				// this course location
				var this_course = {lat: <?php echo $gsd->course_lat; ?>, lng: <?php echo $gsd->course_lng; ?>},
				map = new google.maps.Map(document.getElementById('gs-map'), {center: this_course, zoom: 14});

				var infoString = '<div id="gs-mapInfo">'+
      			'<h4><?php  echo $gsd->name; ?></h4>' +
      			'<div id="gs-bodyInfo">'+
      			'Par: <b class="gs-blue"><?php echo $gsd->par; ?></b><br />' +
      			'Length: <b class="gs-blue"><?php echo number_format($gsd->length); ?></b> yrds<br />' +
      			'Type: <b class="gs-blue"><?php echo $gsd->type; ?></b><br />' +
      			'Region: <b class="gs-blue"><?php echo $gsd->region; ?></b>' +
      			'</div>'+
      			'</div>';

				var infowindow = new google.maps.InfoWindow({
    				content: infoString
  				});

				// golf scotland icon
				// get icon image
				var gs_icon = '<?php echo $img_uri.'2020/07/gs-icon40.png'; ?>';
				// set icon
				var golfscot = {icon: gs_icon};

				// The marker, positioned at this course
				var marker = new google.maps.Marker({position: this_course, icon: gs_icon, map: map});
				marker.addListener('click', function() { infowindow.open(map, marker);});
			}
		</script>
		<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo MAP_KEY; ?> &language=en &region=GB &callback=initMap">
		</script>
		<!-- end Google Maps API -->

<?php if($gsd->img_ad1 != null) : ?>
		<div id="gs-advertBox">
<?php if($gsd->img_ad1_switch == flase) : ?>
			<a href="<?php  echo $gsd->website; ?>">
<?php else : ?>
			<a href="<?php  echo $gsd->ad1_url; ?>">
<?php endif; ?>
				<img class="gs-advert" src="<?php echo $img_uri.$gsd->img_ad1; ?>" alt="current advert No.1" />
			</a>
		</div><!-- end .gs-advertBox -->
<?php
	endif;

	if($gsd->special_offers != null) :
?>
		<h3>Special Offers:</h3>
		<div id="gs-specialOffers">
<?php echo nl2br(html_entity_decode($gsd->special_offers)); ?>
		</div><!-- end #gs-specialOffers-->
<?php
	endif;

	if($gsd->feature_switch == 1) :
		foreach ($gs_gsff as $gsff) : ?>
		<h3>Golf Course Features and Facilities:</h3>
		<div id="gs-features">
			<div class="gs-featBox">
				<div class="gs-featItem"><b>Trolly Hire:</b></div>
				<div class="gs-featIcon"><?php echo tick_cross($gsff->trolly_hire); ?></div>
				<div class="gs-featItem"><b>Catering Available:</b></div>
				<div class="gs-featIcon"><?php echo tick_cross($gsff->catering); ?></div>
				<div class="gs-featItem"><b>Club Hire:</b></div>
				<div class="gs-featIcon"><?php echo tick_cross($gsff->club_hire); ?></div>
				<div class="gs-featItem"><b>Clubhouse:</b></div>
				<div class="gs-featIcon"><?php echo tick_cross($gsff->clubhouse); ?></div>
				<div class="gs-featItem"><b>Showers:</b></div>
				<div class="gs-featIcon"><?php echo tick_cross($gsff->showers); ?></div>
			</div><!-- end .gs-featBox-->

			<div class="gs-featBox">
				<div class="gs-featItem"><b>Changing Rooms:</b></div>
				<div class="gs-featIcon"><?php echo tick_cross($gsff->changing_rooms); ?></div>
				<div class="gs-featItem"><b>Driving Range:</b></div>
				<div class="gs-featIcon"><?php echo tick_cross($gsff->driving_range); ?></div>
				<div class="gs-featItem"><b>Proshop:</b></div>
				<div class="gs-featIcon"><?php echo tick_cross($gsff->proshop); ?></div>
				<div class="gs-featItem"><b>Putting Area:</b></div>
				<div class="gs-featIcon"><?php echo tick_cross($gsff->putting_area); ?></div>
				<div class="gs-featItem"><b>Buggy Hire:</b></div>
				<div class="gs-featIcon"><?php echo tick_cross($gsff->buggy_hire); ?></div>
			</div><!-- end .gs-featBox-->

			<div class="gs-featBox">
				<div class="gs-featItem"><b>Tuition Available:</b></div>
				<div class="gs-featIcon"><?php echo tick_cross($gsff->tuition); ?></div>
				<div class="gs-featItem"><b>Conference Facilities:</b></div>
				<div class="gs-featIcon"><?php echo tick_cross($gsff->conference_facilities); ?></div>
				<div class="gs-featItem"><b>Function Room:</b></div>
				<div class="gs-featIcon"><?php echo tick_cross($gsff->function_room); ?></div>
				<div class="gs-featItem"><b>Corporate Golf:</b></div>
				<div class="gs-featIcon"><?php echo tick_cross($gsff->corporate_golf); ?></div>
				<div class="gs-featItem"><b>Society Golf:</b></div>
				<div class="gs-featIcon"><?php echo tick_cross($gsff->society_golf); ?></div>
			</div><!-- end .gs-featBox -->
		</div><!-- end #gs-features -->
<?php if ($gsff->feature_note != null) : ?>
		<div id="gs-featNotes">
			<h3>Additional Notes on Features:</h3>
<?php echo  nl2br(html_entity_decode($gsff->feature_note)); ?>
		</div><!-- end #featNotes -->
<?php endif; ?>
<?php
		endforeach;
	endif;

	if ($gsd->video1 != null) :
?>
		<h2>Gallery:</h2>
		<div id="gs-gallery">
			<div id="gs-video">
<?php
		foreach ($gs_gsv as $gsvid) :
			for ($x=1; $x <= 3; $x++) :
				$video = 'video'.$x;
				// set video image width and height
				$v_width = 425;
				$v_height = 239;
				if($gsvid->$video != null) :
?>
				<iframe class="gs-vid" width="<?php echo $v_width; ?>" height="<?php echo $v_height; ?>" src="<?php echo $video_uri.$gsvid->$video; ?>" frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
<?php
				endif;
			endfor;
		endforeach;
?>
			</div><!-- end #gs-video -->
		</div><!-- end #gs-gallery -->
<?php	endif; ?>
	</section><!-- end #gs-content -->
</div><!-- end #gs-wrapper -->

<section id="gs-footer">
	<div id="gs-contactDetails" class="clearfix">
		<h5>Ways to contact the golf club directly:</h5>
		<div id="gs-contactItems">
			<b class="gs-contact">Telephone:</b>
			<a href="tel:<?php echo $gsd->telephone; ?>"><?php echo $gsd->telephone; ?></a><br />
			<b class="gs-contact">Website:</b>
			<a href="<?php echo $gsd->website; ?>"><?php echo $gsd->website; ?></a><br />
			<b class="gs-contact">Email:</b>
			<a href="mailto:<?php echo $gsd->email; ?>"><?php echo $gsd->email; ?></a>
		</div><!-- end #gs-contactItems -->

		<div id="gs-socialMedia">
<?php if ($gsd->facebook != null) : ?>
			<div class="gs-social">
				<a href="<?php echo $social_uri[0].$gsd->facebook; ?>">
				<span class="fa-stack fa-lg">
					<i class="fa fa-circle fa-stack-2x"></i>
					<i class="fa fa-facebook fa-stack-1x fa-inverse" title="Follow Us on Facebook" style="color: #ccc;"></i>
				</span>
				</a>
			</div>
<?php
	endif;
	if ($gsd->twitter != null) :
?>
			<div class="gs-social">
				<a href="<?php echo $social_uri[1].$gsd->twitter; ?>">
				<span class="fa-stack fa-lg">
					<i class="fa fa-circle fa-stack-2x"></i>
					<i class="fa fa-twitter fa-stack-1x fa-inverse" title="Follow us on Twitter" style="color: #ccc;"></i>
				</span>
				</a>
			</div>
<?php
	endif;
	if ($gsd->instagram != null) :
?>
			<div class="gs-social">
				<a href="<?php echo $social_uri[2].$gsd->instagram; ?>">
				<span class="fa-stack fa-lg">
					<i class="fa fa-circle fa-stack-2x"></i>
					<i class="fa fa-instagram fa-stack-1x fa-inverse" title="Follow us on Instagram" style="color: #ccc;"></i>
				</span>
				</a>
			</div>
<?php
	endif;
	if ($gsd->youtube != null) :
?>
			<div class="gs-social">
				<a href="<?php echo $social_uri[3].$gsd->youtube; ?>">
				<span class="fa-stack fa-lg">
					<i class="fa fa-circle fa-stack-2x"></i>
					<i class="fa fa-youtube fa-stack-1x fa-inverse" title="Follow us on Youtube" style="color: #ccc;"></i>
				</span>
				</a>
			</div>
<?php endif; ?>
		</div><!-- end #gs-socialMedia -->
	</div><!-- end #gs-contactDetails -->

	<div id="gs-address">
	<?php echo $gsd->address; ?>
	</div><!-- end #gs-address -->
</section><!-- end #gs-footer -->
<?php endforeach; ?>

<?php get_footer(); ?>
