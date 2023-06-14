@documentation
@fixture-AcmeDemoBundle:question.yml

Feature: Search index

  Scenario: Check search configuration index for question
    Given I login as administrator
    And I click "Search"
    And type "TestSubject" in "search"
    When I click "Search Submit"
    Then I should be on Search Result page
    And I should see following search entity types:
      | Type      | N | isSelected |
      | Questions | 2 |            |
