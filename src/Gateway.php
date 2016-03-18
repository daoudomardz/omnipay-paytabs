<?php

namespace Omnipay\PayTabs;

use Omnipay\Common\AbstractGateway;
use Omnipay\PayTabs\Message\CompletePurchaseRequest;
use Omnipay\PayTabs\Message\PurchaseRequest;

/**
 * PayTabs Gateway
 *
 * @link https://www.paytabs.com/PayTabs-API-Documentation-v2.4.pdf
 */
class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'PayTabs';
    }

    public function getDefaultParameters()
    {
        return array();
    }

    public function purchase(array $parameters = array())
    {
        
    }

    public function completePurchase(array $parameters = array())
    {
        
    }
}
