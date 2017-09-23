echo hi there!

cd d:/master_laboro_dev_2.0/dev/documentation/commerce/_static/scripts

rem ProductBundle
rem package/commerce/src/Oro/Bundle/ProductBundle/README.md

rem package/commerce/src/Oro/Bundle/ProductBundle/Resources/doc/customize-products.md
rem package/commerce/src/Oro/Bundle/ProductBundle/Resources/doc/customize-plp.md
rem package/commerce/src/Oro/Bundle/ProductBundle/Resources/doc/customize-pdp.md

pandoc --from=markdown --to=rst --output=d:\master_laboro_dev_2.0\dev\documentation\commerce\dev_guide\bundles\product\index.rst d:\master_laboro_dev_2.0\dev\package\commerce\src\Oro\Bundle\ProductBundle\README.md

touch d:\master_laboro_dev_2.0\dev\documentation\commerce\dev_guide\bundles\product\customize-products.rst

pandoc --from=markdown --to=rst --output=d:\master_laboro_dev_2.0\dev\documentation\commerce\dev_guide\bundles\product\customize-products.rst d:\master_laboro_dev_2.0\dev\package\commerce\src\Oro\Bundle\ProductBundle\Resources\doc\customize-products.md

touch d:\master_laboro_dev_2.0\dev\documentation\commerce\dev_guide\bundles\product\customize-plp.rst

pandoc --from=markdown --to=rst --output=d:\master_laboro_dev_2.0\dev\documentation\commerce\dev_guide\bundles\product\customize-plp.rst d:\master_laboro_dev_2.0\dev\package\commerce\src\Oro\Bundle\ProductBundle\Resources\doc\customize-plp.md

touch d:\master_laboro_dev_2.0\dev\documentation\commerce\dev_guide\bundles\product\customize-pdp.rst

pandoc --from=markdown --to=rst --output=d:\master_laboro_dev_2.0\dev\documentation\commerce\dev_guide\bundles\product\customize-pdp.rst d:\master_laboro_dev_2.0\dev\package\commerce\src\Oro\Bundle\ProductBundle\Resources\doc\customize-pdp.md

