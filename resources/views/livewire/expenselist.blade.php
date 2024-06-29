<div>
    <x-breadcrumb title="Expense"/>
    <div class="container">
        <div class="row">
            <x-card title="Expense">
            <div class="row"><form wire:submit.prevent="search">
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
                    <button class="btn btn-dark"><i class="bi bi-search"></i></button></form>
                </div>
                <?php $key=$expenses->count().now()?>
                <table wire:ignore.self class="table table-striped" id="datalist" wire:key="{{$key}}" width="100%">
                    <thead>
                        <th>Sno</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Description</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach($expenses as $expense)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$expense->date}}</td>
                            <td>{{$expense->credit}}</td>
                            <td>{{$expense->description}}</td>
                            <td>
                                <i class="bi bi-trash text-danger" onclick="return confirm('are you sure?')? @this.call('delete',{{$expense->id}}):false"></i>
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
                        Add
                        Expense
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="addpayment">
                            <div class="mb-3">
                                <input wire:model.defer="date" type=date class="form-control">
                            </div>
                            <div class="mb-3">
                                <input wire:model.defer="amount" type=text class="form-control" placeholder="Amount">
                                @error("amount")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <textarea wire:model.defer="description" class="form-control" placeholder="Details"></textarea >
                                @error("description")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-dark">
                                <i class="bi bi-plus"></i>&nbsp;Add
                                Expnese</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include("sections.maketable")
    </div>
