<?php

declare(strict_types=1);

namespace App\Controller;

use App\Request;
use App\View;
use App\Database\GradeDatabase;
use App\Exception\ConfigurationException;
use App\Exception\NotFoundException;
use App\Exception\StorageException;

abstract class AbstractController
{
   protected const DEFAULT_ACTION = 'list';

   private static array $configuration = [];

   protected Request $request;
   protected View $view;
   protected GradeDatabase $database;

   public static function initConfiguration(array $configuration): void
   {
      self::$configuration = $configuration;
   }

   public function __construct(Request $request) {
      $this->request = $request;
      $this->view = new View(); 
      
      if(empty(self::$configuration['db'])) {
         throw new ConfigurationException('Configuration error');
      }
      $this->database = new GradeDatabase(self::$configuration['db']);
   }

   public function run(): void
   {
      try {
         $action = $this->action().'Action';

         if(!method_exists($this, $action)) {
            $action = self::DEFAULT_ACTION.'Action';   
         }

         $this->$action();
      } catch(StorageException $e) {
         $this->view->render('error', ['message' => $e->getMessage()]);
      } catch (NotFoundException $e) {
         $this->redirect('index.php', ['error' => 'notFoundException']);
         exit;
      }
   }

   protected function redirect(string $page, array $params): void
   {
      $queryParams = [];

      if(count($params)) {
         foreach($params as $key => $value) {
            $queryParams[] = urlencode($key).'='.urlencode($value);
         }

         $queryParams = implode('&', $queryParams);
         $location = $page.'?'.$queryParams;

         header("Location: $location");
         exit('end');
      }
   }

   private function action(): string
   {
      return $this->request->getParam('action', self::DEFAULT_ACTION);
   }
}