@documentation
Feature: WYSIWYG check RTE UI

  Scenario: Create landing page
    Given I login as administrator
    And go to Marketing/ Content Widgets
    And click "Create Content Widget"
    And fill "Content Widget Form" with:
      | Type | Copyright   |
      | Name | test-inline |
    Then I save and close form
    And go to Marketing / Landing Pages
    And click "Create Landing Page"
    And I fill in Landing Page Titles field with "WYSIWYG UI page"
    And I save form

  Scenario: Check inline content widget
    When I add new component "Text" from panel to editor area
    And I select component in canvas by tree:
      | text | 1 |
    And I enter "Lorem ipsum, dolor sit amet consectetur adipisicing elit." text to "SelectedComponent" component
    And I check wysiwyg content in "CMS Page Content":
      | 1 | <div>Lorem ipsum, dolor sit amet consectetur adipisicing elit. |
      | 2 | </div>                                                         |
    And I select component in canvas by tree:
      | text | 1 |
    And I enter to edit mode "SelectedComponent" component in canvas
    Then I select text "ipsum," range in selected component
    And I apply "inlineWidget" action in RTE
    And I click on test-inline in grid
    And I check wysiwyg content in "CMS Page Content":
      | 1 | <div>Lorem                                                                                                                                                         |
      | 2 | <span data-title="test-inline" data-type="copyright" class="content-widget-inline">{{ widget("test-inline") }}</span> dolor sit amet consectetur adipisicing elit. |
      | 3 | </div>                                                                                                                                                             |
    And I save form
    And I select component in canvas by tree:
      | text | 1 |
    Then I select "InlineContentWidget" component in canvas
    And I click "WysiwygToolbarActionDelete"
    And I check wysiwyg content in "CMS Page Content":
      | 1 | <div>Lorem  dolor sit amet consectetur adipisicing elit. |
      | 2 | </div>                                                   |
    And I clear canvas in WYSIWYG
    And I save form
