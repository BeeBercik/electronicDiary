<?php

declare(strict_types=1);

namespace App\Database;

use App\Exception\StorageException;
use App\Exception\NotFoundException;
use Throwable;
use PDO;

class GradeDatabase extends AbstractDatabase
{
   public function getGrade(int $id): array
   {
      try {
         $grade = [];
         $query = "SELECT * from grades WHERE id = $id;";

         $result = $this->connPDO->query($query);
         $grade = $result->fetch(PDO::FETCH_ASSOC);
      } catch(Throwable $e) {
         throw new StorageException('Nie udało się wczytać szczegółów oceny.');
      }

      if(!$grade) {
         throw new NotFoundException('Nie znaleziono oceny');
      }
      return $grade;
   }

   public function getGrades(
      int $pageNumber,
      int $pageSize,
      string $sortBy,
      string $sortOrder
   ): array {
      return $this->findBy(null, $pageNumber, $pageSize, $sortBy, $sortOrder);
   }

   public function searchGrades(
      string $phrase,
      int $pageNumber,
      int $pageSize,
      string $sortBy,
      string $sortOrder
   ): array
   {
      return $this->findBy($phrase, $pageNumber, $pageSize, $sortBy, $sortOrder);
   }

   // nie powielamy kodu bo getGrades i searchGrades byly praktycznie te same (inne zapytanie where)
   private function findBy(
   ?string $phrase,
   int $pageNumber,
   int $pageSize,
   string $sortBy,
   string $sortOrder): array 
   {
      try {
         $limit = $pageSize;
         $offset = ($pageNumber - 1) * $pageSize;
         $phrase = $this->connPDO->quote('%'.$phrase.'%');

         if(!in_array($sortBy, ['created', 'subject'])) {
            $sortBy = 'subject';
         }
         
         if(!in_array($sortOrder, ['asc', 'desc'])) {
            $sortOrder = 'desc';
         }
         
         $where = '';
         // WHERE subject LIKE $phrase

         if($phrase) {
            $where = "WHERE subject LIKE $phrase";
         }

         $query = "SELECT id, grade, subject, teacher, created
         from grades 
         $where
         ORDER BY $sortBy $sortOrder 
         LIMIT $offset, $limit";
   
         $result = $this->connPDO->query($query);
         $grades = $result->fetchAll(PDO::FETCH_ASSOC);

         return $grades;
      } catch (Throwable $e) {
         throw new StorageException('Nie udało się wyszukać ocen ');
      }
   }

   public function getSearchCount(string $phrase): int
   {
      try {   
         $phrase = $this->connPDO->quote($phrase);
      
         $query = "SELECT count(*) as count from grades
         WHERE subject LIKE $phrase";
         $result = $this->connPDO->query($query);
         $gradesCount = $result->fetch(PDO::FETCH_ASSOC);

         if($gradesCount === false) {
            throw new StorageException('Próba pobrania ilości wyszukiwanych notatek nie powiodła się');
         }
         
         return (int) $gradesCount['count'];
      } catch (Throwable $e) {
         throw new StorageException('Nie udało się pobrać informacji o ilości ocen.');
      }
   }


   public function getCount(): int 
   {
      try {   
         $query = "SELECT count(*) as count from grades";
   
         $result = $this->connPDO->query($query);
         $gradesCount = $result->fetch(PDO::FETCH_ASSOC);

         if($gradesCount === false) {
            throw new StorageException('Próba pobrania ilości notatek nie powiodła się');
         }
         
         return (int) $gradesCount['count'];
      } catch (Throwable $e) {
         throw new StorageException('Nie udało się pobrać informacji o ilości ocen.');
      }
   }

   public function createGrade(array $data): void
   {
      try {
         $grade = $this->connPDO->quote($data['grade']);
         $subject = $this->connPDO->quote($data['subject']);
         $teacher = $this->connPDO->quote($data['teacher']);
         $how = $this->connPDO->quote($data['how']);
         $created = $this->connPDO->quote(date('Y-m-d'));

         $query = "INSERT INTO grades(grade, subject, teacher, how, created) 
         VALUES($grade, $subject, $teacher, $how, $created)";

         $this->connPDO->exec($query);
      } catch(Throwable $e) {
         throw new StorageException("Nie udało się utworzyć notatki");
      }
   }

   public function editGrade(int $id, array $data): void
   {
      try {
         $grade = $this->connPDO->quote($data['grade']);
         $subject = $this->connPDO->quote($data['subject']);
         $teacher = $this->connPDO->quote($data['teacher']);
         $how = $this->connPDO->quote($data['how']);
         // $created = $this->connPDO->quote(date('Y-m-d'));

         $query = "UPDATE grades 
         SET grade = $grade, subject = $subject, teacher = $teacher, how = $how
         WHERE id = $id";

         $this->connPDO->exec($query);
      } catch (Throwable) {
         throw new StorageException('Nie udało się zaktualizować oceny.');
      }
   }

   public function deleteGrade(int $id): void
   {
      try {
         $query = "DELETE FROM grades WHERE id = $id LIMIT 1";
         $this->connPDO->exec($query);
      } catch (Throwable $e) {
         throw new StorageException('Usuwanie oceny nie powiodło się.');
      }
   }
   
 
}