<?php

declare(strict_types=1);

error_reporting(E_ALL);
ini_set("display_errors", '1');

function dump($data)
{
   echo '</br><div style="
      border: 2px dashed gray;
      padding: 20px;
      background: lightgray;
      display: inline-block;">
   <pre>';

   print_r($data);

   echo '</pre></div></br>';
}
