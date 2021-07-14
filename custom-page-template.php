<?php
/**
* Template Name: Custum_template
*
*/
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>

	<?php

	$args = array(
		'numberposts' => -1,
		'post_type'   => 'book'
	);

	$query = new WP_Query( array(
		's' => $_GET['search_item'],
		'post_type'             => 'book',
		'posts_per_page'        => -1,
	));

	?>


	<style type="text/css">
	.card {
		/* Add shadows to create the "card" effect */
		box-shadow: 0 4px 8px 0 rgb(0 0 0 / 20%);
		transition: 0.3s;
		width: 30%;
		float: left;
		margin: 0 1% 1% 0;

	}

	/* On mouse-over, add a deeper shadow */
	.card:hover {
		box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
	}

	/* Add some padding inside the card container */
	.container {
		padding: 2px 16px;
	}
</style>

<form>
<div class="section">
	<div class="search_bar">
		<input type="text" name="search_item" value="<?= $_REQUEST['search_item'] ?>">
		<input type="submit" value="Search">
	</div>
</div>
<div class="section" style="width: 100%;">
	<div class="one_forth" style="width:30%; float: left;">
		<?php
		$cut_tax = array('author','subject', 'language', 'exam');
		foreach ($cut_tax as $key => $value1) {

			$terms = get_terms( array(
				'taxonomy' => $value1,
				'hide_empty' => false,
			) );
			?>
			<h1><?= $value1 ?> </h1>

			<?php foreach ($terms as $key => $value): ?>
				<input type="checkbox" name="<?= $value1 ?>[]" value="<?= $value->name ?>"> <?= $value->name ?>	<br/>
			<?php endforeach ?>
		<?php } ?>
	</div>
	<div class="three_fourth" style="width:68%;float: left;">
		<?php 
		echo "<pre>";
		print_r($query);
		echo "</pre>";
		?>
		<?php foreach ($query->posts as $key => $value) {?>
			<div class="card post_id_<?= $value->ID ?>">
				<img src="<?= get_the_post_thumbnail_url($value->ID) ?>" alt="Avatar" style="width:100%">
				<div class="container">
					<h4><b><?= $value->post_title ?></b></h4>
				</div>
			</div>
		<?php } ?>
	</div>
</div>
</form>
</body>
</html>






\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

add_action( 'woocommerce_before_calculate_totals', 'add_custom_price' );

function add_custom_price( $cart_object ) {
  global $woocommerce;
  $free_product_id = 25;
    $custom_price = 5; // This will be your custom price  
    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
        if ( $free_product_id == $cart_item['product_id'] ) {
            $free_key = $cart_item_key;
            $free_qty = $cart_item['quantity'];
            $cart_item['data']->set_price(0); // Optionally set the price to zero
        }
    }

    if (count(WC()->cart->get_cart()) >= 5){
     echo "pen ";
 }


}
add_action( 'template_redirect', 'quadlayers_add_to_cart' );


function quadlayers_add_to_cart(){
 global $woocommerce;
 if ( $woocommerce->cart->cart_contents_count >= 5){

   $product_id = 25;
   $con = WC()->cart->cart_contents;
   $product_cart_id = WC()->cart->generate_cart_id( $product_id );
   if(!WC()->cart->find_product_in_cart( $product_cart_id )) {  
    $id_rate = WC()->cart->add_to_cart( $product_id);

}
}}
