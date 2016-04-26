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
         window.parent.$("#editMovieWindow").data("kendoWindow").close(); //Closest the Kendo Window after Ok in the alert box is clicked

    }

    function submitEdit() { //Occurs when the "Edit Information" button is pushed and replaces the current form (which cannot be editted) with another form from editMoreInfo.php using ajax

    window.parent.$("#editMovieWindow").data("kendoWindow").close(); //Closest the Kendo Window after Ok in the alert box is clicked


        $.ajax({ //submits the values that were entered into the JavaScript form above by the user to be processed by processCreate.php
          type: "POST",
          url:"processEditMovie.php",
          data: {id: <?php echo $_GET["id"]?>, movieName: $("#editmovieName").val(), director: $("#editdirector").val(), rating: $("#editrating").val(), genre: $("#editgenre").val(), price: $("#editprice").val(), quantity: $("#editquantity").val()},
          dataType: 'html',
          success:function(data) {
                alert('You have updated ' + $("#editmovieName").val() + '!');


          }
       });//

        setTimeout(updateTable, 1000); //Allows the database time to process the update

    }

    function updateTable() { //Ajax call to update the table to read by the user
        $.ajax({ //makes the directory update with the newest row
            url: 'readMovies.php',
            dataType: 'json',
            success: function (response) {
            var trHTML = "";
            $.each(response, function (i, val) {
                trHTML += "<tr><td>" + val.title + "</td><td>" + val.director + "</td><td>" + val.genre + "</td><td>" + val.rating + "</td><td>" + val.price + "</td><td>" + val.quantity + "</td><td>" + "<div class='btn-group'> <button id='edit-" + val.item_id + "' type='button' class='btn-md' onClick='editClick(" + val.item_id + ")'>Edit This Entry</button> <button id='delete-" + val.item_id + "' type='button' class='btn-md' onClick='deleteClick(" + val.item_id + ")'>Delete</button></div> </td>" +  "</tr>";

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

	$stmt = $db->prepare("select item.item_id, movie.title, movie.director, movie.genre, movie.rating, item.price, item.quantity FROM (movie NATURAL JOIN item)  WHERE item.item_id= ? ORDER BY movie.title, movie.director, movie.genre, movie.rating");
    $stmt->bind_param("d", $id); 
    $stmt->execute();

    $result = $stmt->get_result();


    $data = $result->fetch_array(); 
    	$item_id = $data['item_id'];

    	$title = $data['title'];

	   	$director = $data['director'];

	   	$rating = $data['rating'];

	   	$genre = $data['genre'];

        $price = $data['price'];

	   	$quantity = $data['quantity'];

    $stmt->close();
    $db->close();


}
    ?>

<div id='firstForm'>

    <windowTitle>Movie Information</windowTitle>
    <form enctype="multipart/form-data">

    <label>Movie Name*  </label> <input type="text" id="editmovieName" value='<?php echo $title ?>'> </br> </br>

        <label>Director  </label> <input type="text" id="editdirector"  value='<?php echo $director ?>'> </br> </br>

        <label>Rating  </label> <select id="editrating">

        <option value="G" <?php if ($rating=="G") echo 'selected=\"selected\"'; ?>>G</option>
        <option value="PG" <?php if ($rating=="PG") echo 'selected=\"selected\"'; ?>>PG</option>
        <option value="PG-13" <?php if ($rating=="PG-13") echo 'selected=\"selected\"'; ?>>PG-13 </option>
        <option value="R" <?php if ($rating=="R") echo 'selected=\"selected\"'; ?>>R</option>
        <option value="NC-17" <?php if ($rating=="NC-17") echo 'selected=\"selected\"'; ?>>NC-17</option>
        <option value="Not Rated" <?php if ($rating=="Not Rated") echo 'selected=\"selected\"'; ?>>Not Rated</option>
        <option value="This Film Is Not Yet Rated" <?php if ($rating=="This Film Is Not Yet Rated") echo 'selected=\"selected\"'; ?>>This Film Is Not Yet Rated</option>
    </select>

    </br> </br>
        <label>Genre  </label> <select id="editgenre"> 
        <option value="Action" <?php if ($genre=="Action") echo 'selected=\"selected\"'; ?>>Action</option>
        <option value="Adventure" <?php if ($genre=="Adventure") echo 'selected=\"selected\"'; ?>>Adventure</option>
        <option value="Animation" <?php if ($genre=="Animation") echo 'selected=\"selected\"'; ?>>Animation</option>
        <option value="Comedy" <?php if ($genre=="Comedy") echo 'selected=\"selected\"'; ?>>Comedy</option>
        <option value="Crime" <?php if ($genre=="Crime") echo 'selected=\"selected\"'; ?>>Crime</option>
        <option value="Documentary" <?php if ($genre=="Documentary") echo 'selected=\"selected\"'; ?>>Documentary</option>
        <option value="Drama" <?php if ($genre=="Drama") echo 'selected=\"selected\"'; ?>>Drama</option>
        <option value="Family" <?php if ($genre=="Family") echo 'selected=\"selected\"'; ?>>Family</option>
        <option value="Fantasy" <?php if ($genre=="Fantasy") echo 'selected=\"selected\"'; ?>>Fantasy</option>
        <option value="History" <?php if ($genre=="History") echo 'selected=\"selected\"'; ?>>History</option>
        <option value="Horror" <?php if ($genre=="Action") echo 'selected=\"selected\"'; ?>>Horror</option>
        <option value="Musical" <?php if ($genre=="Musical") echo 'selected=\"selected\"'; ?>>Musical</option>
        <option value="Mystery" <?php if ($genre=="Mystery") echo 'selected=\"selected\"'; ?>>Mystery</option>
        <option value="Romance" <?php if ($genre=="Romance") echo 'selected=\"selected\"'; ?>>Romance</option>
        <option value="Sci-Fi" <?php if ($genre=="Sci-Fi") echo 'selected=\"selected\"'; ?>>Sci-Fi</option>
        <option value="Thriller" <?php if ($genre=="Thriller") echo 'selected=\"selected\"'; ?>>Thriller</option>
        <option value="Western" <?php if ($genre=="Western") echo 'selected=\"selected\"'; ?>>Western</option>
        <option value="Other" <?php if ($genre=="Other") echo 'selected=\"selected\"'; ?>>Other</option>

        </select>
        </br> </br>

        <label>Price* </label> <input type="text" id="editprice" value='<?php echo $price ?>'> </br> </br>
        <label>Quantity  </label> <input type="text" id="editquantity" value='<?php echo $quantity ?>'> </br> </br>

    </br> </br>
        
    </form>

        <div id='floatRight'>
                        <button id="next" type="button" class="btn-md" onClick="submitEdit()">Submit</button>

                        <button id="cancel" type="button" class="btn-md" onClick="cancel()">Cancel</button>

        </div>

</div>