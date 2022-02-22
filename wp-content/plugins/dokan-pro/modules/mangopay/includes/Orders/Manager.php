<?php

namespace WeDevs\DokanPro\Modules\MangoPay\Orders;

use WeDevs\DokanPro\Modules\MangoPay\Support\Meta;
use WeDevs\DokanPro\Modules\MangoPay\Support\Helper;

/**
 * Manager class for orders.
 *
 * @since 3.5.0
 */
class Manager {

    /**
     * Class constructor.
     *
     * @since 3.5.0
     */
    public function __construct() {
        $this->hooks();
        $this->init_classes();
    }

    /**
     * Registers necessary hooks.
     *
     * @since 3.5.0
     *
     * @return void
     */
    private function hooks() {
        // When order received, on thankyou page, display bankwire references if necessary
        add_action( 'woocommerce_thankyou_' . Helper::get_gateway_id(), array( $this, 'display_bankwire_ref' ) );
    }

    /**
     * Instantiates required classes.
     *
     * @since 3.5.0
     *
     * @return void
     */
    private function init_classes() {
        new Payment();
        new Refund();
    }

    /**
     * Display bankwire ref at top of thankyou page
     * when new order received via bankwire
     *
     * @since 3.5.0
     *
     * @param int $order_id
     *
     * @return void
     */
    public function display_bankwire_ref( $order_id ) {
        $payment_ref = Meta::get_payment_ref( $order_id );

        if ( Meta::get_payment_type( $order_id ) !== 'bank_wire' || ! $payment_ref ) {
            return;
        }

        $address = array( $payment_ref->PaymentDetails->BankAccount->OwnerAddress->AddressLine1 );

        if ( ! empty( $payment_ref->PaymentDetails->BankAccount->OwnerAddress->AddressLine2 ) ) {
            $address[] = $payment_ref->PaymentDetails->BankAccount->OwnerAddress->AddressLine2;
        }

        $address[] = $payment_ref->PaymentDetails->BankAccount->OwnerAddress->City;
        $address[] = $payment_ref->PaymentDetails->BankAccount->OwnerAddress->PostalCode;

        if ( ! empty( $payment_ref->PaymentDetails->BankAccount->OwnerAddress->Region ) ) {
            $address[] = $payment_ref->PaymentDetails->BankAccount->OwnerAddress->Region;
        }

        $address[] = $payment_ref->PaymentDetails->BankAccount->OwnerAddress->Country;

        Helper::get_template(
            'bankwire-reference',
            array(
                'amount'   => $payment_ref->PaymentDetails->DeclaredDebitedFunds->Amount / 100,
                'currency' => $payment_ref->PaymentDetails->DeclaredDebitedFunds->Currency,
                'owner'    => $payment_ref->PaymentDetails->BankAccount->OwnerName,
                'iban'     => $payment_ref->PaymentDetails->BankAccount->Details->IBAN,
                'bic'      => $payment_ref->PaymentDetails->BankAccount->Details->BIC,
                'wire_ref' => $payment_ref->PaymentDetails->WireReference,
                'address'  => implode( ', ', $address ),
            )
        );
    }
}
