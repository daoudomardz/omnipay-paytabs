<?php

namespace Omnipay\PayTabs\Message;

use Omnipay\Common\Message\AbstractResponse;

/**
 * 2Checkout Complete Purchase Response
 */
class CompletePurchaseResponse extends AbstractResponse
{
    
    public function isSuccessful()
    {
        return $this->getCode() == 100;
    }

    public function getTransactionReference()
    {
        return $this->data->pt_invoice_id;
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
