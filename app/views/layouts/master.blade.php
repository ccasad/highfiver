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

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        {{ HTML::script('js/html5shiv.js') }}
        {{ HTML::script('js/respond.min.js') }}
        <![endif]-->
    </head>

    <body>
        <!-- Container -->
        <div class="container">

            <!-- Content -->
            @yield('content')

            <div class="footer">
                <p>Created by Chris Casad - Oct 7th 2013</p>
            </div>

        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
        
    </body>
</html>
