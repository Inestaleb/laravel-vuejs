<?php
function roman2number($roman){
    $conv = array(
        array("letter" => 'I', "number" => 1),
        array("letter" => 'V', "number" => 5),
        array("letter" => 'X', "number" => 10),
        array("letter" => 'L', "number" => 50),
        array("letter" => 'C', "number" => 100),
        array("letter" => 'D', "number" => 500),
        array("letter" => 'M', "number" => 1000),
        array("letter" => 0, "number" => 0)
    );
    $arabic = 0;
    $state = 0;
    $sidx = 0;
    $len = strlen($roman);

    while ($len >= 0) {
        $i = 0;
        $sidx = $len;

        while ($conv[$i]['number'] > 0) {
            if (strtoupper(@$roman[$sidx]) == $conv[$i]['letter']) {
                if ($state > $conv[$i]['number']) {
                    $arabic -= $conv[$i]['number'];
                } else {
                    $arabic += $conv[$i]['number'];
                    $state = $conv[$i]['number'];
                }
            }
            $i++;
        }

        $len--;
    }

    return($arabic);
}
function number2roman($num,$isUpper=true) {
    $n = intval($num);
    $res = '';

    /*** roman_numerals array ***/
    $roman_numerals = array(
        'M' => 1000,
        'CM' => 900,
        'D' => 500,
        'CD' => 400,
        'C' => 100,
        'XC' => 90,
        'L' => 50,
        'XL' => 40,
        'X' => 10,
        'IX' => 9,
        'V' => 5,
        'IV' => 4,
        'I' => 1
    );

    foreach ($roman_numerals as $roman => $number)
    {
        /*** divide to get matches ***/
        $matches = intval($n / $number);

        /*** assign the roman char * $matches ***/
        $res .= str_repeat($roman, $matches);

        /*** substract from the number ***/
        $n = $n % $number;
    }

    /*** return the res ***/
    if($isUpper) return $res;
    else return strtolower($res);
}
function additionRomaine( string $val1, string $val2 ){
$x=roman2number($val1);
$y=roman2number($val2);	
$n=$x+$y;
$result=number2roman($n);
echo $result;
}
if(isset($_POST['submit']))
{

	additionRomaine($_POST['val1'],$_POST['val2']);
}

?>
 <html>
<head>
    <title></title>
</head>
<body>
<form method="post">
<table>
<tr>
<td>Entrer premier valeur:
<td><input type="text" name="val1">
</tr>
<tr>
<td>Entrer dexieme valeur:
<td><input type="text" name="val2">
</tr>
<tr>

<td><input type="submit" name="submit" value="add">
</tr>
</table>
</form>


</body>
</html>