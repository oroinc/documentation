.. _doc-entities:

Entities
========

.. contents:: :local:
    :depth: 3



Overview
---------


``Entity`` is an abstract object in the system. **User**, **Account**, **Lead**, etc. are the examples of entities. One entity may have many instances, they are called ``entity records``. This way, the 'John Doe' user, the 'Lex Shop' account or the 'Jane Smith' lead are specific entity records. 

Entity defines the set of properties that describe an object and how the system must process it. For the **User** entity, for instance, it is defined that each of its records must have a username and only a business unit can be specified as a user record owner. An entity record, in its turn, will have a specific value for the **Username** property.

OroCRM comes with a number of out-of-the-box entities that represent general stakeholders and components of customer relation management. These are called ``system entities``.
 
However, to facilitate managing your business information, you may sometimes require additional entities. These can be created on the interface. For example, you may want to add the **Family Members** entity to store information about users' family members, which is convenient if your company practises giving gifts to family on special occasions or inviting users' family members to corporate parties. 

Entities created by users are called ``custom entities``.

.. note::
   If entities are added not via the interface but at the level of the program code in the course of customization, they may be defined either as system or as custom entities (as will be arranged with the system owner).


System entities come with a predefined set of properties. Such properties are called ``entity fields``. In some cases, you may need to extend this set. For example, if you operate a book store, you may want to add an additional property such as **Hobbies** to the **Customer** entity. And if you operate clothes shops, you may want to add the **Gender** property to the **Customer** entity. 

Similar to entities, out-of-the-box fields are called ``system entity fields``, and fields added by users are called ``custom entity fields``. 

Adding new fields is possible for all custom entities.  However, there is a range of system entities, to which you cannot add custom fields (e.g. you cannot add fields to **MailChimp Campaign** or **Mailbox**). Entities for which it is possible to add new fields are called ``extendible entities``.


.. note::
    If you need to add new fields to an entity that is not extendible, it can be done at the level of the program code in the course of customization.





Links
------

For the description of the entity view page, see the `Entity on the Interface <./entity-interface>`__ guide. 

For which actions you can perform with entities, see the `Actions with Entities <./entity-actions>`__ guide. 

For more information about entity fields, see the `Entity Fields <./entity-fields>`__ guide.



