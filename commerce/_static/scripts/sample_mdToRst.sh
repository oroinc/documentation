#!/usr/bin/env bash
echo hi there!

cd ./../../../../documentation/commerce/_static/scripts

pandoc --from=markdown --to=rst --output=./../../../../documentation/commerce/install_upgrade/installation_quick_start_dev/platform_readme.rst ./../../../../application/platform/README.md

touch ./../../../../documentation/commerce/install_upgrade/installation_quick_start_dev/platform_readme.rst
