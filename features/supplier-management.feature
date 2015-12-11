Feature: Supplier management

  In order to purchase products
  As a webshop owner
  I need to maintain a table with suppliers

  Scenario: User opens supplier management
    When I open supplier management
    Then I should see the supplier index
    And I should be able to add a supplier

  Scenario: User adds a supplier
    When I add a supplier
    Then the supplier should be created
    And I should see the supplier edit form

  Scenario: User wants to update a supplier
    When I click a supplier in the supplier index
    Then I should see the supplier edit form

  Scenario: User updates a supplier
    When I update the supplier
    Then the supplier should be updated
    And I should see the supplier edit form
