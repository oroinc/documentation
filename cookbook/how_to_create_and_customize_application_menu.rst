How to create and customize application menu
============================================

*Used application: OroCRM RC2*

* `Create your route with annotation`_
* `Create and fill navigation.yml`_
* `Override existing section`_
* `References`_


In Oro Platform you can create your totally personalized menu or use a simple technique to add or override section in default menu.
This tutorial describes how to override section in default menu.

Let's assume that you already have a bundle with namespace "Acme\\Bundle\\NewBundle" in the /src directory
with annotation configuration format `generated or created manually`_.

.. _generated or created manually: ./how_to_create_new_bundle.rst


Create your route with annotation
---------------------------------

First you have to go to your default controller, create your action and specify annotation route
(realtive file path is src/Acme/Bundle/NewBundle/Controller/DefaultController.php):

.. code-block:: php

    <?php
    
    namespace Acme\Bundle\NewBundle\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

    class DefaultController extends Controller
    {
        /**
         * @Route("/hello", name="acme_link")
         * @Template()
         */
        public function indexAction()
        {
            return array('name' => "hello link");
        }
    }
    

Next you should specify action template (file path is src/Acme/Bundle/NewBundle/Resources/views/Default/index.html.twig) 
with the following content:

.. code-block:: html+jinja

    {% extends "OroUIBundle:Default:index.html.twig" %}
    {% block content %}
    {{ name }}!
    {% endblock content %}
    
And the latest thing - you shoud register your bundle routes. To do that you have to create file routing.yml
in src/Acme/Bundle/NewBundle/Resources/config/oro/routing.yml with the following content:

.. code-block:: yaml

    acme_new_bundle:
        resource:     "@AcmeNewBundle/Controller"
        type:         annotation
        prefix:       /user


Create and fill navigation.yml
-------------------------------

Now we need to create navigation.yml file in src/Acme/Bundle/NewBundle/Resources/config/navigation.yml with the following content:

.. code-block:: yaml

    oro_menu_config:
        items:
            acme_tab:
                label: Acme label
                uri:   '#'
                extras:
                    position: 300
            acme_tab_link:
                label: Acme link label
                route: acme_link
                extras:
                    routes: ['/^acme_link/']
                    description: My description
        tree:
            application_menu:
                children:
                    acme_tab:
                        children:
                            acme_tab_link: ~
    
    oro_titles:
        acme_link: My link page title


Then you have to reload navigation data and clear cache:

::

    user@host:/var/www/vhosts/platform-application$ php app/console oro:navigation:init
    Load "Title Templates" from annotations and config files to db
    Completed

    user@host:/var/www/vhosts/platform-application$ php app/console cache:clear
    Clearing the cache for the dev environment with debug true

.. note::

    You can use php app/console cache:clear with parameters --env=prod or --env=dev.

Here item and child related to default Oro Platform menu:

.. image:: ./img/how_to_create_and_customize_application_menu/add_item_to_default_nav.png

And here the page result after click:

.. image:: ./img/how_to_create_and_customize_application_menu/add_item_page_result_click.png



Override existing section 
-------------------------

To override some section in menu you have to create the navigation.yml file in 
/src/Acme/Bundle/NewBundle/Resources/config/navigation.yml with the following content
(it will add a link with name "Acme link1 label" in sales section):

.. code-block:: yaml

    oro_menu_config:
        items:
            sales_tab:
                label: Sales
                uri:   '#'
                extras:
                    position: 100
            acme_tab_link1:
                label: Acme link label
                route: acme_link
                extras:
                    routes: ['/^acme_link/']
                    description: My description
        tree:
            application_menu:
                children:
                    sales_tab:
                        merge_strategy: append
                        children:
                            acme_tab_link: ~

    oro_titles:
        acme_link: oro dev
        
        
And reload navigation data and clear cache:

::

    user@host:/var/www/vhosts/platform-application$ php app/console oro:navigation:init
    Load "Title Templates" from annotations and config files to db
    Completed

    user@host:/var/www/vhosts/platform-application$ php app/console cache:clear
    Clearing the cache for the dev environment with debug true


Here you can find the new item Acme link1 label in  Sales section:

.. image:: ./img/how_to_create_and_customize_application_menu/ov_item_in_default_nav.png


References
----------

* `Symfony Best Practices for Structuring Bundles`_
* `OroPlatform NavigationBundle README.md`_

.. _Symfony Best Practices for Structuring Bundles: http://symfony.com/doc/2.3/cookbook/bundles/best_practices.html
.. _OroPlatform NavigationBundle README.md: https://github.com/orocrm/platform/blob/master/src/Oro/Bundle/NavigationBundle/README.md
