# ACF Objects

This package converts the return values of ACF to objects with easy-to-use methods.

Instead of calling `get_field('selector')`, you can use the AcfObjects facade: `AcfObjects::getField('selector')`

## Installation

`composer require tombroucke/acf-objects`

You might have to clear wp acorn cache: `wp acorn optimize:clear`

## Usage

### Checkbox

When getting the value for a Checkbox field, an `Illuminate/Support/Collection` will be returned.

```php
$checkboxValues = AcfObjects::getField('checkbox');
```

### ColorPicker

```blade
{{ AcfObjects::getField('color_picker') }}
```

### DatePicker

When getting the value for a DatePicker field, a `Carbon` instance will be returned. If the field has no value, a `FallbackField` will be returned.

```php
AcfObjects::getField('date')
```

```blade
@if(AcfObjects::getField('date')->isSet())
  AcfObjects::getField('date')->format(get_option('date_format))
@endif
```

### DateTimePicker

When getting the value for a DateTimePicker field, a `Carbon` instance will be returned. If the field has no value, a `FallbackField` will be returned.

```php
AcfObjects::getField('date_time')
```

### Email

```blade
{{ AcfObjects::getField('email')->obfuscate() }}
```

### File

```blade
{{ AcfObjects::getField('file')->url() }}
{{ AcfObjects::getField('file')->title() }}
{{ AcfObjects::getField('file')->filesize() }}
```

### Gallery

When getting the value for a Group field, an `Illuminate/Support/Collection` will be returned.

```blade
@foreach (AcfObjects::getField('gallery') as $image)
  <a href="{{ $image->url('large') }}">
    {!! $image->image('medium') !!}
  </a>
@endforeach
```

### Google Maps

```blade
{{ AcfObjects::getField('google_map')->address() }}
{{ AcfObjects::getField('google_map')->lat() }}
{{ AcfObjects::getField('google_map')->long() }}
```

### Group

```php
  $settings = AcfObjects::getField('settings')
    ->default([
      'foo' => 'bar'
    ]);

  echo $settings->get('foo');
```

```blade
{{ AcfObjects::getField('settings')->get('name') }}
```

### Image

```blade
{!!
AcfObjects::getField('image')
  ->url('medium');
!!}

{!!
AcfObjects::getField('image')
  ->attributes(['class' => 'w-100 h-100 object-fit-cover'])
  ->image('thumbnail');
!!}

{!!
AcfObjects::getField('image')
  ->default(asset('image/placeholder.jpg')->uri())
  ->image('thumbnail');
!!}
```

### Link

```blade
{{ AcfObjects::getField('link')->url() }}

@php
  $link = AcfObjects::getField('link');
@endphp

@if($link->isSet())
  <a href="{{ $link->url() }}" target="{{ $link->target() }}">
      {{ $link->title() }}
  </a>
@endif

// or

@if($link->isSet())
  {!! $link->link() !!}
@endif
```

### Number

```blade
{{ AcfObjects::getField('number') }}
```

### Repeater

When getting the value for a Repeater field, an `Illuminate/Support/Collection` will be returned.

```php
AcfObjects::getField('repeater')
```

```blade
@unless(AcfObjects::getField('repeater')->isEmpty())
<ul>
  @foreach(AcfObjects::getField('repeater') as $item)
    <li>{!! $item['name'] !!}</li>
  @endforeach
</ul>
@endunless
```

### Text

```blade
{{ AcfObjects::getField('text')->default(get_the_title()) }}
```

### TextArea

```blade
{{ AcfObjects::getField('text_area') }}
```

## Upgrading to v4.x from v3.x

### Use new facade

```diff
- Acf::getField(
+ AcfObjects::getField(
```

### Use new facade and remove deprecated get_field method

```diff
- Acf::get_field(
+ AcfObjects::getField(
```

### Use new facade

```diff
- use Otomaties\AcfObjects\Acf;
+ use Otomaties\AcfObjects\Facades\AcfObjects;
```

### Array access for repeaters instead of the `get()` method.

```diff
- $repeater->get('sub_field')
+ $repeater['sub_field']
```
