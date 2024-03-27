<?php

declare(strict_types=1);

namespace App\Controller;

class GradeController extends AbstractController
{
   private const PAGE_SIZE = 10;

   public function createAction(): void
   {
      if(!empty($this->request->postParam('grade')) 
      && !empty($this->request->postParam('subject')) 
      && !empty($this->request->postParam('teacher')) 
      && !empty($this->request->postParam('how')))  {
         $noteData = [
            'grade' => $this->request->postParam('grade'),
            'subject' => $this->request->postParam('subject'),
            'teacher' => $this->request->postParam('teacher'),
            'how' => $this->request->postParam('how'),
         ];
         
         $this->database->createGrade($noteData);
         $this->redirect('index.php', ['before' => 'created']);
      }
      $this->view->render('create');
   }

   public function showAction(): void
   {
      $grade = $this->getGradeInfo(['error' => 'gradeNotFound']);
 
      $this->view->render(
         'show', 
         [
            'grade' => $grade
         ]);
   } 

   public function listAction(): void
   {
      $search = $this->request->getParam('search');
      $pageNumber = (int) $this->request->getParam('page', 1 ); 
      $pageSize = (int) $this->request->getParam('pagesize', self::PAGE_SIZE);
      $sortBy = $this->request->getParam('sortby') ?? 'subject';
      $sortOrder = $this->request->getParam('sortorder') ?? 'asc';

      if(!in_array($pageSize, [1, 5, 10, 25])) {
         $pageSize = self::PAGE_SIZE;  
      }

      if($search) {
         $grades = $this->database->searchGrades($search, $pageNumber, $pageSize, $sortBy, $sortOrder);
         $gradesCount = $this->database->getSearchCount($search); 
      } else {
         $grades = $this->database->getGrades($pageNumber, $pageSize, $sortBy, $sortOrder);
         $gradesCount = $this->database->getCount(); 
      }

      $this->view->render(
         'list', 
         [  
            'gradePage' => [
               'pageNumber' => $pageNumber,
               'pagesize' => $pageSize,
               'pages' => (int) ceil($gradesCount / $pageSize)
         ],
            'search' => $search,
            'sort' => ['by' => $sortBy, 'order' => $sortOrder],
            'grades' => $grades,
            'before' => $this->request->getParam('before'),
            'error' => $this->request->getParam('error')
         ]);
   }

   public function editAction(): void
   {
      // dane do zmienienia
      if($this->request->isPost()) {
         $gradeId = (int) $this->request->postParam('id'); 
         if(!empty($this->request->postParam('grade')) 
         && !empty($this->request->postParam('subject')) 
         && !empty($this->request->postParam('teacher')) 
         && !empty($this->request->postParam('how')))  {
            $noteData = [
               'grade' => $this->request->postParam('grade'),
               'subject' => $this->request->postParam('subject'),
               'teacher' => $this->request->postParam('teacher'),
               'how' => $this->request->postParam('how'),
            ];
         }
         $this->database->editGrade($gradeId, $noteData);
         $this->redirect('index.php', ['before' => 'edited']);
      }

      // wyswietlanie danych
      $grade = $this->getGradeInfo(['error' => 'gradeNotFound']);

      $this->view->render(
         'edit',
         ['grade' => $grade]
      );
   }

   public function deleteAction(): void
   {
      $grade = $this->getGradeInfo(['error' => 'gradeNotFound']);
      $gradeId = (int) $this->request->getParam('id');
      if($this->request->isPost()) {
         $this->database->deleteGrade($gradeId);
         $this->redirect('index.php', ['before' => 'deleted']);
      }

      $this->view->render(
         'delete',
         ['grade' => $grade]
      );
   }

   private function getGradeInfo(): array
   {
      $gradeId = (int) $this->request->getParam('id');

      if(!$gradeId) {
         $this->redirect('index.php', ['error' => 'missingGradeId']);
         exit;
      }

      $grade = $this->database->getGrade($gradeId);

      return $grade;
   }
}