Feature: Landing Page content purify
  In order to restrict access to not allowed elements and attributes
  As an Administrator
  I want to purify text data for Landing Page form

  Scenario: Create a new Landing Page with iframe element
    Given I login as administrator
    When I go to Marketing / Landing Pages
    And click "Create Landing Page"
    And I fill "CMS Page Form" with:
      | Titles  | Other page                                                  |
      | Content | Some content <iframe src=\"https://example.com/\"></iframe> |
    And I save and close form
    Then I should see "Page has been saved" flash message
    And should see "Some Content"
