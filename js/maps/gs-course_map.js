/*
 * ========================================================================
 * Script:		initMap()
 * Purpose:		Initialize and display dynamic Google Map API
 *						
 * Author:		Mark Fletcher
 * Date:			01.06.2020
 *  
 * Notes:			 
 *
 * Revision:	
 *		01.06.2020	1st issue.	
 *
 * ========================================================================
*/

// initialise variables
var course_lat = 56.6007713;
var course_lng = 3.2224757;
var map;

// function to display map
function initMap(course_lat, course_lng) {
	// this course location
	var this_course = {lat: course_lat, lng: course_lng},
	map = new google.maps.Map(document.getElementById('gs-map'), {center: this_course, zoom: 8});
	// The marker, positioned at this course
  var marker = new google.maps.Marker({position: this_course, map: map});
}
