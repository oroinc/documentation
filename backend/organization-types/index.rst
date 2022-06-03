:title: Configure Restrictions and Limitations for Organizations

.. meta::
   :description: A guide how to add and configure organization types to provide a set of restrictions and limitations for organizations in the Enterprise editions of OroCommerce, OroCRM, and OroPlatform.

.. _dev-organization-types:

Organization Types
==================

.. important:: The organization types feature is only available in the Enterprise edition.

An organization type represents a set of predefined restrictions and limitations provided by a developer.
A user can assign an organization type to any non :ref:`global organization <user-ee-multi-org-system>`.

To add an organization type:

1. Create a `Resources/config/oro/organization_types.yml` file in any bundle.

2. Add a configuration of the organization type to this file, e.g.:

   .. code-block:: yaml

       organization_types:
           acme:
               label: oro.organization_type.acme.label
               description: oro.organization_type.acme.description

3. Add translations for the organization type name and description to `Resources/translations/messages.en.yml`, e.g.:

   .. code-block:: yaml

       oro:
           organization_type:
               acme:
                   label: Acme
                   description: The Acme organization type cn be used to ...

4. Rebuild the application cache via the ``php bin/console cache:clear`` command.

5. To make sure that the new organization type was added successfully,
   run the ``php bin/console oro:organization-type:config:debug`` command.

6. Make sure that the new organization type is available
   on the :ref:`Organization edit page in the back-office <user-management-organization-types>`.


The full configuration options available in `Resources/config/oro/organization_types.yml` files are:

.. code-block:: yaml

    organization_types:

        # Prototype
        name:

            # The name of an organization type.
            label:                ~ # Required

            # The description of an organization type.
            description:          ~ # Required

            # A list of feature names that are enabled for an organization type.
            enabled_features:     []

            # A list of feature names that are disabled for an organization type.
            disabled_features:    []

You can also see this information by running the ``php bin/console oro:organization-type:config:dump-reference`` command.
