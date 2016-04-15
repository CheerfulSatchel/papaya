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

<!-- custom-made stylesheet -->
    <link rel="stylesheet" type="text/css" href="directoryStyle.css"/>



<script type="text/javascript">

$( document ).ready(function() {


    $("#cancel").click(function(){
                // call 'close' method on nearest kendoWindow
         window.parent.$("#addGameWindow").data("kendoWindow").close(); //Closest the Kendo Window after Ok in the alert box is clicked
              })


   


}); //end the document.ready function

    function cancel() {
         window.parent.$("#addGameWindow").data("kendoWindow").close(); //Closest the Kendo Window after Ok in the alert box is clicked

    }

    function submit(gameName, price) { //Submits the new game to be added to the processAddGame.php script

        gameName = $("#gameName").val();

        ($("#gameWarning")).html(""); //Makes the warning that "The field is empty" disappear
        ($("#gameName")).css("borderColor", ""); //Makes the red border color disappear

        ($("#priceWarning")).html("");
        ($("#price")).css("borderColor", "");

            if(gameName == null || price == null || gameName == "" || price == "")
                {
                    if (gameName == null || gameName == "") {
                        ($("#gameName")).css("borderColor", "red");
                        ($("#gameWarning")).html("You can't leave this empty").css('color', 'red');
                    }

                    if (price == null || price == "") {
                        ($("#price")).css("borderColor", "red");
                        ($("#priceWarning")).html("You can't leave this empty").css('color', 'red');
                    }


                    return false;
            }


    window.parent.$("#addGameWindow").data("kendoWindow").close(); //Closest the Kendo Window after Ok in the alert box is clicked

          type: "POST",
        $.ajax({ //submits the values that were entered into the JavaScript form above by the user to be processed by processAddGame.php

          url:"processAddGame.php",
          data: {gameName: $("#gameName").val(), platform: $("#platform").val(), genre: $("#genre").val(), price: $("#price").val(), quantity: $("#quantity").val()},
          dataType: 'html',
          success:function(data) {
                alert('You have added ' + gameName + ' to the database!');
          }
       });

        $.ajax({ //makes the directory update with the newest row
            url: 'read.php',
            dataType: 'json',
            success: function (response) {
            var trHTML = "";
            $.each(response, function (i, val) {
                trHTML += "<tr><td>" + val.title + "</td><td>" + val.platform + "</td><td>" + val.genre + "</td><td>" + val.price + "</td><td>" + val.quantity + "</td><td>" + "<div class='btn-group'> <button id='personal-" + val.id + "' type='button' class='btn-md' onClick='personalClick(" + val.id + ")'>More Information</button> <button id='edit-" + val.id + "' type='button' class='btn-md' onClick='editClick(" + val.id + ")'>Edit</button> <button id='delete-" + val.id + "' type='button' class='btn-md' onClick='deleteClick(" + val.id + ")'>Delete</button></div> </td>" +  "</tr>";

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

    <windowTitle>Add a Game</windowTitle>
    <form enctype="multipart/form-data">


        <label>Game Name*  </label> <input type="text" id="gameName"> </br> <div id='gameWarning'> </div> </br>

        <label>Platform  </label> <select id="platform">

        <option value="Xbox One">Xbox One</option>
        <option value="PS4">PS4</option>
        <option value="Xbox 360">Xbox 360</option>
        <option value="PS3">PS3</option>
        <option value="PC">PC</option>
        <option value="Wii U">Wii U</option>
        <option value="3DS">3DS</option>
        <option value="Other">Other</option>
    </select>

    </br> </br>
        <label>Genre  </label> <select id="genre"> 
        <option value="Action">Action</option>
        <option value="Action-Adventure">Action-Adventure</option>
        <option value="Adventure">Adventure</option>
        <option value="MMO">MMO</option>
        <option value="Role-playing Game">Role-playing Game</option>
        <option value="Simulation">Simulation</option>
        <option value="Strategy">Vehicle Simulation</option>
        <option value="Other">Other</option>
        </select>
        </br> </br>

    	<label>Price* </label> <input type="text" id="price"> </br> <div id='priceWarning'> </div> </br>
        <label>Quantity  </label> <input type="text" id="quantity"> </br> </br>
        
    </form>

        <div id='floatRight'>
                        <button id="submit" type="button" class="btn-md" onClick="submit( $('#gameName').val(), $('#price').val())">Submit</button>

                        <button id="cancel" type="button" class="btn-md">Cancel</button>

        </div>
</div>


</body>