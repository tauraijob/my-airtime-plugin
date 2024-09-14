<?php
/*
Plugin Name: Airtime Purchase Plugin
Description: A plugin to allow users to purchase airtime using Paynow.
Version: 1.0
Author: Taurai
*/

defined('ABSPATH') or die('No script kiddies please!');

// Include Paynow SDK
require_once plugin_dir_path(__FILE__) . 'includes/paynow-sdk.php';

// Create a shortcode for airtime purchase form
function airtime_purchase_form() {
    ob_start(); ?>
    <form id="airtimeForm" method="POST" action="">
        <label for="phoneNumber">Phone Number:</label>
        <input type="text" name="phone_number" required>
        
        <label for="amount">Amount:</label>
        <input type="number" name="amount" required>
        
        <button type="submit">Buy Airtime</button>
    </form>
    
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $phone_number = sanitize_text_field($_POST['phone_number']);
        $amount = sanitize_text_field($_POST['amount']);
        process_airtime_purchase($phone_number, $amount);
    }
    return ob_get_clean();
}
add_shortcode('airtime_form', 'airtime_purchase_form');

// Process payment using Paynow
function process_airtime_purchase($phone_number, $amount) {
    // Paynow integration
    $paynow = new Paynow\Payments\Paynow('INTEGRATION_ID', 'INTEGRATION_KEY', 'https://yourwebsite.com/return', 'https://yourwebsite.com/result');
    
    $payment = $paynow->createPayment('Airtime Purchase', 'user@example.com');
    $payment->add('Airtime', $amount);

    $response = $paynow->sendMobile($payment, $phone_number, 'ecocash'); // Example for EcoCash

    if ($response->success()) {
        // Redirect user to Paynow for payment or handle success
        $redirectUrl = $response->redirectUrl();
        wp_redirect($redirectUrl);
        exit;
    } else {
        // Handle failure
        echo 'Payment initiation failed. Please try again.';
    }
}
