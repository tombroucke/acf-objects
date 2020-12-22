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

@if (Acf::get_field('text')->isset())
  <h2>Text field</h2>
  {{ Acf::get_field('text') }}
@endif

@if (Acf::get_field('external', 51)->isset())
  <h2>Text field from other post</h2>
  {{ Acf::get_field('external', 51) }}
@endif

@if (Acf::get_field('text_empty')->isset())
  <h2>Empty field</h2>
  {{ Acf::get_field('text_empty') }}
@endif

<h2>Empty field with default value</h2>
{{ Acf::get_field('text_empty')->default('empty value') }}

@if (Acf::get_field('image')->isset())
  <h2>Image url</h2>
  {{ Acf::get_field('image') }}
@endif

@if (Acf::get_field('image')->isset())
  <h2>Image</h2>
  {!! Acf::get_field('image')->image('thumbnail') !!}
@endif

@if (Acf::get_field('image')->isset())
  <h2>Image with link & 'w-100' class</h2>
  <a href="{{ Acf::get_field('image')->url('full') }}">{!! Acf::get_field('image')->attributes(['class' => 'w-100'])->image('thumbnail') !!}</a>
@endif

<h2>Empty image, default from media library, media ID 48</h2>
{!! Acf::get_field('image_empty')->default(48, 'thumbnail')->image('thumbnail') !!}

<h2>Empty image, default image from url</h2>
{!! Acf::get_field('image_empty')->default('https://picsum.photos/150/150')->image('thumbnail') !!}

@unless (Acf::get_field('repeater')->empty())
  <h2>Repeater iteration</h2>
  @php
      Acf::get_field('repeater')[] = array(
        'text' => new Text( 'test' ),
        'image' => new Image( 'https://picsum.photos/150/150?v=2' )
      );
  @endphp
  <table class="table">
    @foreach(Acf::get_field('repeater') as $key => $row)
      <tr>
        <td>{{ $key }}</td>
        <td>{{ $row->get('text') }}</td>
        <td>{!! $row->get('image')->image() !!}</td>
      </tr>
    @endforeach
  </table>
@endunless

@unless(Acf::get_field('repeater_empty')->empty())
<h2>Empty repeater</h2>
<table class="table">
    @foreach( Acf::get_field('repeater_empty') as $key => $row )
      <tr>
        <td>{{ $key }}</td>
        <td>{{ $row->get('text') }}</td>
        <td>{!! $row->get('image')->image() !!}</td>
      </tr>
    @endforeach
</table>
@endunless

@if (isset(Acf::get_field('repeater')[0]))
  <h2>Repeater array access</h2>
  {{ Acf::get_field('repeater')[0]->get('text') }}
@endif

@if (Acf::get_field('link')->isset())
  <h2>Link</h2>
  <a href="{{ Acf::get_field('link')->url() }}" target="{{ Acf::get_field('link')->target() }}">{{ Acf::get_field('link')->title() }}</a>
  <br />
  {!! Acf::get_field('link')->attributes(['class' => 'btn btn-primary','data-foo' => 'bar'])->link() !!}
@endif

@if (Acf::get_field('group')->get('text')->isset() || Acf::get_field('group')->get('text')->isset())
  <h2>Group</h2>
  @if (Acf::get_field('group')->get('text')->isset())
    {{ Acf::get_field('group')->get('text') }}
  @endif
  @if (Acf::get_field('group')->get('image')->isset())
    {!! Acf::get_field('group')->get('image')->image() !!}
  @endif
@endif

@unless (Acf::get_field('gallery')->empty())
  <h2>Gallery</h2>
  <ul>
    @foreach( Acf::get_field('gallery') as $image )
      <li>{!! $image->attributes(['class' => 'd-none'])->image() !!}</li>
    @endforeach
  </ul>
@endunless

@if (isset( Acf::get_field('gallery')[1] ))
  <h2>Gallery array access</h2>
  {!! Acf::get_field('gallery')[1]->image() !!}
@endif

```

## ACF Fluent
During development of this package, I stumbled upon ACF Fluent by samrap, which works great. The biggest difference between ACF Fluent and this package, is the ability to easily display images: ```Acf::get_field('image')->image('thumbnail')``` and a more intuitive way to iterate over repeater & gallery fields.