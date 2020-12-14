# ACF Objects
The examples are written in Blade syntax, but can easily be converted to plain PHP.

## Installation

```sh
composer require tombroucke/acf-objects
```

## Examples

```blade
@use(Otomaties\AcfObjects\Acf)
@use(Otomaties\AcfObjects\Text)
@use(Otomaties\AcfObjects\Image)

@if (ACF::get_field('text')->isset())
  <h2>Text field</h2>
  {{ ACF::get_field('text') }}
@endif

@if (ACF::get_field('external', 51)->isset())
  <h2>Text field from other post</h2>
  {{ ACF::get_field('external', 51) }}
@endif

@if (ACF::get_field('text_empty')->isset())
  <h2>Empty field</h2>
  {{ ACF::get_field('text_empty') }}
@endif

<h2>Empty field with default value</h2>
{{ ACF::get_field('text_empty')->default('empty value') }}

@if (ACF::get_field('image')->isset())
  <h2>Image url</h2>
  {{ ACF::get_field('image') }}
@endif

@if (ACF::get_field('image')->isset())
  <h2>Image</h2>
  {!! ACF::get_field('image')->image('thumbnail') !!}
@endif

@if (ACF::get_field('image')->isset())
  <h2>Image with link & 'w-100' class</h2>
  <a href="{{ ACF::get_field('image')->url('full') }}">{!! ACF::get_field('image')->attributes(['class' => 'w-100'])->image('thumbnail') !!}</a>
@endif

<h2>Empty image, default from media library, media ID 48</h2>
{!! ACF::get_field('image_empty')->default(48, 'thumbnail')->image('thumbnail') !!}

<h2>Empty image, default image from url</h2>
{!! ACF::get_field('image_empty')->default('https://picsum.photos/150/150')->image('thumbnail') !!}

@unless (ACF::get_field('repeater')->empty())
  <h2>Repeater iteration</h2>
  @php
      ACF::get_field('repeater')[] = array(
        'text' => new Text( 'test' ),
        'image' => new Image( 'https://picsum.photos/150/150?v=2' )
      );
  @endphp
  <table class="table">
    @foreach(ACF::get_field('repeater') as $key => $row)
      <tr>
        <td>{{ $key }}</td>
        <td>{{ $row->get('text') }}</td>
        <td>{!! $row->get('image')->image() !!}</td>
      </tr>
    @endforeach
  </table>
@endunless

@unless(ACF::get_field('repeater_empty')->empty())
<h2>Empty repeater</h2>
<table class="table">
    @foreach( ACF::get_field('repeater_empty') as $key => $row )
      <tr>
        <td>{{ $key }}</td>
        <td>{{ $row->get('text') }}</td>
        <td>{!! $row->get('image')->image() !!}</td>
      </tr>
    @endforeach
</table>
@endunless

@if (isset(ACF::get_field('repeater')[0]))
  <h2>Repeater array access</h2>
  {{ ACF::get_field('repeater')[0]->get('text') }}
@endif

@if (ACF::get_field('link')->isset())
  <h2>Link</h2>
  <a href="{{ ACF::get_field('link')->url() }}" target="{{ ACF::get_field('link')->target() }}">{{ ACF::get_field('link')->title() }}</a>
  <br />
  {!! ACF::get_field('link')->attributes(['class' => 'btn btn-primary','data-foo' => 'bar'])->link() !!}
@endif

@if (ACF::get_field('group')->get('text')->isset() || ACF::get_field('group')->get('text')->isset())
  <h2>Group</h2>
  @if (ACF::get_field('group')->get('text')->isset())
    {{ ACF::get_field('group')->get('text') }}
  @endif
  @if (ACF::get_field('group')->get('image')->isset())
    {!! ACF::get_field('group')->get('image')->image() !!}
  @endif
@endif

@unless (ACF::get_field('gallery')->empty())
  <h2>Gallery</h2>
  <ul>
    @foreach( ACF::get_field('gallery') as $image )
      <li>{!! $image->attributes(['class' => 'd-none'])->image() !!}</li>
    @endforeach
  </ul>
@endunless

@if (isset( ACF::get_field('gallery')[1] ))
  <h2>Gallery array access</h2>
  {!! ACF::get_field('gallery')[1]->image() !!}
@endif

```

## ACF Fluent
During development of this package, I stumbled upon ACF Fluent by samrap, which works great. The biggest difference between ACF Fluent and this package, is the ability to easily display images: ```ACF::get_field('image')->image('thumbnail')``` and a more intuitive way to iterate over repeater & gallery fields.