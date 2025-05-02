.. _bundle-docs-commerce-cms-bundle-content-widget-types:

Content Widget Types
====================

OroCommerce provides 7 types of content widgets.

.. csv-table::

   "`contact_us_form`","The widget type that provides a Contact Us form that allows users to submit inquiries."
   "`image_slider`","The widget type that provides the possibility to configure a multiple-image slider."
   "`oro_tabbed_content`","The widget type that provides the possibility to add content in the form of tabs or an accordion."
   "`product_mini_block`","The widget type that provides the possibility to add a block with product information."
   "`product_segment`","The widget type that provides the possibility to add a product segment(slider)."
   "`customer_dashboard_datagrid`","The widget type that provides the possibility to use defined customer dashboard datagrids."
   "`scorecard`","The widget type that provides the possibility to use defined scorecard metrics."


Customer Dashboard Datagrid
---------------------------

There are multiple ways to extend and add a new type of datagrid for selection in this widget:

    - create a custom service that implements ``Oro\Bundle\CommerceBundle\ContentWidget\Provider\CustomerDashboardDatagridsProviderInterface`` and decorates the existing ``Oro\Bundle\CommerceBundle\ContentWidget\Provider\CustomerDashboardDatagridsProvider``,

    .. hint:: Provider must return only datagrids where the `frontend` option is set to `true`.

.. code-block:: php

    class NewProvider implements CustomerDashboardDatagridsProviderInterface
    {
        public function getDatagrids(): array
        {
            return [
                'oro.customer.frontend.dashboard.widgets.my_latest_orders.title' =>
                    'frontend-customer-dashboard-my-latest-orders-grid',
                'oro.customer.frontend.dashboard.widgets.open_quotes.title' =>
                    'frontend-customer-dashboard-open-quotes-grid',
            ];
        }
    }

.. code-block:: yaml

    services:
        oro_commerce.content_widget.provider.new_provider:
            class: Oro\Bundle\CommerceBundle\ContentWidget\Provider\NewProvider
            decorates: oro_commerce.content_widget.provider.customer_dashboard_datagrids


    - use the `setDatagrids` method of the `CustomerDashboardDatagridsProvider` provider to configure additional datagrids.

.. code-block:: yaml

    services:
        oro_commerce.content_widget.provider.new_provider:
            class: Oro\Bundle\CommerceBundle\ContentWidget\Provider\CustomerDashboardDatagridsProvider
            decorates: oro_commerce.content_widget.provider.customer_dashboard_datagrids
            calls:
                - [setDatagrids, [
                    {
                        'oro.customer.frontend.dashboard.widgets.my_latest_orders.title': 'frontend-customer-dashboard-my-latest-orders-grid',
                        'oro.customer.frontend.dashboard.widgets.open_quotes.title': 'frontend-customer-dashboard-open-quotes-grid'
                    }
                ]]


Scorecard
---------

.. note:: The Scorecard content widget is available as of OroCommerce version 6.1.2.

To extend and add a new type of scorecard for selection in this widget, create a custom scorecard provider that implements ``Oro\Bundle\CommerceBundle\ContentWidget\Provider\ScorecardInterface`` and tag it with `oro_commerce.scorecard`.

.. code-block:: php

    class OpenQuotesScorecardProvider implements ScorecardInterface
    {
        public function __construct(
            private ManagerRegistry $registry,
            private AclHelper $aclHelper,
            private AuthorizationCheckerInterface $authorizationChecker
        ) {
        }

        public function getName(): string
        {
            return 'open_quotes';
        }

        public function getLabel(): string
        {
            return 'oro.commerce.content_widget_type.scorecard.open_quotes';
        }

        public function isVisible(): bool
        {
            return $this->authorizationChecker->isGranted(BasicPermission::VIEW, new Quote());
        }

        public function getData(): int|float|null|string|array
        {
            $qb = $this->registry->getRepository(Quote::class)->createQueryBuilder('r');

            return $this->aclHelper->apply($qb->select('COUNT(r.id)'))->getSingleScalarResult();
        }
    }

.. code-block:: yaml

    oro_commerce.content_widget.scorecards.open_quotes:
        class: Oro\Bundle\CommerceBundle\ContentWidget\Provider\OpenQuotesScorecardProvider
        arguments:
            - '@doctrine'
            - '@oro_security.acl_helper'
            - '@security.authorization_checker'
        tags:
            - { name: oro_commerce.scorecard }

.. note:: See the user documentation on :ref:`Content Widgets Management <concept-guide-content-widgets>` for more details about various content widgets available in the system and their configuration.


.. include:: /include/include-links-dev.rst
   :start-after: begin
