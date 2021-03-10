<form id="gs-search-form" action="all-courses" method="get">
	<div id="gs-search-form-container">
		<div class="gs-query-box">
		
		</div><!-- end .gs-query-box -->
		<div class="gs-query-box">
			<select id="gs-query-regions" name="region">
				<option value="" selected>All Regions</option>
				<script>display_region_options(gs_reg)</script>
			</select>
		</div><!-- end .gs-query-box -->
		<div class="gs-query-box">
			<select id="gs-query-type" name="type">
				<option value="" selected>All Types</option>
				<script>display_type_options(gs_type)</script>
			</select>
		</div><!-- end .gs-query-box -->
		<div class="gs-submit-box">
			<input id="gs-search-button" type="submit" value="SEARCH" />
		</div><!-- end .gs-submit-box -->
	</div><!-- end #gs-search-form-container -->
</form><!-- end #gs-search-form -->

<noscript>
	The Course search function is not active.You MUST have JavaScript turned off for his site.
</noscript>

