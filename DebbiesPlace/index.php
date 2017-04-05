<?php
require_once('SQLFunctions.php');
session_start();


/*if there is no Currnet Navigation set, default to the first on on the list based on order*/
if(!isset($_SESSION['CurNav']))
{ 	echo "CurNav Not Set <br>";/*this is a testing comment*/
    $sql="SELECT Nav_ID
                ,Display_Order 
                ,Nav_Title
          FROM Nav
          ORDER BY Display_Order 
                ,Nav_Title
          LIMIT 1";
    $link = connectDB();
    /*run query, assign the session variable*/
     if ($result = mysqli_query($link,$sql)){
      while ($row = mysqli_fetch_array($result))  {
          $_SESSION['CurNav'] = $row[0];
      } 
    }
    mysqli_close ( $link );
}
/*Set $CurNav variable to the value of the CurNav session variable*/
$CurNav = $_SESSION['CurNav'];




/*Simlar to CRUD, logging out the users that haven't been active in the last 10 mins*/
if(isset($_SESSION['user_id']))
{
    if ($_SESSION['timeout'] + 10 * 60 < time()) {
      /* session timed out */
      header("Location: Logout.php"); 
    } else {
      $_SESSION['timeout'] = time();
      /*For convinience, adding a button to get back to the AdminInxed.php page*/
      echo  "<a href='AdminIndex.php'><button>Admin Menu</button></a>";
    }
}
?>


<!-- The following CSS aligns the Navigation buttons to display side by side, in the 
     middle of the screen with similar color, and font as the original navigation -->
<style type="text/css">
.NavMenu div {
  float:left;
}
.NavMenu {
  float: right;
  position: relative;
  left: -50%; 
}
.NavMenu > .child {
  position: relative;
  left: 50%;
}


input[type=submit] {
  text-transform: uppercase;
  font-weight: 400;
  letter-spacing: 3px;
  margin:5px;
  margin-top: 20px;
}
</style>




<html lang="en">


<head>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $siteTitle; ?></title>


    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">


    <!-- Custom CSS -->
    <link href="css/business-casual.css" rel="stylesheet">


    <!-- Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>


<body>


    <div class="brand"><?php echo $siteBrand; ?></div>
    <div class="address-bar"><?php echo $siteAddress; ?></div>


    <!-- Navigation -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
                <a class="navbar-brand" href="index.php"><?php echo $siteShortTitle; ?></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling 
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li>
                        <a href="about.html">About</a>
                    </li>
                    <li>
                        <a href="blog.html">Blog</a>
                    </li>
                    <li>
                        <a href="contact.html">Contact</a>
                    </li>
                </ul>
            </div>-->
            <!-- /.navbar-collapse -->
            
<!--Foote Cust BEGIN-->
<?php 
  /*Query Navigation*/
	$sql="SELECT Nav_Title
	            ,Nav_ID
        FROM Nav
        ORDER BY Display_Order 
                ,Nav_Title";
	/*echo '<br>sql :'.$sql;*/
 	$link = connectDB();
/*Pull in our custom CSS using div class*/ 	
echo "<div class='NavMenu'>";
  echo "<div class='child'>";
  if ($result = mysqli_query($link,$sql)){
      /*Each row returned will get it's own div with a form contained in it.  
        They will act as dynamic buttons sending the user to UpdateCurNav.php*/
      while ($row = mysqli_fetch_array($result))  {
        echo "<div>
                <form action='UpdateCurNav.php' method='post'>
                  <input type='submit' class='btn' name='submit' value='{$row[0]}'>
                  <input type='hidden' name='NewNav' value='{$row[1]}'>
                </form>
              </div>";
      } 
    }
  echo "</div>" ;   
echo "</div>" ;   
  /*Close database connection*/
	mysqli_close ( $link );
?>
<!--Foote Cust END -->
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>


    <div class="container">


        <div class="row">
            <div class="box">
                <div class="col-lg-12 text-center">
                    <div id="carousel-example-generic" class="carousel slide">
                        <!-- Indicators -->
                        <ol class="carousel-indicators hidden-xs">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                        </ol>


                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <div class="item active">
                                <img class="img-responsive img-full" src="img/slide-1.jpg" alt="">
                            </div>
                            <div class="item">
                                <img class="img-responsive img-full" src="img/slide-2.jpg" alt="">
                            </div>
                            <div class="item">
                                <img class="img-responsive img-full" src="img/slide-3.jpg" alt="">
                            </div>
                        </div>


                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                            <span class="icon-prev"></span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                            <span class="icon-next"></span>
                        </a>
                    </div>
                    <h2 class="brand-before">
                        <small>Welcome to</small>
                    </h2>
                    <h1 class="brand-name"><?php echo $siteShortTitle; ?></h1>
                    <hr class="tagline-divider">
                    <h2>
                        <small>By
                            <strong>Start Bootstrap</strong>
                        </small>
                    </h2>
                </div>
            </div>
        </div>


<!--        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Build a website
                        <strong>worth visiting</strong>
                    </h2>
                    <hr>
                    <img class="img-responsive img-border img-left" src="img/intro-pic.jpg" alt="">
                    <hr class="visible-xs">
                    <p>The boxes used in this template are nested inbetween a normal Bootstrap row and the start of your column layout. The boxes will be full-width boxes, so if you want to make them smaller then you will need to customize.</p>
                    <p>A huge thanks to <a href="http://join.deathtothestockphoto.com/" target="_blank">Death to the Stock Photo</a> for allowing us to use the beautiful photos that make this template really come to life. When using this template, make sure your photos are decent. Also make sure that the file size on your photos is kept to a minumum to keep load times to a minimum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc placerat diam quis nisl vestibulum dignissim. In hac habitasse platea dictumst. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
                </div>
            </div>
        </div>-->


<!--         <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr><h2 class="intro-text text-center">Beautiful boxes <strong>to showcase your content</strong></h2>
                    <hr>
                   <p>Use as many boxes as you like, and put anything you want in them! They are great for just about anything, the sky's the limit!</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc placerat diam quis nisl vestibulum dignissim. In hac habitasse platea dictumst. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>-->
<?php 
    /*Query Content for the Current Navigation*/
	$sql="SELECT ContentTitle
	            ,Content
          FROM Content
          WHERE Nav_ID = ".$CurNav."
          ORDER BY Display_Order";
   /*echo '<br>sql :'.$sql;*/
 
 	$link = connectDB();


  /*Execute the query, for each row returned, display a box with the results of the content in it.*/
  if ($result = mysqli_query($link,$sql)){
      while ($row = mysqli_fetch_array($result))  {
          echo "<div class='row'>";
          echo "  <div class='box'>";
          echo "    <div class='col-lg-12'>";
          echo "      <hr><h2 class='intro-text text-center'><strong>{$row[0]}</strong></h2><hr>";
          echo "<p>{$row[1]}</p>";
          echo "</div>";
          echo "</div>";
          echo "</div>";
      } 
    }
    
  /*Close database connection*/
	mysqli_close ( $link );
?>                       


    </div>
    <!-- /.container -->


    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p><?php echo $siteFooter; ?></p>
                </div>
            </div>
        </div>
    </footer>


    <!-- jQuery -->
    <script src="js/jquery.js"></script>


    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>


    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>


</body>


</html>

