@documentation
@fixture-AcmeDemoBundle:question.yml

Feature: Check report segment

  Scenario: Check question segment and report
    Given I login as administrator
    And I go to Reports & Segments/Question
    And I should see "Export Grid"
    When I click "Export Grid"
    And I click "CSV"
    Then I should see "Export started successfully. You will receive email notification upon completion." flash message
    Then I should see following grid containing rows:
      | Subject      | Description      |
      | TestSubject1 | TestDescription1 |
      | TestSubject2 | TestDescription2 |
