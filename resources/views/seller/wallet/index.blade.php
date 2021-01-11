@php ($seller = Auth::guard('seller')->user())
@extends('seller.layout.main')
@section('title') My Wallet @endsection
@section('content')
<div class="px-10 py-20 mt-32 z-40 shadow-lg border-2 border-black rounded-lg bg-orange-500 w-full md:w-1/2 self-center">

        <h2 class="text-center text-3xl font-extrabold text-black px-4"> Your Wallet: </h2>

        <div class="flex justify-center text-2xl">
            <h3 class="text-xl text-center font-medium text-teal-700 justify-center">Redeemable Earnings: Rs. {{number_format($seller->r_earnings)}}
            </h3>
        </div>

</div>
@endsection