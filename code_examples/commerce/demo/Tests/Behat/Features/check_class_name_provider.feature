@documentation
Feature: Check class name provider

  Scenario: Check Priority ClassName
    Given I login as administrator

    When I go to Acme/Demo/Priorities
    And I click "Create Priority"
    And I fill form with:
      | label | test_label |
    And I save and close form
    Then I should see "Priority has been saved" flash message

    And I go to System/Data Audit
    Then I should see following grid containing rows:
      | Action | Entity Type | Entity Name |
      | Create | PRIORITY    | test_label  |
