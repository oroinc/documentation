@fixture-OroPaymentTermBundle:PaymentTermIntegration.yml
@fixture-ACMEFastShippingBundle:Checkout.yml
Feature: Check FastShipping method
  In order to be able to use Fast Shipping shipping method
  As an administrator
  I want to use Fast Shipping shipping method during checkout

  Scenario: Create different window session
    Given sessions active:
      | Admin | first_session  |
      | Buyer | second_session |

  Scenario: Create new integration
    Given I operate as the Admin
    And I login as administrator
    When I go to System/Integrations/Manage Integrations
    And I click "Create Integration"
    And I select "Fast Shipping" from "Type"
    And I fill "Fast Shipping Integration Form" with:
      | Name        | Fast Shipping |
      | Label       | Fast Shipping |
    And I save and close form
    Then I should see "Integration saved" flash message

  Scenario: Configure shipping rules
    Given I go to System/Shipping Rules
    And I click "Create Shipping Rule"
    And fill "Shipping Rule" with:
      | Enable     | true          |
      | Name       | fast shipping |
      | Sort Order | 1             |
      | Currency   | USD           |
      | Method     | Fast Shipping |
    And fill "Fast Shipping Rule Form" with:
      | With Present Enabled    | true |
      | With Present            | 15   |
      | Without Present Enabled | true |
      | Without Present         | 10   |
    And I save and close form
    Then I should see "Shipping rule has been saved" flash message

  Scenario: Successful order with Fast Shipping shipping method
    Given I operate as the Buyer
    And There are products in the system available for order
    And I signed in as AmandaRCole@example.org on the store frontend
    When I open page with shopping list List 1
    And I click "Create Order"
    And I select "Fifth avenue, 10115 Berlin, Germany" on the "Billing Information" checkout step and press Continue
    And I select "Fifth avenue, 10115 Berlin, Germany" on the "Shipping Information" checkout step and press Continue
    And I check "Fast Shipping Rate With Present" on the "Shipping Method" checkout step and press Continue
    And I check "Payment Terms" on the "Payment" checkout step and press Continue
    And I fill "Checkout Order Review Form" with:
      | PO Number | TEST_PO_NUMBER |
    And I should see "Subtotal $10.00"
    And I should see "Shipping $15.00"
    And I should see "Total $25.00"
    And I click "Submit Order"
    Then I see the "Thank You" page with "Thank You For Your Purchase!" title
