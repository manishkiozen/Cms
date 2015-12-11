Feature: Country management

  In order to ship products to other countries
  As a webshop owner
  I need to maintain a table with countries

  Scenario: User opens country management
    When I open country management
    Then I should see the country index
    And I should be able to add a country

  Scenario: User adds a country
    When I add a country
    Then the country should be created
    And I should see the country edit form

  Scenario: User wants to update a country
    When I click a country in the country index
    Then I should see the country edit form

  Scenario: User updates a country
    When I update the country
    Then the country should be updated
    And I should see the country edit form
