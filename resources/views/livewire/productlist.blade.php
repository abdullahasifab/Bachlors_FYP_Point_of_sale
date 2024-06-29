<div>
    <x-breadcrumb title="Products"/>
    <div class="container">
        <div class="row">
            <x-card title="Products">
            <?php $key=$products->count().now()?>
            <table wire:ignore.self class="table table-striped" id="datalist" wire:key="{{$key}}">
                <thead>
                    <th>Sno</th>
                    <th>Product Name</th>
                    <th>Categories</th>
                    <th>Product Purchase Price</th>
                    <th>Product Sale Price</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td class="text-capitalize">
                            <div contenteditable id="{{$product->id}}-name" class="edit">
                                {{$product->name}}
                            </div>
                        </td>
                        <td>
                            @foreach($product->categories as $index=>$category)
                            <span type="btn"class="badge  {{$classes[$index]}}" wire:click="removecategory({{$product->id}},{{$category->id}})">{{$category->name}}</span>
                            @endforeach
                        </td>
                        <td>
                            <div contenteditable id="{{$product->id}}-purchase" class="edit">
                                {{$product->purchase}}
                            </div>
                        </td>
                        <td>
                            <div contenteditable id="{{$product->id}}-sale" class="edit">
                                {{$product->sale}}
                            </div>
                        </td>
                        <td>
                            <i class="bi bi-trash text-danger" onclick="return confirm('are you sure?')? @this.call('delete',{{$product->id}}):false"></i>
                            <i class="bi bi-pencil text-primary" wire:click="edit('{{$product->id}}')"></i>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </x-card>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="entry-modal">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header ">
                    {{ $flag? 'Update':'Add' }}
                    Product
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="addproduct">
                        <div class="input-group input-group-outline mb-3">
                            <select wire:model.defer="cats" class="form-control" multiple>
                                @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <input wire:model.defer="name" type=text class="form-control" placeholder="Product Name">
                            @error("name")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <input wire:model.defer="barcode" type=text class="form-control" placeholder="Product barcode">
                            @error("barcode")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <input wire:model.defer="purchase" type=text class="form-control" placeholder="Product Purchase Price">
                            @error("purchase")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <input wire:model.defer="sale" type=text class="form-control" placeholder="Product Sale Price">
                            @error("sale")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-dark">
                            {!! $flag? '<i class="bi bi-file-earmark-medical-fill"></i>&nbsp; Update':'<i class="bi bi-plus"></i>&nbsp;Add' !!}
                            Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include("sections.maketable")
</div>