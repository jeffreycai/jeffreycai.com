<?php
	$form = '<form style="visibility:hidden;" role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
	<label class="screen-reader-text" for="s">' . __('Search for:') . '</label>
    <div>
	<input type="text" value="' . get_search_query() . '" name="s" id="s" />
    <span class="glass"><i></i></span>
    </div>
	</form>';

	if ( $echo )
		echo apply_filters('get_search_form', $form);
	else
		return apply_filters('get_search_form', $form);
?>
