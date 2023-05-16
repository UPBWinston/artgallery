<?php


namespace App\Tests\Functional;

use App\Tests\FunctionalTester;

class CreateArtCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
    }

    public function createArtWithSales(FunctionalTester $I)
    {
        $loginUrl = "/login";
        $I->amOnPage($loginUrl);
        $I->see("Please sign in");

        $I->fillField('#inputUsername', 'sam');
        $I->fillField('#inputPassword', 'sale');

        $I->click('Sign in');
        $I->click('art');
        $I->click('Create new');

        $I->fillField('#art2_title', 'test art');
        $I->fillField('#art2_description', 'test description');
        $I->fillField('#art2_year', '2000');
        $I->fillField('#art2_price', '1500');
        $I->click('#art2_isAvailable');
        $I->selectOption('#art2_Artist', 'Wolfgang Bang Bang');
        $I->click('Save');

        $I->see('Art index');
    }
}
