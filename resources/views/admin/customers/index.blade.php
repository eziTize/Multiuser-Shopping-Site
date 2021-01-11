
@extends('admin.layout.main')
@section('title') Customer List @endsection

@section('content')

<div class=" bg-cover overflow-y-scroll px-5">

        <div class="container max-w-4xl mx-auto pt-10 mb-12 text-center break-normal">
                <!--Title-->
                <p class="text-blue-700 font-extrabold text-lg md:text-xl">
                  Customer List
                </p>


           <form action="{{ Asset($link) }}" method="GET" id="search_form">

                <input class="w-full h-12 px-3 border-gray-300 border-2 rounded mt-6 focus:outline-none focus:shadow-outline text-lg px-8 shadow-lg" type="search" name="cust_email" placeholder="Search Customer With Email">

           </form>


        </div>


        <!-- Table with Customer Details -->


          <div class="container mx-auto w-full">


             <table class="border-collapse w-full">
    <thead>
        <tr>

            <th class="p-3 font-bold uppercase shadow bg-blue-800 text-white border border-gray-300 hidden lg:table-cell">ID</th>

            <th class="p-3 font-bold uppercase shadow bg-blue-800 text-white border border-gray-300 hidden lg:table-cell">Name</th>
            <th class="p-3 font-bold uppercase shadow bg-blue-800 text-white border border-gray-300 hidden lg:table-cell">Email</th>
            <th class="p-3 font-bold uppercase shadow bg-blue-800 text-white border border-gray-300 hidden lg:table-cell">Logged In</th>
           
        </tr>
    </thead>
    <tbody>

    	 @foreach($data as $customer)
       
        <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0 items-center justify-center">
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">ID</span>
                <br> {{$customer->id}}
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Name</span>
               <br> {{$customer->name}}
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Email</span>
               <br> {{$customer->email}}
            </td>


               @if($customer->is_logged == 1)
                <td class="w-full lg:w-auto p-3 text-green-500 text-center border border-b text-center block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold text-gray-800 uppercase">Logged In</span>
               <br> Yes
                </td>
               @else
                <td class="w-full lg:w-auto p-3 text-red-500 text-center border border-b text-center block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold text-gray-800 uppercase ">Logged In</span>
               <br> No
                </td>
                @endif
			
        </tr>

        @endforeach
        
    </tbody>

</table>
            <!-- End Table with Customer Details -->


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