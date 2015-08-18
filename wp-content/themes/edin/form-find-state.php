<?php
	query_posts('post_type=states');

	if (have_posts()) {
?>
<form id="find-state-form" action="">
	<select>

	<?php
	    while (have_posts()){
	        the_post();
    ?>
        <option value="<?php echo get_permalink(); ?>"><?php the_title(); ?></option>
    <?php
	    }
	?>

	</select>
	<button type="submit">Get Info</button>
</form>

<?php
	} else {
?>
<p>No states found!</p>
<?php
	}
?>