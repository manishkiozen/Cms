Feature: Product management

  In order to sell my products
  As a webshop owner
  I want to create a database with products

  Scenario: User lists the products
    When I visit the product index
    Then I should see the product index
    And I should be able to add a product

  Scenario: User adds a product
    When I add a product
    Then the product should be created
    And I should see the product edit form

  Scenario: User wants to update a product
    When I click a product in the product index
    Then I should see the product edit form

  Scenario: User updates a product
    When I update the product
    Then the product should be updated
    And I should see the product edit form

  Scenario: User searches for a product by keyword
    When I search for a product by keyword
    Then I should see the product in the product index
    And I should be able to reset my query

  Scenario: User searches for a product by product number
    When I search for a product by product number
    Then I should see the product in the product index
    And I should be able to reset my query

  Scenario: User trashes a product
    When I trash the product
    Then I should be notified the product is trashed
    And I should see the product index
