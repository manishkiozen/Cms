Feature: Authentication

  In order to use the system
  As a user
  I need to be able to log in and log out

  Scenario: User logs in with valid credentials
    When I log in with valid credentials
    Then I should be notified that I am logged in

  Scenario: User logs in with invalid credentials
    When I log in with invalid credentials
    Then I should be warned that login failed

  Scenario: User logs out
    When I log out
    Then I should be notified that I am logged out