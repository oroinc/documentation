.. _orocloud-maintenance-patches:

How to Apply Patches
~~~~~~~~~~~~~~~~~~~~

Maintenance agent is configured to apply patches once the source code is deployed and the composer install command execution is complete.

.. code-block:: none

   deployment:
       after_composer_install_commands:
          - bash -c 'if [[ -d patch ]]; then ls patch | grep ".patch$" | xargs -I{} bash -c "patch -p0 < patch/{}"; fi'

To enforce custom patches, create the `patch` directory in the root of the repository and put the appropriate `.patch` files there.

If your application can apply patches, for example, via the specific bundle, ensure that the patches enforced using the patch directory do not overlap and conflict with those your enforce via embedded application tools.

To ensure that the patch is correct and can be applied, use the following command:

.. code-block:: none

   patch -p0 < patch/file.patch
