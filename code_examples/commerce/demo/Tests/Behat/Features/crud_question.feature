@documentation
@fixture-AcmeDemoBundle:priority.yml
Feature: Crud question

  Scenario: Login to backoffice
    Given I login as administrator

  Scenario Outline: Create new Question
    When I go to Acme/Demo/Question
    And I click "Create Question"
    And I fill "Question Form" with:
      | Subject     | <Subject>             |
      | Description | Description <Subject> |
      | Due Date    | <DueDate>             |
      | Priority    | <Priority>            |
    And I save and close form
    Then I should see "Question has been saved" flash message
    Examples:
      | Subject   | DueDate                 | Priority |
      | Question1 | <DateTime:+1 day 12:00> | low      |
      | Question2 | <DateTime:+2 day 12:00> | normal   |
      | Question3 | <DateTime:+3 day 12:00> | high     |

  Scenario: Check the sorting grid by Due Date default
    When I go to Acme/Demo/Question
    And I filter Description as Contains "Description Question"
    And I should see following grid:
      | Subject   | Description           | Due Date     | Priority | User     |
      | Question3 | Description Question3 | +3 day 12:00 | high     | John Doe |
      | Question2 | Description Question2 | +2 day 12:00 | normal   | John Doe |
      | Question1 | Description Question1 | +1 day 12:00 | low      | John Doe |

  Scenario: Sorting grid
    When sort grid by Subject
    Then Question1 must be first record
    But when I sort grid by Subject again
    Then Question3 must be first record

  Scenario: Filter grid
    When filter Subject as is equal to "Question2"
    Then number of records should be 1
    And I should see following grid:
      | Subject   | Description           | Due Date     | Priority | User     |
      | Question2 | Description Question2 | +2 day 12:00 | normal   | John Doe |
    And I reset Subject filter

  Scenario: Edit Question
    When I click "Edit" on row "Question1" in grid
    And I fill form with:
      | Subject     | Question1 update   |
      | Description | Description update |
      | Priority    | high               |
    And I save and close form
    Then I should see "Question has been saved" flash message
    And I should see Question with:
      | Subject     | Question1 update   |
      | Description | Description update |
      | Priority    | high               |

  Scenario: Delete Question
    When I click "Delete Question"
    And I confirm deletion
    Then I should see "Question deleted" flash message
