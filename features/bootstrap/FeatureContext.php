<?php

use App\ShippingRule;
use App\User;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;
use Illuminate\Support\Facades\Artisan;
use Laracasts\Behat\Context\DatabaseTransactions;
use Laracasts\Behat\Context\Migrator;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements Context, SnippetAcceptingContext
{
    use DatabaseTransactions,
        Migrator;

    use AttributeTrait,
        CarrierTrait,
        CountryTrait,
        ProductTrait,
        ProductTypeTrait,
        ShippingRuleTrait,
        SupplierTrait,
        UserTrait,
        VatRateTrait;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * Dumps the Mink page content and terminates the test.
     */
    public function dumpContent()
    {
        dd($this->getMink()->getSession()->getPage()->getContent());
    }

    /**
     * @When I register an administrator
     */
    public function iRegisterAnAdministrator()
    {
        Artisan::call('admin:register', [
            'name' => $this->user_name,
            'email' => $this->user_email,
            'password' => $this->user_password
        ]);
    }

    /**
     * @Then the user should be created
     */
    public function userShouldBeCreated()
    {
        PHPUnit_Framework_Assert::assertInstanceOf(User::class, $this->currentUser());
        PHPUnit_Framework_Assert::assertContains('Administrator user registered: ' . $this->user_email, Artisan::output());
    }

    /**
     * @Then the user should be an administrator
     */
    public function userShouldBeAnAdministrator()
    {
        PHPUnit_Framework_Assert::assertEquals('admin', $this->currentUser()->role);
    }

    /**
     * @Given I have an account
     */
    public function iHaveAnAccount()
    {
        $this->iRegisterAnAdministrator();
    }

    /**
     * @Then I should be warned that the user already exists
     */
    public function iShouldBeWarnedThatTheUserAlreadyExists()
    {
        PHPUnit_Framework_Assert::assertContains('User already exists: ' . $this->user_email, Artisan::output());
    }

    /**
     * @When I log in with valid credentials
     */
    public function iLogInWithValidCredentials()
    {
        $this->iHaveAnAccount();
        $this->login($this->user_email, $this->user_password);
    }

    /**
     * @Then I should be notified that I am logged in
     */
    public function iShouldBeNotifiedThatIAmLoggedIn()
    {
        $this->assertPageContainsText(trans('authentication.succeeded'));
    }

    /**
     * @When I log in with invalid credentials
     */
    public function iLogInWithInvalidCredentials()
    {
        $this->iHaveAnAccount();
        $this->login($this->user_email, 'invalid ' . $this->user_password);
    }

    /**
     * @Then I should be warned that login failed
     */
    public function iShouldBeWarnedThatLoginFailed()
    {
        $this->assertPageContainsText(trans('authentication.failed'));
    }

    /**
     * @Given I am logged in
     */
    public function iAmLoggedIn()
    {
        $this->iHaveAnAccount();
        $this->login($this->user_email, $this->user_password);
    }

    /**
     * @When I log out
     */
    public function iLogOut()
    {
        $this->iAmLoggedIn();
        $this->logout();
    }

    /**
     * @Then I should be notified that I am logged out
     */
    public function iShouldBeNotifiedThatIAmLoggedOut()
    {
        $this->assertPageContainsText(trans('authentication.logged_out'));
    }


    /**
     * @When I visit the product index
     */
    public function iVisitTheProductIndex()
    {
        $this->iAmLoggedIn();
        $this->clickLink(trans('products.index'));
    }

    /**
     * @Then I should see the product index
     */
    public function iShouldSeeTheProductIndex()
    {
        $this->assertElementOnPage('#product-index');
    }

    /**
     * @Then I should be able to add a product
     */
    public function iShouldBeAbleToAddAProduct()
    {
        $this->assertElementOnPage('a[href="' . route('product.create') . '"]');
    }

    /**
     * @When I add a product
     */
    public function iAddAProduct()
    {
        $this->iAssignTheAttributeToTheProductType();
        $this->iVisitTheProductIndex();
        $this->clickLink(trans('labels.create'));
        $this->selectOption('product_type_id', $this->product_type_description);
        $this->fillField('product_number', $this->product_number);
        $this->fillField('description', $this->product_description);
        $this->pressButton(trans('labels.save'));
    }

    /**
     * @Then The product should be created
     */
    public function theProductShouldBeCreated()
    {
        $product = $this->currentProduct();
        PHPUnit_Framework_Assert::assertNotEmpty($product->id);
        PHPUnit_Framework_Assert::assertEquals($this->product_description, $product->description);
    }

    /**
     * @Then I should see the product edit form
     */
    public function iShouldSeeTheProductEditForm()
    {
        $product = $this->currentProduct();
        $this->assertElementOnPage('form[action="' . route('product.update', $product->id) . '"]');
    }

    /**
     * @When I update the product
     */
    public function iUpdateTheProduct()
    {
        $this->iAddAVatRate();
        $this->iAddASupplier();

        $this->iClickAProductInTheProductIndex();
        $this->fillField('detailed_description', $this->product_detailed_description);
        $this->fillField('ean', $this->product_ean);

        $this->checkOption('can_be_purchased');
        $this->selectOption('supplier_id', $this->supplier_name);
        $this->fillField('delivery_time', $this->product_delivery_time);
        $this->fillField('purchase_price', $this->product_purchase_price);

        $this->checkOption('can_be_sold');
        $this->fillField('selling_price', $this->product_selling_price);

        $this->fillField('recommended_retail_price', $this->product_recommended_retail_price);
        $this->fillField($this->attribute_description, $this->attribute_value);
        $this->pressButton(trans('labels.save'));
    }

    /**
     * @Then The product should be updated
     */
    public function theProductShouldBeUpdated()
    {
        $product = $this->currentProduct();
        PHPUnit_Framework_Assert::assertEquals($this->product_detailed_description, $product->detailed_description);
        PHPUnit_Framework_Assert::assertEquals($this->product_ean, $product->ean);

        PHPUnit_Framework_Assert::assertTrue((bool)$product->can_be_purchased);
        PHPUnit_Framework_Assert::assertEquals($this->product_delivery_time, $product->delivery_time);
        PHPUnit_Framework_Assert::assertEquals($this->product_purchase_price, $product->purchase_price);

        PHPUnit_Framework_Assert::assertTrue((bool)$product->can_be_sold);
        PHPUnit_Framework_Assert::assertEquals($this->product_selling_price, $product->selling_price);
        PHPUnit_Framework_Assert::assertEquals($this->product_recommended_retail_price, $product->recommended_retail_price);

        PHPUnit_Framework_Assert::assertEquals($this->attribute_value, $product->attributes->first()->pivot->value);
    }

    /**
     * @When I search for a product by keyword
     */
    public function iSearchForAProductByKeyword()
    {
        $this->iAddAProduct();
        $this->iVisitTheProductIndex();
        $this->fillField('q', $this->product_description);
        $this->pressButton(trans('labels.search'));
    }

    /**
     * @When I search for a product by product number
     */
    public function iSearchForAProductByProductNumber()
    {
        $this->iAddAProduct();
        $this->iVisitTheProductIndex();
        $this->fillField('q', $this->product_number);
        $this->pressButton(trans('labels.search'));
    }

    /**
     * @Then I should see the product in the product index
     */
    public function iShouldSeeTheProductInTheProductIndex()
    {
        $this->assertPageContainsText($this->product_description);
    }

    /**
     * @Then I should be able to reset my query
     */
    public function iShouldBeAbleToResetMyQuery()
    {
        $this->assertElementOnPage('a.reset-q');
    }

    /**
     * @When I click a product in the product index
     */
    public function iClickAProductInTheProductIndex()
    {
        $this->iAddAProduct();
        $this->iVisitTheProductIndex();
        $this->clickLink($this->product_number);
    }

    /**
     * @When I trash the product
     */
    public function iTrashTheProduct()
    {
        $this->iClickAProductInTheProductIndex();
        $this->pressButton(trans('labels.trash'));
        $this->assertPageNotContainsText($this->product_number);
    }

    /**
     * @Then I should be notified the product is trashed
     */
    public function iShouldBeNotifiedTheProductIsTrashed()
    {
        $this->assertPageContainsText(trans('products.trashed', ['description' => $this->product_description]));
    }

    /**
     * @When I open country management
     */
    public function iOpenCountryManagement()
    {
        $this->iAmLoggedIn();
        $this->clickLink(trans('countries.index'));
    }

    /**
     * @Then I should see the country index
     */
    public function iShouldSeeTheCountryIndex()
    {
        $this->assertElementOnPage('table#country-index');
    }

    /**
     * @Then I should be able to add a country
     */
    public function iShouldBeAbleToAddACountry()
    {
        $this->assertElementOnPage('a[href="' . route('country.create') . '"]');
    }

    /**
     * @When I add a country
     */
    public function iAddACountry()
    {
        $this->iOpenCountryManagement();
        $this->clickLink(trans('labels.create'));
        $this->fillField('iso_code_2', $this->country_iso_code_2);
        $this->fillField('name', $this->country_name);
        $this->pressButton(trans('labels.save'));
    }

    /**
     * @Then the country should be created
     */
    public function theCountryShouldBeCreated()
    {
        $country = $this->currentCountry();
        PHPUnit_Framework_Assert::assertEquals($this->country_iso_code_2, $country->iso_code_2);
        PHPUnit_Framework_Assert::assertEquals($this->country_name, $country->name);
        PHPUnit_Framework_Assert::assertEquals(false, (bool)$country->is_area_of_sales);
    }

    /**
     * @Then I should see the country edit form
     */
    public function iShouldSeeTheCountryEditForm()
    {
        $this->assertElementOnPage('form[action="' . route('country.update', $this->currentCountry()->id)  . '"]');
    }

    /**
     * @When I click a country in the country index
     */
    public function iClickACountryInTheCountryIndex()
    {
        $this->iAddACountry();
        $this->iOpenCountryManagement();
        $this->clickLink($this->country_name);
    }

    /**
     * @When I update the country
     */
    public function iUpdateTheCountry()
    {
        $this->iClickACountryInTheCountryIndex();
        $this->checkOption('is_area_of_sales');
        $this->pressButton(trans('labels.save'));
    }

    /**
     * @Then the country should be updated
     */
    public function theCountryShouldBeUpdated()
    {
        PHPUnit_Framework_Assert::assertTrue((bool)$this->currentCountry()->is_area_of_sales);
    }


    /**
     * @When I open VAT management
     */
    public function iOpenVatManagement()
    {
        $this->iAmLoggedIn();
        $this->clickLink(trans('vat-rates.index'));
    }

    /**
     * @Then I should see the VAT index
     */
    public function iShouldSeeTheVatIndex()
    {
        $this->assertElementOnPage('#vat-rate-index');
    }

    /**
     * @Then I should be able to add a VAT rate
     */
    public function iShouldBeAbleToAddAVatRate()
    {
        $this->assertElementOnPage('a[href="' . route('vat-rate.create') . '"]');
    }

    /**
     * @When I add a VAT rate
     */
    public function iAddAVatRate()
    {
        $this->iOpenVatManagement();
        $this->clickLink(trans('labels.create'));
        $this->fillField('description', $this->vat_description);
        $this->fillField('rate', $this->vat_rate);
        $this->pressButton(trans('labels.save'));
    }

    /**
     * @Then the VAT rate should be created
     */
    public function theVatRateShouldBeCreated()
    {
        $rate = $this->currentVatRate();
        PHPUnit_Framework_Assert::assertEquals($this->vat_description, $rate->description);
        PHPUnit_Framework_Assert::assertEquals($this->vat_rate, $rate->rate);
    }

    /**
     * @Then I should see the VAT rate edit form
     */
    public function iShouldSeeTheVatRateEditForm()
    {
        $this->assertElementOnPage('form[action="' . route('vat-rate.update', 1) . '"]');
    }

    /**
     * @When I click a VAT rate in the VAT rate index
     */
    public function iClickAVatRateInTheVatRateIndex()
    {
        $this->iAddAVatRate();
        $this->iOpenVatManagement();
        $this->clickLink($this->vat_description);
    }

    /**
     * @When I update the VAT rate
     */
    public function iUpdateTheVatRate()
    {
        $this->iClickAVatRateInTheVatRateIndex();
        $this->fillField('description', $this->vat_updated_description);
        $this->fillField('rate', $this->vat_rate + 1);
        $this->pressButton(trans('labels.save'));
    }

    /**
     * @Then the VAT rate should be updated
     */
    public function theVatRateShouldBeUpdated()
    {
        $rate = $this->updatedVatRate();
        PHPUnit_Framework_Assert::assertEquals($this->vat_updated_description, $rate->description);
        PHPUnit_Framework_Assert::assertEquals($this->vat_rate + 1, $rate->rate);
    }

    /**
     * @When I assign a vat rate to the product
     */
    public function iAssignAVatRateToTheProduct()
    {
        $this->iAddAVatRate();
        $this->iAddAProduct();
        $this->iClickAProductInTheProductIndex();
        $this->selectOption('vat_rate_id', $this->vat_description);
        $this->pressButton(trans('labels.save'));
    }

    /**
     * @Then the product should have a vat rate
     */
    public function theProductShouldHaveAVatRate()
    {
        PHPUnit_Framework_Assert::assertEquals($this->currentVatRate()->description, $this->currentProduct()->vatRate->description);
    }

    /**
     * @When I open product type management
     */
    public function iOpenProductTypeManagement()
    {
        $this->iAmLoggedIn();
        $this->clickLink(trans('product-types.index'));
    }

    /**
     * @Then I should see the product type index
     */
    public function iShouldSeeTheProductTypeIndex()
    {
        $this->assertElementOnPage('#product-type-index');
    }

    /**
     * @Then I should be able to add a product type
     */
    public function iShouldBeAbleToAddAProductType()
    {
        $this->assertElementOnPage('a[href="' . route('product-type.create') . '"]');
    }

    /**
     * @When I add a product type
     */
    public function iAddAProductType()
    {
        $this->iOpenProductTypeManagement();
        $this->clickLink(trans('labels.create'));
        $this->fillField('description', $this->product_type_description);
        $this->pressButton(trans('labels.save'));
    }

    /**
     * @Then the product type should be created
     */
    public function theProductTypeShouldBeCreated()
    {
        $type = $this->currentProductType();
        PHPUnit_Framework_Assert::assertEquals($this->product_type_description, $type->description);
    }

    /**
     * @Then I should see the product type edit form
     */
    public function iShouldSeeTheProductTypeEditForm()
    {
        $this->assertElementOnPage('form[action="' . route('product-type.update', $this->currentProductType()->id) . '"]');
    }

    /**
     * @When I click a product type in the product type index
     */
    public function iClickAProductTypeInTheProductTypeIndex()
    {
        $this->iAddAProductType();
        $this->iOpenProductTypeManagement();
        $this->clickLink($this->product_type_description);
    }

    /**
     * @When I update the product type
     */
    public function iUpdateTheProductType()
    {
        $this->iClickAProductTypeInTheProductTypeIndex();
        $this->fillField('description', $this->product_type_description . ' shelf');
        $this->pressButton(trans('labels.save'));
    }

    /**
     * @Then the product type should be updated
     */
    public function theProductTypeShouldBeUpdated()
    {
        $type = $this->currentProductType();
        PHPUnit_Framework_Assert::assertEquals($this->product_type_description . ' shelf', $type->description);
    }

    /**
     * @When I open attribute management
     */
    public function iOpenAttributeManagement()
    {
        $this->iAmLoggedIn();
        $this->clickLink(trans('attributes.index'));
    }

    /**
     * @Then I should see the attribute index
     */
    public function iShouldSeeTheAttributeIndex()
    {
        $this->assertElementOnPage('#attribute-index');
    }

    /**
     * @Then I should be able to add an attribute
     */
    public function iShouldBeAbleToAddAnAttribute()
    {
        $this->assertElementOnPage('a[href="' . route('attribute.create') . '"]');
    }

    /**
     * @When I add an attribute
     */
    public function iAddAnAttribute()
    {
        $this->iOpenAttributeManagement();
        $this->clickLink(trans('labels.create'));
        $this->fillField('description', $this->attribute_description);
        $this->selectOption('type', $this->attribute_type);
        $this->pressButton(trans('labels.save'));
    }

    /**
     * @Then the attribute should be created
     */
    public function theAttributeShouldBeCreated()
    {
        $attribute = $this->currentAttribute();
        PHPUnit_Framework_Assert::assertEquals($this->attribute_description, $attribute->description);
    }

    /**
     * @Then I should see the attribute edit form
     */
    public function iShouldSeeTheAttributeEditForm()
    {
        $attribute = $this->currentAttribute();
        $this->assertElementOnPage('form[action="' . route('attribute.update', $attribute->id) . '"]');
    }

    /**
     * @When I click an attribute in the attribute index
     */
    public function iClickAnAttributeInTheAttributeIndex()
    {
        $this->iAddAnAttribute();
        $this->iOpenAttributeManagement();
        $this->clickLink($this->attribute_description);
    }

    /**
     * @When I update the attribute
     */
    public function iUpdateTheAttribute()
    {
        $this->iClickAnAttributeInTheAttributeIndex();
        $this->fillField('unit_of_measurement', $this->attribute_unit_of_measurement);
        $this->pressButton(trans('labels.save'));
    }

    /**
     * @Then the attribute should be updated
     */
    public function theAttributeShouldBeUpdated()
    {
        $attribute = $this->currentAttribute();
        PHPUnit_Framework_Assert::assertEquals($this->attribute_unit_of_measurement, $attribute->unit_of_measurement);
    }

    /**
     * @When I assign the attribute to the product type
     */
    public function iAssignTheAttributeToTheProductType()
    {
        $this->iAddAProductType();
        $this->iAddAnAttribute();
        $this->iOpenProductTypeManagement();
        $this->clickLink($this->product_type_description);
        $this->checkOption($this->attribute_description);
        $this->pressButton(trans('labels.save'));
    }

    /**
     * @Then the product type should have an attribute
     */
    public function theProductTypeShouldHaveAnAttribute()
    {
        PHPUnit_Framework_Assert::assertTrue($this->currentProductType()->attributes->contains($this->currentAttribute()));
    }

    /**
     * @When I add a an attribute with a list of values
     */
    public function iAddAAnAttributeWithAListOfValues()
    {
        $this->iOpenAttributeManagement();
        $this->clickLink(trans('labels.create'));
        $this->fillField('description', $this->attribute_list_of_values_description);
        $this->selectOption('type', 'in');
        $this->pressButton(trans('labels.save'));
    }

    /**
     * @When I add values to the attribute
     */
    public function iAddValuesToTheAttribute()
    {
        $attribute = $this->currentListOfValuesAttribute();
        $this->assertElementOnPage('form[action="' . route('attribute.update', $attribute->id) . '"]');

        foreach ($this->attribute_list_of_values as $value) {
            $this->fillField('add_value', $value);
            $this->pressButton(trans('labels.save'));
        }
    }

    /**
     * @Then I should see the attribute edit form with values
     */
    public function iShouldSeeTheAttributeEditFormWithValues()
    {
        $attribute = $this->currentListOfValuesAttribute();
        $this->assertElementOnPage('form[action="' . route('attribute.update', $attribute->id) . '"]');

        foreach ($this->attribute_list_of_values as $value) {
            $this->assertPageContainsText($value);
        }
    }

    /**
     * @When I open supplier management
     */
    public function iOpenSupplierManagement()
    {
        $this->iAmLoggedIn();
        $this->clickLink(trans('suppliers.index'));
    }

    /**
     * @Then I should see the supplier index
     */
    public function iShouldSeeTheSupplierIndex()
    {
        $this->assertElementOnPage('#supplier-index');
    }

    /**
     * @Then I should be able to add a supplier
     */
    public function iShouldBeAbleToAddASupplier()
    {
        $this->assertElementOnPage('a[href="' . route('supplier.create') . '"]');
    }

    /**
     * @When I add a supplier
     */
    public function iAddASupplier()
    {
        $this->iOpenSupplierManagement();
        $this->clickLink(trans('labels.create'));
        $this->fillField('name', $this->supplier_name);
        $this->pressButton(trans('labels.save'));
    }

    /**
     * @Then the supplier should be created
     */
    public function theSupplierShouldBeCreated()
    {
        PHPUnit_Framework_Assert::assertEquals($this->supplier_name, $this->currentSupplier()->name);
    }

    /**
     * @Then I should see the supplier edit form
     */
    public function iShouldSeeTheSupplierEditForm()
    {
        $this->assertElementOnPage('form[action="' . route('supplier.update', $this->currentSupplier()->id) . '"]');
    }

    /**
     * @When I click a supplier in the supplier index
     */
    public function iClickASupplierInTheSupplierIndex()
    {
        $this->iAddASupplier();
        $this->iOpenSupplierManagement();
        $this->clickLink($this->supplier_name);
    }

    /**
     * @When I update the supplier
     */
    public function iUpdateTheSupplier()
    {
        $this->iClickASupplierInTheSupplierIndex();
        $this->fillField('attention', $this->supplier_attention);
        $this->fillField('email', $this->supplier_email);
        $this->pressButton(trans('labels.save'));
    }

    /**
     * @Then the supplier should be updated
     */
    public function theSupplierShouldBeUpdated()
    {
        PHPUnit_Framework_Assert::assertEquals($this->supplier_email, $this->currentSupplier()->email);
    }

    /**
     * @When I open carrier management
     */
    public function iOpenCarrierManagement()
    {
        $this->iAmLoggedIn();
        $this->clickLink(trans('carriers.index'));
    }

    /**
     * @Then I should see the carrier index
     */
    public function iShouldSeeTheCarrierIndex()
    {
        $this->assertElementOnPage('#carrier-index');
    }

    /**
     * @Then I should be able to add a carrier
     */
    public function iShouldBeAbleToAddACarrier()
    {
        $this->assertElementOnPage('a[href="'. route('carrier.create') . '"]');
    }

    /**
     * @When I add a carrier
     */
    public function iAddACarrier()
    {
        $this->iOpenCarrierManagement();
        $this->clickLink(trans('labels.create'));
        $this->fillField('name', $this->carrier_name);
        $this->pressButton(trans('labels.save'));
    }

    /**
     * @Then the carrier should be created
     */
    public function theCarrierShouldBeCreated()
    {
        $carrier = $this->currentCarrier();
        PHPUnit_Framework_Assert::assertEquals($this->carrier_name, $carrier->name);
        PHPUnit_Framework_Assert::assertTrue((bool)$carrier->is_default_carrier);
    }

    /**
     * @Then I should see the carrier edit form
     */
    public function iShouldSeeTheCarrierEditForm()
    {
        $this->assertElementOnPage('form[action="' . route('carrier.update', 1) . '"]');
    }

    /**
     * @When I click a carrier in the carrier index
     */
    public function iClickACarrierInTheCarrierIndex()
    {
        $this->iAddACarrier();
        $this->iOpenCarrierManagement();
        $this->clickLink($this->carrier_name);
    }

    /**
     * @When I update the carrier
     */
    public function iUpdateTheCarrier()
    {
        $this->iClickACarrierInTheCarrierIndex();
        $this->fillField('name', $this->another_carrier_name);
        $this->pressButton(trans('labels.save'));
    }

    /**
     * @Then the carrier should be updated
     */
    public function theCarrierShouldBeUpdated()
    {
        PHPUnit_Framework_Assert::assertEquals($this->another_carrier_name, $this->anotherCarrier()->name);
    }

    /**
     * @When I add another carrier
     */
    public function iAddAnotherCarrier()
    {
        $this->iAddACarrier();
        $this->iOpenCarrierManagement();
        $this->clickLink(trans('labels.create'));
        $this->fillField('name', $this->another_carrier_name);
        $this->pressButton(trans('labels.save'));
    }

    /**
     * @When I change the default carrier
     */
    public function iChangeTheDefaultCarrier()
    {
        $this->iOpenCarrierManagement();
        $this->clickLink($this->another_carrier_name);
        $this->checkOption('is_default_carrier');
        $this->pressButton(trans('labels.save'));
    }

    /**
     * @Then the default carrier should be changed
     */
    public function theDefaultCarrierShouldBeChanged()
    {
        PHPUnit_Framework_Assert::assertNotTrue((bool)$this->currentCarrier()->is_default_carrier);
        PHPUnit_Framework_Assert::assertTrue((bool)$this->anotherCarrier()->is_default_carrier);
    }

    /**
     * @When I open shipping rule management
     */
    public function iOpenShippingRuleManagement()
    {
        $this->iAmLoggedIn();
        $this->clickLink(trans('shipping-rules.index'));
    }

    /**
     * @Then I should see the shipping rule index
     */
    public function iShouldSeeTheShippingRuleIndex()
    {
        $this->assertElementOnPage('#shipping-rule-index');
    }

    /**
     * @Then I should be able to add a shipping rule
     */
    public function iShouldBeAbleToAddAShippingRule()
    {
        $this->assertElementOnPage('a[href="' . route('shipping-rule.create') . '"]');
    }

    /**
     * @When I add a shipping rule
     */
    public function iAddAShippingRule()
    {
        $this->iAddACarrier();
        $this->iAddACountry();
        $this->iOpenShippingRuleManagement();
        $this->clickLink(trans('labels.create'));
        $this->selectOption('carrier_id', $this->carrier_name);
        $this->selectOption('country_id', $this->country_name);
        $this->pressButton(trans('labels.save'));
    }

    /**
     * @Then the shipping rule should be created
     */
    public function theShippingRuleShouldBeCreated()
    {
        $rule = $this->currentShippingRule();
        PHPUnit_Framework_Assert::assertEquals($this->currentCarrier()->id, $rule->carrier_id);
        PHPUnit_Framework_Assert::assertEquals($this->currentCountry()->id, $rule->country_id);
    }

    /**
     * @Then I should see the shipping rule edit form
     */
    public function iShouldSeeTheShippingRuleEditForm()
    {
        $this->assertElementOnPage('form[action="' . route('shipping-rule.update', $this->currentShippingRule()->id) . '"]');
    }

    /**
     * @When I click a shipping rule in the shipping rule index
     */
    public function iClickAShippingRuleInTheShippingRuleIndex()
    {
        $this->iAddAShippingRule();
        $this->iOpenShippingRuleManagement();
        $this->clickLink($this->carrier_name);
    }

    /**
     * @When I update the shipping rule
     */
    public function iUpdateTheShippingRule()
    {
        $this->iClickAShippingRuleInTheShippingRuleIndex();
        $this->checkOption('is_enabled');
        $this->fillField('delivery_time', $this->shipping_rule_delivery_time);
        $this->pressButton(trans('labels.save'));
    }

    /**
     * @Then the shipping rule should be updated
     */
    public function theShippingRuleShouldBeUpdated()
    {
        $rule = $this->currentShippingRule();
        PHPUnit_Framework_Assert::assertTrue((bool)$rule->is_enabled);
        PHPUnit_Framework_Assert::assertEquals($this->shipping_rule_delivery_time, $rule->delivery_time);
    }
}
