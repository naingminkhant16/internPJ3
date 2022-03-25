<?php
function dd($str)
{
    echo "<pre>";
    return die(var_dump($str));
}
function isEmptyInput($formData)
{
    //check inputs are empty or not
    $err = null;
    foreach ($formData as $key => $value) {
        empty(trim($value)) ? $err .= $key . "," : "";
    }
    if (empty($err)) {
        return false;
    } else {
        return $err;
    }
}
