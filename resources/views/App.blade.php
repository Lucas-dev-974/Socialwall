<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <title>SocialWall</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">

        <link href="{{ asset('/css/style.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('/css/wall-animation-1.css') }}" rel="stylesheet" type="text/css">

    </head>
    <body class="antialiased">
        <div id="app">
            <layout></layout>
        </div>

        <!-- <script src="{{ secure_asset('js/wall-animation.js') }}"></script> --> 
       
        <script>
            // import store from '../js/services/Storage.js'

            // window.fbAsyncInit = function() {
            //     FB.init({
            //     appId      : '3093684740891759',
            //     cookie     : true,
            //     xfbml      : true,
            //     version    : 'v12.0'
            //     });
                
            //     FB.AppEvents.logPageView();   
                
            // };

            // (function(d, s, id){
            //     var js, fjs = d.getElementsByTagName(s)[0];
            //     if (d.getElementById(id)) {return;}
            //     js = d.createElement(s); js.id = id;
            //     js.src = "https://connect.facebook.net/en_US/sdk.js";
            //     fjs.parentNode.insertBefore(js, fjs);
            // }(document, 'script', 'facebook-jssdk'));

            function checkLoginState() {
                FB.getLoginStatus(function(response) {
                    statusChangeCallback(response);
                });
            }

            function statusChangeCallback(data){
                
            }
        </script>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
