<!doctype html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Store</title>
    <meta name="description" content="Meta Description">
    <meta name="keywords" content="Meta Keywords">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSRF Token For Protection -->
    <script>window.Laravel = { csrfToken: '{{ csrf_token() }}'} 
    </script>
    <script src="https://kit.fontawesome.com/5810dc9d6a.js" crossorigin="anonymous"></script>

    <!------Style & Font------>
    <link rel="stylesheet" href="/css/app.css" />
    <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,700" rel="stylesheet" />

    @yield('css')

</head>

<body class="text-gray-700 bg-white" style="font-family: 'Source Sans Pro', sans-serif">

<div id="app" class="flex flex-col flex-1">

  <div class="h-screen flex flex-col flex-1 overflow-y-auto">
        <Navbar> </Navbar>
    <main class="bg-auto flex-grow">
        <div class=" p-3 bg-auto"> </div>
     
            <router-view></router-view>

    </main>

       <!-- Footer -->

        <div class="bottom-0 pt-2 md:pt-1 lg:pt-3">
         <footer class="font-sans bg-black py-5">

                <div class="mx-2 md:mx-10 px-2 flex justify-between items-center">
                    <a href="https://ezitize.com/" class="text-sm text-yellow-700 flex justify-start">
                        Designed & Developed by EzìTízƎ
                    </a>

                    <div class=" flex justify-end ">


                        <i class="fab fa-facebook-f text-blue-500 -rotate-45 px-2"></i>

                        <i class="fab fa-twitter text-blue-500 -rotate-45 px-2"></i>

                        <i class="fab fa-linkedin-in text-blue-500 -rotate-45 px-2"></i>



                    </div>

                </div>
        </footer>

        <div>
</div>


</div>


    <script src="/js/app.js"> </script>

    @yield('js')


</body>

<style>

</style>