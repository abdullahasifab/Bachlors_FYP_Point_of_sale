<div>
    <x-breadcrumb title="Sale"/>
    <div class="container">
        <div class="row">
            <x-card title="Daily Sale">
            <div class="row  mx-auto">
                <div class="col-md-4">
                    <h3>Product</h3>
                    <hr>
                    <form wire:submit.prevent="add">
                        <div class="input-group input-group-outline mb-3">
                            <select class="form-control" wire:model="clientid">
                                @foreach($clients as $client)
                                <option value="{{$client->id}}">{{$client->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <input type=text  class="form-control" wire:model.lazy="barcode" placeholder="bar code">
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <input type=text class="form-control" wire:model.lazy="productname" list="prod">
                            <datalist id="prod">
                            @foreach($products as $product)
                            <option >{{$product->name}}</option>
                            @endforeach
                        </select>
                        </datalist>
                        @error("productid")
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="input-group input-group-outline mb-3">
                        <input type=number min=1 class="form-control" wire:model="qty">
                    </div>
                    <div class="input-group input-group-outline mb-3">
                        <button class="btn btn-dark">Add To Bill</button>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <i class="bi bi-cart"></i>&nbsp;{{$total}}
                    </div>
                    <hr>
                    @if($clientid!=1)
                    <div class="input-group input-group-outline mb-3">
                        <input type=text class="form-control" placeholder="Cash Amount" wire:model="cash">
                    </div>
                    @endif
                    <button class="btn btn-dark" wire:click.prevent="deal">Print</button>
                </form>
            </div>
            <div class="col-md-6  ">
                <h3>Bill</h3>
                <hr>
                <table class="table">
                    <thead>
                        <th>Sno</th>
                        <th>Product Name</th>
                        <th>Product qty</th>
                        <th>Product Price</th>
                        <th>Total Amount</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach($orderdata as $index=>$data)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$orderdata[$index]['productname']}}</td>
                            <td> <div contenteditable class="edit" id='{{$index}}'>{{$orderdata[$index]['qty']}}</div></td>
                            <td>{{$orderdata[$index]['price']}}</td>
                            <td>{{$orderdata[$index]['amount']}}</td>
                            <td>
                                <i class="bi bi-trash text-danger" onclick="return confirm('are you sure?')? @this.call('delete',{{$index}}):false"></i>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        </x-card>
    </div>
</div>
<script>
document.addEventListener('livewire:load', function () {
$(document).on("blur",".edit",function() {
var id=this.id;
var value=$(this).text();
@this.call("changeqty",id,value);
});
});
</script>
</div>