<?php
/*Configuration Settings*/


define('DB_HOST', 'localhost'); /*Database Server*/
define('DB_NAME', 'cl53-casualadm'); /*Database Name*/
define('DB_USER', 'cl53-casualadm'); /*Database Username*/
define('DB_PWD',  'nERF-!kh9'); /*Database Password*/

$siteTitle = 'PlaceHolder_siteTitle';
$siteFooter= 'PlaceHolder_siteFooter';
$siteBrand=  'PlaceHolder_siteBrand';
$siteAddress= 'PlaceHolder_siteAddress';
$siteShortTitle = 'PlaceHolder_siteShortTitle';


  /*Prepare Query to pull current settings from SiteConfig*/
  $sql="SELECT ConfigName
              ,ShortTextValue
        FROM SiteConfig";
  /*echo '<br>sql :'.$sql;*/
 
  $link = connectDB();


/*Run the query, if ConfigName matches ‘siteBrand, then set $siteBrand to ShortTextValue returned in from the query*/
  if ($result = mysqli_query($link,$sql)){
      while ($row = mysqli_fetch_array($result))  {
        if ($row[0] == 'siteTitle')  { $siteTitle = $row[1];}
        if ($row[0] == 'siteFooter') { $siteFooter = $row[1];}
        if ($row[0] == 'siteBrand') { $siteBrand = $row[1];}
        if ($row[0] == 'siteAddress') { $siteAddress = $row[1];}
        if ($row[0] == 'siteShortTitle') { $siteShortTitle = $row[1];}
      } 
  }

  /*Close database connection*/
	mysqli_close ( $link );

?>
