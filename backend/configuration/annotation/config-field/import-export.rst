* **identity** *boolean* - fields with this option are used to identify (search) the entity. You can use multiple identity fields for one entity.

* **excluded** *boolean* - fields with this option cannot be exported.

* **order** *integer* - used to configure a custom column order.

* **full** *boolean* - all related entity fields' are exported. Fields with the excluded option are skipped. If the option is set to false (the default value), only fields with an identity are exported.

* **short** *boolean* - related entities with this option will be exported if they contain identity fields (the default value is false).

* **process_as_scalar** *boolean* - defines whether a relation field is processed as scalar value when exporting data.

* **header** *string* - sets a custom field header. By default, field label is used.

* **fallback_field** *string* - attribute name of related :ref:`localized fallback values <localizedfallbackvalue-entity-from-orolocalebundle>` (the default value is 'string'). Will work if entity data converter extends ``Oro\Bundle\LocaleBundle\ImportExport\DataConverter\LocalizedFallbackValueAwareDataConverter``.

* **immutable** *boolean* - is used to prohibit changing the import/export association state (regardless of whether it is enabled or not) for the entity. If TRUE, then the current state cannot be changed.
