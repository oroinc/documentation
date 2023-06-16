@documentation
Feature: Crud document

  Scenario: Login to backoffice
    Given I login as administrator

  Scenario Outline: Create priority Outline
    When I go to Acme/Demo/Priorities
    And I click "Create Priority"
    And I fill form with:
      | label | <Type> |
    And I save and close form
    Then I should see "Priority has been saved" flash message
    Examples:
      | Type   |
      | low    |
      | normal |
      | high   |

  Scenario: Validate unique priority label
    When I go to Acme/Demo/Priorities
    And I click "Create Priority"
    And I fill form with:
      | Label | high |
    And I save and close form
    Then I should see validation errors:
      | Label | This value is already used. |
    And I click "Cancel"

  Scenario: Create new Document
    When I go to Acme/Demo/Documents
    And I click "Create Document"
    And I fill "Document Form" with:
      | Subject             | Document                |
      | Description         | Test description        |
      | Due Date            | <DateTime:+1 day 12:00> |
      | Priority            | low                     |
      | My serialized Field | Test serialized field   |
      | Document Rating     | 1                       |
    And I save and close form
    Then I should see "Document has been saved" flash message

  Scenario: Validation for Extended Fields - integer
    When I click "Edit Document"
    And I fill form with:
      | Document Rating | --1 |
    And I save and close form
    Then I should see validation errors:
      | Document Rating | This value should contain only numbers! |
    And I click "Cancel"

  Scenario: Edit Document
    When I click "Edit" on row "Document" in grid
    And I fill form with:
      | Subject             | Document update         |
      | Description         | Description update      |
      | Priority            | normal                  |
      | My serialized Field | Serialized field update |
      | Document Rating     | 2                       |
    And I save and close form
    Then I should see "Document has been saved" flash message

  Scenario: View Document
    When I go to Acme/Demo/Documents
    Then I should see following grid:
      | Subject         | Description        | Due Date     | Priority | My serialized Field     | Document Rating |
      | Document update | Description update | +1 day 12:00 | normal   | Serialized field update | 2               |

  Scenario: Delete Document
    When I click delete "Document" in grid
    And I confirm deletion
    Then I should see "Document deleted" flash message
    And there is no records in grid

  Scenario: Check a New Object Configuration Attribute
    When I go to System / Entities / Entity Management
    And filter Name as is equal to "Document"
    Then I should see following grid:
      | Name     | Demo Attr |
      | Document | MyValue   |
    And I click "Edit" on row "Document" in grid
    And I should see "Demo Attr"
    And I should see "Comment"
