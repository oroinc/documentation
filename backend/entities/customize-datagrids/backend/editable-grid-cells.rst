Editable Datagrid Cells
=======================

Editable datagrid cells are used to change data directly in the grid. Currently, select and radio buttons editable cells are supported.

Example of Use
--------------

A good example is ``customer-product-visibility-grid``. The product edit page has a customer grid with the ``visibilityForCustomer`` column.
Users can set the visibility type of the current product for the customer in the grid.
For example, suppose we already have entity ``CustomerProductVisibility`` with relations between ``customer``, ``product``, and enum ``visibility``.

In this case, a developer should perform three steps, discussed below.

1. **Mark editable some fields in the datagrid config and add cellSelection**

Example of grid configuration:

.. code-block:: yaml

    datagrids:
        customer-product-visibility-grid:
            source:
                acl_resource:      acme_product_view
                type:              orm
                query:
                    select:
                        - customer.id
                        - customer.name
                        - IDENTITY(customerProductVisibility.visibility) as visibility
                    from:
                        - { table: 'Acme\Bundle\DemoBundle\Entity\Customer', alias: customer }
                    join:
                        left:
                            - { join: 'Acme\Bundle\DemoBundle\Entity\CustomerProductVisibility', alias: customerProductVisibility, conditionType: WITH, condition: 'customerProductVisibility.customer = customer' }
                    where:
                        and:
                            - IDENTITY(customerProductVisibility.product) = :product_id
                bind_parameters:
                    - product_id
            inline_editing:
                enable: true # this grid will allow to edit some cells
            columns:
                name:
                    label: acme.customer.name.label
                visibility:
                    label: acme.customer.product_visibility.label
                    frontend_type: select
                    inline_editing:
                        enable: true # this cell will be editable
                    expanded: true # this cell will be rendered as radio buttons
                    choices: "@oro_entity_extend.enum_value_provider->getEnumChoicesByCode('cust_prod_visibility')"
            options:
                cellSelection:
                    dataField: id
                    columnName:
                        - visibility
                    selector: '#customer-product-visibility-changeset'
            properties:
                id: ~

Common options:

The section ``inline_editing`` with the option ``enable`` for columns makes the cell editable. Option ``cellSelection`` adds the editable cell's behavior in the frontend grid.

Event listener ``\Oro\Bundle\DataGridBundle\EventListener\CellSelectionListener`` is applied to all grids with the ``cellSelection`` option.
If this option is specified, the listener will add a js module ``orodatagrid/js/datagrid/listener/change-editable-cell-listener`` to handle changes in behavior in the frontend.

To receive the select options or radio button values, use the ``oro_entity_extend.enum_value_provider`` service, which provides the ability to get enum values by enum code.

2. **Add** ``oro_entity_changeset`` **to form type**

.. code-block:: php

    $builder
        ...
        ->add(
            'visibilityForCustomer',
            EntityChangesetType::class,
            [
                'class' => 'OroB2B\Bundle\CustomerBundle\Entity\Customer'
            ]
        )
        ...


Option ``class`` in ``\Oro\Bundle\FormBundle\Form\Type\EntityChangesetType`` is required. It is the class name of the grid item.

Then, add the ``visibilityForCustomer`` field in the template.

.. code-block:: twig

    ...
    form_row(form.visibilityForCustomer, {'id': 'customer-product-visibility-changeset'})
    ...

Attribute ``id`` must be specified in the ``selector`` parameter of the grid config: ``selector: '#customer-product-visibility-changeset'``.

As a result, field ``visibilityForCustomer`` which contains data in the current format is going to be hidden:

.. code-block:: twig

    {"<customerId>" : {"<visibility>" : "<value>", ...}, ... }

3. **Create a custom form handler with processing editable grid cells**

To convert enum value in the handler, use method ``getEnumValueByCode`` of the ``oro_entity_extend.enum_value_provider`` service.

Below is an example of such a handler:

.. code-block:: php

    ...
    /**
     * Process form
     *
     * @param Product $product
     * @return bool True on successful processing, false otherwise
     */
    public function process(Product $product)
    {
        $this->form->setData($product);
        if (in_array($this->request->getMethod(), ['POST', 'PUT'], true)) {
            $this->form->submit($this->request);

            if ($this->form->isValid()) {
                $this->onSuccess($product);

                return true;
            }
        }

        return false;
    }

    /**
     * "Success" form handler
     *
     * @param Product $product
     */
    protected function onSuccess(Product $product)
    {
        $changeSet = $this->form->get('visibilityForCustomer')->getData();

        foreach ($changeSet as $item) {
            /** @var Customer $customer */
            $customer = $item['entity'];
            $productVisibility = $this->manager->getRepository(CustomerProductVisibility::class)
                ->findOneBy(['product' => $product, 'customer' => $customer]);

            if (!$productVisibility) {
                $productVisibility = new CustomerProductVisibility();
                $productVisibility->setProduct($product);
                $productVisibility->setCustomer($customer);
            }

                'cust_prod_visibility',
                $item['data']['visibility']
            );

            $productVisibility->setVisibility($visibility);
            $this->manager->persist($productVisibility);
        }

        $this->manager->persist($product);
        $this->manager->flush();
    }
    ...
