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
        $I->dontSee('sale event entry');
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

    public function testValidLoginWithAdmin(FunctionalTester $I)
    {
        $loginUrl = "/login";
        $I->amOnPage($loginUrl);
        $I->see("Please sign in");

        $I->fillField('#inputUsername', 'john');
        $I->fillField('#inputPassword', 'doe');
        $I->click('Sign in');

        $I->see("user");
        $I->see("log out");
        $I->see("Welcome to our Art Gallery");

        $I->dontSee("art", "a");
        $I->dontSee("artist");
        $I->dontSee("sale event entry");
        $I->dontSee("orders");

        $I->click('Log out');
        $I->see('Please sign in');
    }
}
