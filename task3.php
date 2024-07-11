<?php
echo "Q1)";
echo " ";

$array = ["red","green","white"];
echo " The memory of that scene for me is like a frame of film forever frozen at that moment: the $array[0]
 carpet, the $array[1] lawn, the $array[2] house, the leaden sky. The new president and his first lady.
Richard M. Nixon";
echo "<br>";
echo "<br>";
?>



<?php
echo "Q2)";
echo " ";
$colors = array('white', 'green', 'red');
echo "<ul>";
echo "<li>$colors[1]</li>";
echo "<li>$colors[2]</li>";
echo "<li>$colors[0]</li>";
echo "</ul>";
echo "<br>";
echo "<br>";
?>


<?php
echo "Q3)";
echo " ";
echo "<br>";
$cities= array( "Italy"=>"Rome", "Luxembourg"=>"Luxembourg", "Belgium"=> "Brussels",
"Denmark"=>"Copenhagen", "Finland"=>"Helsinki", "France" => "Paris",
"Slovakia"=>"Bratislava", "Slovenia"=>"Ljubljana", "Germany" => "Berlin", "Greece" =>
"Athens", "Ireland"=>"Dublin", "Netherlands"=>"Amsterdam", "Portugal"=>"Lisbon",
"Spain"=>"Madrid" );

echo "The capital of Netherlands is " ;
echo $cities["Netherlands"];
echo "<br>";
echo "The capital of Greece is " ;
echo $cities["Greece"];
echo "<br>";
echo "The capital of Germany is " ;
echo $cities["Germany"];
echo "<br>";
echo "<br>";
?>



<?php
echo "Q4)";
echo " ";
$color = array (4 => 'white', 6 => 'green', 11=> 'red');
echo $color[4];
echo "<br>";
echo "<br>";
?>


<?php
echo "Q5)";
echo " ";
$color = array (1,2,3,4,5);
$newItem = "$";
$location = 2;
array_splice($color, $location, 0, $newItem);
print_r($color);
echo "<br>";
echo "<br>";
?>


<?php
echo "Q6)";
echo " ";
$fruits = array("d" => "lemon","a" => "orange","b" => "banana","c" => "apple");
asort($fruits);
print_r($fruits);
echo "<br>";
echo "<br>";
?>



<?php
echo "Q7)";
echo " ";
$temp = array(  78, 60, 62, 68, 71, 68, 73, 85, 66, 64, 76, 63, 75, 76, 73, 68, 62, 73, 72, 65, 74, 62, 62,65, 64, 68, 73, 75, 79, 73);
$total = 0;
$count = count($temp);
$total = array_sum($temp);
$count = count($temp);
$avg = $total / $count;
echo "Average Temperature is: " . $avg;
echo "<br>";
sort($temp);
$lowest_temperatures = array_slice($temp, 0, 5);
echo "List of five lowest temperatures: " . implode(", ", $lowest_temperatures) ;
echo "<br>";
$highest_temperatures = array_slice($temp, -5);
echo "List of five highest temperatures: " . implode(", ", $highest_temperatures) ;
echo "<br>";
echo "<br>";
?>



<?php
echo "Q8)";
echo " ";
$array1 = array("color" => "red", 2, 4);
$array2 = array("a", "b", "color" => "green", "shape" => "trapezoid", 4);
$merged_array = array_merge($array1, $array2);
echo "Merged Array:";
print_r($merged_array);
echo "<br>";
echo "<br>";
?>

<?php
echo "Q9)";
echo " ";
function convertStringsToUpperCase($array) {
    foreach ($array as $key => $value) {
        if (is_string($value)) {
            $array[$key] = strtoupper($value);
        }
    }
    return $array;
}

$colors = array("red", "blue", "white", "yellow");
$uppercaseColors = convertStringsToUpperCase($colors);
echo "Expected Output:\n";
print_r($uppercaseColors);
echo "<br>";
echo "<br>";
?>


<?php
echo "Q10)";
echo " ";
function convertStringsTolowerCase($array) {
    foreach ($array as $key => $value) {
        if (is_string($value)) {
            $array[$key] = strtolower($value);
        }
    }
    return $array;
}

$colors = array("red", "blue", "white", "yellow");
$lowercaseColors = convertStringsTolowerCase($colors);
echo "Expected Output:\n";
print_r($lowercaseColors);
echo "<br>";
echo "<br>";
?>


<?php
echo "Q11)";
echo " ";
for ( $i = 200; $i<=250 ; $i++)
{
    if($i % 4 == 0)
    {
        echo $i;
        echo " ";
    }
}
echo "<br>";
echo "<br>";
?>


<?php
echo "Q12)";
echo " ";
 $words = array("abcd","abc","de","hjjj","g","wer");
$shortestLength = PHP_INT_MAX; 
$longestLength = 0;
foreach ($words as $words) {
    $length = strlen($words);
    if ($length < $shortestLength) {
        $shortestLength = $length;
    }
    
    if ($length > $longestLength) {
        $longestLength = $length;
    }
}

echo "Shortest string length:" . $shortestLength;
echo " .  ";
echo "Longest string length:" . $longestLength; 
echo "<br>";
echo "<br>";
?>

<?php
echo "Q13)";
echo " ";
$minRange = 11;
$maxRange = 20;
$number = [];
for($i = $minRange; $i <= $maxRange; $i++) {
    array_push($number, $i);
}
shuffle($number);
echo implode(', ', $number);
echo "<br>";
echo "<br>";
?>



<?php
echo "Q14)";
echo " ";
$array1 = array( 2, 0, 10, 12, 6) ;
$count = count($array1);
$lowest_integer =$array1[0];
for ($i=1 ; $i<$count  ; $i++) 
{
    if ($array1[$i]<$lowest_integer && $array1[$i]!=0)
    {
        $lowest_integer =$array1[$i];
    }
}
echo $lowest_integer;
echo "<br>";
echo "<br>";
?>


<?php
echo "Q15)";
echo " ";
$Inputarray = array(5, 3, 1, 3, 8, 7, 4, 1, 1, 3);
$count = count($Inputarray);
for ($i = 0; $i < $count - 1; $i++) {
    for ($j = $i + 1; $j < $count; $j++) {
        if ($Inputarray[$j] < $Inputarray[$i]) {
            $x = $Inputarray[$i];
            $Inputarray[$i] = $Inputarray[$j];
            $Inputarray[$j] = $x;
        }
    }
}
print_r($Inputarray);
echo "<br>";
echo "<br>";
?>


<?php
echo "Q16)";
echo " ";
echo "<br>";
function floorDecimal($number, $precision, $separator) {
    $parts = explode($separator, $number);
    if (count($parts) != 2) {
        return "Invalid number format";
    }
    $intPart = $parts[0];
    $decPart = $parts[1];
    $flooredDecPart = substr($decPart, 0, $precision);

    $result = $intPart . $separator . $flooredDecPart;

    return $result;
}

$numbers = [
    "1.155",
    "100.25781",
    "-2.9636"
];
$precisions = [
    2,
    4,
    3
];
$separators = [
    ".",
    ".",
    "."
];

foreach ($numbers as $key => $number) {
    $precision = $precisions[$key];
    $separator = $separators[$key];
    $flooredNumber = floorDecimal($number, $precision, $separator);
    echo " $flooredNumber";
    echo "<br>";
}
echo "<br>";
echo "<br>";
?>


<?php
echo "Q17)";
echo " ";
function mergeUniqueLists($list1, $list2) {
    $array1 = array_filter(array_map('trim', explode(',', $list1)));
    $array2 = array_filter(array_map('trim', explode(',', $list2)));
    $mergedArray = array_unique(array_merge($array1, $array2));
    return implode(', ', $mergedArray);
}
$list1 = "4, 5, 6, 7";
$list2 = "4, 5, 7, 8";
$mergedList = mergeUniqueLists($list1, $list2);

echo  $mergedList;
echo "<br>";
echo "<br>";
?>


<?php
echo "Q18)";
echo " ";
$array1 = array(4, 5, 6, 7, 4, 7, 8);
$array1 = array_unique($array1);
print_r($array1);
echo "<br>";
echo "<br>";
?>

<?php
echo "Q19)";
echo " ";
function isSubset($array1, $array2) {
    $set1 = array_flip(array_unique($array1));
    $set2 = array_flip(array_unique($array2));
    
    foreach ($set2 as $element => $value) {
        if (!isset($set1[$element])) {
            return false;
        }
    }
    return true;
}

$array1 = ['a', '1', '2', '3', '4'];
$array2 = ['a', '3'];

if (isSubset($array1, $array2)) {
    echo "[ 'a', '3' ] is a subset of [ 'a', '1', '2', '3', '4' ]";
} 

if (isSubset($array2, $array1)) {
    echo "[ 'a', '1', '2', '3', '4' ] is a subset of [ 'a', '3' ]";
} 
echo "<br>";
echo "<br>";
?>



