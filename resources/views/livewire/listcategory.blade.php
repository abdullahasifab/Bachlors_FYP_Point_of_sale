<div>
    <x-breadcrumb title="Category"/>
    <div class="container">
        @if (session()->has('smg'))
        <div class="alert alert-success mydiv">
            {{ session('smg') }}
        </div>
        @endif
        <div class="row">
            <x-card title="Category">
            <?php $key=$categories->count().now() ?>
            <table wire:ignore.self class="table table-striped" id="datalist" wire:key="{{$key}}">
                <thead >
                    <th>Sno</th>
                    <th>Category Name</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$category->name}}</td>
                        <td>
                            <i class="bi bi-trash text-danger" onclick="return confirm('are you sure?')? @this.call('delete',{{$category->id}}):false"></i>
                            <i class="bi bi-pencil text-primary" wire:click="edit('{{$category->id}}')"></i>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </x-card>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="entry-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    {{$selectedid? 'Edit':'+Add'}} Category
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="addcategory">
                        <div class="input-group input-group-outline mb-3">
                            <input type=text wire:model.defer="name" class="form-control" placeholder="Enter Category">
                            @error("name")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-dark">
                            {{$selectedid? 'Update':'+Add'}} Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include("sections.maketable")
</div>