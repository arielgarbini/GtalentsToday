<?php

namespace Vanguard\Services\Paypal;

use PayPal\Api\Payment;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;

class PaypalService
{

    private $apiContext;

    public function __construct()
    {
        $this->apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'AVAbTI-_PYcnh969wTzjeDeOeNtnJqer_YC3Sy7fgvaZdqZ3fQN7F1_NLgrb8oaapBKgt_oC-z1Y3mhk',     // ClientID
                'EJGfs2O5OVvYlE8FtLsrhl2r7VYNzTgKHNxUaYYWPbBJM8EVNDx05Z-MCgERY4ksMlMgeITHhV7GJ8K3'      // ClientSecret
            )
        );
    }

    public function initPay($cant, $value)
    {
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $item1 = new Item();
        $item1->setName(\Lang::get('app.credits'))
            ->setCurrency('USD')
            ->setQuantity($cant)
            ->setPrice($value);
        $itemList = new ItemList();
        $itemList->setItems(array($item1));

        $details = new Details();
        $details->setSubtotal($value*$cant);

        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal($value*$cant)
            ->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription(\Lang::get('app.payment_description'))
            ->setInvoiceNumber(uniqid());

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('credits.getpay.success', $value*$cant)."?success=true")
            ->setCancelUrl(route('credits.getpay.cancel')."?success=true");

        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));

        $payment->create($this->apiContext);
        return $payment;
    }

    public function pay($paymentId, $amountt)
    {
        $payment = Payment::get($paymentId, $this->apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($_GET['PayerID']);

        $transaction = new Transaction();
        $amount = new Amount();
        $details = new Details();
        $details->setSubtotal($amountt);

        $amount->setCurrency('USD');
        $amount->setTotal($amountt);
        $amount->setDetails($details);
        $transaction->setAmount($amount);

        $execution->addTransaction($transaction);
        try {
            $result = $payment->execute($execution, $this->apiContext);
            return $result;
        } catch (\Exception $ex) {
            return false;
        }
    }
}