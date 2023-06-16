@documentation
Feature: Check versioned fixture

  Scenario: Check acme demo acls new permission
    Given I login as administrator
    When I go to Acme/ Demo/ Favorites
    And I sort grid by "Id"
    And I sort grid by "Id" again
    Then I should see following grid containing rows:
      | Name           | Value                |
      | First favorite | First favorite value |
      | Last favorite  | Last favorite value  |
