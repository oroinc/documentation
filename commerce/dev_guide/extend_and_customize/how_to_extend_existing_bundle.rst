.. index::
    single: Bundle; Extend a Bundle
    single: Customization; Extend a Bundle

.. _how-to-extend-existing-bundle:

How to Extend Existing Bundle
=============================

*Used application: OroPlatform 1.7*

Bundle Extension
----------------

The OroPlatform application uses `default Symfony functionality to extend bundle`_ (in terms of Symfony it is called
inheritance). To do that you have to override method getParent in your bundle class.
Let's assume that we are using demo bundle from `How to create new bundle`_
article and we want to extend OroUserBundle - in this case ``AcmeNewBundle.php`` file should look like this:

.. _default Symfony functionality to extend bundle: http://symfony.com/doc/2.3/cookbook/bundles/inheritance.html
.. _How to create new bundle: ./how-to-create-new-bundle

.. code-block:: php
    :linenos:

    <?php
    // src/Acme/Bundle/NewBundle/AcmeNewBundle.php
    namespace Acme\Bundle\NewBundle;

    use Symfony\Component\HttpKernel\Bundle\Bundle;

    class AcmeNewBundle extends Bundle
    {
        public function getParent()
        {
            return 'OroUserBundle';
        }
    }

.. caution::
    Due to the Symfony default behaviour the routing from the parent bundle will not be imported automatically.
    So in case if you have any controllers defined in your child bundle you should copy routing definitions from the 
    parent bundle.
    You can check the `Routing` section of Symfony's `How to Override any Part of a Bundle`_ manual for more information.

.. _How to Override any Part of a Bundle: http://symfony.com/doc/current/cookbook/bundles/override.html#routing

In our case will need to add the ``routing.yml`` file with the following content:

.. code-block:: yaml
    :linenos:

    # src/Acme/Bundle/NewBundle/Resources/config/oro/routing.yml
    acme_parent_bundle:
        resource:     "@!OroUserBundle/Controller"
        type:         annotation
        prefix:       /user


The ``@!`` notion is important since it states that the resource should be imported from the parent bundle.

Now let's check that our extension works - to do that let's create a custom template for the User information widget.
So, we need to create ``/src/Acme/Bundle/NewBundle/Resources/views/User/widget/info.html.twig`` file
(this file structure duplicates the file structure of the extended bundle) with our custom content:

.. code-block:: html+jinja
    :linenos:

    <div class="widget-content">
        <div class="row-fluid form-horizontal">
            <div class="responsive-block">
                <h4>My user info widget</h4>
                <b>Username:</b> {{ entity.username }}
            </div>
        </div>
    </div>

And now we can go to the user view page (e.g. ``http://<oro_application_base_url>/index_dev.php/#url=/index_dev.php/user/view/1``) and find
that user info widget has changed:

.. image:: /dev_guide/img/how_to_extend_existing_bundle/user_info_widget.png

That's all - now our demo bundle extends OroUserBundle and can override its parts.


Features and Recommendations
----------------------------

OroPlatform provides several ways of extending bundle resources, and each of them should be used in specific cases.
Extension is the most simple and useful way to do that for basic bundle resources and it can be used widely all over
the system. Other ways to extend specific resources (e.g. configuration files) will be described in further
articles.
Here are the basic parts that can be extended and the way to do that:

* **controller** - using bundle extension (inheritance);
* **templates** - using bundle extension (inheritance);
* **bundles** - using file /Resources/config/oro/bundles.yml;
* **routing** - using file /Resources/config/oro/routing.yml;
* **twig themes** - using file /Resources/config/oro/twig.yml;
* **localization** - using files /Resources/config/oro/locale_data.yml, /Resources/config/oro/name_format.yml,
  /Resources/config/oro/address_format.yml, /Resources/config/oro/currency_data.yml.


References
----------

* `How to use Bundle Inheritance to Override parts of a Bundle`_

.. _How to use Bundle Inheritance to Override parts of a Bundle: http://symfony.com/doc/2.3/cookbook/bundles/inheritance.html

