<?php

/**
* Template Name: Sumit
*
*/

// get_headers();

$args = array(
  'numberposts' => -1,
  'post_type'   => 'book'
);

$query = new WP_Query( array(

    'post_type'             => 'book',
    'posts_per_page'        => -1,
    'tax_query' => array(
        'relation' => 'OR',
        array(
            'taxonomy' => 'Language',
            'field'    => 'name',
            'terms'    => $_REQUEST['lang'],
        ),
        array(
            'taxonomy' => 'Language',
            'field'    => 'name',
            'terms'    => 'English',
        ),
        // array(
        //     'taxonomy' => 'property_city',
        //     'field'    => 'id',
        //     'terms'    => $property_city_terms,
        // ),
        // array(
        //     'taxonomy' => 'property_state',
        //     'field'    => 'id',
        //     'terms'    => $property_state_terms,
        // ),
        // array(
        //     'taxonomy' => 'property_feature',
        //     'field'    => 'id',
        //     'terms'    => $property_feature_terms,
        // ),
    ),

));
 
echo "<pre>";
// print_r($query);

$cut_tax = array('Language','writer');
foreach ($cut_tax as $key => $value1) {
	$terms = get_terms( array(
	    'taxonomy' => $value1,
	    'hide_empty' => false,
	) );
	?>
	
	<?php foreach ($terms as $key => $value): ?>
		<input type="checkbox" name="<?= $value1 ?>[]" value="<?= $value->name ?>"> <?= $value->name ?>	
	<?php endforeach ?>
<?php } ?>

<?php //get_footer(); ?>