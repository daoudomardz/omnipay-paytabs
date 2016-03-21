<?php

namespace Omnipay\PayTabs\Message;

use Omnipay\Common\Message\AbstractResponse;

/**
 * 2Checkout Complete Purchase Response
 */
class ValidateSecretKeyResponse extends AbstractResponse
{
    
    public function isSuccessful()
    {
        return $this->getCode() == 4000;
    }

    public function getMessage()
    {
    	return $this->data->result;
    }

    public function getCode()
    {
    	return $this->data->response_code;
    }

}
