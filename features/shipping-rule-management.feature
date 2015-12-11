Feature: Shipping rule management

  In order to offer shipping options
  As a webshop owner
  I need to maintain a table with shipping rules

  Scenario: User opens shipping rule management
    When I open shipping rule management
    Then I should see the shipping rule index
    And I should be able to add a shipping rule

  Scenario: User adds a shipping rule
    When I add a shipping rule
    Then the shipping rule should be created
    And I should see the shipping rule edit form

  Scenario: User wants to update a shipping rule
    When I click a shipping rule in the shipping rule index
    Then I should see the shipping rule edit form

  Scenario: User updates a shipping rule
    When I update the shipping rule
    Then the shipping rule should be updated
    And I should see the shipping rule edit form
