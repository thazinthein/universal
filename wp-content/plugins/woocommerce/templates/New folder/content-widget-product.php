<?php global $product; ?>
<li>
	<a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
		<div class="random-img" width="120" height="120" style="background:#f6f6f6;padding:10px;border:1px solid #eaeaea;margin-right:10px;"><?php echo $product->get_image(); ?></div>
		<div class="random-title"><?php echo $product->get_title(); ?><br><br><p>Details...</p></div>
	</a>
	<?php if ( ! empty( $show_rating ) ) echo $product->get_rating_html(); ?>
	<?php //echo $product->get_price_html(); ?>
</li>