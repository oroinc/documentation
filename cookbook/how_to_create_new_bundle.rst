How to create new bundle
========================

*Used application: OroPlatform RC2*

* `Create bundle manually`_
* `Create bundle automatically`_
* `Enable bundle`_
* `References`_


New bundle can be created either manually, or automatically using standard Symfony console command.


Create bundle manually
----------------------

First you need to specify name and namespace of your bundle. Symfony framework already has
`best practices for bundle structure and bundle name`_ and we recommend to follow these practices and use them.

.. _best practices for bundle structure and bundle name: http://symfony.com/doc/2.3/cookbook/bundles/best_practices.html#bundle-name

Let's assume that we want to create AcmeNewBundle and put it under namespace Acme\Bundle\NewBundle
in the /src directory. We need to create corresponding directory structure and bundle file
/src/Acme/Bundle/NewBundle/AcmeNewBundle.php with the following content:

.. code-block:: php
    :linenos:

    <?php

    namespace Acme\Bundle\NewBundle;

    use Symfony\Component\HttpKernel\Bundle\Bundle;

    class AcmeNewBundle extends Bundle
    {
    }

Basically, it's a regular Symfony bundle. The only difference is in the way it will be enabled
(see chapter `Enable bundle`_).


