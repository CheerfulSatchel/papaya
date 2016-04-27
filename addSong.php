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
         window.parent.$("#addSongWindow").data("kendoWindow").close(); //Closest the Kendo Window after Ok in the alert box is clicked
              })



   


}); //end the document.ready function

    function cancel() {
         window.parent.$("#addSongWindow").data("kendoWindow").close(); //Closest the Kendo Window after Ok in the alert box is clicked

    }

    function submit(songName, price) { //Submits the new song to be added to the processAddSong.php script

        // gameName = $("#gameName").val();

        ($("#songWarning")).html(""); //Makes the warning that "The field is empty" disappear
        ($("#songName")).css("borderColor", ""); //Makes the red border color disappear

        ($("#priceWarning")).html("");
        ($("#price")).css("borderColor", "");

            if(songName == null || price == null || songName == "" || price == "")
                {
                    if (songName == null || songName == "") {
                        ($("#songName")).css("borderColor", "red");
                        ($("#songWarning")).html("You can't leave this empty").css('color', 'red');
                    }

                    if (price == null || price == "") {
                        ($("#price")).css("borderColor", "red");
                        ($("#priceWarning")).html("You can't leave this empty").css('color', 'red');
                    }


                    return false;
            }


    window.parent.$("#addSongWindow").data("kendoWindow").close(); //Closes the Kendo Window after Ok in the alert box is clicked

        $.ajax({ //submits the values that were entered into the JavaScript form above by the user to be processed by processAddGame.php
          type: "POST",
          url:"processAddSong.php",
          data: {songName: $("#songName").val(), artist: $("#artist").val(), length: $("#length").val(), release_year: $("#release_year").val(), price: $("#price").val(), quantity: $("#quantity").val()},
          dataType: 'html',
          success:function(data) {
                alert('You have added ' + songName + ' to the database!');

          }
       });

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

    <windowTitle>Add a Song</windowTitle>
    <form enctype="multipart/form-data">


        <label>Song Name*  </label> <input type="text" id="songName"> </br> <div id='songWarning'> </div> </br>

        <label>Artist  </label> <input type="text" id="artist"> </br> </br>

        <label>Length  </label> <input type="text" id="length"> </br> </br>

        <label>Release Year  </label> <input type="text" id="release_year"> </br> </br>

        <label>Price* </label> <input type="text" id="price"> </br> <div id='priceWarning'> </div> </br>

        <label>Quantity  </label> <input type="text" id="quantity"> </br> </br>

    </br> </br>
        
    </form>

        <div id='floatRight'>
                        <button id="submit" type="button" class="btn-md" onClick="submit( $('#songName').val(), $('#price').val())">Submit</button>

                        <button id="cancel" type="button" class="btn-md">Cancel</button>

        </div>
</div>


</body>