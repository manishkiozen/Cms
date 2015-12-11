Feature: Product type and attribute management

  In order to describe products in the best possible way
  As a webshop owner
  I want to define product types and their attributes

  Scenario: User opens product type management
    When I open product type management
    Then I should see the product type index
    And I should be able to add a product type

  Scenario: User adds a product type
    When I add a product type
    Then the product type should be created
    And I should see the product type edit form

  Scenario: User wants to update a product type
    When I click a product type in the product type index
    Then I should see the product type edit form

  Scenario: User updates a product type
    When I update the product type
    Then the product type should be updated
    And I should see the product type edit form


  Scenario: User opens attribute management
    When I open attribute management
    Then I should see the attribute index
    And I should be able to add an attribute

  Scenario: User adds an attribute
    When I add an attribute
    Then the attribute should be created
    And I should see the attribute edit form

  Scenario: User wants to update an attribute
    When I click an attribute in the attribute index
    Then I should see the attribute edit form

  Scenario: User updates an attribute
    When I update the attribute
    Then the attribute should be updated
    And I should see the attribute edit form

  Scenario: User assigns an attribute to a product type
    When I assign the attribute to the product type
    Then the product type should have an attribute
    And I should see the product type edit form

  Scenario: User adds values to an attribute
    When I add a an attribute with a list of values
    And I add values to the attribute
    Then I should see the attribute edit form with values
