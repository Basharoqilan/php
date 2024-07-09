<?php
echo "Q1 a)";
echo " ";
echo strtoupper("Hello world!");
echo"<br>";
echo"<br>";
?> 
 
 <?php
echo "Q1 b)";
echo " ";
echo strtolower("Hello world!");
echo"<br>";
echo"<br>";
?> 

<?php
echo "Q1 c)";
echo " ";
echo ucfirst("hello world!");
echo"<br>";
echo"<br>";
?> 

<?php
echo "Q1 d) ";
echo " ";
echo ucwords("Hello world!");
echo"<br>";
echo"<br>";
?> 


<?php
echo "Q2) ";
echo " ";

$datestring = "20240715";

$year = substr($datestring, 0, 4);
$month = substr($datestring, 4, 2);
$day = substr($datestring, 6, 2);
echo $year . ":" . $month . ":" . $day;
echo "<br><br>";
?>


<?php
echo "Q3)";
echo " ";
$sentence = "i am a full stack developer at orange coding academy ";
$word = "orange";
if (strpos($sentence,$word))
{
    echo"The sentence contains the word '$word' ";
}
echo"<br>";
echo"<br>";
?> 



<?php
echo "Q4)";
echo " ";
$filepath = "www.orange.com/index.php";
$filename = basename($filepath);
echo " the filename is $filename";
echo"<br>";
echo"<br>";
?> 


<?php
echo "Q5)";
echo " ";
$email = "info@oeange.com";
$username =explode('@',$email)[0];
echo " the username is $username";
echo"<br>";
echo"<br>";
?> 



<?php
echo "Q6)";
echo " ";
$email = "info@oeange.com";
$substring = substr($email, -3);
echo " $substring";
echo"<br>";
echo"<br>";
?> 



<?php
echo "Q7)";
echo " ";
$password_chars = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
$password_length = 10;
$password = '';
$random_bytes = random_bytes($password_length);
$random_ints = unpack('C*', $random_bytes);
foreach ($random_ints as $byte) {
    $password .= $password_chars[$byte % strlen($password_chars)];
}
echo "Random Password: " . $password;
echo"<br>";
echo"<br>";
?>


<?php
echo "Q8)";
echo " ";
$sentence = "that new trainee is so genius";
$oldword = "that";
$newword = "Our";
$newsentence = str_replace($oldword,$newword,$sentence);
echo "$newsentence ";
echo"<br>";
echo"<br>";
?>



<?php
echo "Q9)";
echo " ";
$string1 = "dragonball";
$string2 = "dragonboll";
for ($i = 0; $i < strlen($string1) && $i < strlen($string2); $i++) {
    if ($string1[$i] !== $string2[$i]) {
       $Letter1 =  $string1[$i];
       $Letter2 = $string2[$i];
        $first_difference = $i; 
        break; 
    }
}
echo "First difference between two strings at position: $first_difference : '$Letter1' vs '$Letter2' ";
echo "<br>";
echo "<br>";
?>


<?php
echo "Q10)";
echo " ";
$string = "Twinkle, twinkle, twinkle , littlestar";
$array = explode(', ', $string);
var_dump($array);
echo "<br>";
echo "<br>";
?>

<?php
echo "Q11)";
echo " ";
$input = 'a'; 
echo "'$input'<br>";
$ascii = ord($input);    
$nextAscii = $ascii + 1;
$nextChar = chr($nextAscii);
echo " '$nextChar'  <br>";
$input = 'z'; 
echo "'$input'<br>";
$ascii = ord($input);    
if ($input == 'z') {
    $nextAscii = ord('a');
}
$nextChar = chr($nextAscii);
echo " '$nextChar'  <br>";
echo "<br>";
echo "<br>";
?>

<?php
echo "Q12)";
echo " ";
$text = 'the brown fox';
$insertString = 'quick ';
$beforeString = 'the';
$afterString = 'brown';
$insertPositionStart = strpos($text, $beforeString) + strlen($beforeString . ' ');
$insertPositionEnd = strpos($text, $afterString, $insertPositionStart);
$text = substr_replace($text, $insertString, $insertPositionStart, 0);
echo  "'$text'";
echo "<br>";
$substring = 'the';  
$position = strpos($text, $substring);
echo "'$substring'";
echo "<br>";
echo "<br>";
?>

<?php
echo "Q13)";
echo " ";
$number = '0000657022.24';
$number = str_replace('0', '', $number);
echo "$number";
echo "<br>";
echo "<br>";
?>

<?php
echo "Q14)";
echo " ";
$text = 'the quick brown fox jumps over the lazy dog';
$text = str_replace('fox', '', $text);
echo "$text";
echo "<br>";
echo "<br>";
?>


<?php
echo "15)";
echo " ";
$text = '\'\1+2\3^2.2-3/4^3';
$text = preg_replace('/[^\p{L}\p{N}\s]/u', '', $text);
echo "$text";
echo "<br>";
echo "<br>";
?>

<?php
echo "16)";
echo " ";
$text = 'the quick brown fox jumps over the lazy dog';
$words = explode(' ', $text);
$first_five_words = array_slice($words, 0, 5);
$result_text = implode(' ', $first_five_words);
echo "$result_text"; 
echo "<br>";
echo "<br>";
?>


<?php
echo "17)";
echo " ";
$text = '2,543.12';
$text = preg_replace('/,/', '', $text);
echo "$text";
echo "<br>";
echo "<br>";
?>



<?php
echo "Q18)";
echo " ";
$input = 'a';
for ($i = 0; $i <= 25; $i++) {
    echo $input;
    echo " ";
    $input++;
}
echo "<br>";
echo "<br>";

?>

  
<?php
echo "Q19)";
echo " ";
$input = 'the quick brown fox jumps over the lazy dog---';
$text = preg_replace('/-/', '', $input);
echo "$text";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
?>




<?php
/*logical statements and operator*/
echo "Q1)";
echo " ";
$leap_year = 2013;
if ($leap_year %4===0) {
    echo "this year is a leap year";
}else{
    echo "this year is not a leap year";
}
echo "<br>";
echo "<br>";
?>

<?php
echo "Q2)";
echo " ";
$temp = 27;
if ($temp <= 20) {
    echo "it is winter time";
}else{
    echo "it is summer time";
}
echo "<br>";
echo "<br>";
?>


<?php
echo "Q3)";
echo " ";
$first_integer= 2;
$second_integer= 2;
$result = 0;
if ($first_integer == $second_integer) {
    $result = ($first_integer + $second_integer) *3;
    echo "$result";
}else{
    $result = $first_integer + $second_integer ;
    echo "$result";
}
echo "<br>";
echo "<br>";
?>


<?php
echo "Q4)";
echo " ";
$first_integer= 10;
$second_integer= 10;
$result = 0;
if ($first_integer + $second_integer == 30) {
    echo "true";
}else{
    echo "false";
}
echo "<br>";
echo "<br>";
?>



<?php
echo "Q5)";
echo " ";
$number= 20;
if ($number % 3 == 0) {
    echo "true";
}else{
    echo "false";
}
echo "<br>";
echo "<br>";
?>


<?php
echo "Q6)";
echo " ";
$number= 50;
if ($number >= 20 && $number <= 50  ) {
    echo "true";
}else{
    echo "false";
}
echo "<br>";
echo "<br>";
?>



<?php
echo "Q7)";
echo " ";
$arr = [1, 5, 9];
$arr_len = count($arr); 
$largest_number = $arr[0]; 
for ($i = 1; $i < $arr_len; $i++) {
    if ($arr[$i] > $largest_number) {
        $largest_number = $arr[$i];
    }
}
echo " $largest_number";

echo "<br>";
echo "<br>";
?>



<?php
echo "Q8)";
echo " ";
$unit = 250; 
if ($unit > 0&& $unit <= 50) {
    $monthly_electricity = $unit * 2.5;
    echo "$monthly_electricity";
} 
else if ($unit > 50 && $unit <= 150) {
    $first_number = 125;
    $monthly_electricity = (($unit - 50) * 5) + $first_number ;
    echo "$monthly_electricity";
} 
else if ($unit > 150 && $unit <= 250) {
    $first_number = 125;
    $second_number =500;
    $monthly_electricity = (($unit - 150) * 6.2) + $first_number+  $second_number;
    echo " $monthly_electricity";
} 
else if ($unit > 250) {
    $first_number = 125;
    $second_number =500;
    $therd_number = 620;
    $monthly_electricity = (($unit - 250) * 7.5)+ $first_number+$second_number+$therd_number;
    echo " $monthly_electricity";
} 
echo "<br>";
echo "<br>";
?>

<?php
echo "Q9)";
echo " ";
echo "<br>";

$number1= 10;
$number2= 10;
$s = 1;
switch($s)
{
 case 1 :
    $Add = $number1 + $number2;
    echo "$Add";
    echo "<br>";
    break;

    case 2 :
    $sub = $number1 - $number2;
    echo "$sub";
    echo "<br>";
    break;

    case 3 :
   $multp = $number1 * $number2;
   echo " $multp";
   echo "<br>";
   break;

   case 4 :
   $div = $number1 / $number2;
    echo " $div ";
    echo "<br>";
    break;

}
   

echo "<br>";
echo "<br>";
?>


<?php
echo "Q10)";
echo " ";
$age= 20;
if($age >= 18)
{
echo "is eligible to vote ";
}else
{
    echo "is no eligible to vote ";

}
  
echo "<br>";
echo "<br>";
?>


<?php
echo "Q11)";
echo " ";
$whether= -60;
if($whether >= 0)
{
echo "positive";
}else
{
    echo "negative ";

}
  
echo "<br>";
echo "<br>";
?>




<?php
echo "Q12)";
echo " ";
$array = [60,86,95,63,55,74,79,62,50];
$total = 0;

for($i=0;$i<9;$i++)
{
    $total = $total+$array[$i];

}
$grade = $total/9; 
if ($grade >= 90 && $grade <= 100) {
    echo 'A';
} else if ($grade >= 80 && $grade <= 90) {
    echo'B';
} else if ($grade >= 70 && $grade <= 80) {
    echo'C';
} else if ($grade >=60 && $grade <= 70) {
    echo 'D';
} else if ($grade < 60) {
    echo 'F';
} 
echo "<br>";
echo "<br>";
?>