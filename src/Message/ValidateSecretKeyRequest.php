<?php

namespace Omnipay\PayTabs\Message;

use Omnipay\Common\Exception\InvalidResponseException;

/**
 * 2Checkout Complete Purchase Request
 */
class ValidateSecretKeyRequest extends PurchaseRequest
{
    protected $endpoint = 'https://www.paytabs.com/apiv2/validate_secret_key';

    public function getData()
    {
        $data = array();

        $data['merchant_email'] = $this->getMerchantEmail();
        $data['secret_key'] = $this->getSecretKey();

        return $data;
    }

    public function sendData($data)
    {
        $request = $this->httpClient->post($this->endpoint, null, $data);
        $response = $request->send();
        return $this->response = new ValidateSecretKeyResponse($this, json_decode($response->getBody()));
    }
}
