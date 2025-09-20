@props([
  'especialidad' => null,
  'dr'  => null,
  'fecha'   => null,
])

<div class="card">
    <div class="card-content">
        <h3>{{ $fecha }}</h3>
        <p>{{ $especialidad }}</p>
        <p>{{ $dr }}</p>
    </div>
</div>