.. _web-api--forms:

Forms and Validators Configuration
==================================

The Symfony |Validation Component| and |Forms Component| are used to validate and transform input data to an entity in :ref:`create <web-api--actions>`, :ref:`update <web-api--actions>`, :ref:`update\_relationship <web-api--actions>`, :ref:`add\_relationship <web-api--actions>` and :ref:`delete\_relationship <web-api--actions>` actions.

Validation
----------

The validation rules are loaded from ``Resources/config/validation.yml`` and annotations as it is commonly done in Symfony applications. So, all validation rules defined for an entity are applicable to the API as well. By default, API uses two validation groups: **Default** and **api**. If you need to add validation constrains that should be applicable in Data API only you should add them in **api** validation group.

In case a validation rule cannot be implemented as a regular validation constraint due to its complexity you can implement it as a processor for ``post_validate`` event of :ref:`customize_form_data <customize-form-data-action>` action. Pay your attention on |FormUtil class|, it contains methods that may be useful in such processor.

If the input data violates validation constraints, they will be automatically converted to :ref:`validation errors <web-api--processors>` that help build the correct response of the API. The conversion is performed by |CollectFormErrors| processor. By default the HTTP status code for validation errors is ``400 Bad Request``. If you need to change it, you can do it in the following ways:

-  Implement |ConstraintWithStatusCodeInterface| in you constraint class.
-  Implement own constraint text extractor. The API bundle has the |default implementation of constraint text extractor|. To add a new extractor, create a class implements |ConstraintTextExtractorInterface| and tag it with the ``oro.api.constraint_text_extractor`` in the dependency injection container. This service can be also used to change an error code and type for a validation constraint.

The following example shows how to add validation constraints to API resources using the ``Resources/config/oro/api.yml`` configuration file:

.. code:: yaml

    api:
    entities:
        Acme\Bundle\AcmeBundle\Entity\AcmeEntity:
            fields:
                primaryEmail:
                    form_options:
                        constraints:
                            # add Symfony\Component\Validator\Constraints\Email validation constraint
                            - Email: ~
                userName:
                    form_options:
                        constraints:
                            # add Symfony\Component\Validator\Constraints\Length validation constraint
                            - Length:
                                max: 50
                            # add Acme\Bundle\AcmeBundle\Validator\Constraints\Alphanumeric validation constraint
                            - Acme\Bundle\AcmeBundle\Validator\Constraints\Alphanumeric: ~


Also, see how to :ref:`validate virtual fields <validate-virtual-fields>`.

Forms
-----

The API forms are isolated from the UI forms. This helps avoid collisions and prevent unnecessary performance overhead in the API. Consequently, all the API form types, extensions, and guessers should be registered separately. There are two ways of how to complete this:

- Use the application configuration file.
- Tag the form elements by appropriate tags in the dependency injection container.

To register a new form elements using application configuration file,  add ``Resources/config/oro/app.yml`` in any bundle or use *config/config.yml* of your application.

.. code:: yaml

    api:
    form_types:
        - Symfony\Component\Form\Extension\Core\Type\DateType # the class name of a form type
        - form.type.date # the service id of a form type
    form_type_extensions:
        - form.type_extension.form.http_foundation # service id of a form type extension
    form_type_guessers:
        - acme.form.type_guesser # service id of a form type guesser
    form_type_guesses:
        datetime: # data type
            form_type: Symfony\Component\Form\Extension\Core\Type\DateTimeType # the guessed form type
            options: # guessed form type options
                model_timezone: UTC
                view_timezone: UTC
                with_seconds: true
                widget: single_text
                format: "yyyy-MM-dd'T'HH:mm:ssZZZZZ" # HTML5

.. note:: The form_types section can contain either the class name or the service id of a form type. Usually, the service id is used if a form type depends on other services in the dependency injection container.

You can find the already registered API form elements in |Resources/config/oro/app.yml|.

If you need to add new form elements can by tagging them in the dependency injection container, use the tags from the following table:

+--------------------------------+-----------------------------------------------+
| Tag                            | Description                                   |
+================================+===============================================+
| oro.api.form.type              | Create a new form type                        |
+--------------------------------+-----------------------------------------------+
| oro.api.form.type\_extension   | Create a new form extension                   |
+--------------------------------+-----------------------------------------------+
| oro.api.form.type\_guesser     | Add your own logic for "form type guessing"   |
+--------------------------------+-----------------------------------------------+

Example:

.. code:: yaml

        acme.form.type.datetime:
            class: Acme\Bundle\AcmeBundle\Form\Type\DateTimeType
            tags:
                - { name: form.type, alias: acme_datetime } # allow to use the form type on UI 
                - { name: oro.api.form.type, alias: acme_datetime } # allow to use the form type in Data API

        acme.form.extension.datetime:
            class: Acme\Bundle\AcmeBundle\Form\Extension\DateTimeExtension
            tags:
                - { name: form.type_extension, alias: acme_datetime } # add the form extension to UI forms
                - { name: oro.api.form.type_extension, alias: acme_datetime } # add the form extension to Data API forms

        acme.form.guesser.test:
            class: Acme\Bundle\AcmeBundle\Form\Guesser\TestGuesser
            tags:
                - { name: form.type_guesser } # add the form type guesser to UI forms
                - { name: oro.api.form.type_guesser } # add the form type guesser to Data API forms

To switch between the general and API forms, use the |ProcessorSharedInitializeApiFormExtension| and |ProcessorSharedRestoreDefaultFormExtension| processors.

The |ProcessorSharedBuildFormBuilder| processor builds the form for a particular entity on the fly based on the :ref:`API configuration <web-api--configuration>` and the entity metadata.


.. include:: /include/include-links-dev.rst
   :start-after: begin
