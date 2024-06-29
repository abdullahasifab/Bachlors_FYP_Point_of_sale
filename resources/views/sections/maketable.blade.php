<script>

        document.addEventListener('livewire:load', function () {


 
 fetch();

    function fetch()
    {
        $('#datalist').DataTable({
    "lengthMenu": [[5,10,20,50,100, -1], [5,10,20,50,100,"All"]],            
    "dom": "<'row '<'col-md-12 mb-3'B>><'row'<'col-md-12 mb-2'fl>><'row '<'col-md-12 'rt>>ip",
    buttons: [
        
        'excel',
        'pdf',
        'print',
        
       

        {
    text: 'Add {{$title}}',
     className: "btn-custom",
    action: function (  ) {
@if($title=="Stock")
window.location.href="/stock-entry";
@else
    $('#entry-modal').modal('toggle');
    @endif
    }
    },
    
 ],
            });
    }

       window.addEventListener('maketable', event => {

                fetch();
                       setTimeout(function(){
    $(".mydiv").removeClass("alert-success").html("");
}, 2000);
        

});

window.addEventListener('openmodal', event => {

                $("#entry-modal").modal("show");
        

});

             window.addEventListener('closemodal', event => {

                $("#entry-modal").modal("hide");

                

});

      


        });

    </script>