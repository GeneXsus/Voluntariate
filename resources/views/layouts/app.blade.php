<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <style>
        .chat {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .chat li {
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px dotted #B3A9A9;
        }

        .chat li .chat-body p {
            margin: 0;
            color: #777777;
        }

        .panel-body {
            overflow-y: scroll;
            height: 350px;
        }

        ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
            background-color: #F5F5F5;
        }

        ::-webkit-scrollbar {
            width: 12px;
            background-color: #F5F5F5;
        }

        ::-webkit-scrollbar-thumb {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
            background-color: #555;
        }
    </style>
</head>
<body>

    <div id="app">
        @include('layouts/header')

        <main class="py-4">
            @yield('content')
        </main>
        @include('layouts/footer')
    </div>
<script src="https://unpkg.com/sweetalert2@7.3.0/dist/sweetalert2.all.js"></script>
    <script type="text/javascript">
        window.onload = function()  {
            $( ".swalButton" ).on('click',function() {
                event.preventDefault();
                let formSend = $(this).attr('data-form-send');
                let title = $(this).attr('data-title-swal');
                let text = $(this).attr('data-text-swal');
                let type = $(this).attr('data-type-swal');
                let cancel = $(this).attr('data-cancel-swal');
                let confirm = $(this).attr('data-confirm-swal');

                swal({
                    title: title,
                    text: text,
                    type: type,
                    showCancelButton: true,
                    confirmButtonColor: '#d33',

                    cancelButtonText: cancel,
                    confirmButtonText: confirm
                }).then((result) => {
                    if (result.value) {
                        document.getElementById(formSend).submit();
                    }
                });
            })
            // Add fadeToggle animation to dropdown
            $('.dropdown.slideToogle').on('show.bs.dropdown', function(e) {
                $(this).find('.dropdown-menu').first().stop(true, true).slideToggle(300);
            });

// Add fadeToggle animation to dropdown
            $('.dropdown.slideToogle').on('hide.bs.dropdown', function(e) {
                $(this).find('.dropdown-menu').first().stop(true, true).slideToggle(300);
            });
        }
    </script>
</body>
</html>
