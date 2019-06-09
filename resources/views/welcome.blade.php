<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    {{--@auth
                        
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth--}}
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    @auth
                        {{ Auth::user()->role->name }}
                    @else
                    {{ config('app.name') }}
                    @endauth
                </div>

                <div class="links">
                    @auth
                        @php
                            $user = Auth::user();    
                        @endphp
                       @if($user->is_renter)
                            <a href="{{ route('renter.bookings.index') }}">My Grill Bookings</a>
                            <a href="{{ route('renter.grills.index') }}">My Grills</a>
                       @elseif($user->is_user)
                            <a href="{{ route('user.grills_near') }}">Grills Near</a>
                            <a href="{{ route('user.bookings') }}">My Bookings</a>
                       @endif
                        @else
                            <a href="{{ route('login') }}">Login</a>
                            <a href="{{ route('register',['role_id'=>2]) }}">Register as User</a>
                            <a href="{{ route('register',['role_id'=>3]) }}">Register as Renter</a>
                    @endauth
                </div>
            </div>
        </div>
    </body>
</html>
