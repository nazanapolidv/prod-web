<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Livewire Debug</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h1>Test Livewire Debug</h1>
    
    <div id="livewire-test">
        <button onclick="testLivewire()">Test JavaScript</button>
        <div id="result"></div>
    </div>

    <!-- Cargar Livewire desde CDN -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://unpkg.com/livewire@3.6.2/dist/livewire.js"></script>
    
    <script>
        function testLivewire() {
            document.getElementById('result').innerHTML = 'JavaScript funciona!';
            console.log('JavaScript ejecutado');
            
            if (typeof Livewire !== 'undefined') {
                console.log('Livewire está disponible');
                document.getElementById('result').innerHTML += '<br>Livewire está cargado!';
            } else {
                console.log('Livewire NO está disponible');
                document.getElementById('result').innerHTML += '<br>Livewire NO está cargado!';
            }
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM cargado');
            if (typeof Livewire !== 'undefined') {
                console.log('Livewire detectado en DOMContentLoaded');
                Livewire.start();
            }
        });
    </script>
</body>
</html>
