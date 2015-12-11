Feature: VAT management

  In order to invoice the correct amount of tax
  As a shop owner
  I need to maintain VAT rates

  Scenario: User opens VAT rate management
    When I open VAT management
    Then I should see the VAT index
    And I should be able to add a VAT rate

  Scenario: User adds a VAT rate
    When I add a VAT rate
    Then the VAT rate should be created
    And I should see the VAT rate edit form

  Scenario: User wants to update a VAT rate
    When I click a VAT rate in the VAT rate index
    Then I should see the VAT rate edit form

  Scenario: User updates a VAT rate
    When I update the VAT rate
    Then the VAT rate should be updated
    And I should see the VAT rate edit form

  Scenario: User assigns a VAT rate to a product
    When I assign a vat rate to the product
    Then the product should have a vat rate
    And I should see the product edit form
