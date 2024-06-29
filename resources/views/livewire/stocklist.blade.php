<div>
    <x-breadcrumb title="Stock"/>
    <div class="container">
        <div class="row">
            <x-card title="Stock">
            <?php $key=$stocks->count().now()?>
            <table  class="table table-striped" id="datalist" wire:key="{{$key}}">
                <thead>
                    <th>Sno</th>
                    <th>Date</th>
                    <th>Vourcher #</th>
                    <th>Vendor</th>
                    <th>Detail</th>
                    <th>Amount</th>
                    <th>Voucher</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach($stocks as $stock)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$stock->date}}</td>
                        <td>{{$stock->vno}}</td>
                        <td>{{$stock->client->name}}</td>
                        <td>{!! $stock->detail!!}</td>
                        <td>{{$stock->amount}}</td>
                        <td><i class="bi bi-file-earmark-text" wire:click="showdetail('{{$stock->id}}')"></i></td>
                        <td>
                            <i class="bi bi-trash text-danger" onclick="return confirm('are you sure?')? @this.call('delete',{{$stock->id}}):false"></i>
                            <i class="bi bi-pencil text-primary" wire:click="edit('{{$stock->id}}')"></i>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </x-card>
        </div>
    </div>
    @include("sections.vendorvoucher")
    @include("sections.maketable")
</div>