<form method="get" id="searchform" action="<?php echo home_url( '/' ); ?>" role="search">
    <input type="text" value="<?php esc_attr(get_query_var('s')); ?>" placeholder="Search" name="s" id="s" />
    <input type="submit" id="searchsubmit" value="Go" />
</form>