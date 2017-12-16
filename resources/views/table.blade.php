<link rel="Stylesheet" href=" " "text="" javascript""="" src=""https://code.jquery.com/jquery-1.12.3.js"">
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.3.js"></script> 
<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script class="cssdeck" src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.1/css/bootstrap-responsive.min.css" class="cssdeck">

<script type="text/javascript">
$(document).ready(function() {  
    $('#MyTable').DataTable( {  
        initComplete: function () {  
            this.api().columns().every( function () {  
                var column = this;  
                var select = $('<select><option value=""></option></select>')  
                    .appendTo( $(column.footer()).empty() )  
                    .on('change', function () {  
                        var val = $.fn.dataTable.util.escapeRegex(  
                            $(this).val()  
                        );  
                //to select and search from grid  
                        column  
                            .search( val ? '^'+val+'$' : '', true, false )  
                            .draw();  
                    } );  
   
                column.data().unique().sort().each( function ( d, j ) {  
                    select.append( '<option value="'+d+'">'+d+'</option>' )  
                } );  
            } );  
        }  
    } );  
} );  
</script>

<table id="MyTable" class="display table table-bordered" cellspacing="0" width="100%">  
        <thead>  
            <tr>  
                <th>Sr No</th>  
                <th>Vehicle No</th>  
                <th>Document Name</th>  
                <th>Images</th>  
            </tr>  
        </thead> 
        @foreach($query as $val) 
        <tbody>  
            <tr>  
                <td><?php echo $val->id;?></td>  
                <td><?php echo $val->vehicle_no;?></td>  
                <td><?php echo $val->document_name;?></td>  
                <td><a class="btn btn-primary" href="<?php echo $val->doc_path;?>">View</a></td>  
            </tr>  
                       
        </tbody>  
        @endforeach 
    </table>  