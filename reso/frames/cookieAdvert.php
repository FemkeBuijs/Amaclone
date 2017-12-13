<script type='text/javascript' src='reso/static/js/cookies.js'> </script>
<?php
// This is a function which finds the index of the maximum element in an array
function findMaxIndex($arr){
  $max = 0;
  for ($j=1; $j<sizeof($arr); $j++){
    if ($arr[$j]>$arr[$max]){
      $max= $j;
    }
  }
  return $max;
}


$mainAdvert = $_COOKIE['cartAdd'];
if($mainAdvert == null){
  // Insert a default advert here
} else {
  $cartAddArray = explode(':',$mainAdvert);
  $idList = [];
  $clicksList = [];
  for ($i=0; $i<sizeof($cartAddArray)-1; $i++){
    if ($i%2===0){
      array_push($idList, explode(' ',$cartAddArray[$i])[1]);
    } else {
      array_push($clicksList, explode(' ', $cartAddArray[$i])[1]);
    }
  }
  if (sizeof($idList)>=3){
  $topThree = [];
  $topThreeId =[];
  for ($t=0; $t<3; $t++){
  array_push($topThree, findMaxIndex($clicksList));
  array_push($topThreeId, $idList[$topThree[$t]]);
  $clicksList[$topThree[$t]]=0;
}
  echo $topThreeId;

} else {

}

}
$secondAdvert = $_COOKIE['descView'];
if($secondAdvert == null){
  // Insert a default advert here
} else {
  $descViewArray = explode(':',$secondAdvert);
  var_dump($descViewArray);
  $idList = [];
  $clicksList = [];
  for ($i=0; $i<sizeof($descViewArray)-1; $i++){
    if ($i%2===0){
      var_dump(explode(' ',$descViewArray[$i]));
      array_push($idList, explode(' ',$descViewArray[$i])[1]);
    } else {
      var_dump(explode(' ', $descViewArray[$i]));
      array_push($clicksList, explode(' ', $descViewArray[$i])[1]);
    }
  }
  var_dump($idList);
  if (sizeof($idList)>=3){
  $topThree = [];
  $topThreeId =[];
  for ($t=0; $t<3; $t++){
  array_push($topThree, findMaxIndex($clicksList));
  array_push($topThreeId, $idList[$topThree[$t]]);
  $clicksList[$topThree[$t]]=0;
}
  var_dump($topThreeId);
setlocale(LC_MONETARY, 'en_GB');
$advertQuery = "SELECT * FROM products WHERE product_id IN (".join(', ', $topThreeId).");";
$advertResults = mysqli_query($con, $advertQuery);
$advertResults = mysqli_fetch_all($advertResults, MYSQLI_ASSOC);
var_dump($advertResults);
echo '<h1> Last chance to  buy! </h1>';
echo '<div class="container">';
echo '<div class = "row">';
for ($a=0; $a<3; $a++){
  echo '<div class="col-lg-4">';
  echo '<h2> '.$advertResults[$a]["title"].'</h2>';
  echo '<img src="'.$advertResults[$a]["img"].'"/>';
  echo '<h3> Special price: £'.(money_format('%.2n', 0.95*$advertResults[$a]["price"])).'! </h3>';
  echo '</div>';
}
echo '</div>';
echo '</div>';
} else {

}

}
?>
