<form role="search" method="get" id="main-menu-search" class="menu-search menu-content close-on-desktop close-on-tablet" action="<?php echo home_url( '/' ); ?>">

	<div id="menu-search-field" class="menu-search-field form-attached clear">

		<input type="search" id="menu-search-input" class="search-input form-input" placeholder="<?php esc_attr_e( 'To search, type and hit enter&hellip;', 'kol-main-menu' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" id="s" />
	
		<button type="submit" class="search-submit form-submit kol-icon kol-icon-search" id="searchsubmit" />

	</div>

</form>