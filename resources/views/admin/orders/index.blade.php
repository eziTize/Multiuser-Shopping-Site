
@extends('admin.layout.main')
@section('title') Check Orders @endsection

@section('content')

<div class=" bg-cover overflow-y-scroll px-5">

        <div class="container max-w-4xl mx-auto pt-10 mb-12 text-center break-normal">
                <!--Title-->
                <p class="text-blue-700 font-extrabold text-lg md:text-xl">
                  Check Orders
                </p>


           <form action="{{ Asset($link) }}" method="GET" id="search_form">

                <input class="w-full h-12 px-3 border-gray-300 border-2 rounded mt-6 focus:outline-none focus:shadow-outline text-lg px-8 shadow-lg" type="search" name="txn_id" placeholder="Search Order With Txn ID">

           </form>


        </div>


        <!-- Table with Order Details -->


          <div class="container mx-auto w-full">


             <table class="border-collapse w-full">
    <thead>
        <tr>

            <th class="p-3 font-bold uppercase shadow bg-blue-800 text-white border border-gray-300 hidden lg:table-cell">Txn ID</th>
            <th class="p-3 font-bold uppercase shadow bg-blue-800 text-white border border-gray-300 hidden lg:table-cell">Customer</th>
            <th class="p-3 font-bold uppercase shadow bg-blue-800 text-white border border-gray-300 hidden lg:table-cell">Date</th>
            <th class="p-3 font-bold uppercase shadow bg-blue-800 text-white border border-gray-300 hidden lg:table-cell">Email</th>
            <th class="p-3 font-bold uppercase shadow bg-blue-800 text-white border border-gray-300 hidden lg:table-cell">Phone</th>
         <!-- <th class="p-3 font-bold uppercase shadow bg-blue-800 text-white border border-gray-300 hidden lg:table-cell">Address</th> -->
            <th class="p-3 font-bold uppercase shadow bg-blue-800 text-white border border-gray-300 hidden lg:table-cell">Method</th>
            <th class="p-3 font-bold uppercase shadow bg-blue-800 text-white border border-gray-300 hidden lg:table-cell">Status</th>
            <th class="p-3 font-bold uppercase shadow bg-blue-800 text-white border border-gray-300 hidden lg:table-cell">Details</th>
           
        </tr>
    </thead>
    <tbody>

    	 @foreach($data as $order)
       
        <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0 items-center justify-center">
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Txn ID</span>
                <br> {{$order->transaction_id}}
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Customer</span>
               <br> {{$user->find($order->user_id)->name}}
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Date</span>
               <br> {{date_format($order->created_at, 'd/m/Y')}}
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Email</span>
               <br> {{$order->email}}
            </td>


             <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Phone</span>
               <br> {{$order->ph_no}}
            </td>


          <!--  <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Address</span>
               <br> {{$order->address}}
            </td> -->

            @if($order->type)
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Method</span>
               <br> {{$order->type}}
            </td>

            @else

             <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Method</span>
               <br> N/A
            </td>

            @endif



               @if($order->status == 'Successful')
                <td class="w-full lg:w-auto p-3 text-green-500 text-center border border-b text-center block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold text-gray-800 uppercase">Status</span>
               <br> Successful

                @elseif($order->status == 'Failed')
                <td class="w-full lg:w-auto p-3 text-red-500 text-center border border-b text-center block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold text-gray-800 uppercase ">Status</span>
               <br> Failed


              @elseif($order->status == 'Refunded')
                <td class="w-full lg:w-auto p-3 text-red-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold text-gray-800 uppercase ">Status</span>
               <br> Refunded

              @elseif($order->status == 'Delivered')
                <td class="w-full lg:w-auto p-3 text-teal-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold text-gray-800 uppercase ">Status</span>
               <br> Delivered

               @else
                <td class="w-full lg:w-auto p-3 text-orange-500 text-center border border-b text-center block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold text-gray-800 uppercase ">Status</span>
               <br> Pending
               
                @endif

                <a href="{{ Asset($link.$order->id.'/edit') }}" class="text-green-500 hover:text-green-700 underline px-2" ><i class="fas fa-edit text-indigo-500"></i></a>
			 </td>

          <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Details</span>
                <br> <a href="{{ Asset($link.$order->id.'/view') }}" class="text-green-500 hover:text-green-700 underline px-2">View<i class="fas fa-eye text-blue-500 px-2"></i></a>
         </td>
        </tr>
        @endforeach
        
    </tbody>

</table>
            <!-- End Table with Order Details -->


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