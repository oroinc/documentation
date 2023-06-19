@ticket-BB-17908
@fixture-OroCMSBundle:AclDraftsUsers.yml
Feature: Acme Block Drafts
  To check the operation of the project
  As an administrator
  I need to create a draft and check base operations

  Scenario: Create Acme Block
    Given I login as administrator
    When I go to Acme/ Acme Blocks
    And I click "Create Acme Block"
    And I fill "Acme Block Form" with:
      | Title   | Original title   |
      | Content | Original content |
    And I save and close form
    Then I should see "Acme Block has been saved" flash message

  Scenario: Prepare draft
    When I click "Create draft"
    Then I should see "UiWindow" with elements:
      | Title        | Action Confirmation                                                                       |
      | Content      | Only the changes from the following fields will be transferred to a draft: content, title |
      | okButton     | Yes                                                                                       |
      | cancelButton | Cancel                                                                                    |
    When I click "Yes" in confirmation dialogue
    Then I should see "Draft has been saved" flash message
    When I fill "Acme Block Form" with:
      | Title   | Draft title   |
      | Content | Draft content |
    And I save and close form
    Then I should see "Acme Block has been saved" flash message

  Scenario: Check draft grid actions
    When I go to Acme/ Acme Blocks
    And I click view "Original title" in grid
    Then I should see following grid:
      | Title       | Owner    |
      | Draft title | John Doe |
    And I should see following actions for Draft title in grid:
      | View          |
      | Edit          |
      | Delete        |
      | Duplicate     |
      | Publish draft |

  Scenario: Disable permissions
    When I go to System/User Management/Roles
    And click edit "Administrator" in grid
    And select following permissions:
      | Acme Block | Create Drafts:None | Delete All Drafts:None | Delete Own Drafts:None | Edit All Drafts:None | View All Drafts:None |
    And I save and close form
    Then should see "Role saved" flash message

  Scenario: Check permission
    When I go to Acme/ Acme Blocks
    And I click view "Original title" in grid
    Then I should not see "Create draft"
    And I should see following grid:
      | Title       | Owner    |
      | Draft title | John Doe |
    And number of records in "Acme Block drafts Grid" should be 1
    And I should see following actions for Draft title in grid:
      | View          |
      | Edit          |
      | Publish draft |
    And I should not see following actions for Draft title in grid:
      | Delete    |
      | Duplicate |

#  Uncomment after BAP-19574
#  Scenario: Check Publish Draft
#    Given I click view "Draft title" in grid
#    And I click "Publish draft"
#    Then I should see "Are you sure you want to publicate draft?"
#    When I click "Yes" in confirmation dialogue
#    Then I should see "Draft has been published" flash message
