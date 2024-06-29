<div>
    <x-breadcrumb title="User Management"/>
    <div class="container">
        <div class="row">
            <x-card title="User Management">
            <div class="row ">
                <div class="card ">
                    <div class="card-body">
                        <form wire:submit.prevent="adduser">
                            <div class="row justify-content-center">
                                <div class="col-md-3">
                                    <div class="input-group input-group-outline">
                                        <input type=text wire:model="username" class="form-control" placeholder="Username">
                                    </div></div>
                                    <div class="col-md-3">
                                        <div class="input-group input-group-outline">
                                            <select wire:model="role" class="form-control" >
                                                <option value="3">Saleman</option>
                                                <option value="2">operator</option>
                                                <option value="1">Supervisor</option>
                                            </select>
                                        </div></div>
                                        <div class="col-md-3">
                                            <div class="input-group input-group-outline">
                                                <input type=text id="password" wire:model="password" class="form-control" placeholder="Password">
                                            </div></div>
                                            <div class="col-md-2">
                                                <button class="btn btn-primary btn-lg">
                                                {{$flag? "Update ":"Add "}}
                                                User</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row my-3 ">
                            <div class="card ">
                                <div class="card-body ">
                                    <table class="table">
                                        <thead>
                                            <th>Sno</th>
                                            <th>User Name</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            @foreach($users as $user)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$user->username}}</td>
                                                <td>{{$user->rolename}}</td>
                                                <td>
                                                    @if($user->username!="admin")
                                                    <i class="bi bi-trash text-danger" onclick="return confirm('are you sure?')? @this.call('delete',{{$user->id}}):false"></i>
                                                    @endif
                                                    <i class="bi bi-pencil text-primary" wire:click="edit('{{$user->id}}')"></i>
                                                </td>
                                            </tr>
                                            @endforeach
                                            <tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                </x-card>
                            </div>
                        </div>
                        <script>
                        document.addEventListener('livewire:load', function () {
                        $("#password").focus(function(){
                        $("#password").val("");
                        })
                        });
                        </script>
                    </div>