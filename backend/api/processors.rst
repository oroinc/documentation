.. _web-api--processors:

Processors
==========

A processor is the main element that implements the business logic of the API. Each processor must implement |ProcessorInterface|  and be registered in the dependency injection container using the ``oro.api.processor`` tag.

Please see the :ref:`actions <web-api--actions>` and :ref:`context <web-api--context-class>` sections for more details about where and how processors are used.

Please see the :ref:`actions <web-api--actions>` section for more details about where and how processors are used.

Also you can use the :ref:`oro:api:debug <oroapidebug>` command to see all actions and processors.

Creating a Processor
--------------------

To create a new processor, create a class that implements |ProcessorInterface| and |tag| it with the ``oro.api.processor`` name.

.. code-block:: php

    <?php

    namespace Acme\Bundle\ProductBundle\Api\Processor;

    use Oro\Bundle\ApiBundle\Processor\Context;
    use Oro\Component\ChainProcessor\ContextInterface;
    use Oro\Component\ChainProcessor\ProcessorInterface;

    /**
     * A short description what the processor does.
     **/
    class DoSomething implements ProcessorInterface
    {
        /**
         * {@inheritdoc}
         */
        public function process(ContextInterface $context)
        {
            /** @var Context $context */

            // do some work here
        }
    }

.. code-block:: yaml

    services:
        acme.api.do_something:
            class: Acme\Bundle\ProductBundle\Api\Processor\DoSomething
            tags:
                - { name: oro.api.processor, action: get, group: normalize_input, priority: 10 }

Please note that:

*  The name of a processor usually starts with a verb and the ``Processor`` suffix is not used.
*  The ``priority`` attribute is used to control the order in which processors are executed. The higher the priority, the earlier a processor is executed. The default value is 0. The possible range is from -255 to 255. But for some types of processors the range can be different. For details, see the documentation of the |ChainProcessor| component. If several processors have the same priority the order they are executed is unpredictable.
*  Each processor should check whether its work is already done, because there may be a processor with a higher priority which does the same but in different way. For example, such processors can be created for customization purposes.
* Prefer `Processor Conditions`_ over a conditional logic inside a processor to avoid loading of unnecessary processors.
*  As API resources can be created for any type of objects, not only ORM entities, it is always a good idea to check whether a processor is applicable to ORM entities. This check is very fast and allows avoiding possible logic issues and performance impact. Please use the ``oro_api.doctrine_helper`` service to get an instance of |Api DoctrineHelper|, as this class is optimized to be used in the API stack.

An example:

.. code-block:: php

        public function process(ContextInterface $context)
        {
            /** @var Context $context */

            $entityClass = $context->getClassName();
            if (!$this->doctrineHelper->isManageableEntityClass($entityClass)) {
                // only manageable entities are supported
                return;
            }

            // do some work
        }

The list of all existing processors you can find in the |Processor| directory.

.. _processor-conditions:

Processor Conditions
--------------------

When you register a processor in the dependency injection container, you can specify conditions when the processor should be executed. Use the attributes of the ``oro.api.processor`` tag to specify conditions. Any context property which is scalar, array or object (instance of the |ToArrayInterface| ) can be used in the conditions.

For example, a simple condition which is used to filter processors by the action:

.. code-block:: yaml

    services:
        acme.api.do_something:
            class: Acme\Bundle\ProductBundle\Api\Processor\DoSomething
            tags:
                - { name: oro.api.processor, action: get }

In this case, the ``acme.api.do_something`` is executed only in scope of the get action, for other actions this processor is skipped.

Conditions provide a simple way to specify which processors are required to accomplish a work. Pay attention that the dependency injection container does not load processors that does not fit the conditions. Use conditions to create the fast API.

This allows building conditions based on any attribute from the context.

Condition types depend on the registered |Applicable Checkers|. By default, the following checkers are registered:

-  |MatchApplicableChecker|

For performance reasons, the functionality of |SkipGroupApplicableChecker| and |GroupRangeApplicableChecker| was implemented as part of |OptimizedProcessorIterator|.

Examples of Processor Conditions
--------------------------------

-  No conditions. A processor is executed for all actions.

.. code-block:: yaml

        tags:
            - { name: oro.api.processor }

-  A processor is executed only for a specified action.

.. code-block:: yaml

        tags:
            - { name: oro.api.processor, action: get_list }

-  A processor is executed only for a specified action and group.

.. code-block:: yaml

        tags:
            - { name: oro.api.processor, action: get_list, group: initialize }

-  A processor is executed only for a specified action, group and request type.

.. code-block:: yaml

        tags:
            - { name: oro.api.processor, action: get_list, group: initialize, requestType: rest }

-  A processor is executed for all requests except for the specified one.

.. code-block:: yaml

        tags:
            - { name: oro.api.processor, action: get_list, group: initialize, requestType: !rest }

-  A processor is executed only for REST requests that conform to the |JSON:API| specification.

.. code-block:: yaml

        tags:
            - { name: oro.api.processor, action: get_list, group: initialize, requestType: rest&json_api }

-  A processor is executed either for REST requests or requests that conform to the |JSON:API| specification.

.. code-block:: yaml

        tags:
            - { name: oro.api.processor, action: get_list, group: initialize, requestType: rest|json_api }

**Please note** that a value can contain either ``&`` (logical AND) or ``|`` (logical OR) operators, but you cannot combine them.

-  A processor is executed for all REST requests excluding requests that conform  to the |JSON:API| specification.

.. code-block:: yaml

        tags:
            - { name: oro.api.processor, action: get_list, group: initialize, requestType: rest&!json_api }

-  A processor is executed for several specified actions.

.. code-block:: yaml

        tags:
            - { name: oro.api.processor, action: get, group: initialize, priority: 10 }
            - { name: oro.api.processor, action: get_list, group: initialize, priority: 5 }

-  A processor is executed only for a specified entity.

.. code-block:: yaml

        tags:
            - { name: oro.api.processor, action: get_list, group: initialize, class: Oro\Bundle\UserBundle\Entity\User }

-  A processor is executed only for entities that implement an certain interface or extend a certain base class. Currently, there are two attributes that are compared by the **instance of** instead of **equal** operator. These attributes are **class** and **parentClass**.

.. code-block:: yaml

        tags:
            - { name: oro.api.processor, action: get_list, group: initialize, class: Oro\Bundle\UserBundle\Entity\AbstractUser }

-  A processor is executed only when ``someAttribute`` exists in the context.

.. code-block:: yaml

        tags:
            - { name: oro.api.processor, action: get_list, group: initialize, someAttribute: exists }

**Please note** that ``exists`` operators cannot be used together with ``&`` (logical AND) and ``|`` (logical OR) operators.

-  A processor is executed only when ``someAttribute`` does not exist in the context.

.. code-block:: yaml

        tags:
            - { name: oro.api.processor, action: get_list, group: initialize, someAttribute: '!exists' }

For more examples, see the |configuration of existing processors|. See ``processors.*.yml`` files.

Error Handling
--------------

There are several types of errors that may occur when processing a request:

-  **Validation errors**. A validation error occurs if a request has some invalid parameters, headers, or data.
-  **Security errors**. This type of error occurs if access is denied to a requested, updated, or deleted entity.
-  **Unexpected errors**. These errors will occur if an unpredictable problem happens. For example, no access to the database or a file system, requested entity does not exist, updating entity is blocked, etc.

Please note that to validate input data for :ref:`create <create-action>` and :ref:`update <update-action>` actions the best solution is to use validation constraints. In most cases it helps avoid writing any PHP code and configuring the required validation rules in ``Resources/config/oro/api.yml``. For the detailed information on how to add custom validation constraints, see the :ref:`Forms and Validators Configuration <web-api--forms>` topic. The following example shows how to add a validation constraint via ``Resources/config/oro/api.yml``:

.. code-block:: yaml

    api:
        entities:
            Acme\Bundle\AcmeBundle\Entity\AcmeEntity:
                fields:
                    primaryEmail:
                        form_options:
                            constraints:
                                # add Symfony\Component\Validator\Constraints\Email validation constraint
                                - Email: ~

If an error occurs in a processor, the main execution flow is interrupted and the control is passed to a special group of processors, that is named **normalize\_result**. This is true for all types of errors. But there are some exceptions for this rule for the errors that occur in any processor of the **normalize\_result** group. The execution flow is interrupted only if any of these processors raises an exception. However, these processors can safely add new errors into the
:ref:`context <web-api--context-class>` and the execution of the next processors will not be interrupted. For implementation details see |RequestActionProcessor|.

An error is represented by the |Error| class. Additionally, the |ErrorSource| class can be used to specify a source of an error, e.g. the name of a URI parameter or the path to a property in the data. These classes have the following methods:

**Error** class

-  **create(title, detail)** *static* - Creates an instance of the **Error** class.
-  **createValidationError(title, detail)** *static* - Creates an instance of the **Error** class represents a violation of validation constraint.
-  **createByException(exception)** *static* - Creates an instance of the **Error** class based on a given exception object.
-  **getStatusCode()** - Retrieves the HTTP status code applicable to this problem.
-  **getCode()** - Retrieves an application-specific error code.
-  **setCode(code)** - Sets an application-specific error code.
-  **getTitle()** - Retrieves a short, human-readable summary of the problem that should not change from occurrence to occurrence of the problem.
-  **setTitle(title)** - Sets a short, human-readable summary of the problem that should not change from occurrence to occurrence of the problem.
-  **getDetail()** - Retrieves a human-readable explanation specific to this occurrence of the problem.
-  **setDetail(detail)** - Sets a human-readable explanation specific to this occurrence of the problem.
-  **getSource()** - Retrieves the instance of |ErrorSource| that represents a source of this occurrence of the problem.
-  **setSource(source)** - Sets the instance of |ErrorSource| that represents a source of this occurrence of the problem.
-  **getInnerException()** - Retrieves an exception object that caused this occurrence of the problem.
-  **setInnerException(exception)** - Sets an exception object that caused this occurrence of the problem.
-  **trans(translator)** - Translates all attributes that are represented by the |Label| object.

**ErrorSource** class

-  **createByPropertyPath(propertyPath)** *static* - Creates an instance of the **ErrorSource** class that represents the path to a property caused the error.
-  **createByPointer(pointer)** *static* - Creates an instance of the **ErrorSource** class that represents a pointer to a property in the request document caused the error.
-  **createByParameter(parameter)** *static* - Creates an instance of the **ErrorSource** class that represents URI query parameter caused the error.
-  **getPropertyPath()** - Retrieves the path to a property that caused the error. For example, ``title`` or ``author.name``.
-  **setPropertyPath(propertyPath)** - Sets the path to a property that caused the error.
-  **getPointer()** - Retrieves a pointer to a property in the request document that caused the error. For JSON, the pointer conforms |RFC 6901|. For example, ``/data`` for a primary data object, or ``/data/attributes/title`` for a specific attribute.
-  **setPointer(pointer)** - Sets a pointer to a property in the request document that caused the error.
-  **getParameter()** - Retrieves URI query parameter that caused the error.
-  **setParameter(parameter)** - Sets URI query parameter that caused the error.

Let us consider how a processor can inform that some error is occurred.

The simplest way is just throw an exception. For example:

.. code-block:: php

    <?php

    namespace Oro\Bundle\ApiBundle\Processor\Shared;

    use Doctrine\ORM\QueryBuilder;

    use Oro\Component\ChainProcessor\ContextInterface;
    use Oro\Component\ChainProcessor\ProcessorInterface;
    use Oro\Component\EntitySerializer\EntitySerializer;
    use Oro\Bundle\ApiBundle\Exception\RuntimeException;
    use Oro\Bundle\ApiBundle\Processor\Context;
    use Oro\Bundle\ApiBundle\Request\ApiActionGroup;

    /**
     * Loads entity using the EntitySerializer component.
     * As returned data is already normalized, the "normalize_data" group will be skipped.
     */
    class LoadEntityByEntitySerializer implements ProcessorInterface
    {
        /** @var EntitySerializer */
        private $entitySerializer;

        /**
         * @param EntitySerializer $entitySerializer
         */
        public function __construct(EntitySerializer $entitySerializer)
        {
            $this->entitySerializer = $entitySerializer;
        }

        /**
         * {@inheritdoc}
         */
        public function process(ContextInterface $context)
        {
            /** @var Context $context */

            if ($context->hasResult()) {
                // data already retrieved
                return;
            }

            $query = $context->getQuery();
            if (!$query instanceof QueryBuilder) {
                // unsupported query
                return;
            }

            $config = $context->getConfig();
            if (null === $config) {
                // an entity configuration does not exist
                return;
            }

            $result = $this->entitySerializer->serialize(
                $query,
                $config,
                $context->getNormalizationContext()
            );
            if (empty($result)) {
                $result = null;
            } elseif (count($result) === 1) {
                $result = reset($result);
            } else {
                throw new RuntimeException('The result must have one or zero items.');
            }

            $context->setResult($result);

            // data returned by the EntitySerializer are already normalized
            $context->skipGroup(ApiActionGroup::NORMALIZE_DATA);
        }
    }

This way is good to for unexpected and security errors (for security errors, throw ``Symfony\Component\Security\Core\Exception\AccessDeniedException``). The raised exception will be converted to the **Error** object automatically by |NormalizeResultActionProcessor|.The services named as exception text extractors automatically fill the meaningful properties of the error objects (like HTTP status code, title, and description) based on the underlying exception object. The default implementation of such extractor is |ExceptionTextExtractor|. To add a new extractor, create a class that implements |ExceptionTextExtractorInterface| and tag it with the ``oro.api.exception_text_extractor`` in the dependency injection container.

Another way to add an **Error** object to the context is good for validation errors because it allows you to add several errors:

.. code-block:: php

    <?php

    namespace Oro\Bundle\ApiBundle\Processor\Shared;

    use Oro\Component\ChainProcessor\ContextInterface;
    use Oro\Component\ChainProcessor\ProcessorInterface;
    use Oro\Bundle\ApiBundle\Model\Error;
    use Oro\Bundle\ApiBundle\Processor\SingleItemContext;
    use Oro\Bundle\ApiBundle\Request\Constraint;

    /**
     * Makes sure that the identifier of an entity exists in the Context.
     */
    class ValidateEntityIdExists implements ProcessorInterface
    {
        /**
         * {@inheritdoc}
         */
        public function process(ContextInterface $context)
        {
            /** @var SingleItemContext $context */

            $entityId = $context->getId();
            if ((null === $entityId || '' === $entityId) && $context->hasIdentifierFields()) {
                 $context->addError(
                    Error::createValidationError(
                        Constraint::ENTITY_ID,
                        'The identifier of an entity must be set in the context.'
                    )
                );
            }
        }
    }


Please note that the default HTTP status code for validation errors is ``400 Bad Request``. If needed, another HTTP status code can be set, e.g. by passing it as a third argument of the ``Error::createValidationError`` method.

The |Constraint| class contains titles for different kind of validation errors. All titles end with word **constraint**. It is recommended to use the same template when adding custom types.

All API logs are written into the api channel. To inject the API logger directly to your processors, use the |common way|. For example:

.. code-block:: yaml

        acme.api.some_processor:
            class: Acme\Bundle\AcmeBundle\Api\Processor\DoSomething
            arguments:
                - '@logger'
            tags:
                - { name: oro.api.processor, ... }
                - { name: monolog.logger, channel: api }


.. include:: /include/include-links-dev.rst
   :start-after: begin
