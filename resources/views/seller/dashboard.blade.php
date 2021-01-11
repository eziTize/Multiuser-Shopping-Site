@php ($seller = Auth::guard('seller')->user())
@extends('seller.layout.main')
@section('title') Dashboard @endsection
@section('content')
<div class="px-4">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    You are logged in!
                </div>


                <div class="flex flex-col justify-center text-2xl">
                  <h2 class="text-center text-black px-4"> Your referral Link:</h2>
                   <h2 class="text-center text-blue-500"> {{ url('/').'/?ref='.$seller->ref_id }} </h2>
                   <h2 class="text-xl text-center text-orange-700 justify-center"> (You will Get {{$seller->profit_percent}}% of Each Referral Sales) </h2>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection