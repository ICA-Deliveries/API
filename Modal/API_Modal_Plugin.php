<?php 
/*
Plugin Name: Modal_API
Description: test
Version: 1.0
Author: ICA Deliveries

ICA Modal API Plugin

*/

ob_start();

add_shortcode('modal_api', 'api');

function api() {

?>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script type="text/javascript"> 
//Script call to API_call.php to process API Request without leaving modal
 $("document").ready(function(){ 
 $(".data-form").submit(function(){  
var data = { 
 "action": "test" 
  };
  data = $(this).serialize() + "&" + $.param(data); 
 $.ajax({ 
  type: "POST", 
  dataType: "json", 
  url:"/API_call.php", //Relative or absolute path to response.php file 
  data: data, 
 success: function(data) { 
 $(".the-price").html( 
 data["json"] 
  );
$(".the-return").html( 
 ""
);
 $('#submit').hide();  
} 
}); 
 return false; 
  }); 
 }); 
</script> 

<h2>Modal Example</h2>
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-backdrop="static" data-target="#myModal">Open Modal</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">ICA Deliveries</h4>
        </div>
        <div class="modal-body">
		<div class="the-return"> 
		</div>	
		<!-- Form that collects customer data for API Request -->
		<form method="POST" class="data-form"><br>
		<p>Please Input Necessary Information For ICA Deliveries Job Submission</p>
		<label>Name: </label><br>
		<input type="text" name="cust" id="cust" value="" required></input><br><br>
		<label>Delivery Recipient's Email: </label><br>
		<input type="text" name="cust_email" id="cust_email" value="" required></input><br>
		<label>Phone: </label><br>
		<input type="text" name="cust_phone" id="cust_phone" value="" required></input><br>
		<input type="hidden" class="start" name="origin" id="start" value="13 Tuhans Road, Mt Waverly"></input><br>
		<label>Destination Address: </label><br>
		<input type="text" class="end" name="destination" id="end" value="" required></input><br><br>
		<label>Desired Delivery Date: </label><br>
		<label style="color:green;">Correct Format: dd-mm-yyyy</label><br>
		<input type="text" name="date" id="date" required></input><br><br>
		<!-- Please Input Your Provided ID and Authentication Codes Into The Empty The Empty Values -->
		<input type="hidden" name="id" id="id" value="" readonly></input>
		<input type="hidden" name="auth" id="auth" value="" readonly></input> 
		<div><button type="submit" value="submit" id="submit" name="submit">Submit</button></div>
		</div>
	<div class="the-price"> 
		</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
</form>
<?php 
}
?>

