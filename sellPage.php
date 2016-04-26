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
		<form align="left" action="sellByCategory.php" method="POST">
			<label> Name </label> <input type = "text" name = "searchItem" placeholder='Enter item name here'>
      <label> Quantity </label> <input type = "text" name = "quantity" placeholder='Enter the quantity to sell'>
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
