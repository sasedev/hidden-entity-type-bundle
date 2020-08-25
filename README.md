# Sasedev - Hidden Entity Type Bundle

Hidden entity type for Symfony forms.

## What is it?

This is a Symfony form type that allows you to add an entity in your form that would be displayed as a hidden input.

## Installation

### Step 1: Download HiddenEntityTypeBundle using composer
```bash
$ composer require sasedev/hidden-entity-type-bundle
```
Composer will install the bundle to your project's vendor directory.

### Step 2: Enable the bundle
Enable the bundle in the config if flex it did´nt do it for you:
```php
<?php
// config/bundles.php

return [
    // ...
    Sasedev\HiddenEntityTypeBundle\SasedevHiddenEntityTypeBundle::class => ['all' => true],
    // ...
];
```

## Usage

### Simple usage:
You can use the type in your forms just like this:
```php
<?php

use Sasedev\HiddenEntityTypeBundle\Form\Type\HiddenEntityType;

// ...
$builder->add('entity', HiddenEntityType::class, array(
    'class' => YourBundleEntity::class
));
```
You can also use the `HiddenDocumentType::class` type:
```php
<?php

use Sasedev\HiddenEntityTypeBundle\Form\Type\HiddenDocumentType;

// ...
$builder->add('document', HiddenDocumentType::class, array(
    'class' => YourBundleDocument::class
));
```
There is only one required option "class". You must specify entity class in Symfony format that you want to be used in your form.

### Advanced usage:
You can use the `HiddenEntityType` or `HiddenDocumentType` type in your forms this way:
```php
<?php
// ...
$builder->add('entity', HiddenEntityType::class, array(
    'class' => YourBundleEntity::class, // required
    'property' => 'entity_id', // Mapped property name (default is 'id'), not required
    'multiple' => false, // support for an array of entities, not required
    'data' => $entity, // Field value by default, not required
    'invalid_message' => 'The entity does not exist.', // Message that would be shown if no entity found, not required
));
```

## Reporting an issue or a feature request
Feel free to report any issues. If you have an idea to make it better go ahead and modify and submit pull requests.

### Original

The orginal source is from Glifery (https://github.com/Glifery/EntityHiddenTypeBundle) but seems not to be supported anymore.
I forked the code from Shapecode (https://github.com/shapecode/hidden-entity-type-bundle) because his bundle doesn't support php 7.2 and i cannont upgrade all my servers to php 7.4
