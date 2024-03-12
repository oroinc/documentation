.. _acl-ancestor:

#[AclAncestor]
==============

This attribute is used to protect a controller based on an existing access control list. The ID of
the parent access control list is passed as the only argument:

.. code-block:: php


    // ...
    use Oro\Bundle\SecurityBundle\Attribute\AclAncestor;

    #[AclAncestor("an_acl_id")]
    public function demoAction()
    {
        // ...
    }
