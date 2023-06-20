Client Side Form Validation with JavaScript
===========================================

Set Up Validation Rules for Form Fields
---------------------------------------

Client-side validation supports the same validation annotation that is used for the server-side - |Symfony validation|. Once `validation.yml` is created, all rules get translated to the frontend format and put into fields' `data-validation` attribute. For example:

.. code-block:: yaml

    Bundle\UserBundle\Entity\User:
        properties:
            username:
                - NotBlank:     ~
                - Length:
                    min:        3
                    max:        255

will be translated to

.. code-block:: html

    <input name="user_form[username]"
        data-validation="{&quot;NotBlank&quot;:null,&quot;Length&quot;:{&quot;min&quot;:3,&quot;max&quot;:255}}">

This `data-validation` is supported by client-side validation, which is an extended version of the |jQuery Validation Plugin|.

The main entry point of this mechanism from the backend point of view is the ``\Oro\Bundle\FormBundle\Form\Extension\JsValidationExtension`` Symfony Form Type Extension, which in its turn is backed by **constraints provider** and **constraint converters**.

Constraints Provider and Constraints Converter
----------------------------------------------

**Constraint provider** (``\Oro\Bundle\FormBundle\Form\Extension\JsValidation\ConstraintsProvider``) is responsible for the extraction of the Symfony validation constraints from a Symfony Form for using in `JsValidationExtension`.

**Constraint converter**  is responsible for converting a Symfony validation constraint object (``\Symfony\Component\Validator\Constraint``) into the validation constraint suitable for converting to frontend format, e.g. add extra data or totally change a constraint. **Constraint converter** is represented by ``\Oro\Bundle\FormBundle\Form\Extension\JsValidation\ConstraintConverter``, but actually it delegates calls to the inner converters. Inner converters implement same ``\Oro\Bundle\FormBundle\Form\Extension\JsValidation\ConstraintConverterInterface`` interface and are collected by the service container tag `oro_form.extension.js_validation.constraint_converter`, so you can easily hook into the process if needed.

The basic constraint converter is ``\Oro\Bundle\FormBundle\Form\Extension\JsValidation\GenericConstraintConverter`` that supports all constraints. Also it adds an important feature - allows total override of a constraint via `jsValidation` payload option, for example:

.. code-block:: yaml
    :caption: config/validation.yml

    Oro\Bundle\UserBundle\Entity\User:
        # ...
        properties:
            # ...
            birthday:
                - Type:
                    type: DateTimeInterface
                    payload:
                        jsValidation:
                            type: Date
                            options:
                                # ...
            # ...


Validation Rules
----------------

The client-side validation method is the JS module, which should export an array with three values:

1. Methods name
2. Validation function
3. Error message or function that defines a message and returns it

The trivial validation rule module would look like this:

.. code-block:: js

    import _ from 'underscore';
    import __ from 'orotranslation/js/translator';

    const DEFAULT_PARAM = {
        message: 'Invalid input value'
    };

    export default [
        'ValidationMethodRule',

        /**
         * @param {string|undefined} value
         * @param {Element} element
         * @param {?Object} param
         * @this {jQuery.validator}
         * @returns {boolean|string}
         */
        (value, element, param) => true

        /**
         * @param {Object} param
         * @param {Element} element
         * @this {jQuery.validator}
         * @returns {string}
         */
        function(param, element) {
            param = {...DEFAULT_PARAM, ...param};
            return __(param.message);
        }
    ];

Loading Custom Validation Rules
-------------------------------

To load a custom validator, call `$.validator.loadMethod` with the name of the JS module, which exports the validation method:

.. code-block:: js

   $.validator.loadMethod('my/validation/method')

Next, the form fields with this constraint are processed by this validation method.

Validation for Optional Group
-----------------------------

When you have one form that saves several different entities at once (e.g., contact entity + address sub-entity), mark the container of sub-entity field elements with the attribute `data-validation-optional-group`.

.. code-block:: html

    <form>
    |
    +--<fieldset>
    |  +--<input>
    |  +--<input>
    |  +--<input>
    |
    +--<fieldset data-validation-optional-group>
       +--<input>
       +--<input>
       +--<input>

Next, validation for sub-entity will work only if some of the fields are not blank. Otherwise, it will ignore all validation rules for the fields element of the sub-entity.

Override of Optional Validation Logic
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To customize "optional validation group" behavior, override a handler responsible for handling field changes in a specific optional validation group. In this case, you need to:

1) add a custom handler to jsmodules.yml

   .. code-block:: yaml

        dynamic-imports:
            commons:
                - example/js/custom-handler

Custom optional validation handler should have two methods: initialize and handle.
Method "Initialise" is responsible for updating the validation state for "optional validation group" after being loaded to the page.
Method "Handle" is responsible for update "optional validation group" validation state after the descendant field will be changed.

You can have any level of "optional validation group" inheritance in your page. In case if your field has more than one "optional validation group" ancestor,
all the "optional validation group" handlers will be called from closest ancestor to root by default. This behavior is configurable, you can return `true` or `false` in your custom "Handle" method.

2) add a data attribute to the validation group

   .. code-block:: html

       +--<fieldset data-validation-optional-group data-validation-optional-group-handler="example/js/custom-handler">
          +--<input>
          +--<input>
          +--<input>

Ignore Validation Section
-------------------------

To suppress validation for a field or a group of fields, use the `data-validation-ignore` attribute of the container element. It works the same way as with the `data-validation-optional-group` attribute, except that the validator omits these fields even if they have a value.

.. code-block:: html

    +<form>
    |
    +--<fieldset>
    |  +--<input>
    |  +--<input>
    |  +--<input>
    |
    +--<fieldset data-validation-ignore>
       +--<input>
       +--<input>
       +--<input>

This attribute is checked in each validation cycle, so you can add/remove it in the runtime to get required behavior.

.. _bundle-docs-platform-form-bundle-js-validation-server-side-validation:

Conformity Server Side Validations to Client Once
-------------------------------------------------

+----------------+---------+-----+---------------------------------------+---------+
| Server side    | Symfony | Oro | Client side                           | Coment. |
+----------------+---------+-----+---------------------------------------+---------+
| All            |    √    |     |                                       |   (2)   |
+----------------+---------+-----+---------------------------------------+---------+
| Blank          |    √    |     |                                       |   (2)   |
+----------------+---------+-----+---------------------------------------+---------+
| Callback       |    √    |     |                                       |   (2)   |
+----------------+---------+-----+---------------------------------------+---------+
| Choice         |    √    |     |                                       |   (2)   |
+----------------+---------+-----+---------------------------------------+---------+
| Collection     |    √    |     |                                       |   (2)   |
+----------------+---------+-----+---------------------------------------+---------+
| Count          |         |  √  | oroform/js/validator/count            |   (1)   |
+----------------+---------+-----+---------------------------------------+---------+
| Country        |    √    |     |                                       |         |
+----------------+---------+-----+---------------------------------------+---------+
| DateTime       |    √    |  √  | oroform/js/validator/datetime         |         |
+----------------+---------+-----+---------------------------------------+---------+
| Date           |    √    |  √  | oroform/js/validator/date             |         |
+----------------+---------+-----+---------------------------------------+---------+
| Email          |    √    |     | oroform/js/validator/email            |         |
+----------------+---------+-----+---------------------------------------+---------+
| False          |    √    |     |                                       |   (2)   |
+----------------+---------+-----+---------------------------------------+---------+
| File           |    √    |     |                                       |   (2)   |
+----------------+---------+-----+---------------------------------------+---------+
| Image          |    √    |     |                                       |   (2)   |
+----------------+---------+-----+---------------------------------------+---------+
| Ip             |    √    |     |                                       |         |
+----------------+---------+-----+---------------------------------------+---------+
| Language       |    √    |     |                                       |         |
+----------------+---------+-----+---------------------------------------+---------+
| Length         |    √    |     | oroform/js/validator/length           |         |
+----------------+---------+-----+---------------------------------------+---------+
| Locale         |    √    |     |                                       |         |
+----------------+---------+-----+---------------------------------------+---------+
| MaxLength      |    √    |     |                                       |         |
+----------------+---------+-----+---------------------------------------+---------+
| Max            |    √    |  √  |                                       |         |
+----------------+---------+-----+---------------------------------------+---------+
| MinLength      |    √    |     |                                       |         |
+----------------+---------+-----+---------------------------------------+---------+
| Min            |    √    |  √  |                                       |         |
+----------------+---------+-----+---------------------------------------+---------+
| NotBlank       |    √    |     | oroform/js/validator/notblank         |   (3)   |
+----------------+---------+-----+---------------------------------------+---------+
| NotNull        |    √    |  √  | oroform/js/validator/notnull          |   (3)   |
+----------------+---------+-----+---------------------------------------+---------+
| Null           |    √    |     |                                       |   (2)   |
+----------------+---------+-----+---------------------------------------+---------+
| Range          |    √    |  √  | oroform/js/validator/range            |         |
+----------------+---------+-----+---------------------------------------+---------+
| NumericRange   |    √    |  √  | oroform/js/validator/numeric-range    |         |
+----------------+---------+-----+---------------------------------------+---------+
| Regex          |    √    |     | oroform/js/validator/regex            |         |
+----------------+---------+-----+---------------------------------------+---------+
| Repeated       |    √    |     | oroform/js/validator/repeated         |         |
+----------------+---------+-----+---------------------------------------+---------+
| SizeLength     |    √    |     |                                       |         |
+----------------+---------+-----+---------------------------------------+---------+
| Size           |    √    |  √  |                                       |         |
+----------------+---------+-----+---------------------------------------+---------+
| Time           |    √    |     |                                       |         |
+----------------+---------+-----+---------------------------------------+---------+
| True           |    √    |     |                                       |   (2)   |
+----------------+---------+-----+---------------------------------------+---------+
| Type           |    √    |     | oroform/js/validator/type             |   (4)   |
+----------------+---------+-----+---------------------------------------+---------+
| UniqueEntity   |    √    |     |                                       |         |
+----------------+---------+-----+---------------------------------------+---------+
| Url            |    √    |     | oroform/js/validator/url              |         |
+----------------+---------+-----+---------------------------------------+---------+

1. supports the only group of checkboxes with the same name (like ``user[role][]``)
2. cannot be supported on client-side
3. alias for `required` validator (standard jQuery.validate)
4. supports only integer type

.. include:: /include/include-links-dev.rst
   :start-after: begin
