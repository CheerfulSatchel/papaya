<!DOCTYPE html>
<!--
 	Page to sell an item, redirects based on category
  Users can only sell an item that the store carries
-->
<html>
	<title>
	   Sell an Item
	</title>
  <body>
    <?php
    session_start();
    if(isset($_SESSION['itemToSell'])) {
      $itemToSell = $_SESSION['itemToSell'];
    }
    ?>
		<form align="left" action="sellConfirmation.php" method="POST">
			<label> Name </label> <input type = "text" name = "searchItem" placeholder='Enter item name here'>
			</br> </br>
				<label>Category</label><select name = "category">
				 <option value="movies">Movies</option>
				 <option value="videogames">Video Games</option>
				 <option value="music">Music</option>
       </select>
		 </br> </br>
				<input type = "submit" name = 'submit' value = "Search">
		</form>
  </body>
</html>
