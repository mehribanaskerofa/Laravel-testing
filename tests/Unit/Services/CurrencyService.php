<?php

namespace Services;

use PHPUnit\Framework\TestCase;

class CurrencyService extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function testConvertUsdToEurSuccessful(): void
    {
        $result=(new \App\Services\CurrencyService())->convert(100,'usd','eur');
        $this->assertEquals($result,98);
    }
    public  function testConvertUsdToAznReturnsZero(){
        $result=(new \App\Services\CurrencyService())->convert(100,'usd','azn');
        $this->assertEquals($result,0);
    }
}
