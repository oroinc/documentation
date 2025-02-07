.. _bundle-docs-commerce-address-validation-bundle:

AddressValidationBundle
=======================

|AddressValidationBundle| implements an address validation feature that uses address validation aware integration to find address suggestions for the entered address and show them to the user.

Configuration
-------------

The bundle adds a new feature, oro_address_validation, that enables or disables address validation for users in the storefront and in the back-office. To enable the feature, navigate to System Configuration > Commerce > Shipping > Address Validation.

Integrate a New Address Validation Service into System Configuration
--------------------------------------------------------------------

To integrate a new address validation service into the system configuration, follow these steps:

1. **Tag Your Channel Type Service**

   - In your ``ChannelType`` class (which implements
     ``\Oro\Bundle\IntegrationBundle\Provider\ChannelInterface``), add the service tag
     ``oro_address_validation.channel``.
   - This tag requires a unique string parameter (``type``), which serves as the integration name.

2. **Define the Address Validation Resolver Factory**

   - Create a service that implements
     ``\Oro\Bundle\AddressValidationBundle\Resolver\Factory\AddressValidationResolverFactoryInterface``.
   - This service acts as the entry point for your address validation integration.
   - It must provide the following additional services:

   - **Request Factory**

     - Implements
       ``\Oro\Bundle\AddressValidationBundle\Client\Request\Factory\AddressValidationRequestFactoryInterface``.
     - Creates a request to your third-party integration based on the user-entered address.

   - **Integration Client**

     - Accepts the created request.
     - Sends the request to the third-party integration.
     - Returns a response containing the raw addresses found.

   - **Resolved Address Factory**

     - Implements
       ``\Oro\Bundle\AddressValidationBundle\ResolvedAddress\Factory\ResolvedAddressFactoryInterface``.
     - Transforms the raw address data into a resolved address model.


Display Address Validation Dialog On Additional Storefront Form
----------------------------------------------------------------

To display the Address Validation Dialog in the storefront, follow these steps:

1. **Implement the Address Validation Interface**

   - Ensure your entity implements
     ``\Oro\Bundle\AddressValidationBundle\Model\AddressValidatedAtAwareInterface``.

2. **Add the ValidatedAt Field to Your Form**

   - Include the ``validatedAt`` field using
     ``\Oro\Bundle\AddressValidationBundle\Form\Type\Frontend\FrontendAddressValidatedAtType``.

3. **Create the Main JavaScript Address Validation Script for the ValidatedAt Field**

   - The script listens for form submissions and detects changes in the customer address book.
   - The script triggers the Address Validation Dialog when an address update occurs and processes the validation results to update the form with the verified address data. 

4. **Ensure Proper Form Rendering and Data Updates**

   - The main JavaScript script is responsible for either re-rendering the form or updating the existing data.
   - Be aware that the region field may also change as part of the validation process.

5. **Extend the Base JavaScript View (Optional)**

   - You may extend
     ``package/customer-portal/src/Oro/Bundle/AddressValidationBundle/Resources/public/js/app/views/base-address-validated-at-view.js``
     to reuse existing validation logic.

6. **Create a JavaScript Script for the Dialog Widget**

   - You may extend
     ``package/customer-portal/src/Oro/Bundle/AddressValidationBundle/Resources/public/js/app/views/frontend-address-validation-dialog-widget.js``
     to customize the Address Validation Dialog behavior.

7. **Render the ValidatedAt Field with Address Validation JS Script Using the ValidatedAt Field Prefix**

   - Check whether the feature is enabled and correctly configured in the system settings.
   - Display the ValidatedAt field with the JavaScript address validation script.

8. **Create a Controller to Handle Address Validation Results**

   - Define a controller with a route that accepts the validated address form data.
   - Extend
     ``\Oro\Bundle\AddressValidationBundle\Controller\Frontend\AbstractAddressValidationController``
     to leverage existing validation logic.

9. **Implement Required Services for the Controller**

   - **Address Validation Form Factory**

     - Implement
       ``\Oro\Bundle\AddressValidationBundle\Form\Factory\AddressValidationAddressFormFactoryInterface``
       to handle request data using the appropriate form type.

   - **Address Validation Result Handler**

     - Implement
       ``\Oro\Bundle\AddressValidationBundle\AddressValidationResultHandler\AddressValidationResultHandlerInterface``
       to process the form and update the ``validatedAt`` property on the entity.

10. **Display Address Validation Result Form**

    - If your form includes a customer address book, render the
      ``\Oro\Bundle\AddressValidationBundle\Form\Type\Frontend\AddressBookAwareAddressValidationResultType`` form.
    - If your form does **not** include a customer address book, render the
      ``\Oro\Bundle\AddressValidationBundle\Form\Type\Frontend\AddressValidationResultType`` form.

Display Address Validation Dialog On Additional Backoffice Form
---------------------------------------------------------------

To display the Address Validation Dialog in the back-office, follow these steps:

1. **Implement the Address Validation Interface**

   - Ensure your entity implements
     ``\Oro\Bundle\AddressValidationBundle\Model\AddressValidatedAtAwareInterface``.

2. **Add the ValidatedAt Field to Your Form**

   - Include the ``validatedAt`` field using
     ``\Oro\Bundle\AddressValidationBundle\Form\Type\FrontendAddressValidatedAtType``.

3. **Create the Main JavaScript Address Validation Script for the ValidatedAt Field**

   - The script listens for form submissions and detects changes in the customer address book.
   - The script triggers the Address Validation Dialog when an address update occurs and processes the validation results to update the form with the verified address data. 

4. **Ensure Proper Form Rendering and Data Updates**

   - The main JavaScript script is responsible for either re-rendering the form or updating the existing data.
   - Be aware that the region field may also change as part of the validation process.

5. **Extend the Base JavaScript View (Optional)**

   - You may extend
     ``package/customer-portal/src/Oro/Bundle/AddressValidationBundle/Resources/public/js/app/views/base-address-validated-at-view.js``
     to reuse existing validation logic.

6. **Create a JavaScript Script for the Dialog Widget**

   - You may extend
     ``package/customer-portal/src/Oro/Bundle/AddressValidationBundle/Resources/public/js/app/views/address-validation-dialog-widget.js``
     to customize the Address Validation Dialog behavior.

7. **Render the ValidatedAt field with Address Validation JS Script Using the ValidatedAt Field Prefix**

   - Check whether the feature is enabled and correctly configured in the system settings.
   - Display the ValidatedAt field with the JavaScript address validation script.

8. **Create a Controller to Handle Address Validation Results**

   - Define a controller with a route that accepts the validated address form data.
   - Extend
     ``\Oro\Bundle\AddressValidationBundle\Controller\AbstractAddressValidationController``
     to leverage existing validation logic.

9. **Implement Required Services for the Controller**

   - **Address Validation Form Factory**

     - Implement
       ``\Oro\Bundle\AddressValidationBundle\Form\Factory\AddressValidationAddressFormFactoryInterface``
       to handle request data using the appropriate form type.

   - **Address Validation Result Handler**

     - Implement
       ``\Oro\Bundle\AddressValidationBundle\AddressValidationResultHandler\AddressValidationResultHandlerInterface``
       to process the form and update the ``validatedAt`` property on the entity.

10. **Display Address Validation Result Form**

    - If your form includes a customer address book, render the
      ``\Oro\Bundle\AddressValidationBundle\Form\Type\AddressBookAwareAddressValidationResultType`` form.
    - If your form does **not** include a customer address book, render the
      ``\Oro\Bundle\AddressValidationBundle\Form\Type\AddressValidationResultType`` form.

.. include:: /include/include-links-dev.rst
   :start-after: begin
