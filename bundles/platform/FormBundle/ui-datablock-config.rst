UI DataBlock Config Overview
============================

This functionality adds the ability to configure DataBlocks for the UI component inside FormType instead of the template.

Configure Block in Template
---------------------------

update.html.twig

.. code-block:: twig

    {% set dataBlocks = [{
                'title': 'First Block',
                'class': '',
                'subblocks': [
                    {
                        'title': '',
                        'data': [
                            form_row(form.name),
                            form_row(form.age)
                        ]
                    },
                    {
                        'title': 'Email SubBlock',
                        'data': [
                            form_row(form.email),
                        ]
                    }
                ]
            }]

    %}

Configure Block in FormType
---------------------------

.. code-block:: php

    class UserType extends AbstractType
    {
        #[\Override]
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder->add('name', TextType::class, ['block' => 'first']);
            $builder->add('age', IntegerType::class, ['block' => 'first', 'subblock' => 'first']);
            $builder->add('email', EmailType::class, ['block' => 'second']);
        }

        #[\Override]
        public function configureOptions(OptionsResolver $resolver)
        {
            $resolver->setDefaults(
                [
                    'block_config' => [
                        'first'  => [
                            'priority'  => 2,
                            'title'     => 'First Block',
                            'subblocks' => [
                                'first'  => [],
                                'second' => [
                                    'title' => 'Email SubBlock'
                                ],
                            ],
                        ],
                    ],
                ]
            );
        }
    }


.. code-block:: twig

   {% set dataBlocks = form_data_blocks(form) %}


* 'block' - the code of a block.

   If a block is not configured in 'block_config', a block will be created.
   If a block title is not configured in 'block_config', title of block will be the same as the code.
   If form type filed options do not have a 'block' attribute, this field will be ignored.

* 'sub-block' - the code of a sub-block.

   If a sub-block is not configured in 'block_config', a subBlock will be created.
   If form type filed options do not have a 'sub-block' attribute, this field will be added to the first sub-block in the block.

   If 'sub-block' is configured but 'block' is not configured, the field will be ignored.


* 'block_config' is an optional attribute.

   This attribute contains the config for the block and sub-block (title, class, sub-blocks).
