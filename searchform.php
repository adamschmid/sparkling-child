<?php
/**
 * The template for displaying search forms in Sparkling
 *
 * @package sparkling
 */
?>
<form role="search" method="get" class="form-search" action="http://foxtonemusic.com/">
	<div class="row">
		<div class="col-lg-12">
			<div class="input-group">
				<label class="screen-reader-text" for="s">Search for:</label>
				<input type="text" class="form-control search-query" value="" name="s" id="s" placeholder="Search for products">
				<span class="input-group-btn">
					<button type="submit" class="btn btn-default" name="submit" id="searchsubmit" value="Search"><span class="glyphicon glyphicon-search"></span></button>
				</span>
				<input type="hidden" name="post_type" value="product">
			</div>
		</div>
	</div>
</form>