@documentation
@ticket-BB-23463
@fixture-OroSaleBundle:Quote.yml

Feature: Check additional workflow grid actions
  In order to check additional grids with workflow actions on some entity view pages
  As an User
  I should have the opportunity to refresh and reset grids without errors

  Scenario: Check customer quotes grid
    Given I login as administrator
    When I go to Customers/Customers
    And I click View first customer in grid
    And I click "Quotes" in scrollspy
    And I click "Process acme demo b2b quote backoffice flow transition"
    Then I should see "Workflow was transited" flash message

    When I click "Quotes" in scrollspy
    And I refresh "Quotes by Customer Grid" grid
    Then number of records in "Quotes by Customer Grid" should be 1
    And I should not see "Data loading failed, try reloading the page. If the issue appears again please contact your administrator."

    When I reset "Quotes by Customer Grid" grid
    Then number of records in "Quotes by Customer Grid" should be 1
    And I should not see "Data loading failed, try reloading the page. If the issue appears again please contact your administrator."
