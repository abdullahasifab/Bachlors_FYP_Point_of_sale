<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bill</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="{{ asset('js/app.js') }}" ></script>
        <style>
        body {
        background: white;
        }
        td {border: none !important;border-right: 1px solid black !important;line-height: 10px;}
        .daba {
        position: absolute;
        left: 70%;
        width: 110px;
        border: 2px solid rgba(0,0,0,0.5);
        padding: 10px;
        font-weight: bold;
        }
        table {
        border: 1px solid black !important;
        }
        th {
        border: 1px solid black !important;
        }
        .line {
        border: 1px solid black !important;
        }
        .addresslogo {
        position: absolute;
        left: 10px;
        width: 110px;
        border: 2px solid rgba(0,0,0,0.5);
        padding: 10px;
        font-weight: bold;
        }
        @media print {
        @page { size: auto;  margin: 1px 40px 5px 12px; }
        html, body {
        height: auto;
        font-size: 12px; /* changing to 10pt has no impact */
        }
        }
        </style>
    </head>
    <body onload="javascript:window.print()">
        <div class="container">
            <div class="row mt-5 mb-0">
                {{-- <div class="addresslogo">
                    Logo
                </div> --}}
                {{-- <div class="daba">
                    @if($credit)
                    Credit Invoice
                    @else
                    Debit Invoice
                    @endif
                    <img  src="/barcode/barcode.php?codetype=Code39&size=40&text=8877"{{$sale->id}}>
                </div> --}}
                <div class="col-md-3 mx-auto">
                    <h1>POINT OF SALE</h1>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between my-3">
                        <span>Bill-No:-{{$sale->id}}</span>
                        <span>Dated:- {{$sale->date}}</span>
                    </div>
                    <div class="d-flex justify-content-between my-3">
                        <span>{{$sale->client->name}}</span>
                    </div>
                    <hr>
                    <table class="table ">
                        <thead>
                            <th>Sno</th>
                            <th>Product Name</th>
                            <th>Product qty</th>
                            <th>Product Price</th>
                            <th>Total Amount</th>
                        </thead>
                        <tbody>
                            @foreach($sale->products as $index=>$data)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$data->name}}</td>
                                <td>{{$data->pivot->quantity}}</td>
                                <td>{{$data->pivot->amount/$data->pivot->quantity}}</td>
                                <td>{{$data->pivot->amount}}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td class="line" colspan=4 align="right"><h5>Total</h5></td>
                                <td class="line" colspan=4><h5>{{$total}}</h5></td>
                            </tr>
                            <tr>
                                <td class="line" colspan=4 align="right"><h5>Cash</h5></td>
                                <td class="line" colspan=4><h5>{{$cash}}</h5></td>
                            </tr>
                            @if($credit)
                            <tr>
                                <td class="line" colspan=4 align="right"><h5>Credit</h5></td>
                                <td class="line" colspan=4><h5>{{$credit}}</h5></td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div></div>
        </body>
    </html>
    <script>
    ( function() {
    var beforePrint = function() {
    console.log('Functionality to run before printing.');
    };
    var afterPrint = function() {
    setTimeout(function(){ window.location ="/sale"; }, 1000);
    };
    if (window.matchMedia) {
    var mediaQueryList = window.matchMedia('print');
    mediaQueryList.addListener(function(mql) {
    if (mql.matches) {
    beforePrint();
    } else {
    afterPrint();
    }
    });
    }
    window.onbeforeprint = beforePrint;
    window.onafterprint = afterPrint;
    }());
    </script>