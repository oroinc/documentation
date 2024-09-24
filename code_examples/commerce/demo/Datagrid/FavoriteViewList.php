<?php

namespace Acme\Bundle\DemoBundle\Datagrid;

use Oro\Bundle\DataGridBundle\Entity\GridView;
use Oro\Bundle\DataGridBundle\Extension\GridViews\AbstractViewsList;
use Oro\Bundle\FilterBundle\Form\Type\Filter\TextFilterType;

/**
 * Grid views for acme-demo-favorite-grid datagrid.
 */
class FavoriteViewList extends AbstractViewsList
{
    protected $systemViews =  [
        [
            'name'         => 'acme_demo.first_view',
            'label'         => 'acme.demo.favorite.datagrid.views.first_example_view_label',
            'is_default'    => false,
            'grid_name'     => 'acme-demo-favorite-grid',
            'type'          => GridView::TYPE_PUBLIC,
            'filters'       => [
                'name' => [
                    'type'  => TextFilterType::TYPE_EQUAL,
                    'value' => 'First favorite'
                ]
            ],
            'sorters'       => [
                'name' => 'DESC'
            ],
            'columns'       => []
        ], [
            'name'         => 'acme_demo.sample_view',
            'label'         => 'acme.demo.favorite.datagrid.views.second_example_view_label',
            'is_default'    => false,
            'grid_name'     => 'acme-demo-favorite-grid',
            'type'          => GridView::TYPE_PUBLIC,
            'filters'       => [
                'name' => [
                    'type'  => TextFilterType::TYPE_STARTS_WITH,
                    'value' => 'Last'
                ]
            ],
            'sorters'       => [],
            'columns'       => [
                'name'                 => ['renderable' => true, 'order' => 1],
                'viewCount'            => ['renderable' => true, 'order' => 2],
                'value'                => ['renderable' => true, 'order' => 3],
            ]
        ]
    ];

    #[\Override]
    protected function getViewsList()
    {
        return $this->getSystemViewsList();
    }
}
