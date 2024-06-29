<div wire:ignore.self class="modal fade" id="entry-modal">
    <div class="modal-dialog">
        <div class="modal-content">
             @if($stockdata)
            <div class="modal-header">
               
           
               <span>Voucher #:-{{$stockdata->vno}}</span>
               <span>Date:- {{$stockdata->date}}</span>
        
          
        </div>
            <div class="modal-body">
               
               <div > Ms:-<span style="border-bottom:1px solid black">{{$stockdata->client->name}}</span></div>
              
                
                <table class="table table-bordered mt-2">
                    <thead>
                        <th>Sno</th>
                        <th>Product Name</th>
                        <th>Product Quantity</th>
                        <th>Product Amount</th>
                    </thead>
                    <tbody>
                        <tr><td>
                      
                         @foreach($stockdata->products as $index=>$product)
                            
                            
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->pivot->quantity }}</td>
                                <td>{{ $product->pivot->amount }}</td>
                                
                                
                            </tr>
                            @endforeach
                           
                        
</td></tr>

                    </tbody>
                        




                </table>
              
            </div>
            <div class="modal-footer">
                <button class="btn btn-dark" data-bs-dismiss="modal">Close</button>
            </div>
             @endif
        </div>
    </div>
</div>