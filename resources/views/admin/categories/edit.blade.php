@extends('admin.layout.main')
@section('title') Edit Category @endsection

@section('content')


  <div class="bg-cover bg-gray-400 overflow-y-scroll">

      <div class="container max-w-4xl mx-auto pt-10 text-center break-normal">
                <!--Title-->
                <p class="text-blue-700 font-extrabold text-lg md:text-xl">
                  Edit Category
                </p>

      </div>

  <div class="container mx-auto w-full px-10 md:px-20 lg:px-40 py-10">

      <form method="POST" role="form" class="w-full" action="{{ Asset($link.$id.'/update')}}" enctype="multipart/form-data">

        @csrf
        @method('PUT')

            <div class="flex flex-wrap mb-6">
              <div class="w-full px-3">
              <label class="block uppercase tracking-wide text-black text-xs font-bold mb-2" for="name">
                 Category Name *

              </label>
              <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="name" type="text" name="name" value="{{$data->name}}" required>
         <!--      <p class="text-gray-600 text-xs italic">Remove if not needed</p> -->
            </div>
          </div>

         <div class="flex flex-wrap mb-6">
            <div class="w-full px-3">
              <label class="block uppercase tracking-wide text-black text-xs font-bold mb-2" for="slug">
                Slug
              </label>
              <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="slug" type="text" name="slug" value="{{$data->slug}}">
            <!--   <p class="text-gray-600 text-xs italic">Remove if not needed</p> -->
            </div>
          </div>

          <div class="flex flex-wrap mb-6">
             <div class="w-full px-3 mb-6 md:mb-0">
               <label class="block uppercase tracking-wide text-black text-xs font-bold mb-2" for="ref_pct">
                    Referral % On Sales
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="ref_pct" type="number" placeholder="Enter Referral %" name="ref_pct" min="0" value="{{$data->ref_pct}}" >
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
          
