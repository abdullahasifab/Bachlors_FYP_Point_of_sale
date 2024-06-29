<div>
    <x-breadcrumb title="Payments"/>
    <div class="container">
        <div class="row">
            <x-card title="Payments">
            <?php $key=$payments->count().now()?>
            <table wire:ignore.self class="table table-striped" id="datalist" wire:key="{{$key}}">
                <thead>
                    <th>Sno</th>
                    <th>Date</th>
                    <th>Client Name</th>
                    <th>Description</th>
                    <th>Debit</th>
                    <th>Credit</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach($payments as $payment)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$payment->date}}</td>
                        <td>{{$payment->client->name}}</td>
                        <td>{{$payment->description}}</td>
                        <td>{{$payment->debit}}</td>
                        <td>{{$payment->credit}}</td>
                        <td>
                            <i class="bi bi-trash text-danger" onclick="return confirm('are you sure?')? @this.call('delete',{{$payment->id}}):false"></i>
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
                <div class="modal-header">
                    {{ $flag? 'Update':'Add' }}
                    payment
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="addpayment">
                        <div class="mb-3">
                            <input wire:model.defer="date" type=date class="form-control">
                        </div>
                        <div class="mb-3">
                            <select wire:model.lazy="client_id" class="form-control" >
                                <option value="">Select Vendor</option>
                                @foreach($clients as $client)
                                <option value="{{$client->id}}">{{$client->name}}({{$client->clienttype}})</option>
                                @endforeach
                            </select>
                            @error("client_id")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input wire:model.defer="balance" type=text class="form-control" placeholder="Balance" readonly>
                        </div>
                        <div class="mb-3">
                            <select wire:model.defer="ttype" class="form-control">
                                <option value="1">Payment</option>
                                <option value="2">Reciept</option>
                            </select>
                            @error("ttype")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input wire:model.defer="amount" type=text class="form-control" placeholder="Amount">
                            @error("amount")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <textarea wire:model.defer="description" class="form-control" placeholder="Details"></textarea required>
                            @error("description")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-dark">
                            {!! $flag? '<i class="bi bi-file-earmark-medical-fill"></i>&nbsp;Update':'<i class="bi bi-plus"></i>&nbsp;Add' !!}
                            payment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include("sections.maketable")
</div>