<?php
/**
 * Dokan Dashboard Auction Product shipping Content
 *
 * @since 2.4
 *
 * @package dokan
 */
?>

<?php do_action( 'dokan_product_options_shipping_before', $post_id ); ?>
<?php
global $post;
$user_id                 = dokan_get_current_user_id();
$processing_time         = dokan_get_shipping_processing_times();
$_required_tax           = get_post_meta( $post_id, '_required_tax', true );
$_disable_shipping       = ( get_post_meta( $post_id, '_disable_shipping', true ) ) ? get_post_meta( $post_id, '_disable_shipping', true ) : 'no';
$_additional_price       = get_post_meta( $post_id, '_additional_price', true );
$_additional_qty         = get_post_meta( $post_id, '_additional_qty', true );
$_processing_time        = get_post_meta( $post_id, '_dps_processing_time', true );
$dps_shipping_type_price = get_user_meta( $user_id, '_dps_shipping_type_price', true );
$dps_additional_qty      = get_user_meta( $user_id, '_dps_additional_qty', true );
$dps_pt                  = get_user_meta( $user_id, '_dps_pt', true );
$porduct_shipping_pt     = ( $_processing_time ) ? $_processing_time : $dps_pt;
$dokan_shipping_option   = get_option( 'woocommerce_dokan_product_shipping_settings' );
$dokan_shipping_enabled  = ( isset( $dokan_shipping_option['enabled'] ) ) ? $dokan_shipping_option['enabled'] : 'yes';
$tax_classes             = array_filter( array_map( 'trim', explode( "\n", get_option( 'woocommerce_tax_classes' ) ) ) );
$classes_options         = array();
$classes_options['']     = __( 'Standard', 'dokan-auction' );

if ( $tax_classes ) {
	foreach ( $tax_classes as $class ) {
		$classes_options[ sanitize_title( $class ) ] = esc_html( $class );
	}
}
?>
<?php if ( $dokan_shipping_enabled == 'yes' &&  ( 'yes' == get_option( 'woocommerce_calc_shipping' ) || 'yes' == get_option( 'woocommerce_calc_taxes' ) ) ): ?>
	<div class="dokan-product-shipping-tax hide_if_virtual hide_if_grouped dokan-edit-row dokan-clearfix dokan-border-top <?php echo ( 'no' == get_option('woocommerce_calc_shipping') ) ? 'woocommerce-no-shipping' : '' ?> <?php echo ( 'no' == get_option('woocommerce_calc_taxes') ) ? 'woocommerce-no-tax' : '' ?>">
		<div class="dokan-section-heading" data-togglehandler="dokan_product_shipping_tax">
			<h2><i class="fa fa-truck" aria-hidden="true"></i> <?php _e( 'Shipping and Tax', 'dokan-auction' ); ?></h2>
			<p><?php _e( 'Manage shipping and tax for this auction', 'dokan-auction' ); ?></p>
			<a href="#" class="dokan-section-toggle">
				<i class="fa fa-sort-desc fa-flip-vertical" aria-hidden="true"></i>
			</a>
			<div class="dokan-clearfix"></div>
		</div>

		<div class="dokan-section-content">
			<?php
			$store_shipping = get_user_meta( get_current_user_id(), '_dps_shipping_enable', true );
			?>
			<?php if( 'yes' == get_option('woocommerce_calc_shipping') ): ?>
				<div class="dokan-clearfix dokan-shipping-container">
					<input type="hidden" name="product_shipping_class" value="0">
					<div class="dokan-form-group">
						<label class="dokan-checkbox-inline" for="_disable_shipping">
							<input type="hidden" name="_disable_shipping" value="yes">
							<input type="checkbox" id="_disable_shipping" name="_disable_shipping" value="no" <?php checked( $_disable_shipping, 'no' ); ?>>
							<?php _e( 'This product requires shipping', 'dokan-auction' ); ?>
						</label>
					</div>

					<div class="show_if_needs_shipping dokan-shipping-dimention-options">
						<?php dokan_post_input_box( $post_id, '_weight', array( 'class' => 'dokan-form-control', 'placeholder' => sprintf( __( 'weight (%s)', 'dokan-auction' ), esc_html( get_option( 'woocommerce_weight_unit' ) ) ) ), 'number' ); ?>
						<?php dokan_post_input_box( $post_id, '_length', array( 'class' => 'dokan-form-control', 'placeholder' => sprintf( __( 'length (%s)', 'dokan-auction' ), esc_html( get_option( 'woocommerce_dimension_unit' ) ) ) ), 'number' ); ?>
						<?php dokan_post_input_box( $post_id, '_width', array( 'class' => 'dokan-form-control', 'placeholder' => sprintf( __( 'width (%s)', 'dokan-auction' ), esc_html( get_option( 'woocommerce_dimension_unit' ) ) ) ), 'number' ); ?>
						<?php dokan_post_input_box( $post_id, '_height', array( 'class' => 'dokan-form-control', 'placeholder' => sprintf( __( 'height (%s)', 'dokan-auction' ), esc_html( get_option( 'woocommerce_dimension_unit' ) ) ) ), 'number' ); ?>
						<div class="dokan-clearfix"></div>
					</div>

					<?php if ( $post_id ): ?>
						<?php do_action( 'dokan_product_options_shipping' ); ?>
					<?php endif; ?>
					<div class="show_if_needs_shipping dokan-form-group">
						<label class="control-label" for="product_shipping_class"><?php _e( 'Shipping Class', 'dokan-auction' ); ?></label>
						<div class="dokan-text-left">
							<?php
							// Shipping Class
							$classes = get_the_terms( $post->ID, 'product_shipping_class' );
							if ( $classes && ! is_wp_error( $classes ) ) {
								$current_shipping_class = current($classes)->term_id;
							} else {
								$current_shipping_class = '';
							}

							$args = array(
								'taxonomy'          => 'product_shipping_class',
								'hide_empty'        => 0,
								'show_option_none'  => __( 'No shipping class', 'dokan-auction' ),
								'name'              => 'product_shipping_class',
								'id'                => 'product_shipping_class',
								'selected'          => $current_shipping_class,
								'class'             => 'dokan-form-control'
							);
							?>

							<?php wp_dropdown_categories( $args ); ?>
							<p class="help-block"><?php _e( 'Shipping classes are used by certain shipping methods to group similar products.', 'dokan-auction' ); ?></p>
						</div>
					</div>
					<?php if( $dokan_shipping_enabled == 'yes' && $store_shipping == 'yes' ) : ?>
						<div class="show_if_needs_shipping dokan-shipping-product-options">

							<div class="dokan-form-group">
								<?php dokan_post_input_box( $post_id, '_overwrite_shipping', array( 'label' => __( 'Override your store\'s default shipping cost for this product', 'dokan-auction' ) ), 'checkbox' ); ?>
							</div>

							<div class="dokan-additional-shipping-wrap show_if_override">
								<div class="dokan-form-group dokan-w3">
									<label class="dokan-control-label" for="_additional_product_price"><?php _e( 'Additional cost', 'dokan-auction' ); ?></label>
									<input id="_additional_product_price" value="<?php echo $_additional_price; ?>" name="_additional_price" placeholder="9.99" class="dokan-form-control" type="number" step="any">
								</div>

								<div class="dokan-form-group dokan-w3">
									<label class="dokan-control-label" for="dps_additional_qty"><?php _e( 'Per Qty Additional Price', 'dokan-auction' ); ?></label>
									<input id="additional_qty" value="<?php echo ( $_additional_qty ) ? $_additional_qty : $dps_additional_qty; ?>" name="_additional_qty" placeholder="1.99" class="dokan-form-control" type="number" step="any">
								</div>

								<div class="dokan-form-group dokan-w3 last-child">
									<label class="dokan-control-label" for="dps_additional_qty"><?php _e( 'Processing Time', 'dokan-auction' ); ?></label>
									<select name="_dps_processing_time" id="_dps_processing_time" class="dokan-form-control">
										<?php foreach ( $processing_time as $processing_key => $processing_value ): ?>
											<option value="<?php echo $processing_key; ?>" <?php selected( $porduct_shipping_pt, $processing_key ); ?>><?php echo $processing_value; ?></option>
										<?php endforeach ?>
									</select>
								</div>
								<div class="dokan-clearfix"></div>
							</div>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<?php if ( 'yes' == get_option( 'woocommerce_calc_taxes' ) ) { ?>
				<div class="dokan-clearfix dokan-tax-container">
					<div class="dokan-tax-product-options">
						<div class="dokan-form-group content-half-part">
							<label class="dokan-control-label" for="_tax_status"><?php _e( 'Tax Status', 'dokan-auction' ); ?></label>
							<div class="dokan-text-left">
								<?php dokan_post_input_box( $post_id, '_tax_status', array( 'options' => array(
									'taxable'   => __( 'Taxable', 'dokan-auction' ),
									'shipping'  => __( 'Shipping only', 'dokan-auction' ),
									'none'      => _x( 'None', 'Tax status', 'dokan-auction' )
								) ), 'select'
								); ?>
							</div>
						</div>

						<div class="dokan-form-group content-half-part">
							<label class="dokan-control-label" for="_tax_class"><?php _e( 'Tax Class', 'dokan-auction' ); ?></label>
							<div class="dokan-text-left">
								<?php dokan_post_input_box( $post_id, '_tax_class', array( 'options' => $classes_options ), 'select' ); ?>
							</div>
						</div>

						<div class="dokan-clearfix"></div>
					</div>
				</div>
			<?php } ?>
		</div><!-- .dokan-side-right -->
	</div><!-- .dokan-product-inventory -->
<?php endif; ?>

<?php do_action( 'dokan_product_edit_after_shipping', $post_id ); ?>