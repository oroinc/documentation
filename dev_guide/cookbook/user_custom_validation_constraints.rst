.. index::
    single: Customization; User Validation Constraints
    single: Validation; User Validation Constraints

How to Add custom User Validation Constraints
=============================================

The UserBundle from OroPlatform already ships a set of
`predefined validation constraints`_ for the ``User`` entity. These rules
are checked when a user is either being created or being modified.

You can define your own validation rules which are applied on top of the
predefined rules when a ``User`` is being validated:

.. configuration-block::

    .. code-block:: yaml
        :linenos:

        # src/Acme/UserBundle/Resources/config/validation.yml
        Oro\Bundle\UserBundle\Entity\User:
            properties:
                enabled:
                    - False:
                        groups: [Registration]

    .. code-block:: xml
        :linenos:

        <!-- src/Acme/UserBundle/Resources/config/validation.xml -->
        <?xml version="1.0" encoding="UTF-8" ?>
        <constraint-mapping xmlns="http://symfony.com/schema/dic/constraint-mapping"
            xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
            xsi:schemaLocation="http://symfony.com/schema/dic/constraint-mapping
                http://symfony.com/schema/dic/constraint-mapping/constraint-mapping-1.0.xsd"
        >
            <class name="Oro\Bundle\UserBundle\Entity\User">
                <property name="password">
                    <constraint name="False">
                        <option name="groups">
                            <value>Registration</value>
                        </option>
                    </constraint>
                </property>
            </class>
        </constraint-mapping>

The example ensures that a user is not activated after being registered.
The validation group associated to a constraint determines when the constraint
is applied to the ``User`` entity:

================= =============================== ===============================
Validation Group   Applied when a user is created Applied when a user is modified
================= =============================== ===============================
Registration      yes                             no
----------------- ------------------------------- -------------------------------
Roles             yes                             yes
----------------- ------------------------------- -------------------------------
No group          yes                             yes
================= =============================== ===============================

.. _`predefined validation constraints`: https://github.com/orocrm/platform/blob/master/src/Oro/Bundle/UserBundle/Resources/config/validation.yml
