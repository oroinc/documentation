@container-incompatible
@fixture-OroFlatRateShippingBundle:FlatRateIntegration.yml
@fixture-OroPaymentTermBundle:PaymentTermIntegration.yml
@fixture-OroCheckoutBundle:Checkout.yml
Feature: Check CollectOnDelivery payment method
  In order to be able to use CollectOnDelivery payment method
  As an administrator
  I want to be able to see actual payment status for Order when it's paid by CollectOnDelivery payment method

  Scenario: Create different window session
    Given sessions active:
      | Admin | first_session  |
      | Buyer | second_session |

  Scenario: Create new CollectOnDelivery Order Integration
    Given I operate as the Admin
    And I login as administrator
    When I go to System/Integrations/Manage Integrations
    And I click "Create Integration"
    And I select "Collect on delivery" from "Type"
    And I fill "Collect On Delivery Integration Form" with:
      | Name        | Collect on Delivery |
      | Label       | Collect on Delivery |
      | Short Label | Collect on Delivery |
    And I save and close form
    Then I should see "Integration saved" flash message

  Scenario: Create new Payment Rule for CollectOnDelivery Order integration
    Given I operate as the Admin
    When I go to System/Payment Rules
    And I click "Create Payment Rule"
    And I check "Enabled"
    And I fill in "Name" with "Collect on Delivery"
    And I fill in "Sort Order" with "1"
    And I select "Collect on Delivery" from "Method"
    And I click "Add Method Button"
    And I save and close form
    Then I should see "Payment rule has been saved" flash message

  Scenario: Successful order payment with Collect on Delivery payment method
    Given I operate as the Buyer
    And There are products in the system available for order
    And I signed in as AmandaRCole@example.org on the store frontend
    When I open page with shopping list List 1
    And I click "Create Order"
    And I select "Fifth avenue, 10115 Berlin, Germany" on the "Billing Information" checkout step and press Continue
    And I select "Fifth avenue, 10115 Berlin, Germany" on the "Shipping Information" checkout step and press Continue
    And I check "Flat Rate" on the "Shipping Method" checkout step and press Continue
    And I check "Collect on Delivery" on the "Payment" checkout step and press Continue
    And I fill "Checkout Order Review Form" with:
      | PO Number | TEST_PO_NUMBER |
    And I should see "Subtotal $10.00"
    And I should see "Shipping $3.00"
    And I should see "Total $13.00"
    And I click "Submit Order"
    Then I see the "Thank You" page with "Thank You For Your Purchase!" title
