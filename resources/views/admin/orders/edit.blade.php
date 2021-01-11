@extends('admin.layout.main')
@section('title') Edit Order @endsection

@section('content')


        <div class="bg-cover bg-gray-400 overflow-y-scroll">

            <div class="container max-w-4xl mx-auto pt-10 text-center break-normal">
                <!--Title-->
                <p class="text-blue-700 font-extrabold text-lg md:text-xl">
                  Change Order Status
                </p>

            </div>

          <div class="container mx-auto w-full px-10 md:px-20 lg:px-40 py-10">


      <form method="POST" role="form" class="w-full" action="{{ Asset($link.$data->id.'/update')}}" enctype="multipart/form-data">

        @csrf
        @method('PUT')


         <div class="flex flex-wrap mb-6">
                <div class="w-full px-3">
              
            </div>
          </div>

          <div class="flex flex-wrap mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-black text-xs font-bold mb-2" for="txn_id">
                 Transaction ID
              </label>
              <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="txn_id" type="text" name="txn_id" value="{{$data->transaction_id}}" readonly>
            </div>

             <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                 <label class="block uppercase tracking-wide text-black text-xs font-bold mb-2" for="email">
                 Customer Email
              </label>
              <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="email" type="text" name="email" value="{{$data->email}}" readonly>
            </div>
          
        </div>


        <div class="flex flex-wrap mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-black text-xs font-bold mb-2" for="type">
                 Payment Method
              </label>
              <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="type" type="text" name="type" value="{{$data->type}}" readonly>
            </div>

             <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                 <label class="block uppercase tracking-wide text-black text-xs font-bold mb-2" for="amount">
                 Order Amount
              </label>
              <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="amount" type="text" name="amount" value="Rs. {{ number_format($data->amount), 2}}" readonly>
            </div>
        </div>


            <label class="block uppercase tracking-wide text-black text-xs font-bold mb-2 px-3" for="category_name">
                    Order Status
            </label>

        <div class="flex flex-wrap mb-6 px-3 relative inline-flex w-full">
         <select class="w-full h-12 px-3 border-gray-300 border-2 rounded mt-6 focus:outline-none focus:shadow-outline text-lg shadow-lg" type="status" name="status" placeholder="Order Status">
                                

                                @if($data->status)
                                    <option>{{$data->status}}</option>
                                @endif


                                @if($data->status == 'Successful')
                                    <option>Pending</option>
                                    <option>Failed</option>
                                    <option>Refunded</option>
                                    <option>Delivered</option>


                                @elseif($data->status == 'Pending')
                                    <option>Successful</option>
                                    <option>Failed</option>
                                    <option>Refunded</option>
                                    <option>Delivered</option> 


                                @elseif($data->status == 'Failed')
                                    <option>Successful</option>
                                    <option>Pending</option>
                                    <option>Refunded</option>

                                @elseif($data->status == 'Refunded')
                                    <option>Successful</option>
                                    <option>Pending</option>
                                    <option>Failed</option>
                                    <option>Delivered</option>

                                @elseif($data->status == 'Delivered')
                                    <option>Successful</option>
                                    <option>Pending</option>
                                    <option>Failed</option>
                                    <option>Refunded</option>

                                @else
                                    <option>Successful</option>
                                    <option>Pending</option>
                                    <option>Failed</option>
                                    <option>Refunded</option>
                                    <option>Delivered</option>

                                @endif                        
                                 

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
          
