.. _dev-guide-setup-content-restrictions:

Lift Default Content Restrictions
=================================

OroCommerce uses content restrictions to keep the content displayed in the UI secure and to prevent users from embedding unsecure markup. Out-of-the-box, all users can enter only safe content in the WYSIWYG fields from the application UI.

There are three content restriction modes: secure (the default mode), selective, and unsecure.

The secure content restriction mode is turned on by default.

Switch to the **selective** mode if you work in a production system and need to enable users with corresponding permissions to insert potentially unsafe content via the back-office UI into certain fields of specific entities.

Enable **unsecure** mode if you develop in a system that no one else has access to. This mode stops validating the content added to the WYSIWYG fields in the UI, so any user with edit permissions for a WYSIWYG field can insert any content via the application UI.

The default **secure** configuration is stored in the |app.yml file of the OroFormBundle|. The default configuration for the **selective** mode is stored |in the app.yml file of the CMSBundle|.

You cannot change restrictions via the back-office application UI, so to lift the default secure content restrictions, override the default configuration file.

There are two ways to do it:

**For developers**:

Create an app.yml file in a bundle of your choice, and change the content restrictions' mode.

.. hint:: See :ref:`Add application configuration settings from any bundle <bundle-docs-platform-platform-bundle-add-config-settings>` for more information on adding settings to the application configuration from your bundle.

In the example below, `secure` mode has been changed to `selective`:

.. code-block:: yaml

   oro_cms:
       content_restrictions:
           mode: selective

**For admins**

To switch between any modes (from selective to unsecure, from unsecure back to secure, and so on), add the same piece of code with the desired mode into the `config/config.yml` file. For example:

.. code-block:: yaml

   oro_cms:
       content_restrictions:
           mode: unsecure

You can add further configuration using the same method, such as allowed protocols, iframe domains, html tags and their attributes, etc. For example, adding the following code into config/config.yml lets you specify the ``sftp://`` protocol in links (<a href="...">...</a>) in selective (lax mode):

.. code-block:: yaml

   oro_form:
       html_purifier_modes:
           lax:
               allowed_uri_schemes:
                   - 'sftp'

Here is an example of how to allow attribute ``title`` for the ``img`` tag in secure (default) mode:

.. code-block:: yaml

   oro_form:
       html_purifier_modes:
           default:
               allowed_html_elements:
                   img:
                       attributes:
                           - title

You can also configure the use of certain modes for certain roles in certain fields of entities, in the same way as modes. For example, the following configuration enables a marketing manager to use the selective mode (which means most of the tags are allowed) in the content of the landing pages (**Marketing > Landing Pages** in the main menu):

.. code-block:: yaml

   oro_cms:
       content_restrictions:
           mode: selective
           lax_restrictions:
               ROLE_MARKETING_MANAGER:
                   Oro\Bundle\CMSBundle\Entity\Page: ['content']

.. hint:: Keep in mind that even if a user has the edit permissions for the certain entity field, they should not be able to insert insecure content unless they also have one of the roles that are configured to allow this and the specified entity field is in the list of the allowed entity fields.

You can flexibly configure the use of any mode in the same way.

The configuration above, or any other configuration of your choice, merges with the default configuration, adding your changes to the appropriate mode.

You can use the following reference table that illustrates the three modes and when to use them:

.. image:: /img/backend/setup/content-restriction/modes.png
   :alt: Three modes of configuration and use cases

**Related Articles**

* :ref:`OroCMSBundle <bundle-docs-commerce-cms-bundle>`
* :ref:`WYSISYG Fields <WYSIWYG-field-dev-guide>`

.. include:: /include/include-links-dev.rst
   :start-after: begin
