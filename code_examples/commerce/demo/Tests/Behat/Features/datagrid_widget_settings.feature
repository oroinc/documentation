@documentation

Feature: Datagrid widget settings
  In order to use a datagrid widget on the dashboard
  As an administrator
  I want to be able to select grid view on the datagrid widget options form

  Scenario: Add datagrid widget to dashboard
    Given I login as administrator
    And I click "Add widget"
    And I type "All users" in "Enter keyword"
    When I click "First Widget Add Button"
    And I click "Close" in modal window
    Then I should see "All Users" widget on dashboard

  Scenario: Add customer grid view for Users grid
    Given I go to System/User Management/Users
    And I click Options in grid view
    And I click "Save As"
    And I type "Custom View" in "name"
    And I click "Save" in modal window
    Then I should see "View has been successfully created" flash message

  Scenario: Check grid views in widget configuration
    Given I am on dashboard
    When I click "All Users Actions"
    And I click "Configure" in "All Users" widget
    Then I should see "Grid View Widget Setting Select" with options:
      | Value          |
      | All Users      |
      | Active Users   |
      | Cannot login   |
      | Disabled Users |
      | Custom View    |
    When I fill form with:
      | Grid view | Custom View |
    And I click "Widget Save Button"
    Then I should see "Widget has been successfully configured" flash message
