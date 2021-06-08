@regression
@ticket-BB-20137
Feature: Check wysiwyg field migrations
  In order to be able to use WYSIWYG fields
  As an Administrator
  I want to be able to see fields which was added or changed by the database migrations

  Scenario: Create blog post
    Given I login as administrator
    When I go to System / Entities / Entity Management / Blog Posts
    And click "Create Blog Post"
    And I fill "Blog Post Form" with:
      | Content | <div>Some Content</div> |
      | Teaser  | <div>Some Teaser</div>  |
    And save and close form
    Then I should see "Blog Post has been saved successfully" flash message

  Scenario: Check datagrid
    When I go to System / Entities / Entity Management / Blog Posts
    Then I should see following grid:
      | Content      |
      | Some Content |

  Scenario: Check view page
    When I click view Some Content in grid
    Then I should see "Current content view is simplified, please check the page on the Storefront to see the actual result."
    And I should see "Some Content"
    And I should see "Some Teaser"

