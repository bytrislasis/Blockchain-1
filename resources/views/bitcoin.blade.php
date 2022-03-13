@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-8">



                {{--Cüzdan Kilit Açma İşlemi--}}
                <div class="card">
                    <div class="card-header">Cüzdan kilidini açın</div>
                    <div class="card-body">
                            <form action="{{route('bitcoinUnlock')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col"><input type="password" name="password" class="form-control" placeholder="Cüzdan şifrenizi Girin"></div>
                                    <div class="col"><input type="text" name="second" class="form-control" placeholder="Kaç Saniye Açık Kalacak"></div>
                                    <div class="col  d-flex justify-content-end"><button  type="submit" class="btn btn-danger">Kilidi Aç</button></div>
                                </div>
                            </form>
                    </div>
                </div>




                {{--Cüzdan Yatırma ve Para Çekme İşlemleri--}}
                <div class="card mt-3">
                    <div class="card-header"><i class="fa-brands fa-btc"></i> {{strtoupper(\Request()->route()->getName())}} Cüzdanı</div>
                    <div class="card-body">
                        <div class="card-text">

                            Bitcoin Adresi :

                            @if($kontrol == null)
                                <span class="fw-bold"><a href="{{route('bitcoinAdressOlustur')}}" class="btn btn-primary">Adres Oluştur</a></span>
                            @else
                                <span class="fw-bold">{{$kontrol->address}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        <form action="{{route('bitcoinCek')}}" method="POST">
                            @csrf
                                <div class="row">
                                    <div class="col"><input type="text" name="quantity" class="form-control" placeholder="miktar"></div>
                                    <div class="col"><input type="text" name="address" class="form-control" placeholder="adres"></div>
                                    <div class="col d-flex justify-content-end"><button  type="submit" class="btn btn-success">Çek</button></div>
                                </div>
                        </form>
                    </div>
                </div>






                {{--Hesap hareketleri--}}
                <div class="card mt-5">
                    <div class="card-header">Geçmiş İşlemler</div>
                    <div class="card-body">


                        <table id="example" class="display border" style="width:100%">

                            <thead>
                            <tr>
                                <th>İşlem</th>
                                <th>Adres</th>
                                <th>TXId</th>
                                <th>Miktar</th>
                                <th>Tarih</th>

                            </tr>
                            </thead>

                            <tbody>

                            @foreach($history as $item)
                                <tr>
                                    <td>

                                        @if($item->category == "receive")
                                            <span class="text-success fw-bold">Deposit</span>
                                            @else
                                            <span class="text-danger fw-bold">Withdraw</span>
                                        @endif

                                    </td>
                                    <td>{{$item->address}}</td>
                                    <td title="{{$item->txid}}">{{substr($item->txid,0,15)}}...</td>
                                    <td>{{$item->amount}}</td>
                                    <td>{{$item->created_at}}</td>
                                </tr>
                            @endforeach


                            </tbody>

                        </table>



                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
@endsection
