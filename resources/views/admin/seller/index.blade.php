
@extends('admin.layout.main')
@section('title') Manage Sellers @endsection

@section('content')

<div class=" bg-cover overflow-y-scroll px-5">

        <div class="container max-w-4xl mx-auto pt-10 mb-12 text-center break-normal">
                <!--Title-->
                <p class="text-blue-700 font-extrabold text-lg md:text-xl">
                  Manage Sellers
                </p>


           <form action="{{ Asset($link) }}" method="GET" id="search_form">

                <input class="w-full h-12 px-3 border-gray-300 border-2 rounded mt-6 focus:outline-none focus:shadow-outline text-lg px-8 shadow-lg" type="search" name="seller_name" placeholder="Search Seller">

           </form>


        </div>


        <!-- Table with Seller Details -->


          <div class="container mx-auto w-full">

    <!--    <div class="pb-10">

         <a href="{{ Asset($link.'create') }}" class=" w-56 bg-blue-800 cta-btn font-semibold text-white py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-blue-900 flex items-center justify-center">
                <i class="fas fa-plus mr-3"></i> Add New Seller
        </a>

        </div> -->

             <table class="border-collapse w-full">
    <thead>
        <tr>
            <th class="p-3 font-bold uppercase shadow bg-blue-800 text-white border border-gray-300 hidden lg:table-cell">Seller name</th>
            <th class="p-3 font-bold uppercase shadow bg-blue-800 text-white border border-gray-300 hidden lg:table-cell">Phone</th>
         <!--   <th class="p-3 font-bold uppercase shadow bg-blue-800 text-white border border-gray-300 hidden lg:table-cell">Email</th> -->
            <th class="p-3 font-bold uppercase shadow bg-blue-800 text-white border border-gray-300 hidden lg:table-cell">Ref_ID</th>
            <th class="p-3 font-bold uppercase shadow bg-blue-800 text-white border border-gray-300 hidden lg:table-cell">Current Earnings</th>
            <th class="p-3 font-bold uppercase shadow bg-blue-800 text-white border border-gray-300 hidden lg:table-cell">Actions</th>
        </tr>
    </thead>
    <tbody>

    	 @foreach($data as $seller)
       
        <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0 items-center justify-center">
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Seller name</span>
                <br> {{$seller->name}}
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Phone</span>
               <br> {{$seller->phone}}
            </td>
           <!-- <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Email</span>
               <br> {{$seller->email}}
            </td> -->

            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Ref_ID</span>
               <br> {{$seller->ref_id}}
            </td>

            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Current Earnings</span>
               <br> Rs. {{number_format($seller->r_earnings)}}
               <a href="{{ Asset($link.$seller->id.'/e-reset') }}" class="text-orange-500 hover:text-orange-700 underline pl-6" onclick="event.preventDefault();
                                         if(confirm('Reset Seller Earnings?')){document.getElementById('reset_form_{{$seller->id}}').submit()};
                                   "><i class="fas fa-sync mr-2 text-orange-500"></i>Reset</a>

                <form id="reset_form_{{$seller->id}}" action="{{ Asset($link.$seller->id.'/e-reset') }}" method="POST" style="display: none;">
                  @csrf
                  @method('PUT')

                </form>
            </td>

            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Actions</span>
                <br>
                <a href="{{ Asset($link.$seller->id.'/edit') }}" class="text-green-500 hover:text-green-700 underline" ><i class="fas fa-edit mr-2 text-green-500"></i>Edit</a>
               
                <a href="{{ Asset($link.$seller->id.'/delete') }}" class="text-red-500 hover:text-red-700 underline pl-6" onclick="event.preventDefault();
                						 if(confirm('Delete Seller?')){document.getElementById('delete_form_{{$seller->id}}').submit()};
                                   "><i class="fas fa-trash mr-2 text-red-500"></i>Delete</a>

                <form id="delete_form_{{$seller->id}}" action="{{ Asset($link.$seller->id.'/delete') }}" method="POST" style="display: none;">
                  @csrf
                  @method('DELETE')

                </form>


                <br>

            </td>

			
        </tr>

        @endforeach
        
    </tbody>

</table>
            <!-- End Table with Seller Details -->


<!-- Pagination -->

<div class="container mx-auto flex justify-center my-8 mt-auto pt-8 mb-10 pb-5">
@if ($data->hasPages())
    <ul class="pagination flex justify-between mx-4 mt-4 list-reset text-white font-bold">

        {{-- Previous Page Link --}}
        @if ($data->onFirstPage())
            <li class="disabled">
                <span class="button bg-blue-800 border border-brown py-2 px-4 rounded opacity-50 cursor-not-allowed">@lang('pagination.previous')</span>
            </li>
        @else
            <li>
                <a class="button bg-blue-800 border border-brown py-2 px-4 rounded opacity-85" href="{{ $data->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a>
            </li>
        @endif

        {{-- Next Page Link --}}
        @if ($data->hasMorePages())
            <li>
                <a class="button bg-blue-800 border border-brown py-2 px-4 rounded opacity-85" href="{{ $data->nextPageUrl() }}" rel="next">@lang('pagination.next')</a>
            </li>
        @else
            <li class="disabled ">
                <span class="button bg-blue-800 border border-brown py-2 px-4 rounded opacity-50 cursor-not-allowed">@lang('pagination.next')</span>
            </li>
        @endif
    </ul>
@endif


</div>

<!-- End Pagination -->

</div>

@endsection