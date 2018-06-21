<?php
//
// Recommended way to include parent theme styles.
//  (Please see http://codex.wordpress.org/Child_Themes#How_to_Create_a_Child_Theme)
// 
function get_state_abbrev( $state ) {

    $states = array (
        'Alabama' => 'AL',
        'Alaska' => 'AK',
        'Arizona' => 'AZ',
        'Arkansas' => 'AR',
        'California' => 'CA',
        'Colorado' => 'CO',
        'Connecticut' => 'CT',
        'Delaware' => 'DE',
        'District Of Columbia' => 'DC',
        'Florida' => 'FL',
        'Georgia' => 'GA',
        'Hawaii' => 'HI',
        'Idaho' => 'ID',
        'Illinois' => 'IL',
        'Indiana' => 'IN',
        'Iowa' => 'IA',
        'Kansas' => 'KS',
        'Kentucky' => 'KY',
        'Louisiana' => 'LA',
        'Maine' => 'ME',
        'Maryland' => 'MD',
        'Massachusetts' => 'MA',
        'Michigan' => 'MI',
        'Minnesota' => 'MN',
        'Mississippi' => 'MS',
        'Missouri' => 'MO',
        'Montana' => 'MT',
        'Nebraska' => 'NE',
        'Nevada' => 'NV',
        'New Hampshire' => 'NH',
        'New Jersey' => 'NJ',
        'New Mexico' => 'NM',
        'New York' => 'NY',
        'North Carolina' => 'NC',
        'North Dakota' => 'ND',
        'Ohio' => 'OH',
        'Oklahoma' => 'OK',
        'Oregon' => 'OR',
        'Pennsylvania' => 'PA',
        'Rhode Island' => 'RI',
        'South Carolina' => 'SC',
        'South Dakota' => 'SD',
        'Tennessee' => 'TN',
        'Texas' => 'TX',
        'Utah' => 'UT',
        'Vermont' => 'VT',
        'Virginia' => 'VA',
        'Washington' => 'WA',
        'West Virginia' => 'WV',
        'Wisconsin' => 'WI',
        'Wyoming' => 'WY'
    );
    return $states[$state];
} 
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
}
//
// Your code goes below
//
//
// // removes Order Notes Title - Additional Information
add_filter( 'woocommerce_enable_order_notes_field', '__return_false' );

// WooCommerce Checkout Fields Hook
// update the WC checkout billing fields from the GF membership form
add_filter( 'gf_woocommerce_checkout_billing', 'update_wc_billing', 10, 3 );
function update_wc_billing( $fields, $data ) { 
        
    if ( $data ) {
        if ( empty( $POST['billing_first_name'] ) ) {
            $_POST['billing_first_name'] = $data['billing_first_name'];
        } 
        if ( empty( $POST['billing_last_name'] ) ) {
            $_POST['billing_last_name'] = $data['billing_last_name'];
        }  
        if ( empty( $POST['billing_email'] ) ) {
            $_POST['billing_email'] = $data['billing_email_field'];
        }  
	    if ( strcasecmp($data['membership_for'],"myself") == 0 ) {
            if ( empty( $POST['billing_address_1'] ) ) {
                $_POST['billing_address_1'] = $data['billing_address_1'];
            } 
            if ( empty( $POST['billing_address_2'] ) ) {
                $_POST['billing_address_2'] = $data['billing_address_2'];
            } 
            if ( empty( $POST['billing_city'] ) ) {
                $_POST['billing_city'] = $data['billing_city'];
            } 
            if ( empty( $POST['billing_state'] ) ) {
                $_POST['billing_state'] = get_state_abbrev($data['billing_state']);
            } 
            if ( empty( $POST['billing_postcode'] ) ) {
                $_POST['billing_postcode'] = $data['billing_postcode'];
            } 
            //if ( empty( $POST['billing_country'] ) ) {
            //    $_POST['billing_country'] = $data['billing_country'];
            //} 
	    }
   }
   print_r($_POST);
   return $fields;
} 
