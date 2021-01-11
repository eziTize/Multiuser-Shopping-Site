<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>Admin Login</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://kit.fontawesome.com/5810dc9d6a.js" crossorigin="anonymous"></script>
    <script>window.Laravel = { csrfToken: '{{ csrf_token() }}'} </script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <style>
        .gradient {
            background: linear-gradient(90deg, #d53369 0%, #daae51 100%);
        }
    </style>
</head>
<body>
    <div id="admin-login">           
        
        <div class="bg-blue-400 h-screen overflow-x-hidden">


            <div class="flex flex-col items-center flex-1 h-full justify-center px-4 sm:px-0">


                <div class="pb-10">
                   @if(Session::has('error'))
                    <div id="card-alert" class="bg-red-500">
                      <div class="text-white">
                        <p><i class="fas fa-exclamation"></i> {{ Session::get('error') }}</p>
                      </div>
                    </div>
                    @endif

                    @if(Session::has('message'))
                    <div id="card-alert" class="bg-green-500">
                      <div class="text-white">
                        <p><i class="fas fa-check"></i> {{ Session::get('message') }}</p>
                      </div>
                    </div>
                    @endif
                </div>

                <div class="flex rounded-lg shadow-lg w-full sm:w-3/4 lg:w-1/2 bg-white sm:mx-0" style="height: 500px">
                    <div class="flex flex-col w-full md:w-1/2 p-4">
                        <div class="flex flex-col flex-1 justify-center mb-8">
                            <h1 class="text-4xl text-center font-thin">Admin Panel Login</h1>
                            <div class="w-full mt-4">
                                <form class="form-horizontal w-3/4 mx-auto" method="POST" action="{{ Asset(env('admin').'/login') }}">
                                        @csrf

                                    <div class="flex flex-col mt-4">
                                        <input id="email" type="email" class="flex-grow h-8 px-2 border rounded border-grey-400 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="{{ __('E-Mail Address') }}" required autocomplete="email" autofocus>

                                
                                    </div>
                                    <div class="flex flex-col mt-4">
                                        <input id="password" type="password" class="flex-grow h-8 px-2 rounded border border-grey-400 @error('password') is-invalid @enderror" name="password" required placeholder="{{ __('Password') }}" required autocomplete="current-password">

                                


                                    </div>
                                    <div class="flex items-center mt-4">
                                        <input type="checkbox" name="remember" id="remember" class="mr-2" {{ old('remember') ? 'checked' : '' }}> 


                                        <label for="remember" class="text-sm text-grey-dark">{{ __('Remember Me') }}</label>


                                    </div>
                                    <div class="flex flex-col mt-8">
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white text-sm font-semibold py-2 px-4 rounded">
                                            {{ __('Login') }}
                                        </button>
                                    </div>

                               <!--       <div class="text-center mt-4">
                                     @if (Route::has('password.request'))
                                             <a class="no-underline hover:underline text-blue-dark text-xs" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                            </a>
                                    @endif
                                    </div> -->

                                </form>
                              
                            </div>

                         <!--    <div class="text-center mt-4">
                                
                                             <a class="no-underline hover:underline text-blue-dark text-xs" href="{{ Asset(env('seller').'/login') }}">
                                      Seller Login Panel
                                            </a>
                            </div> -->

                        </div>
                    </div>
                    <div class="hidden md:block md:w-1/2 rounded-r-lg" style="background: url('https://images.unsplash.com/photo-1515965885361-f1e0095517ea?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=3300&q=80'); background-size: cover; background-position: center center;"></div>
                </div>
            </div>
        </div>

    </div>
</body>


<style> 



</style>


</html>