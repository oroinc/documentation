@documentation
Feature: Check attribute family

  Scenario: Check attribute family
    Given I login as administrator
    When I go to Acme/Demo/Document Attributes
    And I click "Create Attribute"
    When I fill form with:
      | Field Name | StringAttribute1 |
      | Type       | String           |
    And I click "Continue"
    And I save and close form
    Then I should see "Attribute was successfully saved" flash message

    When I click "Create Attribute"
    And I fill form with:
      | Field Name | StringAttribute2 |
      | Type       | String           |
    And I click "Continue"
    And I save and close form
    Then I should see "Attribute was successfully saved" flash message

    And I should see following grid containing rows:
      | Name             | Data Type |
      | StringAttribute1 | String    |
      | StringAttribute2 | String    |

    When I go to Acme/Demo/Document Families
    And I click "Create Product Family"
    And I fill "Product Family Form" with:
      | Code       | family                               | Product Families |
      | Label      | family                               |                  |
      | Enabled    | True                                 |                  |
      | Attributes | [StringAttribute1, StringAttribute2] |                  |
    And save and close form
    Then should see "Product Family was successfully saved" flash message

    And I should see following grid containing rows:
      | Code   | Label  |
      | family | family |

    When I go to Acme/Demo/Document Attributes
    Then I should see following grid containing rows:
      | Name             | Data Type | Product Families |
      | StringAttribute1 | String    | family           |
      | StringAttribute2 | String    | family           |
