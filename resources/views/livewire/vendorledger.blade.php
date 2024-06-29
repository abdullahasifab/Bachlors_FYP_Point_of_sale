<div>
    <x-breadcrumb title="Vendor Ledger"/>
    <div class="container">
        <div class="row">
            <x-card title="Vendor Ledger">
            <div class="row">
                <div class="col-md-12 mx-auto ">
                    <form wire:submit.prevent="search">
                        <div class="row my-2">
                            <div class="col-md-3 ">
                                <div class="input-group input-group-outline">
                                    <select class="form-control" wire:model.defer="client_id">
                                        <option value="">Select Vendor</option>
                                        @foreach($clients as $client)
                                        <option value="{{$client->id}}">{{$client->name}}</option>
                                        @endforeach
                                    </select>
                                </div></div>
                                <div class="col-md-3 ">
                                    <div class="input-group input-group-outline">
                                        <input type=date wire:model.defer="sdate" class="form-control" value="{{$sdate}}">
                                    </div>
                                </div>
                                <div class="col-md-3 ">
                                    <div class="input-group input-group-outline">
                                        <input type=date wire:model.defer="edate" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3 ">
                                    <div class="input-group input-group-outline">
                                        <button class="btn btn-primary"><i class="bi bi-search"></i></button>
                                    </div></div>
                                </div>
                            </form>
                            <div class="row">
                                @if($client_id)
                                <?php $key=now()?>
                                <table wire:ignore.self class="table table-striped" id="datalist" wire:key="{{$key}}">
                                    <thead>
                                        <th>Sno</th>
                                        <th>Date</th>
                                        <th>Detail</th>
                                        <th>Debit</th>
                                        <th>Credit</th>
                                        <th>Balance</th>
                                    </thead>
                                    <tbody>
                                        @forelse($payments as $payment)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$payment->date}}</td>
                                            <td>{!!$payment->detail!!}</td>
                                            <td>{{$payment->debit}}</td>
                                            <td>{{$payment->credit}}</td>
                                            <td>{{$payment->balance}}</td>
                                        </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    </tfoot>
                                </table>
                                @endif
                            </div>
                        </div>
                    </div>
                    </x-card>
                </div>
            </div>
            @include("sections.vendorvoucher")
            <script>
            document.addEventListener('livewire:load', function () {
            function fetch()
            {
            $('#datalist').DataTable({
            "lengthMenu": [[50,100, -1], [50,100,"All"]],
            "dom": "<'row '<'col-md-12 mb-3'B>><'row'<'col-md-12 mb-2'fl>><'row '<'col-md-12 'rt>>ip",
            buttons: [
            { extend: 'print', footer: true,exportOptions: {
            columns: ':visible',
            stripHtml: false
            }},
            { extend: 'excel', footer: true ,exportOptions: {
            columns: ':visible',
            stripHtml: false
            }},
            { extend: 'pdf', footer: true,exportOptions: {
            columns: ':visible',
            stripHtml: false
            } },
            { extend: 'colvis', footer: true },
            ],
            footerCallback: function ( row, data, start, end, display ) {
            var api = this.api(),data;
            function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
            return typeof i === 'string' ?
            i.replace(/[\$,]/g, '')*1 :
            typeof i === 'number' ?
            i : 0;
            };
            if(end>0)
            var b=api.cell(end-1, 5).data();
            else
            var b=0;
            var total=[];
            for(var i=3;i<=4;i++)
            {
            total.push( api
            .column(i, { page: 'current'} )
            .data()
            .reduce( function (a, b) {
            return intVal(a) + intVal(b);
            }, 0));
            }
            // var total2 = api
            // .column(4, { page: 'current'} )
            // .data()
            // .reduce( function (a, b) {
            //     return intVal(a) + intVal(b);
            //         }, 0);
            $( api.column(3).footer() ).html(numberWithCommas(total[0]));
            $( api.column(4).footer() ).html(numberWithCommas(total[1]));
            $( api.column(5).footer() ).html(numberWithCommas(b));
            },
            });
            }
            window.addEventListener('maketable', event => {
            fetch();
            setTimeout(function(){
            $(".mydiv").removeClass("alert-success").html("");
            }, 2000);
            });
            window.addEventListener('openmodal', event => {
            $("#entry-modal").modal("show");
            });
            window.addEventListener('closemodal', event => {
            $("#entry-modal").modal("hide");
            });
            });
            </script>
        </div>