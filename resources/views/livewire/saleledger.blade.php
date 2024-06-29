<div>
    <x-breadcrumb title="Sale Ledger"/>
    <div class="container">
        <div class="row">
            <x-card title="Sale Ledger">
            <div class="row">
                <div class="col-md-12 mx-auto ">
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
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <?php $key=count($sales).now()?>
                            <table wire:ignore.self class="table table-striped" id="datalist" wire:key="{{$key}}">
                                <thead>
                                    <th>Sno</th>
                                    <th>Date</th>
                                    <th>Bill #</th>
                                    <th>Customer</th>
                                    <th>Detail</th>
                                    <th>Cash</th>
                                    <th>Credit</th>
                                    <th>Print</th>
                                </thead>
                                <tbody>
                                    @foreach($sales as $sale)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$sale->date}}</td>
                                        <td>{{$sale->id}}</td>
                                        <td>{{$sale->client->name}}</td>
                                        <td>{!! $sale->detail !!}</td>
                                        <td>{{ $sale->payment ? $sale->payment->debit : '0' }}</td>
                                        <td>{{ $sale->payment ? ($sale->payment->credit - $sale->payment->debit) : '0' }}</td>
                                        <td>
                                            <a href="/print/{{$sale->id}}" target="_Blank">
                                                <i class="bi bi-printer"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>Total Sale</th>
                                    <th>{{$totalsale}}</th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>Credit Sale</th>
                                    <th>{{$totalcredit}}</th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>Cash in Hand</th>
                                    <th>{{$cashinhand}}</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    </x-card>
                </div>
            </div>
            <script>
            document.addEventListener('livewire:load', function () {
            fetch();
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