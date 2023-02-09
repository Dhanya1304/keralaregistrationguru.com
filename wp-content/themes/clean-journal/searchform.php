<?php
/**
 * The template for displaying search forms
 *
 * @package Catch Themes
 * @subpackage Clean Journal
 * @since Clean Journal 0.1 
 */
?>

<?php $options 	= clean_journal_get_theme_options(); // Get options ?>
<?php  ?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/custom_search.php' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php _ex( 'Search for:', 'label', 'clean-journal' ); ?></span>
		<!-- <input type="search" autocomplete="off" class="search-field" placeholder="< ?php echo esc_attr( $options[ 'search_text' ] ); ?>" value="< ?php echo esc_attr( get_search_query() ); ?>" name="s" title="< ?php _ex( 'Search for:', 'label', 'clean-journal' ); ?>"> -->
		<input type="search" autocomplete="off" class="search-field" placeholder="<?php echo esc_attr( $options[ 'search_text' ] ); ?>" name="search" value="<?php echo $_GET['search']; ?>">
	</label>
	<input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'clean-journal' ); ?>">
</form> <?php  ?>

<?php /* ?><form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/custom_search.php' ) ); ?>">
	<input type="search" class="search-field" placeholder="<?php echo esc_attr( $options[ 'search_text' ] ); ?>" name="search" value="<?php echo $_GET['search']; ?>">
</form><?php */ ?> 