@documentation
Feature: Check workflow

  Scenario: Check acme demo workflow
    Given I login as administrator
    When I go to System / Workflows
    And I check "User" in Related Entity filter
    Then I should see "Introduction flow" in grid with following data:
      | Name           | Introduction flow |
      | Related Entity | User              |
      | Applications   | commerce          |
      | Active         | Yes               |
