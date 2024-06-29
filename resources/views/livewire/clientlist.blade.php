<div>

    <x-breadcrumb title="Client"/>
    <div class="container">
        <x-card title="Client">
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">Select Client Type</div>
                    <div class="col-md-8">
                        <div class="input-group input-group-outline mb-3">
                            <select wire:model="selectedtype" class="form-control">
                                <option value="all">All</option>
                                <option value="vendors">Vendors</option>
                                <option value="customers">Customers</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <?php $key=$clients->count().now() ?>
            <table wire:ignore.self class="table table-striped" id="datalist" wire:key="{{$key}}">
                <thead >
                    <th>Sno</th>
                    <th>Code</th>
                    <th>Customer/Vendor</th>
                    <th> Name</th>
                    <th>Contact</th>
                    <th> Adress</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach($clients as $client)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$client->id}}</td>
                        <td>{{$client->clienttype}}</td>
                        <td>{{$client->name}}</td>
                        <td>{{$client->contact}}</td>
                        <td>{{$client->address}}</td>
                        <td>
                            <i class="bi bi-trash text-danger" onclick="return confirm('are you sure?')? @this.call('delete',{{$client->id}}):false"></i>
                            <i class="bi bi-pencil text-primary" wire:click="edit('{{$client->id}}')"></i>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        </x-card>
    </div>
    @include("sections.maketable")
    <div wire:ignore.self class="modal fade" id="entry-modal">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header ">
                    {{ $flag? 'Update':'Add' }}
                    Client
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="addvendor">
                        <div class="input-group input-group-outline mb-3">
                            <select wire:model="ctype" class="form-control">
                                <option value="">Select Client Type</option>
                                <option value="0">Customer</option>
                                <option value="1">Vendor</option>
                            </select>
                            @error("ctype")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <input wire:model.defer="name" type=text class="form-control" placeholder=" Name">
                            @error("name")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <input wire:model.defer="contact" type=text class="form-control" placeholder="Contact #">
                            @error("contact")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <input wire:model.defer="address" type=text class="form-control" placeholder=" Address">
                            @error("address")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-dark">
                            {!! $flag? '<i class="bi bi-file-earmark-medical-fill"></i>&nbsp;Update':'<i class="bi bi-plus"></i>&nbsp;Add' !!}
                            Client</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
