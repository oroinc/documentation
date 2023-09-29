@documentation
Feature: Check custom entity

  Scenario: Check a New Custom Entities
    Given I login as administrator
    When I go to System / Entities / Entity Management
    And filter Name as is equal to "CustomEntity"
    And I click View CustomEntity in grid
    Then I should see following grid containing rows:
      | Name  | Data Type   |
      | name  | String      |
      | users | Many to one |
