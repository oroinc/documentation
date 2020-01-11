.. _draft-bundle--use-draft-acl:

How to Use Draft ACL
====================

Draft entities have constraints when working with ACL.

Follow the instructions provided in the :ref:`Introduction to Security in Oro Applications <bundle-docs-platform-security-bundle-introduction>` topic for more details.

Permissions
-----------

The list of permissions:

* **Create Drafts** - is responsible for the ``CREATE_DRAFT`` permission. It grants a user permissions to create a draft.
* **View Drafts** - the owner permission (virtual). Responsible for the ``VIEW_DRAFT`` permission of draft entities created by the owner. It has a higher priority than ``View All Drafts``.
* **View All Drafts** - is responsible for the ``VIEW_ALL_DRAFTS`` permission. It grants a user permissions to view all drafts. (Does not restrict draft entities created by the owner).
* **Edit Drafts** - the owner permission (virtual). Responsible for the ``EDIT_DRAFT`` permission of draft entities created by the owner. It has a higher priority than ``Edit All Drafts``.
* **Edit All Drafts** - is responsible for the ``EDIT_ALL_DRAFTS`` permission. It grants a user permissions to edit all drafts. (Does not restrict draft entities created by the owner).
* **Delete Own Drafts** - the owner permission. Responsible for the ``DELETE_DRAFT`` permission of draft entities created by the owner. It has a higher priority than ``Delete All Drafts``.
* **Delete All Drafts** - is responsible for `the `DELETE_ALL_DRAFTS`` permission. It grants a user permissions to delete a draft.
* **Publish Drafts** - is responsible for the ``PUBLISH_DRAFT`` permission. It grants a user permissions to publish a draft.
