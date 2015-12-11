Feature: User registration

  In order to maintain the webshop contents
  As as shop owner
  I want to set up an administrator account by command line

  Scenario: Shop owner registers administrator account
    When I register an administrator
    Then the user should be created
    And the user should be an administrator

  Scenario: Shop owner tries to register twice
    Given I have an account
    When I register an administrator
    Then I should be warned that the user already exists
