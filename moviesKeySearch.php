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

  $( document ).ready(function() {
    var email = "tj@virginia.edu";
    var keyword = '<?php echo $_SESSION['keyword']?>';
    alert(email);
    alert(keyword);
    //Ajax request to get the json data of the mysql results from read.php and display it on the table
    $.ajax({
      url: 'readMoviesKey.php',
      dataType: 'json',
      data: {keyword:keyword},
      success: function (response) {
        var trHTML = "";
        $.each(response, function (i, val) {
            trHTML += "<tr><td>" + val.title + "</td><td>" + val.director + "</td><td>" + val.actor_names + "</td><td>" + val.genre + "</td><td>" + val.price + "</td><td>" + val.quantity +
						 "</td><td><button type='button' class='btn-md' onClick=\"(buyMovie('" + val.item_id + "," + email + "'))\">Add To Cart</button></td>";
        });
        ($("#table tbody")).html(trHTML); //changes the contents of the table body to add the html rows filled in with the data from the JSON object
      },
	    error:function(exception){alert(exception)}
    });
  });

  </script>

  <title>Movies Section</title>

  </head>

	<h1> Movies Section</h1>
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
        <th> Name </th>
        <th> Director </th>
        <th> Actors </th>
        <th> Genre </th>
        <th> Rating </th>
        <th> Price </th>
        <th> </th>
	    </tr>
    </thead>

    <tbody>
    </tbody>

  </table>

  </body>

</html>
