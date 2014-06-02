<?php

// # Create Payment using PayPal as payment method
// This sample code demonstrates how you can process a 
// PayPal Account based Payment.
// API used: /v1/payments/payment

require __DIR__ . '/../bootstrap.php';
use PayPal\Api\Address;
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\FundingInstrument;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
session_start();


$total = strval($_SESSION["total"]);

$_SESSION["contactinfo"] = array();
$_SESSION["contactinfo"]["phone"] = $_POST["phone"];
$_SESSION["contactinfo"]["email"] = $_POST["email"];
$_SESSION["contactinfo"]["b_name"] = $_POST["b_name"];
$_SESSION["contactinfo"]["b_address"] = $_POST["b_address"];
$_SESSION["contactinfo"]["b_country"] = $_POST["b_country"];
$_SESSION["contactinfo"]["b_postalcode"] = $_POST["b_postalcode"];
$_SESSION["contactinfo"]["b_city"] = $_POST["b_city"];
$_SESSION["contactinfo"]["b_province"] = $_POST["b_province"];
if($_POST["shipping_same"]) {
	$_SESSION["contactinfo"]["s_name"] = $_POST["b_name"];
	$_SESSION["contactinfo"]["s_address"] = $_POST["b_address"];
	$_SESSION["contactinfo"]["s_country"] = $_POST["b_country"];
	$_SESSION["contactinfo"]["s_postalcode"] = $_POST["b_postalcode"];
	$_SESSION["contactinfo"]["s_city"] = $_POST["b_city"];
	$_SESSION["contactinfo"]["s_province"] = $_POST["b_province"];
} else {
	$_SESSION["contactinfo"]["s_name"] = $_POST["s_name"];
	$_SESSION["contactinfo"]["s_address"] = $_POST["s_address"];
	$_SESSION["contactinfo"]["s_country"] = $_POST["s_country"];
	$_SESSION["contactinfo"]["s_postalcode"] = $_POST["s_postalcode"];
	$_SESSION["contactinfo"]["s_city"] = $_POST["s_city"];
	$_SESSION["contactinfo"]["s_province"] = $_POST["s_province"];
}

// ### Payer
// A resource representing a Payer that funds a payment
// Use the List of `FundingInstrument` and the Payment Method
// as 'credit_card'
$payer = new Payer();
$payer->setPayment_method("paypal");

// ### Amount
// Let's you specify a payment amount.
$amount = new Amount();
$amount->setCurrency("CAD");
$amount->setTotal($total);

// ### Transaction
// A transaction defines the contract of a
// payment - what is the payment for and who
// is fulfilling it. Transaction is created with
// a `Payee` and `Amount` types
$transaction = new Transaction();
$transaction->setAmount($amount);
$transaction->setDescription("Wally's Widget Warehouse - Payment");

// ### Redirect urls
// Set the urls that the buyer must be redirected to after 
// payment approval/ cancellation.
$redirectUrls = new RedirectUrls();
$redirectUrls->setReturn_url(getBaseUrl() . "/confirmation.php?success=1");
$redirectUrls->setCancel_url(getBaseUrl() . "/confirmation.php?cancel=1");

// ### Payment
// A Payment Resource; create one using
// the above types and intent as 'sale'
$payment = new Payment();
$payment->setIntent("sale");
$payment->setPayer($payer);
$payment->setRedirect_urls($redirectUrls);
$payment->setTransactions(array($transaction));

// ### Api Context
// Pass in a `ApiContext` object to authenticate 
// the call and to send a unique request id 
// (that ensures idempotency). The SDK generates
// a request id if you do not pass one explicitly. 
$apiContext = new ApiContext($cred, 'Request' . time());

// ### Create Payment
// Create a payment by posting to the APIService
// using a valid apiContext
// The return object contains the status and the
// url to which the buyer must be redirected to
// for payment approval
try {
	$payment->create($apiContext);
} catch (\PPConnectionException $ex) {
	echo "Exception: " . $ex->getMessage() . PHP_EOL;
	var_dump($ex->getData());	
	exit(1);
}

// ### Redirect buyer to paypal
// Retrieve buyer approval url from the `payment` object.
foreach($payment->getLinks() as $link) {
	if($link->getRel() == 'approval_url') {
		$redirectUrl = $link->getHref();
	}
}
// It is not really a great idea to store the payment id
// in the session. In a real world app, please store the
// payment id in a database.
$_SESSION['paymentId'] = $payment->getId();
if(isset($redirectUrl)) {
	header("Location: $redirectUrl");
	exit;
}
