
@extends('admin.layout.main')
@section('title') Check Sales @endsection

@section('content')

<div class=" bg-cover overflow-y-scroll px-5">

        <div class="container max-w-4xl mx-auto pt-10 mb-12 text-center break-normal">
                <!--Title-->
                <p class="text-blue-700 font-extrabold text-lg md:text-xl">
                  Sales From Referrals
                </p>


       <form action="{{ Asset($link) }}" method="GET" id="search_form">

                <select class="w-full h-12 px-3 border-gray-300 border-2 rounded mt-6 focus:outline-none focus:shadow-outline text-lg shadow-lg" type="search" name="seller_id" placeholder="Select Seller" onchange="submit_search()">


                           <option value="">Select Seller</option>
                        
                         @foreach($seller as $slr)

                            <option value="{{ $slr->id }}">

                            {{ $slr->name }}, (ID: {{ $slr->id }})

                            </option>

                        @endforeach

                </select>

           </form>


             {{--! Script for Search Submit !--}}

            <script>

            function submit_search() {

                document.getElementById('search_form').submit()
           
            }

            </script>

            {{--! End Script !--}}
        </div>


        <!-- Table with Sales Details -->


          <div class="container mx-auto w-full">


             <table class="border-collapse w-full">
    <thead>
        <tr>

            <th class="p-3 font-bold uppercase shadow bg-blue-800 text-white border border-gray-300 hidden lg:table-cell">Seller</th>
            <th class="p-3 font-bold uppercase shadow bg-blue-800 text-white border border-gray-300 hidden lg:table-cell">Txn ID</th>
            <th class="p-3 font-bold uppercase shadow bg-blue-800 text-white border border-gray-300 hidden lg:table-cell">Date</th>
            <th class="p-3 font-bold uppercase shadow bg-blue-800 text-white border border-gray-300 hidden lg:table-cell">Order Amount</th>
            <th class="p-3 font-bold uppercase shadow bg-blue-800 text-white border border-gray-300 hidden lg:table-cell">Earning</th>
           
        </tr>
    </thead>
    <tbody>

    	 @foreach($data as $sales)
       
        <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0 items-center justify-center">
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Seller</span>
                <br> {{$seller->find($sales->seller_id)->name}}, (ID: {{$seller->find($sales->seller_id)->id}})
            </td>

            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Txn ID</span>
               <br> {{$order->find($sales->order_id)->transaction_id}}
            </td>

            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Date</span>
               <br> {{date_format($order->find($sales->order_id)->created_at, 'd/m/Y')}}
            </td>

            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Order Amount</span>
               <br>Rs. {{number_format($order->find($sales->order_id)->amount)}}
            </td>


             <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Earning</span>
               <br>Rs. {{number_format($sales->pr_earned)}}
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