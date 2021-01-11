@extends('admin.layout.main')
@section('title') Update Profile @endsection

@section('content')


        <div class="bg-cover bg-gray-400 overflow-y-scroll">

            <div class="container max-w-4xl mx-auto pt-10 text-center break-normal">
                <!--Title-->
                <p class="text-blue-700 font-extrabold text-lg md:text-xl">
                  Update Profile
                </p>

            </div>

          <div class="container mx-auto w-full px-10 md:px-20 lg:px-40 py-10">


      <form method="POST" role="form" class="w-full" action="{{ route('admin.settings') }}">

        @csrf
            <div class="flex flex-wrap mb-6">
                <div class="w-full px-3">
              <label class="block uppercase tracking-wide text-black text-xs font-bold mb-2" for="name">
                 Name *

              </label>
              <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="name" type="text" name="name" value="{{ $data->name }}" required>
         <!--      <p class="text-gray-600 text-xs italic">Remove if not needed</p> -->
            </div>
          </div>

      <div class="flex flex-wrap mb-6">
        <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-black text-xs font-bold mb-2" for="email">
                    Email *
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="email" type="email" name="email" placeholder="Email" value="{{ $data->email }}" required>
            </div>
        </div>


        <div class="flex flex-wrap mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                 <label class="block uppercase tracking-wide text-black text-xs font-bold mb-2" for="password">
                    Current Password *
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="password" type="password" name="password" placeholder="confirm current password" required>
            </div>



        <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-black text-xs font-bold mb-2" for="new_password">
                    New Password
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="new_password" type="password" name="new_password" placeholder="input here to update password">
            </div>
        </div>


        <div class="md:flex md:items-center">
            <div class="md:w-1/3 px-3">
                <button class="shadow bg-teal-400 hover:bg-teal-500 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                    Update
                </button>
            </div>
        </div>

    </form>
 </div>
</div>

@endsection