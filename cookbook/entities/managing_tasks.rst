How to Create and Modify Tasks
==============================

To let the users create new tasks and edit existing ones you need to perform several steps:

#. :ref:`Create a form type for the Task entity <cookbook-entity-form-type>`.

#. :ref:`Create a controller <cookbook-entity-controller>`.

#. :ref:`Render the form in a template <cookbook-entity-template>`.

#. :ref:`Link data grid entries to the controller <controller-entity-grid-create-edit-link>`.

.. _cookbook-entity-form-type:

The Form Type
-------------

First, you need to create a form type that makes it possible to let the user enter all the data
needed to describe a task:

.. code-block:: php
    :linenos:

    // src/AppBundle/Form/TaskType.php
    namespace AppBundle\Form;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    class TaskType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder)
        {
            $builder
                ->add('subject')
                ->add('description')
                ->add('dueDate')
                ->add('priority')
            ;
        }

        public function configureOptions(OptionsResolver $resolver)
        {
            $resolver->setDefaults(array(
                'data_class' => 'AppBundle\Entity\Task',
            ));
        }
    }

.. _cookbook-entity-controller:

The Controllers
---------------

You then need to create a controller class that comes with two actions: one that is called when a
new task should be created, and one that is able to fetch an existing task to let the user modify
its data:

.. code-block:: php
    :linenos:

    // src/AppBundle/Controller/TaskController.php
    namespace AppBundle\Controller;

    use AppBundle\Entity\Task;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Request;

    /**
     * @Route("/task")
     */
    class TaskController extends Controller
    {
        /**
         * @Route("/create", name="app_task_create")
         * @Template("AppBundle:Task:update.html.twig")
         */
        public function createAction(Request $request)
        {
            return $this->update(new Task(), $request);
        }

        /**
         * @Route("/edit/{id}", name="app_task_update", requirements={"id"="\d+"})
         * @Template("AppBundle:Task:update.html.twig")
         */
        public function editAction(Task $task, Request $request)
        {
            return $this->update($task, $request);
        }

        private function update(Task $task, Request $request)
        {
            $form = $this->createForm(new TaskType(), $task);

            return array(
                'entity' => $task,
                'form' => $form->createView(),
            );
        }
    }

.. _cookbook-entity-template:

The Template
------------

The template that is responsible to display the form fields should extend the base template
``OroUIBundle:actions:html.twig`` from the OroUIBundle. This templates defines some basic blocks
that you can use. This way your own forms will provide the same look and feel as the ones coming
with the OroPlatform:

.. code-block:: html+jinja
    :linenos:

    {# src/AppBundle/Resources/views/Task/update.html.twig #}

    {# extend the base template from the OroUIBundle #}
    {% extends 'OroUIBundle:actions:update.html.twig' %}

    {# reuse the form theme provided with the OroPlatform #}
    {% form_theme form with 'OroFormBundle:Form:fields.html.twig' %}

    {# make the current task accessible with the task variable #}
    {% set task = form.vars.value %}

    {# choose the appropriate action depending on whether a task is created or modified #}
    {# this variable needs to be named formAction as this is what the base template expects #}
    {% if task.id %}
        {% set formAction = path('app_task_update', { 'id': task.id }) %}
    {% else %}
        {% set formAction = path('app_task_create') %}
    {% endif %}

    {% block navButtons %}
        {# the cancelButton() macro creates a button that discards the
           entered data and leads the user to the linked controller #}
        {{ UI.cancelButton(path('app_task_index')) }}

        {# the dropdownSaveButton() macro offers a way to let the user select
           between different options when saving an entity, the selected option
           will be passed to the controller handling the request as an additonal
           parameter #}
        {{ UI.dropdownSaveButton({
            'html': UI.saveAndCloseButton() ~ UI.saveAndStayButton()
        }) }}
    {% endblock navButtons %}

    {% block pageHeader %}
        {% if task.id %}
            {% set breadcrumbs = {
                'entity': task,
                'indexPath': path('app_task_index'),
                'indexLabel': 'Tasks',
                'entityTitle': task.subject
            } %}
            {{ parent() }}
        {% else %}
            {% set title = 'oro.ui.create_entity'|trans({ '%entityName%': 'Task' }) %}
            {{ include('OroUIBundle::page_title_block.html.twig', { title: title }) %}
        {% endif %}
    {% endblock pageHeader %}

    {% block content_data %}
        {% set id = 'task-edit' %}
        {% set dataBlocks = [{
                'title': 'General'|trans,
                'class': 'active',
                'subblocks': [{
                    'title': '',
                    'data': [
                        form_row(form.subject),
                        form_row(form.description),
                        form_row(form.dueDate),
                        form_row(form.priority),
                    ]
                }]
            }]
        %}

        {# the data variable is a special variable that is used in the
           parent content_data block to render the visual content "blocks"
           of a page #}
        {% set data = {
            'formErrors': form_errors(form) ? form_errors(form) : null,
            'dataBlocks': dataBlocks,
        } %}

        {{ parent() }}
    {% endblock content_data %}

.. _controller-entity-grid-create-edit-link:

Linking the Data Grid
---------------------

Finally, you need to link both actions on the page that displays the list of tasks:

**1. Add a link to create new tasks**

The base ``index.html.twig`` template from the OroUIBundle that you already used to embed the data
grid comes with a pre-defined ``navButtons`` block which you can use to add a button that links to
the *create task action*:

.. code-block:: html+jinja
    :linenos:

    {# src/AppBundle/Resources/views/Task/index.html.twig #}
    {% extends 'OroUIBundle:actions:index.html.twig' %}

    {% set gridName = 'app-tasks-grid' %}
    {% set pageTitle = 'Task' %}

    {% block navButtons %}
        <div class="btn-group">
            {{ UI.addButton({
                'path': path('app_task_create'),
                'entity_label': 'Create a task',
            }) }}
        </div>
    {% endblock %}

**2. Link task rows to the related update action**

To make it possible to modify each task you need to define a property that describes how the URL of
the update action is built and then add this URL to the list of available actions in your data grid
configuration:

.. code-block:: yaml
    :linenos:

    # src/AppBundle/Resources/config/datagrid.yml
    datagrid:
        app-tasks-grid:
            # ...
            properties:
                id: ~
                update_link:
                    type: url
                    route: app_task_update
                    params:
                        - id
                # ...
            actions:
                # ...
                edit:
                    type: navigate
                    label: Edit
                    link: update_link
                    icon: edit
