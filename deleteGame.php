<?php
	include 'databaseinfo.php'; //database information to access MySQL

	$id = $_POST['id'];



	// $itemQuery = "DELETE FROM item
	// 	WHERE item_id= ?";

	$itemQuery = $db->prepare("DELETE FROM item WHERE item_id= ?") or die("Your item deletion couldn't be done: " . $db->error);

    $itemQuery->bind_param("d",$id); 

    $itemQuery->execute();


?>

<script type="text/javascript">

    setTimeout(updateTable, 3000); //Allows the database time to process the update


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