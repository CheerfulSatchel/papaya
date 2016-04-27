<html>
  <head>

  <?php session_start(); ?>

  <!-- JQuery Stuff -->
  <script src="js/jquery.min.js"></script>
  <!-- End JQUERY Stuff -->

  <!-- Bootstrap stuff -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/bootstrap.min.js"></script>
  <!-- End of Bootstrap stuff -->

  <!-- CSS stuff-->
  <link rel="stylesheet" type="text/css" href="directoryStyle.css"/>

  <script type="text/javascript">

  function buySong() {
    var a = arguments[0];
    //alert(a);

    var deleteConfirm = confirm("Are you sure you want to buy this item?");
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
      //alert(id);
      //alert(email);

         $.ajax({ //submits the values that were entered into the JavaScript form above by the user to be processed by processCreate.php
          type: "POST",
          url:"addMusicBuy.php",
          data: {id: id, email: email},
          success:function(data) {
              alert("HEy, we made it into update");
              setTimeout(updateTable(email), 3000); //Allows the database time to process the update
          }
       });

    }
  }


  $( document ).ready(function() {
    //var email = "tj@virginia.edu"; //TO BE CHANGED TO SESSION VARIABLE
    var email = '<?php echo $_SESSION['email']?>';
    var keyword = '<?php echo $_SESSION['keyword']?>';
    //alert(email);
    //alert(keyword);
    //Ajax request to get the json data of the mysql results from read.php and display it on the table
    $.ajax({
      type: "POST",
      url: 'readSongsKeyword.php',
      dataType: 'json',
      data: {key:keyword},
      success: function (response) {
        var trHTML = "";
        $.each(response, function (i, val) {
            trHTML += "<tr><td>" + val.name + "</td><td>" + val.artist + "</td><td>" + val.length + "</td><td>" + val.release_year + "</td><td>" + val.price +
						 "</td><td><button type='button' class='btn-md' onClick=\"(buySong('" + val.item_id + "," + email + "'))\">Add To Cart</button></td>";
        });
        ($("#table tbody")).html(trHTML); //changes the contents of the table body to add the html rows filled in with the data from the JSON object
      },
	    error:function(exception){alert(exception)}
    });
  });

  </script>

  <title>Songs Section</title>

  </head>

	<h1> Songs Section </h1>
	<br />

  <div id="editPopup"></div>

  <div class="container-fluid">

  <table class="table table-striped table-bordered table-condensed table-responsive" id="table" width="75%">
	  <thead>
      <tr height="30px">
		    <td colspan="6">
	         <div id="buttonLeft">
             <input id="search" type="search"> <div class="btn-group"><button type="button">Search</button> </div>
	         </div>
        </td>
	    </tr>

      <tr>
        <th> Title </th>
        <th> Artist </th>
        <th> Length </th>
        <th> Release </th>
        <th> Price </th>
        <th> </th>
	    </tr>
    </thead>

    <tbody>
    </tbody>

  </table>

  </body>

</html>
