<?php

function validation($request) //$_POSTの連想配列が入る
{
    $errors = [];

    if (empty($request["your_name"])) $errors[] = "氏名は必須です";

    return $errors;
}
