<?php

declare(strict_types=1);
namespace App;

class View
{
   public function Render(string $page, array $params = null): void
   {
      $params = $this->escape($params);

      require_once('templates/layout.php');
   }

   private function escape(?array $params): array
   {
      $clearParams = [];

      if($params) {
         foreach ($params as $key => $param) {
            switch(true) {
               case is_array($param): 
                  $clearParams[$key] = $this->escape($param);
                  break;
               case is_int($param):
                  $clearParams[$key] = (int) $param;
                  break;
               case $param:
                  $clearParams[$key] = htmlentities($param);
                  break;
               default:
                  $clearParams[$key] = $param;
                  break;
            }
         }
      }
      return $clearParams;
   }
}