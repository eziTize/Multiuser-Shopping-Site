@extends('admin.layout.main')
@section('title') Edit Product @endsection

@section('content')


        <div class="bg-cover bg-gray-400 overflow-y-scroll">

            <div class="container max-w-4xl mx-auto pt-10 text-center break-normal">
                <!--Title-->
                <p class="text-blue-700 font-extrabold text-lg md:text-xl">
                  Edit Product
                </p>

            </div>

          <div class="container mx-auto w-full px-10 md:px-20 lg:px-40 py-10">


      <form method="POST" role="form" class="w-full" action="{{ Asset($link.$id.'/update')}}" enctype="multipart/form-data">

        @csrf
        @method('PUT')

            <div class="flex flex-wrap mb-6">
                <div class="w-full px-3">
              <label class="block uppercase tracking-wide text-black text-xs font-bold mb-2" for="name">
                 Product Name *

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
                <div class="w-full px-3">
              <label class="block uppercase tracking-wide text-black text-xs font-bold mb-2" for="slug">
                Product Image
              </label>
                <img class=" w-1/3" src="{{asset($data->image)}}" id="Image" name="Image" />

          </div>
        </div>


           <div class="flex flex-wrap mb-6">
                <div class="w-full px-3">
              <label class="block uppercase tracking-wide text-black text-xs font-bold mb-2" for="image">
               Change Product Image
              </label>
              <input type="file" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="product_image" type="text" name="image" accept=".jpeg,.jpg,.png" onchange="checkextension()" value="{{$data->image}}">
            <!--   <p class="text-gray-600 text-xs italic">Remove if not needed</p> -->

             {{--! Script for Error on non-jpg/jpeg/png files !--}}

            <script>


            function checkextension() {

                var file = document.querySelector("#product_image");

                
                         if (/\.(jpg|jpeg|png)$/i.test(file.files[0].name) === false) {

                    alert("File format not supported, supported formats: jpg/jpeg/png.");
                    document.querySelector("#product_image").value = "";

                }
           
            }

            </script>
          
          {{--! End Script !--}}


            </div>
          </div>


        <div class="flex flex-wrap mb-6">
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-black text-xs font-bold mb-2" for="price">
                    Price (INR) *
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="price" type="number" placeholder="Numbers Only" name="price" step=".01" min="0" value="{{$data->price}}" required>
            </div>

             <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-black text-xs font-bold mb-2" for="price">
                    MRP (INR)
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="mrp" type="number" placeholder="Numbers Only" name="mrp" step=".01" min="0" value="{{$data->mrp}}">
            </div>

            <div class="w-full md:w-1/3 px-3">
                <label class="block uppercase tracking-wide text-black text-xs font-bold mb-2" for="units">
                    Units Available
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="units" type="number" min="0" name="units" placeholder="Numbers Only" value="{{$data->units}}">
            </div>
        </div>

        <div class="flex flex-wrap mb-6">
            <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-black text-xs font-bold mb-2" for="description">
                    Description
                </label>
                <textarea class="no-resize appearance-none block w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 h-48 resize-y" id="description" name="description">{{$data->description}}</textarea>

              <!-- <p class="text-black text-xs italic">Re-size can be disabled by set by resize-none / resize-y / resize-x / resize</p> -->
            </div>
        </div>

            <label class="block uppercase tracking-wide text-black text-xs font-bold mb-2 px-3" for="category_name">
                    Category
            </label>

        <div class="flex flex-wrap mb-6 px-3 relative inline-flex">
          <svg class="w-2 h-2 absolute top-0 right-0 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232"><path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero"/></svg>
          <select class="border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none" name="category_name">


            @if($data->category_name)
            <option>{{$data->category_name}}</option>
            @endif

           @foreach($categories as $category)

            @if($data->category_name != $category->name)
            <option>{{$category->name}}</option>
            @endif

          @endforeach

          </select>
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
          
