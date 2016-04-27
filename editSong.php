<?php ini_set('display_errors', 1); ?>

<DOCTYPE html>
<html>
<head>


<!-- Bootstrap stuff -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/bootstrap.min.css"> 
<script src="js/bootstrap.min.js"></script> 
<!-- End of Bootstrap stuff -->

<!-- custom-made stylesheet -->
    <link rel="stylesheet" type="text/css" href="directoryStyle.css"/>


<script type="text/javascript">

    function cancel() {
         window.parent.$("#editSongWindow").data("kendoWindow").close(); //Closest the Kendo Window after Ok in the alert box is clicked

    }

    function submitEdit() { //Occurs when the "Edit Information" button is pushed and replaces the current form (which cannot be editted) with another form from editMoreInfo.php using ajax

    window.parent.$("#editSongWindow").data("kendoWindow").close(); //Closest the Kendo Window after Ok in the alert box is clicked


        $.ajax({ //submits the values that were entered into the JavaScript form above by the user to be processed by processCreate.php
          type: "POST",
          url:"processEditSong.php",
          data: {id: <?php echo $_GET["id"]?>, songName: $("#editsongName").val(), artist: $("#editartist").val(), length: $("#editlength").val(), release_year: $("#editreleaseyear").val(), price: $("#editprice").val(), quantity: $("#editquantity").val()},
          dataType: 'html',
          success:function(data) {
                alert('You have updated ' + $("#editsongName").val() + '!');


          }
       });//

        setTimeout(updateTable, 1000); //Allows the database time to process the update

    }

    function updateTable() { //Ajax call to update the table to read by the user
        $.ajax({ //makes the directory update with the newest row
            url: 'readSongs.php',
            dataType: 'json',
            success: function (response) {
            var trHTML = "";
            $.each(response, function (i, val) {
                trHTML += "<tr><td>" + val.name + "</td><td>" + val.artist + "</td><td>" + val.length + "</td><td>" + val.release_year + "</td><td>" + val.price + "</td><td>" + val.quantity + "</td><td>" + "<div class='btn-group'> <button id='edit-" + val.item_id + "' type='button' class='btn-md' onClick='editClick(" + val.item_id + ")'>Edit This Entry</button> <button id='delete-" + val.item_id + "' type='button' class='btn-md' onClick='deleteClick(" + val.item_id + ")'>Delete</button></div> </td>" +  "</tr>";

            });
            ($("#table tbody")).html(trHTML); //changes the contents of the table body to add the html rows filled in with the data from the JSON object
        },
     error:function(exception){alert(exception)}
    });

    }



    


</script>

<style type="text/css">
    label{
        display: inline-block;
        float: left;
        clear: left;
        width: 100px;
        text-align: right;

    }

    label2{
        display: inline-block;
        float: left;
        clear: left;
        width: 200px;
        text-align: right;

    }

    windowTitle{
        display: block;
        font-size: 2em;
        font-weight: bold; 
    }

    #floatRight{
        float: right;
    }

    </style>

</head>

</head>

  <?php
 		include 'databaseinfo.php'; //database information to access MySQL

if (isset($_GET["id"])) { //Check if the get variable is empty and if not, do this

	$id = $_GET["id"]; //get the unique id of the record that each person has in the mysql table

	$stmt = $db->prepare("select item.item_id, song.name, song.artist, song.length, song.release_year, item.price, item.quantity FROM (song NATURAL JOIN item)  WHERE item.item_id= ? ORDER BY song.name, song.artist, song.length, song.release_year");
    $stmt->bind_param("d", $id); 
    $stmt->execute();

    $result = $stmt->get_result();


    $data = $result->fetch_array(); 
    	$item_id = $data['item_id'];

    	$name = $data['name'];

	   	$artist = $data['artist'];

	   	$length = $data['length'];

	   	$release_year = $data['release_year'];

        $price = $data['price'];

	   	$quantity = $data['quantity'];

    $stmt->close();
    $db->close();


}
    ?>

<div id='firstForm'>

    <windowTitle>Song Information</windowTitle>
    <form enctype="multipart/form-data">

    <label>Song Name*  </label> <input type="text" id="editsongName" value='<?php echo $name ?>'> </br> </br>

        <label>Artist  </label> <input type="text" id="editartist"  value='<?php echo $artist ?>'> </br> </br>

        <label>Length  </label> <input type="text" id="editlength"  value='<?php echo $length ?>'> </br> </br>

        <label>Release Year  </label> <input type="text" id="editreleaseyear"  value='<?php echo $release_year ?>'> </br> </br>


        <label>Price* </label> <input type="text" id="editprice" value='<?php echo $price ?>'> </br> </br>
        <label>Quantity  </label> <input type="text" id="editquantity" value='<?php echo $quantity ?>'> </br> </br>

    </br> </br>
        
    </form>

        <div id='floatRight'>
                        <button id="next" type="button" class="btn-md" onClick="submitEdit()">Submit</button>

                        <button id="cancel" type="button" class="btn-md" onClick="cancel()">Cancel</button>

        </div>

</div>