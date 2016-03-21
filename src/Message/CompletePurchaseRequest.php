<?php

namespace Omnipay\PayTabs\Message;

use Omnipay\Common\Exception\InvalidResponseException;

/**
 * 2Checkout Complete Purchase Request
 */
class CompletePurchaseRequest extends PurchaseRequest
{
	protected $endpoint = 'https://www.paytabs.com/apiv2/verify_payment';

    public function getData()
    {
        $data = array();

        $data['merchant_email'] = $this->getMerchantEmail();
        $data['secret_key'] = $this->getSecretKey();
        $data['payment_reference'] = $this->getTransactionReference();

        return $data;
    }

    public function sendData($data)
    {
        $request = $this->httpClient->post($this->endpoint, null, $data);
        $response = $request->send();
        return $this->response = new CompletePurchaseResponse($this, json_decode($response->getBody()));
    }
}
