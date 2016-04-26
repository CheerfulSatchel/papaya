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

function updateTable() { //Ajax call to update the table to read by the user
  alert("Inside update table");
  alert(arguments[0]);
  var email = arguments[0];
   $.ajax({ //makes the directory update with the newest row
       url: 'readBuy.php',
       type: 'POST',
       dataType: 'json',
       data: ({userName: email}),
       success: function (response) {
       var trHTML = "";
       $.each(response, function (i, val) {
         //CDs have names, movies and videogames have titles
         if(typeof val.title !== 'undefined') {
            trHTML += "<tr><td>" + val.title + "</td><td>" + val.price + "</td><td>" + "<div class='btn-group'><button id='delete-" + val.item_id
             + "' type='button' class='btn-md' onClick=\"(deleteClick('" + val.item_id + "," + email + "'))\">Delete</button></div> </td>" +  "</tr>";
         } else if(typeof val.name !== 'undefined') {
           trHTML += "<tr><td>" + val.name + "</td><td>" + val.price + "</td><td>" + "<div class='btn-group'> <button id='delete-" + val.item_id
            + "' type='button' class='btn-md' onClick=\"(deleteClick('" + val.item_id  + "," + email + "'))\">Delete</button></div> </td>" +  "</tr>";
         }
       });
       ($("#table tbody")).html(trHTML); //changes the contents of the table body to add the html rows filled in with the data from the JSON object
   },
     error:function(exception){alert(exception)}
   });
}

function deleteClick(a, b){ //function that handles when the "Delete" button is clicked
    var deleteConfirm = confirm("Are you sure you want to delete this entry? This cannot be undone.");
    if (deleteConfirm == true) {
      var id = "";
      var email = "";
      var found = 0;
      for(var i = 0; i < a.length; i++) {
        if(found == 0) {
          var n = a.charAt(i);
          if(n != ",") {
            id += n;
          } else {
            found = 1;
          }
        } else {
          var n = a.charAt(i);
          email += n;
        }
      }
      alert(id);
      alert(email);

         $.ajax({ //submits the values that were entered into the JavaScript form above by the user to be processed by processCreate.php
          type: "POST",
          url:"deleteBuy.php",
          data: {id: id, email: email},
          success:function(data) {
              alert("HEy, we made it into update");
              setTimeout(updateTable(email), 3000); //Allows the database time to process the update
          }
       });

    }
}

$( document ).ready(function() {



//Ajax request to get the json data of the mysql results from read.php and display it on the table
var email = "tj@virginia.edu";
$.ajax({
    url: 'readBuy.php',
    type: 'POST',
    dataType: 'json',
    data: ({userName: email}),
    success: function (response) {
        var trHTML = "";
        $.each(response, function (i, val) {
          //CDs have names, movies and videogames have titles
          if(typeof val.title !== 'undefined') {
             trHTML += "<tr><td>" + val.title + "</td><td>" + val.price + "</td><td>" + "<div class='btn-group'><button id='delete-" + val.item_id
              + "' type='button' class='btn-md' onClick=\"(deleteClick('" + val.item_id + "," + email + "'))\">Delete</button></div> </td>" +  "</tr>";
          } else if(typeof val.name !== 'undefined') {
            trHTML += "<tr><td>" + val.name + "</td><td>" + val.price + "</td><td>" + "<div class='btn-group'> <button id='delete-" + val.item_id
             + "' type='button' class='btn-md' onClick=\"(deleteClick('" + val.item_id  + "," + email + "'))\">Delete</button></div> </td>" +  "</tr>";
          }
        });
        ($("#table tbody")).html(trHTML); //changes the contents of the table body to add the html rows filled in with the data from the JSON object
    	},
	error:function(exception){alert(exception)}
});

});





function finalCheckout() {
  window.location.replace("index.html");
}







</script>



<title>Checkout Page</title>
</head>

	<h1> Checkout Page </h1>
	<br />

<div id="editPopup"></div>


<div class="container-fluid">

<table class="table table-striped table-bordered table-condensed table-responsive" id="table" width="75%">
  <thead>
	   <tr height="30px">
	      <td colspan="6">
	         <div id="buttonLeft">
             <button type="button">Back</button>
	         </div>
           <div id="buttonRight">
             <button type="button" onClick='finalCheckout()'>Checkout</button>
	         </div>
        </td>
    </tr>

    <tr>
      <th> Name </th>
      <th> Price </th>
    </tr>
  </thead>

  <tbody>
  </tbody>

</table>

</body>

</html>
