<?php ini_set('display_errors', 1); ?>

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

<link rel="stylesheet" type="text/css" href="directoryStyle.css"/>


<script type="text/javascript">

function updateTable(email) { //Ajax call to update the table to read by the user
  //alert("Inside update table");
  //alert(arguments[0]);
   $.ajax({ //makes the directory update with the newest row
       url: 'readBuy.php',
       type: 'POST',
       dataType: 'json',
       data: ({userName: email}),
       success: function (response) {
       var trHTML = "";
       $.each(response, function (i, val) {
         //CDs have names, movies and videogames have titles
         if(typeof val.title !== 'undefined') {
            trHTML += "<tr><td>" + val.title + "</td><td>" + val.price + "</td><td>" + val.Count + "</td><td>" + "<div class='btn-group'><button id='delete-" + val.item_id
             + "' type='button' class='btn-md' onClick=\"(deleteClick('" + val.item_id + "," + email + "'))\">Delete</button></div> </td>" +  "</tr>";
         } else if(typeof val.name !== 'undefined') {
           trHTML += "<tr><td>" + val.name + "</td><td>" + val.price + "</td><td>" + val.Count + "</td><td>" + "<div class='btn-group'> <button id='delete-" + val.item_id
            + "' type='button' class='btn-md' onClick=\"(deleteClick('" + val.item_id  + "," + email + "'))\">Delete</button></div> </td>" +  "</tr>";
         }
       });
       ($("#table tbody")).html(trHTML); //changes the contents of the table body to add the html rows filled in with the data from the JSON object
   },
     error:function(exception){alert(exception)}
   });
}

function deleteClick(a, b){ //function that handles when the "Delete" button is clicked
    var deleteConfirm = confirm("Are you sure you want to delete this entry? This cannot be undone.");
    if (deleteConfirm == true) {
      var id = "";
      var email = "";
      var found = 0;
      for(var i = 0; i < a.length; i++) {
        if(found == 0) {
          var n = a.charAt(i);
          if(n != ",") {
            id += n;
          } else {
            found = 1;
          }
        } else {
          var n = a.charAt(i);
          email += n;
        }
      }
      //alert(id);
      //alert(email);

         $.ajax({ //submits the values that were entered into the JavaScript form above by the user to be processed by processCreate.php
          type: "POST",
          url:"deleteBuy.php",
          data: {id: id, email: email},
          success:function(data) {
              //alert("HEy, we made it into update");
              setTimeout(updateTable(email), 3000); //Allows the database time to process the update
          }
       });

    }
}

$( document ).ready(function() {



//Ajax request to get the json data of the mysql results from read.php and display it on the table
var email = '<?php session_start(); echo $_SESSION['email'];?>';
$.ajax({
    url: 'readBuy.php',
    type: 'POST',
    dataType: 'json',
    data: ({userName: email}),
    success: function (response) {
        var trHTML = "";
        $.each(response, function (i, val) {
          //CDs have names, movies and videogames have titles
          if(typeof val.title !== 'undefined') {
             trHTML += "<tr><td>" + val.title + "</td><td>" + val.price + "</td><td>"  + val.Count + "</td><td>" + "<div class='btn-group'><button id='delete-" + val.item_id
              + "' type='button' class='btn-md' onClick=\"(deleteClick('" + val.item_id + "," + email + "'))\">Delete</button></div> </td>" +  "</tr>";
          } else if(typeof val.name !== 'undefined') {
            trHTML += "<tr><td>" + val.name + "</td><td>" + val.price + "</td><td>" + val.Count + "</td><td>" + "<div class='btn-group'> <button id='delete-" + val.item_id
             + "' type='button' class='btn-md' onClick=\"(deleteClick('" + val.item_id  + "," + email + "'))\">Delete</button></div> </td>" +  "</tr>";
          }
        });
        ($("#table tbody")).html(trHTML); //changes the contents of the table body to add the html rows filled in with the data from the JSON object
    	},
	error:function(exception){alert(exception)}
});
});





function finalCheckout(email) {
  // alert("HEY");
  // alert(arguments[0]);
  // alert(email);
   $.ajax({ //makes the directory update with the newest row
       url: 'updateSell.php',
       type: 'POST',
       dataType: 'json',
       data: ({email: email}),
       success: function (response) {
         alert("Thanks for being our loyal customer. We hope there are more Papayas in your future!");
       },
       error:function(exception){alert(exception)}
    });








  window.location.replace("index.html");
}

function back() {
  window.location.replace("index.html");
}

</script>



 <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shopping Cart</title>

    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <div class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="user-menu">
                        <ul>
                          <li><a href="index.html"><i class="fa fa-user"></i>  Home</a></li>
                            <li><a href="login.php"><i class="fa fa-user"></i> Login</a></li>
                            <li><a href="logout.php"><i class="fa fa-user"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="header-right">

                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End header area -->

    <div class="site-branding-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="logo">
                        <h1><a href="index.html">Papaya</a></h1>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="shopping-item">
                        <a href="checkout.php">Shopping Cart<i class="fa fa-shopping-cart"></i></a>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div> <!-- End site branding area -->

    <div class="mainmenu-area">
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="movies.php">Movies</a></li>
                        <li><a href="music.php">Music</a></li>
                        <li><a href="videoGames.php">Video Games</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div> <!-- End mainmenu area -->

    <!--div class="promo-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo">
                        <i class="fa fa-refresh"></i>
                        <p>30 Days return</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo">
                        <i class="fa fa-truck"></i>
                        <p>Free shipping</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo">
                        <i class="fa fa-lock"></i>
                        <p>Secure payments</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo">
                        <i class="fa fa-gift"></i>
                        <p>New products</p>
                    </div>
                </div>
            </div>
        </div>
    </div--> <!-- End promo area -->


</head>
<br/>
  <h1> My Shopping Cart</h1>
  <br />
<div id="editPopup"></div>


<div class="container-fluid">



<title>My Cart</title>
</head>

<div id="editPopup"></div>


<div class="container-fluid">

<table class="table table-striped table-bordered table-condensed table-responsive" id="table" width="75%">
  <thead>
     <tr height="30px">
        <td colspan="6">
           <div id="buttonLeft">
            Total price:
           </div>
           <div id="buttonRight">
             <button type="button" onClick="finalCheckout('<?php echo $_SESSION['email'] ?>')">Checkout</button>
           </div>
        </td>
    </tr>

  <tr>
<th> Item </th>
<th> Price </th>
<th> Quantity </th>


  <tbody>
  </tbody>

</table>

            </div>
        </div>
    </div> <!-- End product widget area -->

    <!--div class="footer-top-area">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="footer-about-us">
                        <h2><span>Papaya</span></h2>
                        <p>Helping you find the electronic entertainment you need.</p>
                    </div>
                </div>

            </div>
        </div>
        <p1> CS 4750 Project</p1>
        <br/>
        <br/>
         <p2>Jeffrey Chiang (jac7mc), Michael Mahoney (mjm5qu), James Wu (jw3qz)<p2>
        <br/>
        <br/>
        <p3> Professor Basit Spring 2016</p3>

    </div--> <!-- End footer top area -->
    <!-- Latest jQuery form server -->
    <script src="https://code.jquery.com/jquery.min.js"></script>

    <!-- Bootstrap JS form CDN -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <!-- jQuery sticky menu -->
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.sticky.js"></script>

    <!-- jQuery easing -->
    <script src="js/jquery.easing.1.3.min.js"></script>

    <!-- Main Script -->
    <script src="js/main.js"></script>



</body>

</html>
