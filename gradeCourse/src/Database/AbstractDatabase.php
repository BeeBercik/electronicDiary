<?php

declare(strict_types=1);

namespace App\Database;

use App\Exception\ConfigurationException;
use App\Exception\StorageException;
use PDO;
use PDOException;

abstract class AbstractDatabase
{
   protected PDO $connPDO;

   public function __construct(array $config) {
      try {
         $this->validate($config);
         $this->createConnection($config);
      } catch (PDOException $e) {
         throw new StorageException('Connection error');
      }
   }

   protected function createConnection($config): void
   {
      $dsn = "mysql:dbname={$config['database']};host={$config['host']}";
      $this->connPDO = new PDO(
         $dsn,
         $config['user'],
         $config['password'],
         [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
         ]
      );
   }

   protected function validate($config): void
   {
      if(empty($config['database'])
            || empty($config['host'])
            || empty($config['user'])
            || empty($config['password'])
         ) {
            throw new ConfigurationException('Storage configuration error');
         }
   }
}
