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
    <link rel="icon" type="image/vnd.microsoft.icon" href="{{ asset('/favicon.ico') }}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <style>

    </style>
</head>
<body>

    <div id="app">
        @include('layouts/header')

        <main class="py-4 contenedor">
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


            $('.rating-form input').change(function () {
                var $radio = $(this);
                $('.rating-form .selected').removeClass('selected');
                $radio.closest('label').addClass('selected');
            });

            @if(isset($chat_id) && isset($isSubscribe) && isset($offer) && $isSubscribe && $offer->user)
                const app = new Vue({
                    el: '#chat-vue',

                    data: {
                        messages: []
                    },

                    created() {
                        this.fetchMessages();
                        //use your own credentials you get from Pusher
                        var pusher = new Pusher('e190b5eb2a677b3e0e0a', {
                            cluster: 'eu',
                            encrypted: false,
                        });

                        //Subscribe to the channel we specified in our Adonis Application
                        let channel = pusher.subscribe('chat.{{$chat_id}}');

                        channel.bind('MessageSent', (e) => {
                            console.log(e);
                            this.messages.unshift({
                                created_at: e.message.created_at,
                                message: e.message.message,
                                user: e.user
                            });
                        })


                    },

                    methods: {
                        fetchMessages() {
                            axios.get('/messages/{{$offer->id}}/{{$chat_id}}').then(response => {

                                this.messages = response.data;
                            });
                        },

                        addMessage(message) {


                            axios.post('/messages/{{$offer->id}}/{{$chat_id}}', message).then(response => {
                                console.log(response.data);
                            });
                        }
                    },
                    destroyed() {
                        pusher.unsubscribe('chat.{{$chat_id}}');
                    }
                });
            @endif


        }


    </script>

</body>
</html>
