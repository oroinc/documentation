.. _backend-filters-form-types:

Filter Form Types
=================

Filter Form Types are PHP classes that represent filters and extend standard Symfony form types.
Each filter form type is a compound and consists of two fields:

* a field for filter value (named "value")
* a field for filter operator (named "type")

The following filters form types are available:

.. csv-table::
   :header: "Class","Name", "Short Description"
   :widths: 15, 15, 30

   "FilterType","oro_type_filter","Basic type for all filters, declares two children value and type"
   "TextFilterType","oro_type_text_filter","Represents text filter form"
   "NumberFilterType","oro_type_number_filter","Represents number filter form"
   "NumberRangeFilterType","oro_type_number_range_filter","Represents number range filter form"
   "ChoiceFilterType","oro_type_choice_filter","Represents choice filter form"
   "EntityFilterType","oro_type_entity_filter","Represents entity filter form"
   "BooleanFilterType","oro_type_boolean_filter","Represents boolean filter form"
   "DateRangeFilterType","oro_type_date_range_filter","Represents date filter form"
   "DateTimeRangeFilterType","oro_type_datetime_range_filter","Represents date and time filter form"
   "DateRangeType","oro_type_date_range","This form type is used by oro_type_date_range_filter as field type"
   "DateTimeRangeType","oro_type_datetime_range","This form type is used by oro_type_datetime_range_filter as field type"
   "SelectRowFilterType","oro_type_selectrow_filter","This form type is used by datagrid extension only"
   "DateGroupingFilterType","oro_type_date_grouping_filter","Represents date grouping filter"
   "SkipEmptyPeriodsFilterType","oro_type_skip_empty_periods_filter","Represents skip empty periods filter"

oro\_type\_filter Form Type
---------------------------

**Children**

* value
* type

**Options**

* field_type
* field_options
* operator_choices
* operator_type
* operator_options
* show_filter

**Default Options**

* field_type = TextType::class
* operator_type = ChoiceType::class
* show_filter = False

**Class**

``Oro\Bundle\FilterBundle\Form\Type\Filter\FilterType``

**Options Description**

* **field_type** - This option declares type of value child element.
* **field_options** - Value of this option will be used as options array for value field.
* **operator_choices** - Value of this option will be used as value of "choices" option of type field.
* **operator_type** - This option declares type of type child element. By default has "choice" value.
* **operator_options** - Value of this option will be used as options array for type field.
* **show_filter** - If FALSE then filter will be hidden when it's rendered in filter list.

oro\_type\_text\_filter Form Type
---------------------------------

**Inherit Options**

* field_type
* field_options
* operator_choices
* operator_type
* operator_options
* show_filter

**Default Options**

* field_type = text
* operator\_choices

  * TextFilterType::TYPE\_CONTAINS
  * TextFilterType::TYPE\_NOT_CONTAINS
  * TextFilterType::TYPE\_EQUAL

**Parent Type**

oro\_type\_filter

**Class**

``Oro\Bundle\FilterBundle\Form\Type\Filter\TextFilterType``

**JS Class**

*ro.Filter.TextFilter*

.. _backend-filters-form-types--number:

oro\_type\_number\_filter Form Type
-----------------------------------

**Options**

* data_type
* fromatter_options

**Inherit Options**

* field_type
* field_options
* operator_choices
* operator_type
* operator_options
* show_filter

**Default Options**

* field_type = text
* operator\_choices

  * NumberFilterType::TYPE\_GREATER\_EQUAL
  * NumberFilterType::TYPE\_GREATER\_THAN
  * NumberFilterType::TYPE\_EQUAL
  * NumberFilterType::TYPE\_LESS\_EQUAL
  * NumberFilterType::TYPE\_LESS\_THAN

* data\_type = NumberFilterType::DATA\_INTEGER

**Parent Type**

oro\_type\_filter

**Class**

``Oro\Bundle\FilterBundle\Form\Type\Filter\NumberFilterType``

**JS Class**

*Oro.Filter.NumberFilter*

**Options**

* **data\_type** - This option can be used for configuration of value field type. Can be a value of one of constants:
  ::DATA\_INTEGER or NumberFilterType::DATA\_DECIMAL.

**formatter_options**

In addition to data_type option, this option can contain parameters for number formatter that is used by value field. 
Available attributes are:

* decimals - maximum fraction digits
* grouping - use grouping to separate digits
* orderSeparator - symbol of grouping separator
* decimalSeparator - symbol of decimal separator.

.. _backend-filters-form-types-oro-type-number-range-filter:

oro\_type\_number\_range\_filter Form Type
------------------------------------------

**Options**

* data_type
* formatter_options

**Inherit Options**

* field_type
* field_options
* operator_choices
* operator_type
* operator_options
* show_filter

**Default Options**

* field_type = text
* operator\_choices

  * NumberRangeFilterType::TYPE\_BETWEEN
  * NumberRangeFilterType::TYPE\_NOT\_BETWEEN
  * NumberRangeFilterType::TYPE\_GREATER\_EQUAL
  * NumberRangeFilterType::TYPE\_GREATER\_EQUAL
  * NumberRangeFilterType::TYPE\_GREATER\_THAN
  * NumberRangeFilterType::TYPE\_EQUAL
  * NumberRangeFilterType::TYPE\_LESS\_EQUAL
  * NumberRangeFilterType::TYPE\_LESS\_THAN
  * FilterUtility::TYPE\_EMPTY
  * FilterUtility::TYPE\_NOT\_EMPTY

* data\_type = NumberFilterType::DATA\_INTEGER

**Parent Type**

oro\_type\_number\_filter

**Class**

``Oro\Bundle\FilterBundle\Form\Type\Filter\NumberRangeFilterType``

**JS Class**

*Oro.Filter.NumberRangeFilter*

**Options**

* **data\_type** - This option can be used for configuration of value field type. Can be a value of one of constants:
  NumberFilterType::DATA\_INTEGER or NumberFilterType::DATA\_DECIMAL.

**formatter_options**

In addition to data_type option, this option can contain parameters for number formatter that is used by value field.
Available attributes are:

* decimals - maximum fraction digits
* grouping - use grouping to separate digits
* orderSeparator - symbol of grouping separator
* decimalSeparator - symbol of decimal separator.

.. _backend-filters-form-types-oro-type-choice-filter:

oro\_type\_choice\_filter Form Type
-----------------------------------

**Inherit Options**

* field\_type
* field\_options
* operator\_choices
* operator\_type
* operator\_options
* show\_filter

**Default Options**

* field\_type = choice
* operator\_choices

  * ChoiceFilterType::TYPE\_CONTAINS
  * ChoiceFilterType::TYPE\_NOT\_CONTAINS

**Parent Type**

oro\_type\_filter

**Class**

``Oro\Bundle\FilterBundle\Form\Type\Filter\ChoiceFilterType``

**JS Classes**

*Oro.Filter.MultiSelectFilter*
*Oro.Filter.SelectFilter*

.. _backend-filters-form-types-oro-type-entity-filter:

oro\_type\_entity\_filter Form Type
-----------------------------------

**Inherit Options**

* field\_type
* field\_options
* operator\_choices
* operator\_type
* operator\_options
* show\_filter

**Default Options**

* field\_type = entity

**Parent Type**

oro\_type\_choice\_filter

**Class**

``Oro\Bundle\FilterBundle\Form\Type\Filter\EntityFilterType``

**JS Classes**

*Oro.Filter.MultiSelectFilter*
*Oro.Filter.SelectFilter*

.. _backend-filters-form-types-oro-type-boolean-filter:

oro\_type\_boolean\_filter Form Type
------------------------------------

**Inherit Options**

* field\_type
* field\_options
* operator\_choices
* operator\_type
* operator\_options
* show\_filter

**Default Options**

* field\_options = choices

  * BooleanFilterType::TYPE\_YES
  * BooleanFilterType::TYPE\_NO

**Parent Type**

oro\_type\_choice\_filter

**Class**

``Oro\Bundle\FilterBundle\Form\Type\Filter\BooleanFilterType``

**JS Class**

*Oro.Filter.SelectFilter*

.. _backend-filters-form-types-oro-type-daterange-filter:

oro\_type\_date\_range\_filter Form Type
----------------------------------------

**Options**

* widget\_options
* type\_values

**Inherit Options**

* field\_type
* field\_options
* operator\_choices
* operator\_type
* operator\_options
* show\_filter

**Default Options**

* field\_type = oro\_type\_date\_range
* widget\_options = array("dateFormat" => "mm/dd/yy", "firstDay" => 0)
* operator\_choices

  * DateRangeFilterType::TYPE\_BETWEEN
  * DateRangeFilterType::TYPE\_NOT\_BETWEEN

* type\_values

  * DateRangeFilterType::TYPE\_BETWEEN
  * DateRangeFilterType::TYPE\_NOT\_BETWEEN

**Parent Type**

oro\_type\_filter

**Class**

``Oro\Bundle\FilterBundle\Form\Type\Filter\DateRangeFilterType``

**JS Classes**

*Oro.Filter.DateFilter*

**Options Description**

* **widget\_options** - Value of this option will be used by javascript widget to correctly display its data. Default value of this option depend from of current application locale options.
* **type\_values** - Value of this option will be used by javascript widget to generate valid hint of current filter value (strings like "between %start% and %end%", "before %start%", "after %end%", "not between %start%", etc)

.. _backend-filters-form-types-oro-type-datetime-filter:

oro\_type\_datetime\_range\_filter Form Type
--------------------------------------------

**Options**

* widget\_options
* type\_values

**Inherit Options**

* field\_type
* field\_options
* operator\_choices
* operator\_type
* operator\_options
* show\_filter
* type\_values
* widget\_options

**Default Options**

* field\_type = oro\_type\_datetime\_range
* widget\_options = array("dateFormat" => "mm/dd/yy", "timeFormat" => "hh:mm tt", "firstDay" => 0)

**Parent Type**

oro\_type\_date\_range\_filter

**Class**

``Oro\Bundle\FilterBundle\Form\Type\Filter\DateRangeFilterType``

**JS Classes**

*Oro.Filter.DateFilter*

oro\_type\_date\_range Form Type
--------------------------------

**Children**

* start
* end

**Options**

* field\_type
* field\_options
* start\_field\_options
* end\_field\_options

**Default Options**

* field\_type = "date"

**Class**

``Oro\Bundle\FilterBundle\Form\Type\DateRangeType``

**Options Description**

* **field\_type** - This option declares type of start and end child elements.
* **field\_options** - Value of this option will be used as options array for start and end fields.
* **start\_field\_options** - Value of this option will be used as options array for start field.
* **end\_field\_options** - Value of this option will be used as options array for end field.

oro\_type\_datetime\_range Form Type
------------------------------------

**Default Options**

* field\_type = "datetime"

**Parent Type**

oro\_type\_date\_range

**Class**

``Oro\Bundle\FilterBundle\Form\Type\DateTimeRangeType``

.. _backend-filters-form-types-selectrow:

oro\_type\_selectrow  Form Type
-------------------------------

Provides filtering by selected/not selected rows in datagrid

**Default Options**

* field\_type = "choice"

**Parent Type**

oro\_type\_filter

**Class**

``Oro\Bundle\FilterBundle\Form\Type\SelectRowFilterType``

oro_filter.form.type.date_grouping

.. _backend-filters-form-types-grouping:

oro\_type\_date\_grouping\_filter Form Type
-------------------------------------------

**Options**

* data\_name
* joined\_column
* not\_nullable\_field
* calendar\_entity
* target\_entity

**Inherit Options**

* field\_type
* field\_options
* operator\_choices
* operator\_type
* operator\_options
* show\_filter
* field\_type
* operator\_choices

**Default Options**

* calendar\_table = "calendarDate"
* calendar\_column = 'date'
* calendar\_table\_for\_grouping = 'calendarDate1'
* calendar\_column\_for\_grouping = 'date'
* joined\_table = 'joinedTableAlias'
* target\_column = 'date'

**Parent Type**

oro\_type\_choice\_filter

**Class**

``Oro\Bundle\FilterBundle\Form\Type\Filter\DateGroupingFilterType``

**JS Classes**

*Oro.Filter.MultiSelectFilter*
*Oro.Filter.SelectFilter*

.. _backend-filters-form-types-skip-empty-periods:

oro\_type\_skip\_empty\_periods\_filter Form Type
-------------------------------------------------

**Options**

* not\_nullable\_field

**Inherit Options**

* field\_type
* field\_options
* operator\_choices
* operator\_type
* operator\_options
* show\_filter
* field\_type
* operator\_choices

**Parent Type**

oro\_type\_choice\_filter

**Class**

``Oro\Bundle\FilterBundle\Form\Type\Filter\DateGroupingFilterType``

**JS Classes**

*Oro.Filter.MultiSelectFilter*
*Oro.Filter.SelectFilter*

Example of Usage
----------------

You can use filter form types as any other form type in Symfony. For example, consider you have a form 
with three filters. In your form type you should add code like this:

.. code-block:: php
   :linenos:

    class MyFilterFormType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            // Add some form fields
            // ...
            // Add filters
            $builder->add('name', 'oro_type_text_filter');
            $builder->add('salary', 'oro_type_number_filter');
            $builder->add('hobby', 'oro_type_choice_filter', array(
            field_options' => array(
                    'choices' => array(1 => 'Coding', 2 => 'Hiking', 3 => 'Photography'),
                    'multiple' => true
                )
            ));
        }
    }


References
----------

* Symfony 2 Form Types

  * |Create Custom Field Type|
  * |Types|

.. include:: /include/include-links-dev.rst
   :start-after: begin