<div>
    <x-breadcrumb title="Stock Entry"/>
    <div class="container">
        <div class="row">
            <x-card title="Stock Entry">
            <form wire:submit.prevent="addstock">
                <div class="card p-5">
                    <div class="card-body">
                        <div class="input-group input-group-outline mb-3">
                            <input type=date class="form-control" wire:model="date">
                            @error("date")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <select class="form-control" wire:model="vendorid">
                                <option value="">Select Vendor</option>
                                @foreach($vendors as $vendor)
                                <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                                @endforeach
                            </select>
                            @error("vendorid")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <input type=text class="form-control" wire:model="vno" placeholder="Voucher #">
                            @error("vno")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="card mt-3 shadow-lg">
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Amount</th>
                                        <th><i class="bi bi-cart"></i>{{$total}}</th>
                                    </thead>
                                    <tbody>
                                        @foreach($orderdata as $index=>$data)
                                        <tr>
                                            <td>
                                                <select class="form-control" wire:model="orderdata.{{$index}}.productid">
                                                    <option value="">Select Prdouct</option>
                                                    @foreach($products as $product)
                                                    <option value="{{$product->id}}">{{$product->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error("orderdata.*.productid")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type=number class="form-control" min=1 wire:model.lazy="orderdata.{{$index}}.qty" >
                                            </td>
                                            <td>
                                                <input type=text class="form-control" min=1 wire:model.lazy="orderdata.{{$index}}.amount" >
                                            </td>
                                            <td valign="middle">
                                                <i class="bi bi-trash " wire:click="removeitem('{{$index}}')"></i>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <button class="btn btn-dark my-3" wire:click.prevent="additem">
                                <i class="bi bi-plus"></i>Add Item</button>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-dark my-3 "><i class="bi bi-plus"></i>Add Stock</button>
                </div>
            </form>
            </x-card>
        </div>
    </div>
</div>