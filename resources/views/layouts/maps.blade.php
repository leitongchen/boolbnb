<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- TOMTOM --}}
    <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.69.1/maps/maps.css'>
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.69.1/maps/maps-web.min.js"></script>
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.69.1/services/services-web.min.js"></script>

    <title>@yield('pageTitle')</title>
</head>
<body>

    <h1>pagina search</h1>
    <div id="app">
        <search-form></search-form>
    
    </div>

    {{-- <div>
        <h1>prova 2</h1>
        <input type="text" id="query" v-model="querySearch">
        <button type="submit" @click="onSubmit">Cerca</button>

    </div> --}}


    {{-- <h1>Dov'è Florian?</h1>
    <input type="text" id="query" value="">
    <button id="queryBtn">Cerca</button> --}}


    <br>
    <br>


    <div id="mymap" class="map" style="width:90vw; height:90vh">
        
    
    </div>

    {{-- <script src="{{ asset('js/maps.js') }}"></script> --}}
    <script src="{{ asset('js/app.js') }}"></script>

</body>
</html>