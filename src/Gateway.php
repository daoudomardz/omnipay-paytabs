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
        return array(
            'merchantEmail' => '',
            'secretKey' => '',
            'siteUrl' => '',
            'language' => 'English',
            'merchantIp' => ''
            );
    }

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

    public function getSiteUrl()
    {
        return $this->getParameter('siteUrl');
    }

    public function setSiteUrl($value)
    {
        return $this->setParameter('siteUrl', $value);
    }

    public function getLanguage()
    {
        return $this->getParameter('language');
    }

    public function setLanguage($value)
    {
        return $this->setParameter('language', $value);
    }

    public function getMerchantIp()
    {
        return $this->getParameter('merchantIp');
    }

    public function setMerchantIp($value)
    {
        return $this->setParameter('merchantIp', $value);
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\PayTabs\Message\PurchaseRequest', $parameters);
    }

    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\PayTabs\Message\CompletePurchaseRequest', $parameters);
    }
    
}
