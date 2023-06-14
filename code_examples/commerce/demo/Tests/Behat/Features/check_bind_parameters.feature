@documentation
Feature: Check bind parameters

  Scenario: Login to backoffice
    Given I login as administrator

  Scenario: Create Document
    When I go to Acme/Demo/Documents
    And I click "Create Document"
    And I fill "Document Form" with:
      | Subject     | Subject document          |
      | Description | Test description document |
      | Priority    | minor                     |
    And I save and close form
    Then I should see "Document has been saved" flash message

  Scenario: Create Question
    When I go to Acme/Demo/Question
    And I click "Create Question"
    And I fill "Question Form" with:
      | Subject     | Subject question          |
      | Description | Test description question |
      | Priority    | minor                     |
    And I save and close form
    Then I should see "Question has been saved" flash message

  Scenario: Check view page Priority
    When I go to Acme/Demo/Priorities
    And I click "View" on row "minor" in grid
    Then I should see following "PriorityDocumentGrid" grid containing rows:
      | Subject          | Description               | Priority |
      | Subject document | Test description document | minor    |
    And I should see following "PriorityQuestionGrid" grid containing rows:
      | Subject          | Description               | Priority |
      | Subject question | Test description question | minor    |
