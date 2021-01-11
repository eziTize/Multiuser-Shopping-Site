@extends('status')
@section('status')

<div  class="text-gray-900 bg-gray-200">

    <div class="pt-20 pb-10 flex justify-center">
        <h1 class="text-3xl text-red-500">
            Payment Failed
        </h1>
    </div>


     <p class="text-center pb-10 text-gray-600 px-2"> Please check with <b>Paytm</b> support if your funds were deducted, if <b>Paytm</b> informs that the payment went through, please contact us at <a href="mailto:sandipan21saha@yahoo.com" class="text-blue-500"><b>sandipan21saha@yahoo.com</b></a>. </p>


</div>


<div class="container mx-auto flex justify-center my-8 mt-auto pt-8 pb-">
    <a href="/"> <button class="border border-blue-500 text-blue-500 block rounded-sm font-bold py-2 px-6 mr-2 flex items-center hover:bg-blue-500 hover:text-white">
       <i class="fas fa-arrow-left pr-2"> </i> Back
    </button>
   </a>
</div>


@endsection