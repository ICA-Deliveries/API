<?php
/** Plug this Modal Form into your checkout. 
It will appear as a button that will open a modal window containing these forms **/

ob_start();

?>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script type="text/javascript">
//JQUERY AJAX Calls to process DistanceCheck.php request without leaving modal 
 $("document").ready(function(){ 
 $(".check_distance").submit(function(){ 
var data = { 
 "action": "test" 
  };
  data = $(this).serialize() + "&" + $.param(data); 
 $.ajax({ 
  type: "POST", 
  dataType: "json", 
  url: "/Check_Distance.php", //Relative or absolute path to response.php file 
  data: data, 
 success: function(data) { 
 $(".the-return").html( 
 data["json"] 
  );
$('#start').val(data["origin"]);
$('#end').val(data["destination"]);  
  } 
}); 
 return false; 
  }); 
 }); 
</script> 
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
          	<p>Check If Delivery Is Within 15km Distance Limit</p>
		<!-- Form that collects address for Distance Check-->
		<form method="POST" class="check_distance">
		<!-- Please Input Your Stores' Address Inside Of Value -->
		<input type="hidden" name="origin" value="" id="origin" />
		<div>
		<label>Delivery Destination: </label><br> 
 		<input type="text" name="destination"</input>
		</div> 
 		<input type="submit" name="check-distance" value="Check Distance" />
		</form>
		<div class="the-return"> 
		</div>	
		<!-- Form that collects customer data for API Request -->
		<form method="POST" class="data-form"><br>
		<p>Please Input Necessary Information For ICA Deliveries Job Submission</p>
		<label>Name: </label><br>
		<input type="text" name="cust" id="cust" value="" required></input><br>
		<label>Delivery Recipient's Email: </label><br>
		<input type="text" name="cust_email" id="cust_email" value="" required></input><br>
		<label>Phone: </label>
		<input type="text" name="cust_phone" id="cust_phone" value="" required></input><br>
		<input type="hidden" class="start" name="origin" id="start" value="13 Tuhans Road, Mt Waverly"></input><br>
		<label>Destination Address: </label><br>
		<input type="text" class="end" name="destination" id="end" value="" required></input><br><br>
		<label style="font-style:bold;">Delivery Time Slots
		<ul>
			<li>Monday-Wednesday: 1:00-3:00pm</li>
			<li>Thursday-Friday: 7:30-9:30pm</li>
			<li>Saturday-Sunday: 3:00-5:00pm</li>
		</ul></label><br>
		<label>Desired Delivery Date: </label><br>
		<label style="color:green;">Correct Format: 18-05-2016</label><br>
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
