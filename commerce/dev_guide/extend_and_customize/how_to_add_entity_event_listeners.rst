.. index::
    single: Customization; Entity Event Listeners
    single: Events; Entity Event Listeners

How to Add Entity Event Listeners
=================================

*Used application: OroPlatform 1.7*

In some cases, you need to update a field before saving or before updating an entity.
A Doctrine Listener is a perfect way to do that.

Configuring the Listener
------------------------

Suppose that you have already extended an Oro bundle like ``OroContactBundle`` (you can find more information
on this page: `How to extend existing bundle`_).
And you would like to compliment your contact's social information with some external API data.

For this you need to register your listener in the ``services.yml`` file.

.. code-block:: yaml
    :linenos:

    # src/Acme/Bundle/ContactBundle/Resources/config/services.yml
    services:
        contact.listener:
            class: Acme\Bundle\ContactBundle\Listener\SocialFields
            tags:
                - { name: doctrine.event_listener, event: onFlush }

.. _How to extend existing bundle: ./how_to_extend_existing_bundle.rst

Creating the Listener Class
---------------------------

In the previous part, we created the contact.listener that is triggered during the flush of en entity.
In fact, the event will be triggered when all managed entities are being flushed, so you need to check the current
entity class type.

This class must have the ``onFlush`` method, which will be called when the event is dispatched:

.. code-block:: php
    :linenos:

    <?php
    // src/Acme/Bundle/ContactBundle/Listener/SocialFields.php
    namespace Acme\Bundle\ContactBundle\Listener;

    use Doctrine\ORM\Event\OnFlushEventArgs;
    use Oro\Bundle\ContactBundle\Entity\ContactEmail;

    class SocialFields
    {
        public function onFlush(OnFlushEventArgs $args)
        {
            $em = $args->getEntityManager();
            $uow = $em->getUnitOfWork();

            // we would like to listen on insertions and updates events
            $entities = array_merge(
                $uow->getScheduledEntityInsertions(),
                $uow->getScheduledEntityUpdates()
            );

            foreach ($entities as $entity) {
                // every time we update or insert a new ContactEmail entity we do the work
                if (!$entity instanceof ContactEmail) {
                    continue;
                }

                // check if email is primary
                if ($entity->isPrimary()) {
                    $owner = $entity->getOwner();

                    // ... update social info of the owner with its primary email

                    // force persist
                    $em->persist($owner);
                    $md = $em->getClassMetadata(get_class($owner));
                    $uow->computeChangeSet($md, $owner);
                }
            }
        }
    }

.. caution::

    In case of update, we need to persist the related entities and force update
    them with ``computeChangeSet()`` function. Every entity related to the current
    one must be updated like this if you change any property values. If you
    do not, the new value of your related entity's property will not be updated.

References
----------

* `Symfony Cookbook How to Register Event Listeners and Subscribers`_
* `Doctrine Events`_

.. _Symfony Cookbook How to Register Event Listeners and Subscribers: http://symfony.com/doc/current/cookbook/doctrine/event_listeners_subscribers.html
.. _Doctrine Events: http://doctrine-orm.readthedocs.org/en/latest/reference/events.html
