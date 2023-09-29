@documentation
@fixture-AcmeDemoBundle:question.yml

Feature: Data audit

  Scenario: Check Question Data auditable
    Given I login as administrator
    And I go to Acme/Demo/Question
    Then I should see following grid containing rows:
      | Subject      | Description      |
      | TestSubject1 | TestDescription1 |
      | TestSubject2 | TestDescription2 |
    When I click edit TestSubject1 in grid
    And I fill "Question Form" with:
      | Subject | TestSubjectNew |
    And I save and close form
    Then I should see "Question has been saved" flash message
    And I go to System/Data Audit
    Then I should see following grid containing rows:
      | Action | Entity Type | Entity Name                     |
      | Update | Question    | TestSubjectNew TestDescription1 |
