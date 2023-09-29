@documentation
Feature: Check versioned fixture and datagrid view list

  Scenario: Check acme demo acls new permission
    Given I login as administrator
    When I go to Acme/ Demo/ Favorites
    And I sort grid by "Id"
    And I sort grid by "Id" again
    Then I should see following grid containing rows:
      | Name           | Value                |
      | First favorite | First favorite value |
      | Last favorite  | Last favorite value  |

  Scenario: Check the functionality of the datagrid view list
    When I click on "View Icon"
    And I click "First Example View"
    Then I should see following grid:
      | Name           | Value                | View Count |
      | First favorite | First favorite value | 14         |
    And there is one record in grid

    When I click on "View Icon"
    And I click "Second Example View"
    Then I should see following grid:
      | Name          | View Count | Value               |
      | Last favorite | 18         | Last favorite value |
    And there is one record in grid
