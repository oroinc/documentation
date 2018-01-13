Forms and Validators Configuration
==================================

Table of Contents
-----------------

-  `Overview <#overview>`__
-  `Validation <#validation>`__
-  `Forms <#forms>`__

Overview
--------

The Symfony `Validation Component <http://symfony.com/doc/current/book/validation.html>`__ and `Forms Component <http://symfony.com/doc/current/book/forms.html>`__ are used to validate and transform input data to an entity in `create <./actions#create-action>`__, `update <./actions#update-action>`__, `update\_relationship <./actions#update_relationship-action>`__, `add\_relationship <./actions#add_relationship-action>`__ and
`delete\_relationship <./actions#delete_relationship-action>`__ actions.

Validation
----------

The validation rules are loaded from ``Resources/config/validation.yml`` and annotations as it is commonly done in Symfony applications. So, all validation rules defined for an entity are applicable in Data API as well. Also, by default, Data API uses two validation groups: **Default** and **api**. If you need to add validation constrains that should be applicable in Data API only you should add them in **api** validation group.

In case if input data violates some validation constraints, these constraints will be automatically converted to `validation errors <./processors#error-handling>`__ which are used to build correct response of Data API. The conversion is performed by `CollectFormErrors <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/Shared/CollectFormErrors.php>`__ processor. By default the HTTP status code for validation errors is ``400 Bad Request``. But, if needed, there
are several ways to change it:

-  Implement `ConstraintWithStatusCodeInterface <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Validator/Constraints/ConstraintWithStatusCodeInterface.php>`__ in you constraint class.
-  Implement own constraint text extractor. The API bundle has the `default implementation of constraint text extractor <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Request/ConstraintTextExtractor.php>`__. To add new extractor just create a class implements `ConstraintTextExtractorInterface <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Request/ConstraintTextExtractorInterface.php>`__ and tag it with the ``oro.api.constraint_text_extractor``
   in the dependency injection container. Also this service can be used to change an error code and type for a validation constraint.

Here are several examples how to add validation constraints to API resources using ``Resources/config/oro/api.yml`` configuration file:

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

Forms
-----

The Data API forms are isolated from UI forms. It is done to avoid collisions between them and to prevent unnecessary performance overhead in Data API. And as result all Data API form types, extensions and guessers should be registered separately. There are two ways how it can be done:

-  using application configuration file
-  tagging form elements by appropriate tag in the dependency injection container

To register new form elements using application configuration file you can add ``Resources/config/oro/app.yml`` in any bundle or use *app/config/config.yml* of your application. The following example shows how it can be done:

.. code:: yaml

    api:
        form_types:
            - form.type.date # service id of "date" form type
        form_type_extensions:
            - form.type_extension.form.validator # service id of Symfony form validation extension
        form_type_guessers:
            - form.type_guesser.validator # service id of Symfony form type guesser based on validation constraints
        form_type_guesses:
            datetime: # data type
                form_type: datetime # the name of guessed form type
                options: # guessed form type options
                    model_timezone: UTC
                    view_timezone: UTC
                    with_seconds: true
                    widget: single_text
                    format: "yyyy-MM-dd'T'HH:mm:ssZZZZZ" # HTML5

Already registered Data API form elements you can find in `Resources/config/oro/app.yml <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Resources/config/oro/app.yml>`__.

Also new form elements can be added using appropriate dependency injection tags. The following table shows all available tags.

+--------------------------------+-----------------------------------------------+
| Tag                            | Description                                   |
+================================+===============================================+
| oro.api.form.type              | Create a new form type                        |
+--------------------------------+-----------------------------------------------+
| oro.api.form.type\_extension   | Create a new form extension                   |
+--------------------------------+-----------------------------------------------+
| oro.api.form.type\_guesser     | Add your own logic for "form type guessing"   |
+--------------------------------+-----------------------------------------------+

An example:

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

To switch between general and Data API forms `Processor:raw-latex:`\Shared`:raw-latex:`\InitializeApiFormExtension` <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/Shared/InitializeApiFormExtension.php>`__ and `Processor:raw-latex:`\Shared`:raw-latex:`\RestoreDefaultFormExtension` <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/Shared/RestoreDefaultFormExtension.php>`__ processors can be used.

A form for a particular entity is built on the fly based on `Data API configuration <./configuration.rst>`__ and an entity metadata. It is performed by `Processor:raw-latex:`\Shared`:raw-latex:`\BuildFormBuilder` <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Processor/Shared/BuildFormBuilder.php>`__ processor.
