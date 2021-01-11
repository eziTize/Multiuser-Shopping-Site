@php ($user = Auth::guard('seller')->user())
@php($page = Request::segment(2))

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


     <!-- <title>{{ config('app.name', 'Laravel') }}</title> -->


    <title>@yield('title')</title>


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://kit.fontawesome.com/5810dc9d6a.js" crossorigin="anonymous"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="dash" class="bg-gray-100 flex">

  <aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl bg-orange-700">
        <div class="p-6">
            <a href="index.html" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Seller</a>
          <!--  <button class="w-full bg-white cta-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
                <i class="fas fa-plus mr-3"></i> Add New Seller
            </button> -->
        </div>
        <nav class="text-white text-base font-semibold pt-3">

             <!-- Dashboard -->

            @if($page == "dashboard")
            <a href="{{ Asset(env('seller').'/dashboard') }}" class="flex items-center active-nav-link text-white py-4 pl-6 nav-item">
            <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </a>

            @else
            <a class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item" href="{{ Asset(env('seller').'/dashboard') }}">
            <i class="fas fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </a>
            @endif


            <!-- Sales -->

            @if($page == "sales")
            <a class="flex items-center text-white py-4 pl-6 nav-item active-nav-link" href="{{ Asset(env('seller').'/sales') }}">
            <i class="fas fa-rupee-sign mr-3"></i>
                Sales
            </a>

            @else
            <a class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item" href="{{ Asset(env('seller').'/sales') }}">
            <i class="fas fa-rupee-sign mr-3"></i>
            Sales
            </a>
            @endif


            <!-- Wallet -->

            @if($page == "wallet")
            <a class="flex items-center text-white py-4 pl-6 nav-item active-nav-link" href="{{ Asset(env('seller').'/wallet') }}">
            <i class="fas fa-wallet mr-3"></i>
            Wallet
            </a>

            @else
            <a class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item" href="{{ Asset(env('seller').'/wallet') }}">
            <i class="fas fa-wallet mr-3"></i>
            Wallet
            </a>
            @endif


        </nav>
        @if($page == "settings")
        <a href="{{ Asset(env('seller').'/settings') }}" class="absolute w-full upgrade-btn bottom-0 active-nav-link text-white flex items-center justify-center py-4">
            <i class="fas fa-user mr-3"></i>
            Edit Profile
        </a>
        @else
        <a href="{{ Asset(env('seller').'/settings') }}" class="absolute w-full upgrade-btn bottom-0 text-white flex items-center justify-center py-4 opacity-75 hover:opacity-100">
            <i class="fas fa-user mr-3"></i>
            Edit Profile
        </a>
        @endif
    </aside>

        <main class="w-full flex flex-col h-screen overflow-y-hidden bg-gray-400">
        <header class="w-full flex items-center bg-gray-600 shadow-2xl py-2 px-6">
            <div class="relative w-full py-4 flex justify-end">
             
                <ul class="inline-flex items-center">

                    <li>
                        <p class="px-4 hover:text-gray-800"><i class="fas fa-user-shield text-lg px-2"></i>Hi, {{$user->name}}</p>
                    </li>

                    <li>
                        <a href="{{ Asset(env('seller').'/logout') }}" class="px-4 hover:text-gray-800">Logout<i class="fas fa-sign-out-alt text-lg  px-2"></i></a>

                    </li>


                </ul>
            </div>

        </header>


@if(count($errors) > 0)
 <div class="flex bg-yellow-500 w-full mb-4 text-center">

        @foreach ($errors->all() as $error)
        <div class="w-16 bg-yellow">                
          <div class="p-4">
             <svg class="h-8 w-8 text-white fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M437.019 74.981C388.667 26.629 324.38 0 256 0S123.333 26.63 74.981 74.981 0 187.62 0 256s26.629 132.667 74.981 181.019C123.332 485.371 187.62 512 256 512s132.667-26.629 181.019-74.981C485.371 388.667 512 324.38 512 256s-26.629-132.668-74.981-181.019zM256 470.636C137.65 470.636 41.364 374.35 41.364 256S137.65 41.364 256 41.364 470.636 137.65 470.636 256 374.35 470.636 256 470.636z"/><path d="M256 235.318c-11.422 0-20.682 9.26-20.682 20.682v94.127c0 11.423 9.26 20.682 20.682 20.682 11.423 0 20.682-9.259 20.682-20.682V256c0-11.422-9.259-20.682-20.682-20.682zM270.625 147.248A20.826 20.826 0 0 0 256 141.19a20.826 20.826 0 0 0-14.625 6.058 20.824 20.824 0 0 0-6.058 14.625 20.826 20.826 0 0 0 6.058 14.625A20.83 20.83 0 0 0 256 182.556a20.826 20.826 0 0 0 14.625-6.058 20.826 20.826 0 0 0 6.058-14.625 20.839 20.839 0 0 0-6.058-14.625z"/></svg>
          </div>
      </div>
      <div class="w-full text-grey-darker items-center p-4">
          <span class="text-lg font-bold pb-4 text-white">
               Error!
          </span>
          <p class="leading-tight text-white">
            {{ $error }}
          </p>
      </div>
        @endforeach

  </div>
@endif

@if(Session::has('error'))
 <div class="flex bg-red-500 w-full mb-4 text-center">
      <div class="w-16 bg-red">
          <div class="p-4">
               <svg class="h-8 w-8 text-white fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M503.191 381.957c-.055-.096-.111-.19-.168-.286L312.267 63.218l-.059-.098c-9.104-15.01-23.51-25.577-40.561-29.752-17.053-4.178-34.709-1.461-49.72 7.644a66 66 0 0 0-22.108 22.109l-.058.097L9.004 381.669c-.057.096-.113.191-.168.287-8.779 15.203-11.112 32.915-6.569 49.872 4.543 16.958 15.416 31.131 30.62 39.91a65.88 65.88 0 0 0 32.143 8.804l.228.001h381.513l.227.001c36.237-.399 65.395-30.205 64.997-66.444a65.86 65.86 0 0 0-8.804-32.143zm-56.552 57.224H65.389a24.397 24.397 0 0 1-11.82-3.263c-5.635-3.253-9.665-8.507-11.349-14.792a24.196 24.196 0 0 1 2.365-18.364L235.211 84.53a24.453 24.453 0 0 1 8.169-8.154c5.564-3.374 12.11-4.381 18.429-2.833 6.305 1.544 11.633 5.444 15.009 10.986L467.44 402.76a24.402 24.402 0 0 1 3.194 11.793c.149 13.401-10.608 24.428-23.995 24.628z"/><path d="M256.013 168.924c-11.422 0-20.681 9.26-20.681 20.681v90.085c0 11.423 9.26 20.681 20.681 20.681 11.423 0 20.681-9.259 20.681-20.681v-90.085c.001-11.421-9.258-20.681-20.681-20.681zM270.635 355.151c-3.843-3.851-9.173-6.057-14.624-6.057a20.831 20.831 0 0 0-14.624 6.057c-3.842 3.851-6.057 9.182-6.057 14.624 0 5.452 2.215 10.774 6.057 14.624a20.822 20.822 0 0 0 14.624 6.057c5.45 0 10.772-2.206 14.624-6.057a20.806 20.806 0 0 0 6.057-14.624 20.83 20.83 0 0 0-6.057-14.624z"/></svg>
          </div>
      </div>
      <div class="w-full text-grey-darker items-center p-4">
          <span class="text-lg text-white font-bold pb-4">
               ERROR!
          </span>
          <p class="leading-tight text-white">
            {{ Session::get('error') }}
          </p>
      </div>
  </div>
@endif

@if(Session::has('message'))
 <div class="flex bg-green-500 w-full mb-4 text-center">
      <div class="w-16 bg-green">
          <div class="p-4">
              <svg class="h-8 w-8 text-white fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M468.907 214.604c-11.423 0-20.682 9.26-20.682 20.682v20.831c-.031 54.338-21.221 105.412-59.666 143.812-38.417 38.372-89.467 59.5-143.761 59.5h-.12C132.506 459.365 41.3 368.056 41.364 255.883c.031-54.337 21.221-105.411 59.667-143.813 38.417-38.372 89.468-59.5 143.761-59.5h.12c28.672.016 56.49 5.942 82.68 17.611 10.436 4.65 22.659-.041 27.309-10.474 4.648-10.433-.04-22.659-10.474-27.309-31.516-14.043-64.989-21.173-99.492-21.192h-.144c-65.329 0-126.767 25.428-172.993 71.6C25.536 129.014.038 190.473 0 255.861c-.037 65.386 25.389 126.874 71.599 173.136 46.21 46.262 107.668 71.76 173.055 71.798h.144c65.329 0 126.767-25.427 172.993-71.6 46.262-46.209 71.76-107.668 71.798-173.066v-20.842c0-11.423-9.259-20.683-20.682-20.683z"/><path d="M505.942 39.803c-8.077-8.076-21.172-8.076-29.249 0L244.794 271.701l-52.609-52.609c-8.076-8.077-21.172-8.077-29.248 0-8.077 8.077-8.077 21.172 0 29.249l67.234 67.234a20.616 20.616 0 0 0 14.625 6.058 20.618 20.618 0 0 0 14.625-6.058L505.942 69.052c8.077-8.077 8.077-21.172 0-29.249z"/></svg>
          </div>
      </div>
      <div class="w-full text-grey-darker items-center p-4">
          <span class="text-lg font-bold pb-4 text-white">
               SUCCESS!
          </span>
          <p class="leading-tight text-white">
            {{ Session::get('message') }}
          </p>
      </div>
  </div>
   @endif



   @yield('content')
        </main>
    </div>
</body>

<style>
</style>
</html>