<script type="text/javascript">

    /*function update() {
      alert("HEy, we made it into update");
      setTimeout(updateTable, 3000); //Allows the database time to process the update
    }

     function updateTable() { //Ajax call to update the table to read by the user
       alert("Inside update table");
        $.ajax({ //makes the directory update with the newest row
            url: 'readBuy.php',
            type: 'POST'
            dataType: 'json',
            data: ({userName: email}),
            success: function (response) {
            var trHTML = "";
            var email = <?php //echo $email;?>
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
    }*/

</script>

<?php
	include 'databaseInfo.php'; //database information to access MySQL
	$id = $_POST['id'];
  $email = $_POST['email'];

  //echo "HEYYYYYYYY";
	$itemQuery = $db->prepare("DELETE FROM Buy WHERE item_id= ? AND email = ? LIMIT 1") or die("Your item deletion couldn't be done: " . $db->error);
  $itemQuery->bind_param("ds",$id, $email);
  $itemQuery->execute();
  //echo "Hello World!";
  //header("Location: deleteBuyJScript.php");
  //echo "<script type='text/javascript'>update();</script>";
?>
