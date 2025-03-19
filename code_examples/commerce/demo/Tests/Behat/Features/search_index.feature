@documentation
@fixture-AcmeDemoBundle:question.yml

Feature: Search index

  Scenario: Check search configuration index for question
    Given I login as administrator
    When type "TestSubject" in "search"
    Then I should see 2 search suggestions
    When I click "Search Submit"
    Then I should be on Search Result page
    And I should see following search entity types:
      | Type      | N | isSelected |
      | Questions | 2 |            |
    And number of records should be 2
    And I should see following search results:
      | Title                         | Type     |
      | TestSubject2 TestDescription2 | Question |
      | TestSubject1 TestDescription1 | Question |

  Scenario: Search by Questions
    When I select "Question" from search types
    And type "TestSubject" in "search"
    Then I should see 2 search suggestions
    When I click "Search Submit"
    Then I should be on Search Result page
    And I should see following search entity types:
      | Type      | N | isSelected |
      | All       | 2 |            |
      | Questions | 2 | yes        |
    And number of records should be 2
    And I should see following search results:
      | Title                         | Type     |
      | TestSubject2 TestDescription2 | Question |
      | TestSubject1 TestDescription1 | Question |
