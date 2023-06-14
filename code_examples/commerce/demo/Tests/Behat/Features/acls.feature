@documentation
Feature: Acls

  Scenario: Check acme demo acls new permission
    Given I login as administrator
    When I go to System/ User Management/ Roles
    And click view Administrator in grid
    And the role has following active permissions:
      | Favorites | View:Global | Create:Global | Edit:Global | Delete:Global | Assign:Global | Label for Permission 2:Global |

  Scenario: Check demo Favorite custom access rule
    When I go to Acme/ Demo/ Favorites
    Then I should see following grid containing rows:
      | Name           | Value                |
      | First favorite | First favorite value |
      | Last favorite  | Last favorite value  |
    And I should not see "Second favorite"

  Scenario: Check CSRF protection
    When I go to Acme/ Demo/ Favorites
    Then I should see following buttons:
      | Custom Action         |
      | Protected CSRF Action |
    And I click "Protected CSRF Action"
    Then I should see following grid containing rows:
      | Name           | Value                |
      | First favorite | First favorite value |
      | Last favorite  | Last favorite value  |
    When I reload the page
    Then I should see "403. Forbidden You don't have permission to access this page."
