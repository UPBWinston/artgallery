<?php


namespace App\Tests\Functional;

use App\Tests\FunctionalTester;

class ShowArtDetailsAsCustomerCest
{
    public function _before(FunctionalTester $I)
    {
        $loginUrl = "/login";
        $I->amOnPage($loginUrl);

        $I->fillField('#inputUsername', 'customer');
        $I->fillField('#inputPassword', 'customer');
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
    }

    public function placeOrder(FunctionalTester $I)
    {
        $I->click('Sign in');
        $I->click('art');
        $I->see('Art Index');
        $I->dontSee('delete');
        $I->dontSee('edit');

        $I->click('//a[@href="/art/3"]');
        $I->see('Lonely Pony');
        $I->see('Such Pony much lonely');
        $I->see('1993');
        $I->see('1500');
        $I->see('Yes');
    }
}
