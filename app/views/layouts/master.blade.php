<!DOCTYPE html>
<html>
    <head>
        <title>
            @section('title')
            HighFiver
            @show
        </title>

        {{ HTML::style('css/styles.css') }}

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">

    </head>

    <body>
        <!-- Container -->
        <div class="container">

            <!-- Content -->
            @yield('content')

        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
        
    </body>
</html>
