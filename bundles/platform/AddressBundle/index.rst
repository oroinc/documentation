.. _bundle-docs-platform-address-bundle:

OroAddressBundle
================

OroAddressBundle introduces the base entity and interfaces for addresses and address-related entities such as a country, a region, a phone, and an email. It also provides a dictionary with country region codes and names.

.. _bundle-docs-platform-address-bundle-address-type:

Address Type
------------

An address type is an entity used to specify a type of an address. An address can have several address types, which are billing and shipping by default.
An address type entity is called AddressType and is stored in ``Oro/Bundle/AddressBundle/Entity/AddressType.php``. It has two properties:

1. a *name* that defines a symbolic name of the type, and
2. a *label* that is used in the frontend.

Address types are translatable entities, so their labels should be defined for each supported locale.
Loading and translation of address types are performed in the ``Oro/Bundle/AddressBundle/Data/ORM/LoadAddressTypeData.php`` data fixture.

Entity AbstractTypedAddress is an abstract address entity that extends AbstractAddress and adds the "primary" flag and a set of address types to it.
It has the "types" property and methods to work with it, but you need to define the DB relation between an address and an address type in a specific class:

.. code-block:: php

    /**
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="Oro\Bundle\AddressBundle\Entity\AddressType")
     * @ORM\JoinTable(
     *     name="orocrm_contact_address_to_address_type",
     *     joinColumns={@ORM\JoinColumn(name="contact_address_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="type_name", referencedColumnName="name")}
     * )
     **/
    protected $types;

Address Entities
----------------

OroAddressBundle provides several entities to work with addresses.

Classes Description
^^^^^^^^^^^^^^^^^^^

* **AbstractAddress** - encapsulates basic address attributes (label, street, city, country, first and last name etc.);
* **AbstractTypedAddress** - extends AbstractAddress and adds the "primary" flag and a set of address types;
* **Address** - a basic implementation of AbstractAddress;
* **Country** - encapsulates country attributes (ISO2 and ISO3 codes, a name, a collection of regions);
* **CountryTranslation** - an entity that provides translation for the Country entity;
* **Region** - encapsulates region attributes (the "country+region" combined code, a code, a name, a country entity);
* **RegionTranslation** - an entity that provides translation for the Region entity;
* **AddressType** - describes an address type and includes a type name and a type label. The default types are "billing" and "shipping";
* **AddressTypeTranslation** - an entity that provides translation for the AddressType entity.

Address Form Types
------------------

OroAddressBundle provides form types to render address entities by forms.

Form Types Description
^^^^^^^^^^^^^^^^^^^^^^

* **oro\_address** - encapsulates form fields for the Address entity;
* **oro\_address\_collection** - a collection of form types for address entities;
* **oro\_country** - encapsulates form fields for the Country entity;
* **oro\_region** - encapsulates form fields for the Region entity.

Classes Description
^^^^^^^^^^^^^^^^^^^

* **Form \ Type \ AddressType** - a base form for Address that includes form fields for the address attributes;
* **Form \ Type \ TypedAddressType** - extends AddressType, adds functionality to work with address types;
* **Form \ Type \ AddressType** - implementation of AbstractAddressType. The form type is "oro_address";
* **Form \ Type\ AddressCollectionType** - provides functionality to work with address collections. The form type is "oro_address_collection";
* **Form \ Type \ CountryType** - provides form types for the Country entity and is represented by the "oro_country" form type;
* **Form \ Type \ RegionType** - provides form types for the Region entity. The form type is "oro_region";
* **Form \ EventListener \ AddressCountryAndRegionSubscriber** - is responsible for processing relations between countries and regions by address forms;
* **Form \ EventListener \ FixAddressesPrimarySubscriber** - ensures that only the newly created/updated address is specified as primary for the selected owner. If also removes the primary status for the other addresses added previously;
* **Form \ EventListener \ FixAddressesTypesSubscriber** - ensures that only the newly created/updated address type (shipping/billing) is specified as primary for the selected owner. If also removes the primary status for the other address types added previously;
* **Form \ Handler \ AddressHandler** - processes save for Address entity using specified form.

Usage
-----

PHP API
^^^^^^^

.. code-block:: php

    <?php
        //create empty address entity
        $address = mew Address();

        //process insert/update
        $this->get('oro_address.form.handler.address')->process($entity)

        //accessing address form service
        $this->get('oro_address.form.address')

Address Collection
^^^^^^^^^^^^^^^^^^

Address collection can be added to a form following the next three steps:

1) Add a field with the *oro_address_collection* type to a form:

   .. code-block:: php

        $builder->add(
            'addresses',
            AddressCollectionType::class,
            [
                'required' => false,
                'type'     => 'oro_address'
            ]
        );


2) Add AddressCollectionTypeSubscriber. AddressCollectionTypeSubscriber must be initialized with an address collection field name and an address class name.

   .. code-block:: php

      $builder->addEventSubscriber(new AddressCollectionTypeSubscriber('addresses', $this->addressClass));


3) Add *@OroAddress/Include/fields.html.twig* to the template to enable address form field types.

   .. code-block:: twig

     {% form_theme form with ['@OroAddress/Include/fields.html.twig']}

Address Validators
------------------

OroAddressBundle has specific validators that can be used to validate addresses and address collection.

Classes Description
^^^^^^^^^^^^^^^^^^^

* **Validator \ Contraints \ ContainsPrimaryValidator** - checks an address collection to ensure that it contains only one primary address;
* **Validator \ Contraints \ ContainsPrimary** - contains an error message for ContainsPrimaryValidator;
* **Validator \ Contraints \ UniqueAddressTypesValidator** - checks an address collection to ensure that it has no more than one address per each address type;
* **Validator \ Contraints \ UniqueAddressTypes** - contains an error message for UniqueAddressTypesValidator.

Example of Usage
^^^^^^^^^^^^^^^^

Validation configuration should be placed in the *Resources/config/validation.yml* file in the appropriate bundle.

.. code-block:: yaml

    Oro\Bundle\ContactBundle\Entity\Contact:
        properties:
            addresses:
                - Oro\Bundle\AddressBundle\Validator\Constraints\UniqueAddressTypes: ~

.. include:: /include/include-links-dev.rst
   :start-after: begin