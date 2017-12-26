
<!DOCTYPE html>
<link class="cssdeck" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.1/css/bootstrap-responsive.min.css" class="cssdeck">
	<script class="cssdeck" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script class="cssdeck" src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.1/js/bootstrap.min.js"></script>
<html lang="en">
<title>Vehicle Dashboard</title>
<head>
	<h3 style="text-align: center;">Vehicle Dashboard</h3>
</head>
<style type="text/css">
   tr:hover {
          background-color: #5bc0de;
        }
 #myInput {
  width: 20%;
  font-size: 16px;
  padding: 9px 17px 8px 15px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}
</style>
<script type="text/javascript">
  function Search() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
       }
    }       
  }
}
</script>
<body>
<div id="vehicledashboard">
    <div style="padding-left: 20px;">
    	<b style="font-size:20px;">Search:</b>
    	<input type="text" id="myInput" onkeyup="Search()" placeholder="Search for Vehicle No" title="Type in a Vehicle No"> 
    </div>
	<table class="table table-bordered" id="myTable">
    <thead>
        <tr class="btn-primary" style="font-weight: bold; height:30px;">
                        <th align="left" style="padding-left: 4px; width: 3%">Sr No</th>
                        <th align="left" style="padding-left: 4px; width: 10%">Vehicle No</th>
                        <th align="left" style="padding-left: 4px; width: 10%">Document Name</th>
                        <th align="left" style="padding-left: 4px; width: 5%">Images</th>
    </thead>   
   @foreach($query as $val)                 
    <tbody>
       <tr>
          <td align="left" style="padding-left: 4px"  width="3%"><?php echo $val->id;?></td>
          <td align="left" style="padding-left: 4px"  width="10%"><?php echo $val->vehicle_no;?></td>
          <td align="left" style="padding-left: 4px"  width="10%"><?php echo $val->document_name;?></td>
          <td align="left" style="padding-left: 4px"  width="5%"><a class="btn btn-primary" href="<?php echo $val->doc_path;?>">View</a></td>
       </tr>
     @endforeach
     </tbody> 
    </table>   
</div>
</body>
</html>