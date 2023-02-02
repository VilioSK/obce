<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        
        <!-- Styles -->
        @vite(['resources/less/app.less', 'resources/js/app.js'])
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    </head>
    <body class="antialiased">
        <div class="container-fluid obce-header">
            @include('modules.header')
        </div>
        <div class="container-fluid obce-menu">
            @include('modules.menu')
        </div>
        <div class="container-fluid obce-main">
            <div class="row">                
                <div class="col mb-12 text-center">
                    <h2>Vyhľadať v databáze obcí</h2>
                    <input class=" form-control" placeholder="Zadajte názov" autocomplete="off" id="lie_nazov_input" name="lie_nazov" type="text">
                </div>
            </div>
        </div>
        <div class="container-fluid obce-footer">
            @include('modules.footer')
        </div>
    </body>
</html>
