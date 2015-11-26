Creating a simple CRUD
======================

When you deal with your own entities you usually want to create so-called CRUDs for them. CRUD is
an acronym for **C**\ reate, **R**\ ead, **U**\ pdate and **D**\ elete.

Basically, you will want to create controllers for the following actions:

* :ref:`Display a filterable list of objects. <book-crud-grid>`
* :ref:`Create forms to create new objects and update existing ones. <book-crud-create-update>`
* :ref:`View all the details of a single stored object. <book-crud-view>`
* :ref:`Add a way to delete an entity. <book-crud-delete>`

This chapter assumes that you want to manage the car pool of your company. You want to store the
car model, the number of seats, the date it was purchased and the date when it needs to be returned
to the leasing company. The ``Vehicle`` entity class can look like this:

.. code-block:: php
    :linenos:

    // src/InventoryBundle/Entity/Vehicle.php
    namespace InventoryBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;

    /**
     * @ORM\Entity
     * @ORM\Table(name="vehicle")
     */
    class Vehicle
    {
        /**
         * @ORM\Id
         * @ORM\GeneratedValue(strategy="AUTO")
         * @ORM\Column(type="integer")
         */
        private $id;

        /**
         * @ORM\Column(type="string", length=100)
         */
        private $model;

        /**
         * @ORM\Column(type="integer")
         */
        private $seats;

        /**
         * @ORM\Column(name="bought_at", type="date")
         */
        private $boughtAt;

        /**
         * @ORM\Column(name="leased_until", type="date")
         */
        private $leasedUntil;

        public function getId()
        {
            return $this->id;
        }

        public function getModel()
        {
            return $this->model;
        }

        public function setModel($model)
        {
            $this->model = $model;
        }

        public function getSeats()
        {
            return $this->seats;
        }

        public function setSeats($seats)
        {
            $this->seats = $seats;
        }

        public function getBoughtAt()
        {
            return $this->boughtAt;
        }

        public function setBoughtAt($boughtAt)
        {
            $this->boughtAt = $boughtAt;
        }

        public function getLeasedUntil()
        {
            return $this->leasedUntil;
        }

        public function setLeasedUntil($leasedUntil)
        {
            $this->leasedUntil = $leasedUntil;
        }
    }

.. _book-crud-controller-class:

The main Controller Class
-------------------------

The controller actions to view, create and modify entities that will be explained in the following
sections will live in the ``VehicleController`` class:

.. code-block:: php
    :linenos:

    // src/InventoryBundle/Controller/VehicleController.php
    namespace InventoryBundle\Controller;

    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;

    /**
     * @Route("/vehicle")
     */
    class VehicleController extends Controller
    {
    }

Unless in common Symfony applications you only have to add the routing information for this
controller class in a ``routing.yml`` file that is located in the bundle's ``Resources/config/oro``
directory:

.. code-block:: yaml
    :linenos:

    # src/InventoryBundle/Resources/config/oro/routing.yml
    inventory_bundle:
        resource: "@InventoryBundle/Controller"
        type: annotation
        prefix: /inventory

When the routing configuration is located in the ``Resources/config/oro`` directory, it will be
discovered automatically when the cache is warmed up. So you do not need to add anything to the
global application routing configuration.

.. _book-crud-grid:

The Datagrid
------------

Relying on the features provided by OroPlatform, the controller for listing the stored objects
becomes really slim. It basically just needs to return the name of the grid:

.. code-block:: php
    :linenos:

    // src/InventoryBundle/Controller/VehicleController.php
    namespace InventoryBundle\Controller;

    use Oro\Bundle\SecurityBundle\Annotation\Acl;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
    // ...

    class VehicleController extends Controller
    {
        /**
         * @Route("/", name="inventory.vehicle_index")
         * @Template
         * @Acl(
         *     id="inventory.vehicle_view",
         *     type="entity",
         *     class="InventoryBundle:Vehicle",
         *     permission="VIEW"
         * )
         */
        public function indexAction()
        {
            return array('gridName' => 'vehicles-grid');
        }
    }

The ``@Route`` annotation tells Symfony to map requests to ``/inventory/vehicle/`` to your new
``indexAction`` controller (the ``/inventory`` part comes from the prefix configured in
:ref:`routing.yml file <book-crud-controller-class>` and the ``/vehicle`` part is configured
via the ``@Route`` annotation on the class level).

Using the ``@Template`` annotation lets Symfony create a response based on a template whose name
is derived from the bundle name and the actual action while using the returned array as parameters
passed to the template (since the default format is HTML, the logical template name for this action
will be ``InventoryBundle:Vehicle:index.html.twig``).

.. seealso::

    You can read more about both the ``@Route`` and the ``@Template`` annotation in the
    `SensioFrameworkExtraBundle documentation`_.

``@Acl`` and ``@AclAncestor`` annotations will help you to configure security limitations for your action

.. seealso::

    Take a look at the `OroSecurityBundle`_ documentation to find out details about security configuration


Now you have to create the template for this action:

.. code-block:: html+jinja
    :linenos:

    {% extends 'OroUIBundle:actions:index.html.twig' %}
    {% import 'OroUIBundle::macros.html.twig' as UI %}
    {% set pageTitle = 'Vehicles'|trans %}

    {% block navButtons %}
        {% if resource_granted('inventory.vehicle_view') %}
            <div class="btn-group">
                {{ UI.addButton({
                'path': path('inventory.vehicle_create'),
                'entity_label': 'Vehicle'|trans
                }) }}
            </div>
        {% endif %}
    {% endblock %}

As you can see, the template extends the `OroUIBundle:actions:index.html.twig`_ template from the
OroPlatform and uses a `macro from the UI bundle`_ to add a button for creating new vehicles.

But how does the UI bundle know which properties should be displayed in which order? The answer to
this is the ``gridName`` variable (set to ``vehicles-grid`` above). This variable refers to the
name of a datagrid that will be looked up from a file called ``datagrid.yml`` in the bundle's
``Resources/config`` directory:

.. code-block:: yaml
    :linenos:

    # src/InventoryBundle/Resources/config/datagrid.yml
    datagrid:
        vehicles-grid:
            source:
                acl_resource: inventory.vehicle_view
                type: orm
                query:
                    select:
                        - v.id
                        - v.model
                        - v.seats
                        - v.boughtAt
                        - v.leasedUntil
                    from:
                        - { table: InventoryBundle:Vehicle, alias: v }
            columns:
                model:
                    label: Model
                seats:
                    label: '# Seats'
                boughtAt:
                    label: Bought at
                    frontend_type: date
                leasedUntil:
                    label: Leased until
                    frontend_type: date
            properties:
                id: ~
                update_link:
                    type: url
                    route: inventory.vehicle_update
                    params:
                        - id
                view_link:
                    type: url
                    route: inventory.vehicle_view
                    params:
                        - id
                delete_link:
                    type: url
                    route: inventory_api_delete_vehicle
                    params:
                        - id
            sorters:
                columns:
                    model:
                        data_name: v.model
                    seats:
                        data_name: v.seats
                    boughtAt:
                        data_name: v.boughtAt
                    leasedUntil:
                        data_name: v.leasedUntil
                default:
                    model: ASC
            filters:
                columns:
                    model:
                        type: string
                        data_name: v.model
                    seats:
                        type: number
                        data_name: v.seats
                    boughtAt:
                        type: date
                        data_name: v.boughtAt
                    leasedUntil:
                        type: date
                        data_name: v.leasedUntil
            actions:
                view:
                    type:          navigate
                    label:         View
                    link:          view_link
                    icon:          eye-open
                    acl_resource:  inventory.vehicle_view
                    rowAction:     true
                update:
                    type:          navigate
                    label:         Update
                    link:          update_link
                    icon:          edit
                    acl_resource:  inventory.vehicle_update
                delete:
                    type:          delete
                    label:         Delete
                    link:          delete_link
                    icon:          trash
                    acl_resource:  inventory.vehicle_delete

This file contains the configuration for one more datagrids under the ``datagrid`` key. Each grid
is identified by a name (``vehicles-grid`` here) and consists of the following sections:

``source``
    First, you need to configure which data the grid will be showing. Usually, you'll do this by
    configuring a Doctrine query (by using the value ``orm`` for the ``type`` key). The
    ``acl_resource`` option can be used to define access rules for a datagrid. In this example, the
    ACL is not needed as the controller itself is already protected with the same rule. Though it
    is recommended to add it nonetheless since a datagrid can be reused in other actions.

``columns``
    The ``columns`` key is used to configure the grid's columns. The ``label`` option is used to
    define a headline per column (the Twig ``trans`` filter is automatically applied to each
    label). If you do not configure a ``frontend_type``, the value will be shown as is.

``properties``
    With ``properties`` you have to configure some reusable properties. At least, you will have to
    define the ``id`` property which is used by the grid to determine if an entity is new. Usually,
    you can set this to ``~``. It will then be assumed that your entity is identified by an ``id``
    property. Usually, you also configure the links to other controller actions.

``sorters``
    To be able to click on the column headlines to sort the rows, you use the ``sorters`` option.
    For each column you define the entity property to sort by when the column is clicked. The
    ``default`` key is used to determine how to sort rows when the datagrid is visited the first
    time.

``filters``
    Configures the filters displayed above the datagrid.

``actions``
    Here, you define which actions can be performed by the user. For the links, you refer to the
    ones defined with the ``properties`` key before. Labels will also be translated. If the
    configured ``type`` is ``navigate``, clicking the icon will be the same as clicking on an HTML
    link while using ``delete`` performs an HTTP DELETE request in the background.

.. seealso::
    Take a look on `OroDatagridBundle`_ to find more details about datagrid configuration

.. _book-crud-create-update:

Creating and Updating Entities
------------------------------

To be able to create new vehicles and update existing ones, you first have to create a form type
and register it as a service:

.. code-block:: php
    :linenos:

    // src/InventoryBundle/Form/Type/VehicleType.php
    namespace InventoryBundle\Form\Type;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolverInterface;

    class VehicleType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder
                ->add('model')
                ->add('seats')
                ->add('boughtAt')
                ->add('leasedUntil')
            ;
        }

        public function configureOptions(OptionsResolver $resolver)
        {
            $resolver->setDefaults(array(
                'data_class' => 'InventoryBundle\Entity\Vehicle',
            ));
        }

        public function getName()
        {
            return 'inventory_vehicle';
        }
    }

.. code-block:: yaml
    :linenos:

    # src/InventoryBundle/Resources/config/form.yml
    services:
        inventory.form.type.vehicle:
            class: InventoryBundle\Form\Type\VehicleType
            tags:
                - { name: form.type, alias: inventory_vehicle }

Note that most often it is a good idea (especially when you have many services in your bundle) to define form related services in a separate configuration file. By convention ``form.yml`` is used but since it's not autoloaded we need to loaded maually in the bundle extension class:

.. code-block:: php
    :linenos:
    
    // src/InventoryBundle/DependencyInjection/InventoryExtension.php;
    namespace InventoryBundle\DependencyInjection;

    // ...
    
    class InventoryExtension extends Extension
    {
        public function load(array $configs, ContainerBuilder $container)
        {
            ...
            
            $loader->load('form.yml');
        }
    }

Then, you will need to create the needed controller actions. You can simplify the actions if you
create a dedicated method that is handling the form submission:

.. code-block:: php
    :linenos:

    // src/InventoryBundle/Controller/VehicleController.php
    namespace InventoryBundle\Controller;

    // ...
    use InventoryBundle\Entity\Vehicle;
    use Symfony\Component\HttpFoundation\Request;

    class VehicleController extends Controller
    {
        /**
         * @Route("/create", name="inventory.vehicle_create")
         * @Template("InventoryBundle:Vehicle:update.html.twig")
         * @Acl(
         *     id="inventory.vehicle_create",
         *     type="entity",
         *     class="InventoryBundle:Vehicle",
         *     permission="CREATE"
         * )
         */
        public function createAction(Request $request)
        {
            return $this->update(new Vehicle(), $request);
        }

        /**
         * @Route("/update/{id}", name="inventory.vehicle_update", requirements={"id":"\d+"}, defaults={"id":0})
         * @Template()
         * @Acl(
         *     id="inventory.vehicle_update",
         *     type="entity",
         *     class="InventoryBundle:Vehicle",
         *     permission="EDIT"
         * )
         */
        public function updateAction(Vehicle $vehicle, Request $request)
        {
            return $this->update($vehicle, $request);
        }

        private function update(Vehicle $vehicle, Request $request)
        {
            $form = $this->get('form.factory')->create('inventory_vehicle', $vehicle);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($vehicle);
                $entityManager->flush();

                return $this->get('oro_ui.router')->redirectAfterSave(
                    array(
                        'route' => 'inventory.vehicle_update',
                        'parameters' => array('id' => $vehicle->getId()),
                    ),
                    array('route' => 'inventory.vehicle_index'),
                    $vehicle
                );
            }

            return array(
                'entity' => $vehicle,
                'form' => $form->createView(),
            );
        }
    }

.. seealso::

    You can also use unified `OroFormUpdateHandler`_ to handle entity create/update requests

Both actions just need to return the ``Vehicle`` to be shown in the form as well as the
``FormView`` itself. Then, the template can look like this:

.. code-block:: html+jinja
    :linenos:

    {# src/InventoryBundle/Resources/views/Vehicle/update.html.twig #}
    {% extends 'OroUIBundle:actions:update.html.twig' %}
    {% form_theme form with 'OroFormBundle:Form:fields.html.twig' %}

    {% if form.vars.value.id %}
        {% set formAction = path('inventory.vehicle_update', { 'id': form.vars.value.id }) %}
    {% else %}
        {% set formAction = path('inventory.vehicle_create') %}
    {% endif %}

    {% block navButtons %}
        {% if form.vars.value.id and resource_granted('DELETE', form.vars.value) %}
            {{ UI.deleteButton({
                'dataUrl': path('inventory_api_delete_vehicle', {'id': form.vars.value.id}),
                'dataRedirect': path('inventory.vehicle_index'),
                'aCss': 'no-hash remove-button',
                'id': 'btn-remove-tag',
                'dataId': form.vars.value.id,
                'entity_label': 'Vehicle'|trans
            }) }}
            {{ UI.buttonSeparator() }}
        {% endif %}
        {{ UI.cancelButton(path('inventory.vehicle_index')) }}
        {% set html = UI.saveAndCloseButton() %}
        {% if resource_granted('inventory.vehicle_update') %}
            {% set html = html ~ UI.saveAndStayButton() %}
        {% endif %}
        {{ UI.dropdownSaveButton({ 'html': html }) }}
    {% endblock navButtons %}

    {% block pageHeader %}
        {% if form.vars.value.id %}
            {% set breadcrumbs = {
                'entity':      form.vars.value,
                'indexPath':   path('inventory.vehicle_index'),
                'indexLabel': 'Vehicles'|trans,
                'entityTitle': form.vars.value.model
            } %}
            {{ parent() }}
        {% else %}
            {% set title = 'oro.ui.create_entity'|trans({'%entityName%': 'Vehicle'|trans}) %}
            {% include 'OroUIBundle::page_title_block.html.twig' with { title: title } %}
        {% endif %}
    {% endblock pageHeader %}

    {% block content_data %}
        {% set id = 'vehicle-edit' %}

        {% set dataBlocks = [{
                'title': 'General'|trans,
                'class': 'active',
                'subblocks': [{
                    'title': '',
                    'data': [
                        form_row(form.model),
                        form_row(form.seats),
                        form_row(form.boughtAt),
                        form_row(form.leasedUntil),
                    ]
                }]
            }]
        %}
        {% set data = {
            'formErrors': form_errors(form)? form_errors(form) : null,
            'dataBlocks': dataBlocks,
        } %}
        {{ parent() }}
    {% endblock content_data %}

The template extends the `update.html.twig`_ base template that is defined in the OroUIBundle. You
just have to customize some important blocks to get desired output:

``navButtons``

    With this block, you can customize which buttons will be shown above the form allowing the user
    to save the form and to trigger additional options. Beware that you set the ``formAction``
    variable to a proper value depending on the controller the user accessed.

``pageHeader``

    This is the title block that is used to show a breadcrumb-style navigation and a custom title.

``content_data``

    This block defines the main contents of the update page which is read from the ``data``
    variable by the parent template. If you want to divide your form into several sections, you can
    define multiple ``dataBlocks`` here for this purpose.

.. seealso::

    Take a look at the templates that are shipped with the OroUIBundle to find out what blocks you
    can also use to customize the layout of your forms.

After the user submitted the form and the entered data is valid, the data will be persisted using
the entity manager and a flash message is added which will be shown to the user on the request. The
``oro_ui.router`` service is then used to redirect the user depending on the button they clicked to
submit the form. They will be redirected to the first route that is passed to
``redirectAfterSave()`` if they chose the *Save* button and if the user chose the *Save and close*
button they will be redirected to the second route.

.. _book-crud-view:

Show Details of an Entity
-------------------------

To display all the details of an entity, you have to perform two steps. First, you need to create a
controller that fetches the object from the database and passes it to a template:

.. code-block:: php
    :linenos:

    // src/InventoryBundle/Controller/VehicleController.php
    namespace InventoryBundle\Controller;

    use InventoryBundle\Entity\Vehicle;
    use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
    // ...

    class VehicleController extends Controller
    {
        /**
         * @Route("/{id}", name="inventory.vehicle_view", requirements={"id"="\d+"})
         * @Template
         * @AclAncestor("inventory.vehicle_view")
         */
        public function viewAction(Vehicle $vehicle)
        {
            return array('vehicle' => $vehicle);
        }
    }

And of course you also have to create the matching template:

.. code-block:: html+jinja
    :linenos:

    {# src/InventoryBundle/Resources/views/Vehicle/view.html.twig #}
    {% extends 'OroUIBundle:actions:view.html.twig' %}
    {% import 'OroUIBundle::macros.html.twig' as UI %}

    {% block navButtons %}
        {% if resource_granted('EDIT', vehicle) %}
            {{ UI.editButton({
                'path' : path('inventory.vehicle_update', { id: vehicle.id }),
                'entity_label': 'Vehicle'|trans
            }) }}
        {% endif %}

        {% if resource_granted('DELETE', vehicle) %}
            {{ UI.deleteButton({
                'dataUrl': path('inventory_api_delete_vehicle', {'id': vehicle.id}),
                'dataRedirect': path('inventory.vehicle_index'),
                'aCss': 'no-hash remove-button',
                'id': 'btn-remove-vehicle',
                'dataId': vehicle.id,
                'entity_label': 'Vehicle'|trans,
            }) }}
        {% endif %}
    {% endblock navButtons %}

    {% block pageHeader %}
        {% set breadcrumbs = {
            'entity':      vehicle,
            'indexPath':   path('inventory.vehicle_index'),
            'indexLabel': 'Vehicles'|trans,
            'entityTitle': vehicle.model
        } %}
        {{ parent() }}
    {% endblock pageHeader %}

    {% block content_data %}
        {% set data %}
            <div class="widget-content">
                <div class="row-fluid form-horizontal">
                    <div class="responsive-block">
                        {{ UI.renderProperty('Model'|trans, vehicle.model) }}
                        {{ UI.renderProperty('Seats'|trans, vehicle.seats) }}
                        {{ UI.renderProperty('Bought at'|trans, vehicle.boughtAt|date) }}
                        {{ UI.renderProperty('Leased until'|trans, vehicle.leasedUntil|date) }}
                    </div>
                </div>
            </div>
        {% endset %}
        {% set dataBlocks = [
            {
                'title': 'Data'|trans,
                'class': 'active',
                'subblocks': [
                    { 'data' : [data] }
                ]
            }
        ] %}

        {% set id = 'vehicleView' %}
        {% set data = { 'dataBlocks': dataBlocks } %}
        {{ parent() }}
    {% endblock content_data %}

As you can see the blocks being used are basically the same as in the template that was used to
display a :ref:`form to create and update vehicles <book-crud-create-update>`. Refer to that
section for an explanation of the different blocks.

.. _book-crud-delete:

Deleting Entities
-----------------

As you may have noticed, the datagrid configuration used the special ``delete`` type when defining
the action that will be performed when the user clicks the trash icon for an entry. When the
``delete`` is used, Oro will perform a ``DELETE`` HTTP request to the referenced resource. You can
easily create a REST controller that handles the ``DELETE`` request by extending the
:class:`Oro\\Bundle\\SoapBundle\\Controller\\Api\\Rest\\RestController` class:

.. code-block:: php
    :linenos:

    // src/InventoryBundle/Controller/Api/Rest/VehicleController.php
    namespace InventoryBundle\Controller\Api\Rest;

    use FOS\RestBundle\Controller\Annotations\NamePrefix;
    use FOS\RestBundle\Controller\Annotations\RouteResource;
    use Oro\Bundle\SecurityBundle\Annotation\Acl;
    use Oro\Bundle\SoapBundle\Controller\Api\Rest\RestController;

    /**
     * @RouteResource("vehicle")
     * @NamePrefix("inventory_api_")
     */
    class VehicleController extends RestController
    {
        /**
         * @Acl(
         *      id="inventory.vehicle_delete",
         *      type="entity",
         *      class="InventoryBundle:Vehicle",
         *      permission="DELETE"
         * )
         */
        public function deleteAction($id)
        {
            return $this->handleDeleteRequest($id);
        }

        public function getForm()
        {
        }

        public function getFormHandler()
        {
        }

        public function getManager()
        {
            return $this->get('inventory.vehicle_manager.api');
        }
    }

Thanks to the `FOSRestBundle`_, you just have to follow some naming conventions to create the
controller action that is able to properly handle the ``DELETE`` requests.

The ``getManager()`` method must return an object that is able to actually delete the object that
is identified by the passed ID. Luckily, you don't have to implement your own class, but you can
just create a service which is an instance of the
:class:`Oro\\Bundle\\SoapBundle\\Entity\\Manager\\ApiEntityManager` class:

.. code-block:: yaml
    :linenos:

    # src/InventoryBundle/Resources/config/services.yml
    services:
        inventory.vehicle_manager.api:
            class: Oro\Bundle\SoapBundle\Entity\Manager\ApiEntityManager
            parent: oro_soap.manager.entity_manager.abstract
            arguments:
                - InventoryBundle\Entity\Vehicle
                - "@doctrine.orm.entity_manager"

Finally, make sure to load the controllers route:

.. code-block:: yaml
    :linenos:

    # src/InventoryBundle/Resources/config/oro/routing.yml
    inventory_api_vehicle:
        resource:     "@InventoryBundle/Controller/Api/Rest/VehicleController.php"
        type:         rest
        prefix:       api/rest/{version}/
        requirements:
            version:  latest|v1
            _format:  json
        defaults:
            version:  latest

.. _`SensioFrameworkExtraBundle documentation`: http://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/index.html
.. _`OroUIBundle:actions:index.html.twig`: https://github.com/orocrm/platform/blob/master/src/Oro/Bundle/UIBundle/Resources/views/actions/index.html.twig
.. _`macro from the UI bundle`: https://github.com/orocrm/platform/blob/master/src/Oro/Bundle/UIBundle/Resources/views/macros.html.twig
.. _`update.html.twig`: https://github.com/orocrm/platform/blob/master/src/Oro/Bundle/UIBundle/Resources/views/actions/update.html.twig
.. _`FOSRestBundle`: http://symfony.com/doc/master/bundles/FOSRestBundle/index.html
.. _`OroSecurityBundle`: https://github.com/orocrm/platform/blob/master/src/Oro/Bundle/SecurityBundle/readme.md
.. _`OroDatagridBundle`: https://github.com/orocrm/platform/blob/master/src/Oro/Bundle/DataGridBundle/README.md
.. _`OroFormUpdateHandler`: https://github.com/orocrm/platform/blob/master/src/Oro/Bundle/FormBundle/Model/UpdateHandler.php