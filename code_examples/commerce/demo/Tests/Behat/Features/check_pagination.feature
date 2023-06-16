@documentation
Feature: Check pagination

  Scenario: Create new Question
    Given I login as administrator
    When I go to Acme/Demo/Question
    And I click "View" on row "Important task" in grid
    Then I should see an "Entity pagination" element
