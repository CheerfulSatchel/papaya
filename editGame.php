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
         window.parent.$("#editGameWindow").data("kendoWindow").close(); //Closest the Kendo Window after Ok in the alert box is clicked

    }

    function submit() { //Occurs when the "Edit Information" button is pushed and replaces the current form (which cannot be editted) with another form from editMoreInfo.php using ajax


    window.parent.$("#editGameWindow").data("kendoWindow").close(); //Closest the Kendo Window after Ok in the alert box is clicked


        $.ajax({ //submits the values that were entered into the JavaScript form above by the user to be processed by processCreate.php
          type: "POST",
          url:"processEditGame.php",
          data: {id: <?php echo $_GET["id"]?>, gameName: $("#gameName").val(), publisher: $("#publisher").val(), rating: $("#rating").val(), platform: $("#platform").val(), genre: $("#genre").val(), price: $("#price").val(), quantity: $("#quantity").val()},
          dataType: 'html',
          success:function(data) {
                alert('You have updated ' + $("#gameName").val() + '!');
  	            ($("#test")).html(data); //changes the contents of the table body to add the html rows filled in with the data from the JSON object

          }
       });

        setTimeout(updateTable, 1000); //Allows the database time to process the update

    }

    function updateTable() { //Ajax call to update the table to read by the user
        $.ajax({ //makes the directory update with the newest row
            url: 'readVideoGames.php',
            dataType: 'json',
            success: function (response) {
            var trHTML = "";
            $.each(response, function (i, val) {
                trHTML += "<tr><td>" + val.title + "</td><td>"  + val.publisher + "</td><td>"  + val.rating + "</td><td>" + val.platform + "</td><td>" + val.genre + "</td><td>" + val.price + "</td><td>" + val.quantity + "</td><td>" + "<div class='btn-group'> <button id='personal-" + val.item_id + "' type='button' class='btn-md' onClick='personalClick(" + val.item_id + ")'>More Information</button> <button id='edit-" + val.item_id + "' type='button' class='btn-md' onClick='editClick(" + val.item_id + ")'>Edit</button> <button id='delete-" + val.item_id + "' type='button' class='btn-md' onClick='deleteClick(" + val.item_id + ")'>Delete</button></div> </td>" +  "</tr>";

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

	$stmt = $db->prepare("select item.item_id, video_game.title, video_game.publisher, video_game.rating, video_game.platform, video_game.genre, item.price, item.quantity FROM (video_game NATURAL JOIN item)  WHERE item.item_id= ? ORDER BY video_game.title, video_game.platform, video_game.publisher, video_game.genre, video_game.rating");
    $stmt->bind_param("d", $id); 
    $stmt->execute();

    $result = $stmt->get_result();


    $data = $result->fetch_array(); 
    	$item_id = $data['item_id'];

    	$title = $data['title'];

	   	$publisher = $data['publisher'];

	   	$rating = $data['rating'];

	   	$platform = $data['platform'];

	   	$genre = $data['genre'];

        $price = $data['price'];

	   	$quantity = $data['quantity'];

}
    ?>

<div id='firstForm'>

    <windowTitle>Video Game Information</windowTitle>
    <form enctype="multipart/form-data">

    <label>Game Name*  </label> <input type="text" id="gameName" value='<?php echo $title ?>'> </br> </br>

        <label>Publisher  </label> <input type="text" id="publisher"  value='<?php echo $publisher ?>'> </br> </br>

        <label>Rating  </label> <select id="rating">

        <option value="Early Childhood" <?php if ($rating=="Early Childhood") echo 'selected=\"selected\"'; ?>>Early Childhood</option>
        <option value="Everyone" <?php if ($rating=="Everyone") echo 'selected=\"selected\"'; ?>>Everyone</option>
        <option value="Teen" <?php if ($rating=="Teen") echo 'selected=\"selected\"'; ?>>Teen</option>
        <option value="Mature" <?php if ($rating=="Mature") echo 'selected=\"selected\"'; ?>>Mature</option>
        <option value="Adults Only" <?php if ($rating=="Adults Only") echo 'selected=\"selected\"'; ?>>Adults Only</option>
        <option value="Rating Pending" <?php if ($rating=="Rating Pending") echo 'selected=\"selected\"'; ?>>Rating Pending</option>
    </select>

    </br> </br>
        <label>Platform  </label> <select id="platform">

        <option value="Xbox One" <?php if( $platform =="Xbox One") echo 'selected=\"selected\"'; ?>>Xbox One</option>
        <option value="PS4" <?php if( $platform =="PS4") echo 'selected=\"selected\"'; ?>>PS4</option>
        <option value="Xbox 360" <?php if( $platform =="Xbox 360") echo 'selected=\"selected\"'; ?>>Xbox 360</option>
        <option value="PS3" <?php if( $platform =="PS3") echo 'selected=\"selected\"'; ?>>PS3</option>
        <option value="PC" <?php if( $platform =="PC") echo 'selected=\"selected\"'; ?>>PC</option>
        <option value="Wii U" <?php if( $platform =="Wii U") echo 'selected=\"selected\"'; ?>>Wii U</option>
        <option value="3DS" <?php if( $platform =="3DS") echo 'selected=\"selected\"'; ?>>3DS</option>
        <option value="Other" <?php if( $platform =="Other") echo 'selected=\"selected\"'; ?>>Other</option>
    </select>

    </br> </br>
        <label>Genre  </label> <select id="genre"> 
        <option value="Action" <?php if( $genre =="Action") echo 'selected=\"selected\"'; ?>>Action</option>
        <option value="Action-Adventure"  <?php if( $genre =="Action-Adventure") echo 'selected=\"selected\"'; ?>>Action-Adventure</option>
        <option value="Adventure"  <?php if( $genre =="Adventure") echo 'selected=\"selected\"'; ?>>Adventure</option>
        <option value="MMO" <?php if( $genre =="MMO") echo 'selected=\"selected\"'; ?>>MMO</option>
        <option value="Role-playing Game"  <?php if( $genre =="Role-playing Game") echo 'selected=\"selected\"'; ?>>Role-playing Game</option>
        <option value="Simulation"  <?php if( $genre =="Simulation") echo 'selected=\"selected\"'; ?>>Simulation</option>
        <option value="Strategy"  <?php if( $genre =="Strategy") echo 'selected=\"selected\"'; ?>>Strategy</option>
        <option value="Other"  <?php if( $genre =="Other") echo 'selected=\"selected\"'; ?>>Other</option>
        </select>
        </br> </br>

        <label>Price* </label> <input type="text" id="price" value='<?php echo $price ?>'> </br> </br>
        <label>Quantity  </label> <input type="text" id="quantity" value='<?php echo $quantity ?>'> </br> </br>

    </br> </br>
        
    </form>

        <div id='floatRight'>
                        <button id="next" type="button" class="btn-md" onClick="submit()">Submit</button>

                        <button id="cancel" type="button" class="btn-md" onClick="cancel()">Cancel</button>

        </div>

</div>