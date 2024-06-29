<div>
    <x-breadcrumb title="Stock In Hand"/>
    <div class="container">
        <div class="row">
            <x-card title="Stock In Hand">
            <table class="table table-bordered">
                <thead>
                    <th>Sno</th>
                    <th>Product Name</th>
                    <th>Total Purchase</th>
                    <th>Total Sale</th>
                    <th>IN Hand</th>
                </thead>
                <tbody>
                    @foreach($items as $item)
                    <tr class="{{$item->inhand<10? 'bg-danger text-white':''}}">
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->product}}</td>
                        <td>{{$item->purchase}}</td>
                        <td>{{$item->sale}}</td>
                        <td>{{$item->inhand}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </x-card>
        </div>
    </div>
</div>