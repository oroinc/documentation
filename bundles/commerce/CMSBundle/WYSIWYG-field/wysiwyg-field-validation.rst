.. _wysiwyg-field-validation:

WYSIWYG Field Validation
========================

OroPlatform uses |HTML Purifier| (a standards-compliant HTML filter library) to prevent XSS attacks.
By default HTML Purifier is configured extremely strictly - only the allowed elements and attributes are permitted in WYSIWYG fields. This ensures that the content displayed on UI is always safe and secure, and the no users can embed unsecure markup in WYSIWYG fields.
However, sometimes it may be necessary to allow some potentially insecure elements or attributes, for example, iframes - to embed videos or other media content from 3-rd party websites, |Bootstrap| framework elements or attributes - to utilize Bootstrap's capabilities, etc. If your organization security policy allows some or all users to edit and publish such potentially unsecure content, you may extend the default HTML Purifier configuration for WYSIWYG fields.

.. note:: This configuration affects only the WYSIWYG field type. The OroRichTextType (with TinyMCE editor) fields always use the strict purifier rules.

HTML Purifier Modes
-------------------

Out of the box, there are two HTML Purifier modes available:

**``default``** - it has only secure elements and attributes and is used in common cases;
**``lax``** - this mode extends ``default`` mode and includes additional allowed HTML elements and attributes.

Content Restrictions Modes
--------------------------

Which of the HTML Purifier modes is applied to WYSIWYG fields depends on the ``content_restrictions`` ``mode`` configuration.

There are three modes with different secure levels:

**secure** - on the secure level, there is no way to insert any potentially insecure content via UI by any users

**selective** - on the less secure level, some roles can insert the potentially insecure content via UI into specific fields of specific entities (even if a user has the edit permissions for the certain entity field, they should not be able to insert insecure content unless they also have one of the roles that are configured to allow this, and the specified entity field is in the list of the allowed entity fields).

**unsecure** - on this level, any content can be inserted via UI by any user with the edit permissions on the WYSIWYG field.

Out-of-the-box, this option is set to ``strict.``

Validation
----------

Validator for WYSIWYG fields validates the content based on the content restrictions mode configuration by comparing the submitted content (before purification) to the content after purification. If submitted and purified versions do not match, a validation error will appear and the user will not be allowed to save the data.

.. _wysiwyg-field-customization:

Customization
-------------

Creating Custom HTML Purifier Modes
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You can create your own HTML Purifier mode using the inheritance hierarchy:

    .. oro_integrity_check:: 2550e5ab22bcfdfafa21640f038a26a7802e636f

        .. literalinclude:: /code_examples_untested/wysiwyg_field/wysiwyg-validation/Resources/config/oro/app.yml
            :language: yaml
            :lines: 8-26
            :linenos:

The ``extends`` key allows to reuse the existing config from the extended scope that will be merged with your configuration.

Creating Custom Content Restrictions
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The ``addScopeMapping`` method of the ``oro_cms.provider.html_purifier_scope_provider`` service provides the possibility to connect the HTML Purifier mode with content restrictions modes.
The ``oro_cms.provider.html_purifier_scope_provide`` class enables to get an appropriate scope based on the entity and entity field names taking into account current user roles.
To connect your custom HTML Purifier mode with the content restrictions mode, you should configure the container to call ``addScopeMapping``.

    .. oro_integrity_check:: 6de7a9e0dae2af459db71e7be02ee88440d6d1c1

        .. literalinclude:: /code_examples_untested/wysiwyg_field/wysiwyg-validation/Resources/config/services.yml
            :language: yaml
            :linenos:

To be able to use the ``content_restrictions_additional`` and ``content_restrictions_extra`` modes in configuration, you should add this mode to the ``oro_cms`` extension.

    .. oro_integrity_check:: fa38ac7298cf82acf17f7f1ef41d905cdff2f2da

        .. literalinclude:: /code_examples_untested/wysiwyg_field/wysiwyg-validation/ACMEWysiwygValidationBundle.php
            :language: php
            :linenos:

After this, you can use the ``content_restrictions_additional`` or  ``content_restrictions_extra`` mode in the content restrictions configuration.

    .. oro_integrity_check:: 668605e7272dc61e0db8ba33cf92258ab9319452

        .. literalinclude:: /code_examples_untested/wysiwyg_field/wysiwyg-validation/Resources/config/oro/app.yml
            :language: yaml
            :lines: 1-6
            :linenos:

The ``lax_restrictions`` key in configuration is used to limit the usage of the HTML Purifier mode. It specifies the user role, entity, and entity field to which your HTML Purifier mode will be applied.
For example, the above mentioned user with the ``ROLE_ADMINISTRATOR`` role can use ``example.com`` for iframe domain when editing the ``Landing Page`` ``content`` field. At the same time, this user is not allowed to use this iframe domain in other WYSIWYG fields.

.. include:: /include/include-links-dev.rst
   :start-after: begin
