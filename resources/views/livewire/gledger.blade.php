<div>
    <x-breadcrumb title="General Ledger"/>
    <div class="container">
        <div class="row">
            <x-card title="General Ledger">
            <div class="row">
                <form wire:submit.prevent="search">
                    <div class="row my-1 justify-content-center">
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
                        <button class="btn btn-primary"><i class="bi bi-search"></i></button></form>
                    </div>
                    <div class="row mt-3">
                        <?php $key=count($payments).now()?>
                        <table wire:ignore.self class="table table-striped" id="datalist" wire:key="{{$key}}">
                            <thead>
                                <th>Sno</th>
                                <th>Date</th>
                                <th>description</th>
                                <th>Recieved</th>
                                <th>Payment</th>
                                <th>Credit</th>
                                <th>Balance</th>
                            </thead>
                            <tbody>
                                @foreach($payments as $payment)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$payment->date}}</td>
                                    <td>{{$payment->description}}</td>
                                    <td>{{$payment->recieved}}</td>
                                    <td>{{$payment->payment}}</td>
                                    <td>{{$payment->credit}}</td>
                                    <td>{{$payment->balance}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            </tfoot>
                        </table>
                    </div>
                    </x-card>
                </div>
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
                var total1 = api
                .column(3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                return Number(a)+Number(b);
                }, 0);
                var total2 = api
                .column(4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                return Number(a)+Number(b);
                }, 0);
                var total3 = api
                .column(5, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                return Number(a)+Number(b);
                }, 0);
                var total4 = api
                .column(6, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                return Number(a)+Number(b);
                }, 0);
                $( api.column(3).footer() ).html(total1);
                $( api.column(4).footer() ).html(total2);
                $( api.column(5).footer() ).html(total3);
                $( api.column(6).footer() ).html(total4);
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