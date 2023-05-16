<?php


namespace App\Tests\Functional;

use App\Tests\FunctionalTester;
use http\Exception\RuntimeException;


class PlaceOrderCest
{
    public function _before(FunctionalTester $I)
    {
        $loginUrl = "/login";
        $I->amOnPage($loginUrl);

        $I->fillField('#inputUsername', 'customer');
        $I->fillField('#inputPassword', 'customer');
        $I->click('Sign in');
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
    }

    public function placeOrder(FunctionalTester $I)
    {
        $I->click('sale event');
        $I->click('//a[text()="show art"][1]');
        $I->click('//a[text()="place order"][1]');

        $orderId = $I->grabTextFrom('//table[@class="active-table"]/tbody/tr[1]/td[1]');
        $I->click('//a[text()="cancel"][1]');
        $I->see($orderId, '//table[@class="inactive-table"]/tbody/tr/td[1]');
    }
}
