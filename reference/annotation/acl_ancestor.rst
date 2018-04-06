@AclAncestor
============

.. include:: /old_version_notice.rst
   :start-after: begin_old_version_notice

This annotation is used to protect a controller based on an existing access control list. The ID of
the parent access control list is passed as the only option:

.. code-block:: php
    :linenos:

    // ...
    use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

    /**
     * @AclAncestor("an_acl_id")
     */
    public function demoAction()
    {
        // ...
    }
