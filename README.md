# ACF Objects

## Installation

```sh
composer require tombroucke/acf-objects
```

# Usage
- In sage 10, Acorn should be able to locate src/AcfObjectsServiceProvider.php. If it doesn't, you should add this provider to the providers array in /config/app.php:

```php
Otomaties\AcfObjects\AcfObjectsServiceProvider::class
```

- To use this library without Acorn, use this snippet:
```php
add_filter('acf/format_value', function ($value, $post_id, $field) {
    $value = \Otomaties\AcfObjects\Acf::findClassByFieldType($value, $post_id, $field);
    return $value;
}, 99, 3);
```

# Examples
Wherever you want to use ACF Objects, import the Otomaties\AcfObjects\Acf class:

```php
<?php use Otomaties\AcfObjects\Acf; ?>
```

### Test if field has value
```php
<?php if(Acf::get_field('fieldname')->isSet()): ?>
<?php endif; ?>
```
#### Fields with array access (Gallery, Repeater, Flexible Content)
```php
<?php if(!Acf::get_field('fieldname')->isEmpy()): ?>
<?php endif; ?>
```

## Datepicker
```php
<?php echo Acf::get_field('date')->format('d/m/Y'); ?>
```

## File
```php
<?php echo Acf::get_field('file')->url(); ?>
<?php echo Acf::get_field('file')->title(); ?>
<?php echo Acf::get_field('file')->filesize(); ?>
```

## Gallery
```php
<ul>
  <?php foreach (Acf::get_field('gallery') as $image): ?>
    <li><?php echo $image->attributes(['class' => 'd-none'])->image(); ?></li>
  <?php endforeach; ?>
</ul>
```

#### Gallery array access
```php
<?php echo Acf::get_field('gallery')[1]->image(); ?>
```

## Google maps
```php
<?php echo Acf::get_field('google_map')->address(); ?>
<?php echo Acf::get_field('google_map')->lat(); ?>
<?php echo Acf::get_field('google_map')->lat(); ?>
...
```

## Group
```php
<?php echo Acf::get_field('group')->get('text'); ?>
```

## Image
```php
<?php echo Acf::get_field('image')->url('medium'); ?> 
```

### Image tag
```php
<?php echo Acf::get_field('image')->image('medium'); ?>
```

#### Image tag with attributes, wrapped with link
```php
<a href="<?php echo Acf::get_field('image')->url('full'); ?>">
  <?php echo Acf::get_field('image')->attributes(['class' => 'w-100'])->image('thumbnail'); ?>
</a>
```

#### Image with default image from media library, media ID 48
```php
<?php echo Acf::get_field('image')->default(48, 'thumbnail')->image('thumbnail'); ?>
```

#### Image with default image from url
```php
<?php echo Acf::get_field('image')->default('https://picsum.photos/150/150')->image('thumbnail'); ?>
```

## Link

```php
<?php echo Acf::get_field('link')->link(); // Will output an a-tag with href, target & title ?>
```
```php
<?php echo Acf::get_field('link')->attributes(['class' => 'btn btn-primary','data-foo' => 'bar'])->link(); ?>
```
```php
<a href="<?php echo Acf::get_field('link')->url(); ?>" target="<?php echo Acf::get_field('link')->target(); ?>">
    <?php echo Acf::get_field('link')->title(); ?>
</a>
```

## Repeater
```php
<table class="table">
  <?php foreach (Acf::get_field('repeater') as $key => $row): ?>
    <tr>
      <td><?php echo $key; ?></td>
      <td><?php echo $row->get('text'); ?></td>
      <td><?php echo $row->get('image')->image('thumbnail'); ?></td>
    </tr>
  <?php endforeach; ?>
</table>

```

### Repeater array access
```php
<?php if (isset(Acf::get_field('repeater')[0])): ?>
  <?php echo Acf::get_field('repeater')[0]->get('text'); ?>
<?php endif; ?>
```

## Text
```php
<?php echo Acf::get_field('text'); ?>
```
```php
<?php echo Acf::get_field('text')->default('Default text'); ?>

```

### Text from other post
```php
<?php echo Acf::get_field('text', 51); ?>
```


## ACF Fluent
During development of this package, I stumbled upon ACF Fluent by samrap, which works great. The biggest difference between ACF Fluent and this package, is the ability to easily display images: ```Acf::get_field('image')->image('thumbnail')``` and a more intuitive way to iterate over repeater & gallery fields.
