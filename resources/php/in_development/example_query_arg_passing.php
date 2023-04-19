<?php

// The following example is one way of how we can pass query arguments
// to a function if we want to use a dictionary-based approach

function processDictionary($dict) {
    foreach ($dict as $key => $value) {
        echo "$key: $value\n";
    }
}

$myDict = array("name" => "John", "age" => 25, "gender" => "Male");

processDictionary($myDict);

?>