.. _bundle-docs-platform-ui-bundle-input-widgets:

Input Widgets
=============

An input widget is a widget used for form elements, such as datepicker, uniform, select2, or others.

An **input widget** is used to provide a common API for all input widgets.
By using this API, you provide the ability to change the input widget to any other or remove it without changing the code that interacts with the widget.

**InputWidgetManager** is used to register input widgets and create a widget for applicable inputs.

**$.fn.inputWidget** - is a jQuery API for InputWidgetManager or InputWidget.

**Example of usage:**

.. code-block:: javascript
   :linenos:

    //Create new input widget

    var AbstractInputWidget = require('oroui/js/app/views/input-widget/abstract');
    var UniformSelectInputWidget = AbstractInputWidget.extend({
        widgetFunctionName: 'uniform',
        refreshOptions: 'update',
        containerClassSuffix: 'select',

        dispose: function() {
            if (this.disposed) {
                return;
            }
            this.$el.uniform.restore();
            UniformSelectInputWidget.__super__.dispose.apply(this, arguments);
        },

        findContainer: function() {
            return this.$el.parent('.selector');
        }
    });

    //Register widget in InputWidgetManager

    var InputWidgetManager = require('oroui/js/input-widget-manager');
    InputWidgetManager.addWidget('uniform-select', {
        selector: 'select:not(.no-uniform)',
        Widget: UniformSelectInputWidget
    });

    //Create widgets for all apllicable inputs

    $(':input').inputWidget('create');

    /**
    * Call function from InputWidget or jQuery.
    * See available functions in AbstractInputWidget.overrideJqueryMethods
    * Example: will be executed InputWidget.val function, if widget and function exists, or $.val function.
    */
    $(':input').inputWidget('val', newValue);

Your can see more examples in code:

* `InputWidgetManager` and `$.fn.inputWidget` with examples in comments: |oroui/js/input-widget-manager.js|
* `AbstractInputWidget`: |oroui/js/app/views/input-widget/abstract|
* `UniformSelectInputWidget`: |oroui/js/app/views/input-widget/uniform-select|
* `UniformFileInputWidget`: |oroui/js/app/views/input-widget/uniform-file|
* Register `UniformSelectInputWidget` and `UniformFileInputWidget` in `InputWidgetManager`: |oroui/js/app/modules/input-widgets|


.. include:: /include/include-links-dev.rst
   :start-after: begin