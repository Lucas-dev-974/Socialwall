<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <title>Social-wall</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">

        <link href="{{ asset('/css/style.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('/css/dashboard.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('/css/wall-animation-1.css') }}" rel="stylesheet" type="text/css">

    </head>
    <body class="antialiased">
        <div id="app">
            <layout></layout>
        </div>

        <!-- <script src="{{ secure_asset('js/wall-animation.js') }}"></script> --> 
        <script src="{{ asset('js/app.js') }}"></script>
        <script>
            function checkLoginState() {
                FB.getLoginStatus(function(response) {
                    statusChangeCallback(response);
                });
            }

            function statusChangeCallback(data){
                let storage = JSON.parse(localStorage.getItem('vuex')) // Get Vuex Store from localStorage
                if(data.status == 'connected'){ // If user have login into facebook so register the facebook response in the store
                    storage.facebook = {
                        user_infos: data.authResponse,
                        connected: true
                    }
                    
                }else{  // If user tryed connect to facebook without success Just setup facebook.connected to false
                    storage.facebook = { connected: false }
                }
                localStorage.setItem('vuex', JSON.stringify(storage)) // Update Vuex Store
            }
        </script>
        
    </body>
</html>
