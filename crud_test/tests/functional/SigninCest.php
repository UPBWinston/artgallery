<?php


namespace App\Tests\Functional;

use App\Tests\FunctionalTester;

class SigninCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
    }

    public function testValidLoginWithCustomer(FunctionalTester $I)
    {
        $loginUrl = "/login";
        $I->amOnPage($loginUrl);
        $I->see("Please sign in");

        $I->fillField('#inputUsername', 'customer');
        $I->fillField('#inputPassword', 'customer');

        $I->click('Sign in');
        $I->see("Welcome to our Art Gallery");
    }

    public function testValidLoginWithSales(FunctionalTester $I)
    {
        $loginUrl = "/login";
        $I->amOnPage($loginUrl);
        $I->see("Please sign in");

        $I->fillField('#inputUsername', 'sam');
        $I->fillField('#inputPassword', 'sale');

        $I->click('Sign in');
        $I->see("Welcome to our Art Gallery");
    }
}
