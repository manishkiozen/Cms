Feature: Carrier management

  In order to deliver products
  As a webshop owner
  I need to maintain carriers and shipping methods

  Scenario: User opens carrier management
    When I open carrier management
    Then I should see the carrier index
    And I should be able to add a carrier

  Scenario: User adds a carrier
    When I add a carrier
    Then the carrier should be created
    And I should see the carrier edit form

  Scenario: User wants to update a carrier
    When I click a carrier in the carrier index
    Then I should see the carrier edit form

  Scenario: User updates a carrier
    When I update the carrier
    Then the carrier should be updated
    And I should see the carrier edit form

  Scenario: User changes default carrier
    When I add another carrier
    And I change the default carrier
    Then the default carrier should be changed