<?php

namespace Omnipay\PayTabs\Message;

use Omnipay\Common\Message\AbstractRequest;

/**
 * 2Checkout Purchase Request
 */
class PurchaseRequest extends AbstractRequest
{
	protected $version = 'jestillore/omnipay-paytabs 2.0.x-dev';
    protected $endpoint = 'https://www.paytabs.com/apiv2/create_pay_page';

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

    public function getTitle()
    {
        return $this->getParameter('title');
    }

    public function setTitle($value)
    {
        return $this->setParameter('title', $value);
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

    public function getData()
    {
    	$this->validate('amount', 'returnUrl');

    	$data = array();

    	$data['merchant_email'] = $this->getMerchantEmail();
    	$data['secret_key'] = $this->getSecretKey();
    	$data['site_url'] = $this->getSiteUrl();
    	$data['return_url'] = $this->getReturnUrl();
    	$data['title'] = $this->getTitle();
    	$data['ip_merchant'] = $this->getMerchantIp();
    	$data['msg_lang'] = $this->getLanguage();

    	$data['currency'] = $this->getCurrency();
    	$data['ip_customer'] = $this->getClientIp();
    	$data['reference_no'] = $this->getTransactionId();

    	if ($this->getCard())
    	{
    		$card = $this->getCard();

	    	$data['cc_first_name '] = $card->getFirstName();
	    	$data['cc_last_name'] = $card->getLastName();
	    	$data['cc_phone_number'] = $card->getPhone();
	    	$data['phone_number'] = $card->getPhone();
	    	$data['email'] = $card->getEmail();
	    	$data['billing_address'] = $card->getAddress1() . ', ' . $card->getAddress2();
	    	$data['state'] = $card->getState();
	    	$data['city'] = $card->getCity();
	    	$data['postal_code'] = str_pad($card->getPostcode(), 5, '0', STR_PAD_LEFT);
	    	$data['country'] = $card->getCountry();

	    	$data['shipping_first_name'] = $card->getShippingFirstName();
	    	$data['shipping_last_name'] = $card->getShippingLastName();
	    	$data['address_shipping'] = $card->getShippingAddress1() . ', ' . $card->getShippingAddress2();
	    	$data['state_shipping'] = $card->getShippingState();
	    	$data['city_shipping'] = $card->getShippingCity();
	    	$data['postal_code_shipping'] = str_pad($card->getShippingPostcode(), 5, '0', STR_PAD_LEFT);
	    	$data['country_shipping'] = $card->getShippingCountry();
    	}

    	$data['amount'] = $this->getAmount();

    	// line items
    	$products = [];
    	$prices = [];
    	$quantities = [];

    	foreach ($this->getItems() as $item)
    	{
    		$products[] = $item->getName();
    		$prices[] = $item->getPrice();
    		$quantities[] = $item->getQuantity();
    	}

    	$data['products_per_title'] = join(' || ', $products);
    	$data['unit_price'] = join(' || ', $prices);
    	$data['quantity'] = join(' || ', $quantity);

    	$data['cms_with_version'] = $this->version;

    	$data['other_charges'] = $this->getParameter('otherCharges');
    	$data['discount'] = $this->getParameter('discount');

        return $data;
    }

    public function sendData($data)
    {
    	$response = $this->httpClient->post($this->endpoint, $data);
    	return $this->response = new PurchaseResponse($this, json_decode($response));
    }

}
