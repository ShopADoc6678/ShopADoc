<?php

namespace WPDesk\FCF\Free\Validator\Error;

/**
 * {@inheritdoc}
 */
class InvalidUrlError extends ErrorAbstract {

	/**
	 * {@inheritdoc}
	 */
	public function get_error_message(): string {
		return sprintf(
		/* translators: %1$s: field label */
			__( 'The URL address provided is not valid for the %1$s field.', 'flexible-checkout-fields' ),
			sprintf( '<strong>%s</strong>', strip_tags( $this->field_data['label'] ) )
		);
	}
}
