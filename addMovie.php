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

$( document ).ready(function() {


$("#cancel").click(function(){
                // call 'close' method on nearest kendoWindow
         window.parent.$("#addMovieWindow").data("kendoWindow").close(); //Closest the Kendo Window after Ok in the alert box is clicked
              })



   


}); //end the document.ready function

    function cancel() {
         window.parent.$("#addMovieWindow").data("kendoWindow").close(); //Closest the Kendo Window after Ok in the alert box is clicked

    }

    function submit(movieName, price) { //Submits the new movie to be added to the processAddMovie.php script

        // gameName = $("#gameName").val();

        ($("#movieWarning")).html(""); //Makes the warning that "The field is empty" disappear
        ($("#movieName")).css("borderColor", ""); //Makes the red border color disappear

        ($("#priceWarning")).html("");
        ($("#price")).css("borderColor", "");

            if(movieName == null || price == null || movieName == "" || price == "")
                {
                    if (movieName == null || movieName == "") {
                        ($("#movieName")).css("borderColor", "red");
                        ($("#movieWarning")).html("You can't leave this empty").css('color', 'red');
                    }

                    if (price == null || price == "") {
                        ($("#price")).css("borderColor", "red");
                        ($("#priceWarning")).html("You can't leave this empty").css('color', 'red');
                    }


                    return false;
            }


    window.parent.$("#addMovieWindow").data("kendoWindow").close(); //Closes the Kendo Window after Ok in the alert box is clicked

        $.ajax({ //submits the values that were entered into the JavaScript form above by the user to be processed by processAddGame.php
          type: "POST",
          url:"processAddMovie.php",
          data: {movieName: $("#movieName").val(), director: $("#director").val(), actor1: $("#actor1").val(), actor2: $("#actor2").val(), actor3: $("#actor3").val(),  rating: $("#rating").val(), platform: $("#platform").val(), genre: $("#genre").val(), price: $("#price").val(), quantity: $("#quantity").val()},
          dataType: 'html',
          success:function(data) {
                alert('You have added ' + movieName + ' to the database!');
                ($("#test")).html(data); //changes the contents of the table body to add the html rows filled in with the data from the JSON object

          }
       });

        setTimeout(updateTable, 1000); //Allows the database time to process the update


    }


    function updateTable() { //Ajax call to update the table to read by the user
        $.ajax({ //makes the directory update with the newest row
            url: 'readMovies.php',
            dataType: 'json',
            success: function (response) {
            var trHTML = "";
            $.each(response, function (i, val) {
            trHTML += "<tr><td>" + val.title + "</td><td>" + val.director + "</td><td>" + val.actor_names + "</td><td>" + val.genre + "</td><td>" + val.rating + "</td><td>" + val.price + "</td><td>" + val.quantity + "</td><td>" + "<div class='btn-group'> <button id='edit-" + val.item_id + "' type='button' class='btn-md' onClick='editClick(" + val.item_id + ")'>Edit This Entry</button> <button id='delete-" + val.item_id + "' type='button' class='btn-md' onClick='deleteClick(" + val.item_id + ")'>Delete</button></div> </td>" +  "</tr>";
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
        font-weight:bold;
    }

    label2{
        display: inline-block;
        float: left;
        clear: left;
        width: 120px;
        text-align: right;
        font-weight:bold;

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


<body>

<div id='firstForm'>

    <windowTitle>Add a Movie</windowTitle>
    <form enctype="multipart/form-data">


        <label>Movie Name*  </label> <input type="text" id="movieName"> </br> <div id='movieWarning'> </div> </br>

        <label>Director  </label> <input type="text" id="director"> </br> </br>

        <label>Actor Name  </label> <input type="text" id="actor1"> </br> </br>

        <label>Actor Name </label> <input type="text" id="actor2"> </br> </br>

        <label>Actor Name  </label> <input type="text" id="actor3"> </br> </br>

        <label>Rating  </label> <select id="rating">

        <option value="G">G</option>
        <option value="PG">PG</option>
        <option value="PG-13">PG-13 </option>
        <option value="R">R</option>
        <option value="NC-17">NC-17</option>
        <option value="Not Rated">Not Rated</option>
        <option value="This Film Is Not Yet Rated">This Film Is Not Yet Rated</option>

    </select>

    </br> </br>
        <label>Genre  </label> <select id="genre"> 
        <option value="Action">Action</option>
        <option value="Adventure">Adventure</option>
        <option value="Animation">Animation</option>
        <option value="Comedy">Comedy</option>
        <option value="Crime">Crime</option>
        <option value="Documentary">Documentary</option>
        <option value="Drama">Drama</option>
        <option value="Family">Family</option>
        <option value="Fantasy">Fantasy</option>
        <option value="History">History</option>
        <option value="Horror">Horror</option>
        <option value="Musical">Musical</option>
        <option value="Mystery">Mystery</option>
        <option value="Romance">Romance</option>
        <option value="Sci-Fi">Sci-Fi</option>
        <option value="Thriller">Thriller</option>
        <option value="Western">Western</option>
        <option value="Other">Other</option>

        </select>
        </br> </br>

    	<label>Price* </label> <input type="text" id="price"> </br> <div id='priceWarning'> </div> </br>
        <label>Quantity  </label> <input type="text" id="quantity"> </br> </br>

    </br> </br>

    <div id="test"> </div>
        
    </form>

        <div id='floatRight'>
                        <button id="submit" type="button" class="btn-md" onClick="submit( $('#movieName').val(), $('#price').val())">Submit</button>

                        <button id="cancel" type="button" class="btn-md">Cancel</button>

        </div>
</div>


</body>