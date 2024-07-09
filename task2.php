<?php
echo "Q1)";
echo " ";
for ($i = 1 ; $i<=10 ; $i++)
{
echo $i;
if($i!=10)
echo "-";
}
echo"<br>";
echo"<br>";
?> 


<?php
echo "Q2)";
echo " ";
$total = 0;
for ($i = 0 ; $i<=30 ; $i++)
{
    $total =$total + $i;
}
echo  $total;
echo"<br>";
echo"<br>";
?> 



<?php
echo "Q3)";
echo " ";
echo "<br>";
$row=5;
for ($i = 0 ; $i<5 ; $i++)
{
    for($j=0;$j<5;$j++)
    {
        if($j< $row-$i-1)
        {
            echo 'A';
        }else
        {
            echo chr(65+$i);
        }
    }
    echo "<br>";
}
echo"<br>";
echo"<br>";
?> 





<?php

echo "Q4)";
echo " ";
echo "<br>";

$row=5;
for ($i = 0 ; $i<5 ; $i++)
{
    for($j=0;$j<5;$j++)
    {
        if($j< $row-$i-1)
        {
            echo '1';
        }else
        {
            echo (1+$i);
        }
    }
    echo "<br>";
}
echo"<br>";
echo"<br>";
?> 




<?php
echo "Q5)";
echo " ";
echo "<br>";
for ($i = 1; $i<6 ; $i++)
{
    for($j=1;$j<6;$j++)
    {
        if($j===$i)
        {
            echo $i;
        }else
        {
            echo '0';
        }
    }
    echo "<br>";
}
echo"<br>";
echo"<br>";
?> 


<?php
echo "Q6)";
echo " ";
$total = 1;
for ($i = 5; $i > 0; $i--)
{
    $total = $total * $i;
}
echo $total;
echo "<br>";
echo "<br>";
?>

<?php
echo "Q7)";
echo " ";
$n = 9;
$first = 0;
$second = 1;
echo $first;
echo " ," ;
echo $second ;
echo " ," ;

for ($i = 2; $i < $n; $i++) {
    $next = $first + $second;
    echo $next ;
    echo " ," ;
    $first = $second;
    $second = $next;
}

echo "<br>";
echo "<br>";
?>


<?php
echo "Q8)";
echo " ";
$text = "Orange Coding Academy";
$length = strlen($text );
$count = 0;
for ($i = 0; $i <$length; $i++) {
if($text[$i] == "C" || $text[$i] == "c" )
{
    $count =  $count +1;
}
}
echo  $count;
echo "<br>";
echo "<br>";
?>


<?php
echo "Q9)";
echo " ";
echo "<table cellpadding='3px' cellspacing='0px' border='1' style='border-collapse: collapse;'>";
for ($i = 1; $i <= 6; $i++) {
    echo "<tr>";
    for ($j = 1; $j <= 5; $j++) {
        echo "<td> $i * $j = " ;
        echo ($i * $j) ;
        echo "</td>";
    }
    echo "</tr>";
}

echo "</table>";
echo "<br>";
echo "<br>";
?>


<?php
echo "Q10)";
echo " ";
for ($i = 1; $i <= 50; $i++) {
if($i%3==0)
{
    echo "Fizz";
}
if($i%5==0)
{
    echo "Buzz";
}else if ($i%3 !=0 && $i%5!=0)
{
    echo $i;
    echo " ";

}
}

echo "<br>";
echo "<br>";
?>


<?php
echo "Q11)";
echo " ";
echo "<br>";
$number = 1;
for ($i = 1; $i <= 5; $i++) {
 for ($j = 1; $j <= 5; $j++ )
 {
    if($j<=$i)
    {
        echo $number;
        echo " ";
        $number++;
    }else
    {
        echo " ";
        
    }
 }
 echo "<br>";
}

echo "<br>";
echo "<br>";
?>


<?php 

    echo "<br><br><br>Q12<br><br>";


    $letters = range('A', 'E'); 
    $maxRows = 5; 

    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A&nbsp;A <br>";
    for ($i = 2; $i <= $maxRows; $i++) {

        for ($j = $maxRows - $i; $j > 0; $j--) {
            echo "&nbsp;&nbsp;&nbsp;&nbsp;"; 
        }

        for ($j = 0; $j < $i; $j++) {
            echo $letters[$j] . "&nbsp;&nbsp;&nbsp;&nbsp;"; 
        }
        echo "<br>";
    }

    for ($i = $maxRows - 1; $i > 1; $i--) {

        for ($j = $maxRows - $i; $j > 0; $j--) {
            echo "&nbsp;&nbsp;&nbsp;&nbsp;"; 
        }

        for ($j = 0; $j < $i; $j++) {
            echo $letters[$j] . "&nbsp;&nbsp;&nbsp;&nbsp;"; 
        }
        echo "<br>";
    }
    echo "<br>";
    echo "<br>";
?>



<?php
echo "Q1) ";
echo " ";
$x = 49;
function prime_number($x) {
    if ($x < 2) {
        echo "$x is not a prime number";
        return;
    }

    for ($i = 2; $i <= sqrt($x); $i++) {
        if ($x % $i == 0) {
            echo "$x is not a prime number";
            return;
        }
    }
    echo "$x is a prime number";
}

prime_number($x);
echo "<br>";
echo "<br>";
?>



<?php
echo "Q2)";
echo " ";
$text = "remove";
function reverse_string ($text)
{
    echo strrev($text);
}
reverse_string  ($text);
    echo "<br>";
    echo "<br>";
?>


<?php
echo "Q3)";
echo " ";

$text = "remove";

function lower_case($text) {
    if (ctype_lower($text)) {
        echo "your string is true";
    } else {
        echo "your string is false";
    }
}
lower_case($text);
echo "<br>";
echo "<br>";
?>


<?php
echo "Q4) ";
echo " ";
function swap() {
    $x = 12;
    $y = 10;
    $f = $x;
    $x = $y;
    $y = $f;
    echo "$x , $y";
}
swap();
echo "<br>";
echo "<br>";
?>


<?php
echo "Q5) ";
echo " ";
function swap1() {
    $x = 12;
    $y = 10;
    $f = $x;
    $x = $y;
    $y = $f;
    echo "$x , $y";
}
swap1();
echo "<br>";
echo "<br>";
?>


<?php
echo "Q6) ";
function Armstrong($number) {
    $numberString = (string)$number;
    $y = strlen($numberString);
    $total = 0;

    for ($i = 0; $i < $y; $i++) {
        $x =  pow((int)$numberString[$i], 3); 
        $total = $total + $x;
    }

    if ($total == $number) { 
        echo "$number is an Armstrong number";
    } else {
        echo "$number is not an Armstrong number";
    }
}

$number = 407;
Armstrong($number);
echo "<br>";
echo "<br>";
?>


<?php
echo "Q7) ";
function palindrome($text) {
    $lowercaseStr = strtolower($text);
    $text1 = preg_replace('/[^a-zA-Z]/', '', $lowercaseStr);
    $reverse = strrev($text1);
    if ($text1 == $reverse) {
        echo "Yes, it is a palindrome.";
    } else {
        echo "No, it is not a palindrome.";
    }
}
$text = "Eva , can i see bees in a cave ?";
palindrome($text);
echo "<br>";
echo "<br>";
?>


<?php
echo "Q8) ";
function remove_duplicates($array1) {
    $uniqueArray = array_unique($array1);
    $result = implode(', ', $uniqueArray);
    echo $result;
}
$array1 = array(2, 4, 7, 4, 8, 4);
remove_duplicates($array1);

echo "<br>";
echo "<br>";
?>



