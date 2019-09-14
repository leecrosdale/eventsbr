<html>
<head>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
<div id="app">
    <map-overview-component :terrain="{{ json_encode($terrain) }}"></map-overview-component>
</div>

</body>
</html>


