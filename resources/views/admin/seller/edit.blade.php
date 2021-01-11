@extends('admin.layout.main')
@section('title') Edit Seller @endsection

@section('content')


        <div class="bg-cover bg-gray-400 overflow-y-scroll">

            <div class="container max-w-4xl mx-auto pt-10 text-center break-normal">
                <!--Title-->
                <p class="text-blue-700 font-extrabold text-lg md:text-xl">
                  Edit Seller
                </p>

            </div>

          <div class="container mx-auto w-full px-10 md:px-20 lg:px-40 py-10">


      <form method="POST" role="form" class="w-full" action="{{ route('seller.update', ['id' => $data->id ]) }}">

        @csrf
        @method('PUT')

            <div class="flex flex-wrap mb-6">
                <div class="w-full px-3">
              <label class="block uppercase tracking-wide text-black text-xs font-bold mb-2" for="name">
                 Seller Name *

              </label>
              <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="name" type="text" name="name" value="{{ $data->name }}" required>
         <!--      <p class="text-gray-600 text-xs italic">Remove if not needed</p> -->
            </div>
          </div>

           <div class="flex flex-wrap mb-6">
            <div class="w-full px-3">
              <label class="block uppercase tracking-wide text-black text-xs font-bold mb-2" for="ref_id">
                Referral ID
              </label>
              <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="ref_id" type="text" name="ref_id" value="{{$data->ref_id}}" disabled>
                  <p class="text-blue-600 text-sm italic font-medium">Link: {{ url('/').'/?ref='.$data->ref_id }}</p> 
            </div>
          </div>

        <div class="flex flex-wrap mb-6">
          <div class="w-full px-3 mb-6 md:mb-0">
          <label class="block uppercase tracking-wide text-black text-xs font-bold mb-2" for="profit_percent">
                    Gender
                </label>
          <select class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3 focus:outline-none focus:bg-white" name="gender" value="{{ $data->gender }}">


            @if($data->gender)
            <option>{{$data->gender}}</option>
            @endif


            @if($data->gender == 'Male')
            <option>Female</option>

            @elseif($data->gender == 'Female')
            <option>Male</option>

            @else
            <option>Female</option>
            <option>Male</option>
            @endif


          </select>
        </div>
      </div>

         <div class="flex flex-wrap mb-6">
                <div class="w-full px-3">
              <label class="block uppercase tracking-wide text-black text-xs font-bold mb-2" for="address">
                Address *
              </label>
              <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="address" type="text" name="address" value="{{ $data->address }}" placeholder="Seller Address" required>
            <!--   <p class="text-gray-600 text-xs italic">Remove if not needed</p> -->
            </div>
          </div>


        <div class="flex flex-wrap mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-black text-xs font-bold mb-2" for="phone">
                    Phone Number
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="phone" type="number" placeholder="Seller Phone Number" name="phone" min="0" value="{{ $data->phone }}" >
            </div>



        <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-black text-xs font-bold mb-2" for="email">
                    Email
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="email" type="email" name="email" placeholder="Seller Email" value="{{ $data->email }}">
            </div>
        </div>


        <div class="flex flex-wrap mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                 <label class="block uppercase tracking-wide text-black text-xs font-bold mb-2" for="password">
                    Password
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="password" type="password" name="password" placeholder="******************">
            </div>



        <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-black text-xs font-bold mb-2" for="confirm_password">
                    Confirm Password
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="confirm_password" type="password" name="confirm_password" placeholder="******************">
            </div>
        </div>



        <div class="flex flex-wrap mb-6">

          <!-- <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
               <label class="block uppercase tracking-wide text-black text-xs font-bold mb-2" for="profit_percent">
                    Profit % On Sales
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="profit_percent" type="number" placeholder="Enter % Profit for Seller" name="profit_percent" min="0" value="{{ $data->profit_percent}}" >
            </div> -->


            <div class="w-full px-3 mb-6 md:mb-0">
              <label class="block uppercase tracking-wide text-black text-xs font-bold mb-2" for="profit_percent">
                    Seller Status
                </label>
                
              <select class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3 focus:outline-none focus:bg-white" name="status" value="{{ $data->status }}">


                @if($data->status == '1')
                <option value="1" >Inactive</option>
                <option value="0">Active</option>

                 @elseif($data->status == '0')
                <option value="0" >Active</option>
                <option value="1">Inactive</option>

                @else
                <option value="0" >Active</option>
                <option value="1">Inactive</option>
                @endif


              </select>
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
          
