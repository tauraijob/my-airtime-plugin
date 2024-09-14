<?php
// Paynow SDK: Simplified version for demonstration
namespace Paynow\Payments;

class Paynow
{
    private $integration_id;
    private $integration_key;
    private $result_url;
    private $return_url;
    
    public function __construct($integration_id, $integration_key, $return_url, $result_url)
    {
        $this->integration_id = $integration_id;
        $this->integration_key = $integration_key;
        $this->result_url = $result_url;
        $this->return_url = $return_url;
    }

    // Create a new payment
    public function createPayment($reference, $email)
    {
        return new Payment($reference, $email);
    }

    // Send mobile payment request (Example for Ecocash)
    public function sendMobile($payment, $phone_number, $method)
    {
        // Simplified mock request to Paynow
        $response = new Response(true, "https://www.paynow.co.zw/interface/request/?ref=" . $payment->reference);

        return $response;
    }
}

class Payment
{
    public $reference;
    public $email;
    public $items = [];

    public function __construct($reference, $email)
    {
        $this->reference = $reference;
        $this->email = $email;
    }

    // Add an item to the payment
    public function add($title, $amount)
    {
        $this->items[] = ['title' => $title, 'amount' => $amount];
    }
}

class Response
{
    private $success;
    private $redirect_url;

    public function __construct($success, $redirect_url)
    {
        $this->success = $success;
        $this->redirect_url = $redirect_url;
    }

    // Check if the request was successful
    public function success()
    {
        return $this->success;
    }

    // Get the redirect URL for the payment
    public function redirectUrl()
    {
        return $this->redirect_url;
    }
}
