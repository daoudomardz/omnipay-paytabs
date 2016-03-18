<?php

namespace Omnipay\TwoCheckout;

use Omnipay\Tests\GatewayTestCase;
use Omnipay\Common\CreditCard;

class GatewayTest extends GatewayTestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testPurchase()
    {
        
    }

    /**
     * @expectedException Omnipay\Common\Exception\InvalidResponseException
     */
    public function testCompletePurchaseError()
    {
        
    }

    public function testCompletePurchaseSuccess()
    {
        
    }
}
