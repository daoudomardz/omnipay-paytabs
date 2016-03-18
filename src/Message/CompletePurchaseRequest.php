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
        return $this->httpRequest->request->all();
    }

    public function sendData($data)
    {
		$response = $this->httpClient->post($this->endpoint, $data);
        return $this->response = new CompletePurchaseResponse($this, json_decode($response));
    }
}
