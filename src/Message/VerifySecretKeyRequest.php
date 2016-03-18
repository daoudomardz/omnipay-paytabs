<?php

namespace Omnipay\PayTabs\Message;

use Omnipay\Common\Message\AbstractRequest;

/**
 * 2Checkout Purchase Request
 */
class VerifySecretKeyRequest extends AbstractRequest
{
    protected $endpoint = 'https://www.paytabs.com/apiv2/validate_secret_key';

    public function getMerchantEmail()
    {
        return $this->getParameter('merchantEmail');
    }

    public function setMerchantEmail($value)
    {
        return $this->setParameter('merchantEmail', $value);
    }

    public function getSecretKey()
    {
        return $this->getParameter('secretKey');
    }

    public function setSecretKey($value)
    {
        return $this->setParameter('secretKey', $value);
    }

    public function getData()
    {
    	$this->validate('amount', 'returnUrl');

    	$data = array();

    	$data['merchant_email'] = $this->getMerchantEmail();
    	$data['secret_key'] = $this->getSecretKey();

        return $data;
    }

    public function sendData($data)
    {
    	$response = $this->httpClient->post($this->endpoint, $data);
    	return $this->response = new VerifySecretKeyResponse($this, json_decode($response));
    }

}
