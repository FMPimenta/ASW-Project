<?php

// get the q parameter from URL
$q = $_REQUEST["q"];
include "openconn.php";


$prods="";
$sql = "SELECT freguesia FROM freguesia";
$result=mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
            $a[]=$row["freguesia"];
        }
        
mysqli_close($conn);
$hint = "";

// lookup all hints from array if $q is different from "" 
if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    foreach($a as $name) {
        if (stristr($q, substr($name, 0, $len))) {
            if ($hint === "") {
                $hint = utf8_encode($name);
            } else {
                $hint .= ", " . utf8_encode($name);
            }
        }
    }
}

// Output "no suggestion" if no hint was found or output correct values 
echo $hint === "" ? "Sem sugestão" : $hint;
?>