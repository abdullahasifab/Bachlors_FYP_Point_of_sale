<div>
    <x-breadcrumb title="Profit & Loss Ledger"/>
    <style>
    td {
    border: none !important;
    height: 20px !important;
    }
    .line {
    border-bottom: 1px solid rgba(0,0,0,0.3) !important;
    }
    </style>
    <div class="container">
        <div class="row">
            <x-card title="Profit Ledger">
            <div class="row">
                <div class="col-md-12 mx-auto ">
                    <form wire:submit.prevent="search">
                        <div class="row my-1 justify-content-center">
                            <div class="col-md-3">
                                <div class="input-group input-group-outline">
                                    <input type="date" wire:model.defer="sdate" class="form-control" value="{{$sdate}}">
                                </div></div>
                                <div class="col-md-3">
                                    <div class="input-group input-group-outline">
                                        <input type="date" wire:model.defer="edate" class="form-control">
                                    </div></div>
                                    <div class="col-md-3">
                                        <button class="btn btn-primary"><i class="bi bi-search"></i></button>
                                    </div>
                                </div>
                            </form>
                            @if($totalsale)
                            <div class="row mt-3">
                                <div class="col-md-12  ">
                                    <h3 class="text-center">Profit & Loss Statement </h3>
                                    <h6 class="text-center">From {{date("d-m-Y",strtotime($sdate))}} To {{date("d-m-Y",strtotime($edate))}}</h6>
                                    <hr>
                                    <table class="table">
                                        <tr>
                                            <td><h5>Total Sale</h5></td>
                                            <td><h5>Rs.{{$totalsale}}/-</h5></td>
                                        </tr>
                                        <tr>
                                            <td><h5>Cost Goods Sold</h5></td>
                                            <td><h5>Rs.{{$cost}}/-</h5></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="line"></td>
                                        </tr>
                                        <tr>
                                            <td><h5>Gross Profit</h5></td>
                                            <td><h5>Rs.{{$grossprofit}}/-</h5></td>
                                        </tr>
                                        <tr>
                                            <td><h5>Total Expenses</h5></td>
                                            <td><h5>Rs.{{$totalexpense}}/-</h5></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="line"></td>
                                        </tr>
                                        <tr>
                                            <td class="line"><h5>Net Profit 💸</h5></td>
                                            <td class="line"><h5><b>Rs.{{$netprofit}}/-</b></h5></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    </x-card>
                </div>
            </div>
            <script>
            document.addEventListener('livewire:load', function () {
            fetch();
            function fetch() {
            $('#datalist').DataTable({
            "lengthMenu": [[50, 100, -1], [50, 100, "All"]],
            "dom": "<'row '<'col-md-12 mb-3'B>><'row'<'col-md-12 mb-2'fl>><'row '<'col-md-12 'rt>>ip",
            buttons: [
            { extend: 'print', footer: true, exportOptions: { columns: ':visible', stripHtml: false }},
            { extend: 'excel', footer: true, exportOptions: { columns: ':visible', stripHtml: false }},
            { extend: 'pdf', footer: true, exportOptions: { columns: ':visible', stripHtml: false }},
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
