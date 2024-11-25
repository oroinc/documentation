<?php

namespace Acme\Bundle\DemoBundle\Workflow\ActionGroup;

use Oro\Bundle\CheckoutBundle\Workflow\ActionGroup\StartShoppingListCheckoutInterface;
use Oro\Bundle\ShoppingListBundle\Entity\ShoppingList;

/**
 * Transfer external_po_number from shopping list to the checkout on checkout creation.
 */
class StartShoppingListCheckout implements StartShoppingListCheckoutInterface
{
    public function __construct(
        private StartShoppingListCheckoutInterface $innerAction
    ) {
    }

    public function execute(
        ShoppingList $shoppingList,
        bool $forceStartCheckout = false,
        bool $showErrors = false,
        bool $validateOnStartCheckout = true,
        bool $allowManualSourceRemove = true,
        bool $removeSource = true,
        bool $clearSource = false
    ): array {
        $result = $this->innerAction->execute(
            $shoppingList,
            $forceStartCheckout,
            $showErrors,
            $validateOnStartCheckout,
            $allowManualSourceRemove,
            $removeSource,
            $clearSource
        );

        $result['checkout']->setExternalPoNumber($shoppingList->getExternalPoNumber());

        return $result;
    }
}
