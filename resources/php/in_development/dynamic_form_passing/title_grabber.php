<?php
if (isset($_POST['zipcode']))
{
  $zipcode = $_POST['zipcode'];
  
  // Get the titles from the titleList
  $titles = "";
  if (isset($_POST['titleList']))
  {
    $titles = $_POST['titleList'];
  }
  
  // Split the titles into an array
  $titleArray = explode("</li><li>", $titles);
  // Remove the opening and closing <li> tags from the first and last elements
  $titleArray[0] = str_replace("<li>", "", $titleArray[0]);
  $titleArray[count($titleArray)-1] = str_replace("</li>", "", $titleArray[count($titleArray)-1]);

  echo "Zipcode: " . $zipcode . "<br>";
  
  // Iterate over the array and do something with each element
  foreach ($titleArray as $title)
  {
    // Do something with the title (e.g. add it to a database)
    echo $title . "<br>";
  }

  echo $titleArray;
}
?>
