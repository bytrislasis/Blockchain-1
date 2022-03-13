@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">


            <div class="card mb-3">
                <div class="card-body">
			<span class="float-start m-2 me-4">
				<img src="https://satoshiturk.com/data/avatars/m/0/1.jpg?1642262749" style="height:100px" alt="" class="rounded-circle img-thumbnail">
			</span>
                    <div class="">
                        <h4 class="mt-1 mb-1">Sabri Yaşın</h4>

                        <p class="font-13"> SatoshiTURK.Com <br>
                            <span class="text-danger">Türkiye'nin Lider Kripto Para Forumu</span>
                        </p>


                        <ul class="mb-0 list-inline">

                            <li class="list-inline-item me-3  border p-2">
                                <a href="{{route('bitcoin')}}" class="text-black text-decoration-none">
                                    <h5 class="mb-1">Bitcoin ( <i class="fa-brands fa-btc"></i> )</h5>
                                </a>
                                <p class="mb-0 font-13">Miktar: <span class="text-warning">{{\Illuminate\Support\Facades\Auth::user()->bitcoinAddress()->first()->balance}}</span></p>
                            </li>


                            <li class="list-inline-item me-3  border p-2">
                                <a href="{{route('litecoin')}}" class="text-black text-decoration-none">
                                    <h5 class="mb-1">Litecoin ( <i class="fa-solid fa-litecoin-sign"></i> )</h5>
                                </a>
                                <p class="mb-0 font-13">Miktar: <span class="text-warning">{{\Illuminate\Support\Facades\Auth::user()->litecoinAddress()->first()->balance}}</span></p>
                            </li>


                            <li class="list-inline-item me-3  border p-2">
                                <a href="{{route('dogecoin')}}" class="text-black text-decoration-none">
                                    <h5 class="mb-1">Dogecoin ( <i class="fa-solid fa-dog"></i> )</h5>
                                </a>
                                <p class="mb-0 font-13">Miktar: <span class="text-warning">{{\Illuminate\Support\Facades\Auth::user()->dogecoinAddress()->first()->balance}}</span></p>
                            </li>

                        </ul>
                    </div>

                </div>

            </div>


            <div class="card mt-3">
                <div class="card-header">Bitcoin Cüzdan Detayları</div>
                <div class="card-body">
                    <code>
                    {{json_encode(bitcoind()->client('bitcoin')->getwalletinfo(),JSON_PRETTY_PRINT)}}
                </code>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header">Litecoin Cüzdan Detayları</div>
                <div class="card-body">
                    <code>
                    {{json_encode(bitcoind()->client('litecoin')->getwalletinfo(),JSON_PRETTY_PRINT)}}
                </code>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header">Dogecoin Cüzdan Detayları</div>
                <div class="card-body">
                    <code>
                    {{json_encode(bitcoind()->client('dogecoin')->getwalletinfo(),JSON_PRETTY_PRINT)}}
                </code>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
