<?php
error_reporting(E_ALL);

$range = (0,39);
$div = 25;

foreach ($range as $row) {
  $gs_course_result[] = $row;
}
echo (count($gs_course_result));

if(count($gs_course_result) > 1) :
?>
<button>1</button>

<?php endif; ?>

<html lang="en">
<head>
  <meta charset="utf-8" />
</head>
<script>
// create navbar
// dispaly navbar if results total greater than 20
// calculate number of pages result total divided by 20

var x = '';
var result = '';
var resultCount = 50;
var navCounter = 1;

for (x = navCounter; x < (navCounter+20); x++) {
  document.write(x+"<br />");
}
</script>
</html>
