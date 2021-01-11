@extends('admin.layout.main')
@section('title') Order Details @endsection

@section('css')
<style>
    .my-orders .order-container {
        margin-bottom: 64px;
        border: 1px solid black;
    }

    .my-orders .order-header {
        background: #2c5282;
        border: 1px solid #DDDDDD;
        padding: 14px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .my-orders .order-products {
        background: auto;
        border: 1px solid #DDDDDD;
        border-top: none;
        padding: 14px;
    }

    .my-orders .order-header-items {
        display: flex;
    }

    .my-orders .order-header-items.div {
        margin-right: 14px;
    }

    .my-orders .order-product-item {
        display: flex;
        margin: 32px 0;
    }

    .my-orders .order-product-item.img {
        max-width: 140px;
        margin-right: 24px;
    }

    .uppercase {
        text-transform: uppercase;
    }

    .font-bold {
        font-weight: bold;
    }
</style>
@endsection

@section('content')

  {{--  <div class="container">
        @if (session()->has('success_message'))
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
        @endif

        @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div> --}}
 <div class="mx-auto container my-16 px-16 py-16 bg-gray-400 overflow-y-auto"> 
    <div class="products-section my-orders container">
        <div class="Order ID">
            <h1>Transaction ID: {{ $data->transaction_id }}</h1>

        </div> <!-- end sidebar -->

        <div class="my-profile">

            <div>
                <div class="order-container">
                    <div class="order-header">
                        <div class="order-header-items">
                            <div>
                                <div class="uppercase font-bold text-center">Order Placed At: </div>
                                {!! $data->created_at->format('d-m-Y\<\b\r\>h:i a') !!}
                            </div>

                        </div>
                       {{-- <div>
                            <div class="order-header-items">
                                <div><a href="#">Invoice</a></div>
                            </div>
                        </div> --}}
                    </div>
                    <div class="order-products">
                        <table class="table" style="width:50%">
                            <tbody>
                            <tr>
                                <td>Customer Name</td>
                                <td>{{ $data->user->name }}</td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td>{{ $data->ph_no }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{ $data->email }}</td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>{{ $data->address }}</td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td>Rs. {{ number_format($data->amount), 2}}</td>
                            </tr>
                             <tr>
                                <td>Status</td>
                                @if($data->status == 'Successful')
                                <td class="text-green-500">{{ $data->status }}</td>
								@elseif($data->status == 'Failed')
								<td class="text-red-500">{{ $data->status }}</td>
								@elseif($data->status == 'Refunded')
								<td class="text-red-800">{{ $data->status }}</td>
								@elseif($data->status == 'Delivered')
								<td class="text-teal-800">{{ $data->status }}</td>
								@else
								<td class="text-orange-500">{{ $data->status }}</td>
								@endif
                            </tr>

                            @if($data->ref_id)
                            <tr>
                                <td>Referred By</td>
                                <td>{{ $ref->name }}, ID: {{ $ref->id }}</td>
                            </tr>
                            @endif
                            </tbody>
                        </table>

                    </div>
                </div> <!-- end order-container -->

                <div class="order-container">
                    <div class="order-header">
                        <div class="order-header-items">
                            <div>
                                Ordered Products
                            </div>
                        </div>
                    </div>
                    <div class="order-products">
                        @foreach ($order_p as $o_p)
                            <div class="order-product-item">
                                <div class="mx-10"><img class="w-auto h-16" src="{{ asset($o_p->product->image) }}" alt="Product Image"></div>
                                <div>
                                    <div>
                                      <h4>{{ $o_p->product->name }}</h4>
                                    </div>
                                    <div>Rs. {{ number_format($o_p->product->price), 2 }}</div>
                                    <div>Quantity: {{ $o_p->quantity }}</div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div> <!-- end order-container -->
            </div>
        </div>
    </div>
  </div>

@endsection