<!DOCTYPE html>
<html>
<head>
    <title>Test Livewire Debug</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h1>Test Livewire Debug</h1>
    
    <button onclick="testJS()">Test JavaScript</button>
    <button onclick="testLivewire()">Test Livewire</button>
    
    <div id="result"></div>
    
    <!-- Cargar Livewire directamente -->
    <script src="{{ asset('vendor/livewire/livewire.min.js') }}"></script>
    
    <script>
        function testJS() {
            document.getElementById('result').innerHTML = 'JavaScript funciona!';
        }
        
        function testLivewire() {
            if (typeof Livewire !== 'undefined') {
                document.getElementById('result').innerHTML = 'Livewire está disponible!';
            } else {
                document.getElementById('result').innerHTML = 'Livewire NO está disponible';
            }
        }
    </script>
</body>
</html>
