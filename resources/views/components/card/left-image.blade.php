@props([
'title' => null,
'text' => null,
'img' => null,
'alt' => '',
'link' => ''
])

<div {{ $attributes->class('card') }}>
  <a href="{{ $link }}" class="flex w-full">
    @if($img)
    <div class="card_image_container">
      <img
        src="{{ \Illuminate\Support\Str::startsWith($img, ['http://','https://','/','data:']) ? $img : Vite::asset($img) }}"
        alt="{{ $alt }}" />
    </div>
    @endif

    <div class="card-content">
      @if($title)
      <h3>{{ $title }}</h3>
      @endif

      @if($text)
      <p>{{ $text }}</p>
      @endif

      {{ $slot }}
    </div>
  </a>
</div>