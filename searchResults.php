<!DOCTYPE html>
<html>
  <head>
    <title> Search Results </title>
  </head>
  <body>
    <?php
    $found = "no";
    //get the string being searched and the category to search in
    if(isset($_POST['searchItem'])) {
      $itemToSearchFor = $_POST['searchItem'];
      $itemToSearchFor = trim($itemToSearchFor);
    }
    if(isset($_POST['category'])) {
      $category  =$_POST['category'];
      $category = trim($category);
    }
    //echo "$itemToSearchFor";
    //echo "$category";
    //Database parameters
    $server = "stardock.cs.virginia.edu";
    $username = "cs4750mjm5qu";
    $dbpassword = "snowball";
    $db_name = "cs4750mjm5qu";
    $db = new mysqli("$server", "$username", "$dbpassword", "$db_name");
    //Try to connect
    if ($db->connect_error){
      die("Connection error: " . $db->connect_error);
    }
    if($category == "music" || ($category == "all" && $found == "no")) {
      $query = "Select * from Item Natural Join CD where name = '$itemToSearchFor'";
      $result = $db->query("$query");
      if($result->num_rows > 0) {
        $found = "yes";
        //make the table for CD attributes specifically?>
        <center>
        <table border = "1">
          <tr align = "center">
            <th> Artist </th>
            <th> Name </th>
            <th> Length </th>
            <th> Release Year </th>
            <th> Price </th>
            <th> Add To Cart / Purchase </th>
          </tr>
        </center>
        <?php
        $rows = $result->num_rows;
        for($i = 0; $i < $rows; $i++) {
          $row = $result->fetch_array();
           foreach ($row as $key=>$val):
             if($key === "artist") {
               $artist = $val;
             }
             if($key === "name") {
               $name = $val;
             }
             if($key === "length") {
               $length = $val;
             }
             if($key === "release_year") {
               $releaseYear = $val;
             }
             if($key === "price") {
               $price = $val;
             }
           endforeach;
           ?>
           <tr align = "center">
             <td> <?php echo "$artist"; ?> </td>
             <td> <?php echo "$name"; ?> </td>
             <td> <?php echo "$length"; ?> </td>
             <td> <?php echo "$releaseYear"; ?> </td>
             <td> <?php echo "$$price"; ?> </td>
             <td> <form action="addToCart.php" method = "POST">
               <input type="submit" name="addToCart" value="Add to Cart"> </td>
               </form>
             </td>
           </tr>
           <?php
        }
      }
    }
    if($category == "movies" || ($category == "all" && $found == "no")) {
      $query = "Select * from Item Natural Join movie where title = '$itemToSearchFor'";
      $result = $db->query("$query");
      if($result->num_rows > 0) {
        $found = "yes";
        //make the table for CD attributes specifically?>
        <center>
        <table border = "1">
          <tr align = "center">
            <th> Title </th>
            <th> Director </th>
            <th> Genre </th>
            <th> Rating </th>
            <th> Price </th>
            <th> Add To Cart / Purchase </th>
          </tr>
        </center>
        <?php
        $rows = $result->num_rows;
        for($i = 0; $i < $rows; $i++) {
          $row = $result->fetch_array();
           foreach ($row as $key=>$val):
             if($key === "genre") {
               $genre = $val;
             }
             if($key === "director") {
               $director = $val;
             }
             if($key === "title") {
               $title = $val;
             }
             if($key === "rating") {
               $rating = $val;
             }
             if($key === "price") {
               $price = $val;
             }
           endforeach;
           ?>
           <tr align = "center">
             <td> <?php echo "$title"; ?> </td>
             <td> <?php echo "$director"; ?> </td>
             <td> <?php echo "$genre"; ?> </td>
             <td> <?php echo "$rating"; ?> </td>
             <td> <?php echo "$$price"; ?> </td>
             <td> <form action="addToCart.php" method = "POST">
               <input type="submit" name="addToCart" value="Add to Cart"> </td>
               </form>
             </td>
           </tr>
           <?php
        }
      }
    }

    if($category == "videogames" || ($category == "all" && $found == "no")) {
      $query = "Select * from Item Natural Join video_game where title = '$itemToSearchFor'";
      $result = $db->query("$query");
      if($result->num_rows > 0) {
        $found = "yes";
        //make the table for CD attributes specifically?>
        <center>
        <table border = "1">
          <tr align = "center">
            <th> Title </th>
            <th> Publisher </th>
            <th> Platform </th>
            <th> Genre </th>
            <th> Rating </th>
            <th> Price </th>
            <th> Add To Cart / Purchase </th>
          </tr>
        </center>
        <?php
        $rows = $result->num_rows;
        for($i = 0; $i < $rows; $i++) {
          $row = $result->fetch_array();
           foreach ($row as $key=>$val):
             if($key === "genre") {
               $genre = $val;
             }
             if($key === "platform") {
               $platform = $val;
             }
             if($key === "title") {
               $title = $val;
             }
             if($key === "rating") {
               $rating = $val;
             }
             if($key === "price") {
               $price = $val;
             }
             if($key === "publisher") {
               $publisher = $val;
             }
           endforeach;
           ?>
           <tr align = "center">
             <td> <?php echo "$title"; ?> </td>
             <td> <?php echo "$publisher"; ?> </td>
             <td> <?php echo "$platform"; ?> </td>
             <td> <?php echo "$genre"; ?> </td>
             <td> <?php echo "$rating"; ?> </td>
             <td> <?php echo "$$price"; ?> </td>
             <td> <form action="addToCart.php" method = "POST">
               <input type="submit" name="addToCart" value="Add to Cart"> </td>
               </form>
             </td>
           </tr>
           <?php
        }
      }
    }

    if($found == "no") {
      echo "Sorry, we don't have that item. Try searching by category to get a more advanced search";
    }
    ?>
  <body>
</html>
