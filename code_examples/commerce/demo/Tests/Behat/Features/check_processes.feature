@documentation
Feature: Check processes

  Scenario: Check acme demo process definition
    Given I login as administrator
    When I go to System / Processes
    And I check "Contact" in Related Entity filter
    Then I should see "Contact Definition" in grid with following data:
      | Name           | Contact Definition |
      | Related Entity | Contact            |
      | Enabled        | Yes                |
