<?php ini_set('display_errors', 1); ?>

<DOCTYPE html>
<html>
<head>

<!-- JQuery Stuff -->
<script src="js/jquery.min.js"></script>
<!-- End JQUERY Stuff -->

<!-- Bootstrap stuff -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/bootstrap.min.js"></script>
<!-- End of Bootstrap stuff -->

<link rel="stylesheet" type="text/css" href="directoryStyle.css"/>


<script type="text/javascript">

$( document ).ready(function() {

  //Ajax request to get the json data of the mysql results from read.php and display it on the table
  var email = "hey";
  $.ajax({
    url: 'readSold.php',
    type: 'POST',
    dataType: 'json',
    data: ({userName: email}),
    success: function (response) {
        var trHTML = "";
        $.each(response, function (i, val) {
          //CDs have names, movies and videogames have titles
          if(typeof val.title !== 'undefined') {
             trHTML += "<tr><td>" + val.email + "</td><td>" + val.lastName + "</td><td>" + val.title + "</td><td>" + val.price + "</td><td>"  + val.count + "</td>" +  "</tr>";
          } else if(typeof val.name !== 'undefined') {
            trHTML += "<tr><td>" + val.email + "</td><td>" + val.lastName + "</td><td>" + val.name + "</td><td>" + val.price + "</td><td>"  + val.count + "</td>" +  "</tr>";
          }
        });
        ($("#table tbody")).html(trHTML); //changes the contents of the table body to add the html rows filled in with the data from the JSON object
    	},
	    error:function(exception){alert(exception)}
  });

});

function back() {
  window.location.replace("index.html");
}

</script>

<title>Sold Records</title>
</head>

	<h1> Sold Records  </h1>
	<br />

<div id="editPopup"></div>


<div class="container-fluid">

<table class="table table-striped table-bordered table-condensed table-responsive" id="table" width="75%">
  <thead>
	   <tr height="30px">
	      <td colspan="6">
	         <div id="buttonLeft">
             <!--<button type="button" onClick='back()'>Back</button>-->
	         </div>
           <div id="buttonRight">

	         </div>
        </td>
    </tr>

    <tr>
      <th> Email </th>
      <th> Last Name </th>
      <th> Name </th>
      <th> Price </th>
      <th> Quantity </th>
    </tr>
  </thead>

  <tbody>
  </tbody>

</table>

</body>

</html>
