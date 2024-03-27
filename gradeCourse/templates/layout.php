<html>
   <head>
      <link rel="stylesheet" href="public/style.css">
   </head>
   <body>
      <div class="container">
      <section class='warning'>
         <?php
            if(isset($params['error']) AND !empty($params['error'])) {
               switch ($params['error']) {
                  case 'gradeNotFound':
                     echo "<article class='messageBad'> Nie znaleziono notatki </article>";
                     break;
                     case 'missingGradeId':
                        echo "<article class='messageBad'> Niepoprawny identyfikator notatki </article>";
                        break;
                     }
                  }
                  
                  if(isset($params['before']) AND !empty($params['before'])) {
                     switch ($params['before']) {
                  case 'created':
                     echo "<article class='messageOk'> Dodano ocenę </article>";
                     break;
                     case 'edited':
                        echo "<article class='messageOk'> Zmodyfikowano ocenę </article>";
                        break;
                        case 'deleted':
                           echo "<article class='messageOk'> Usunięto ocenę </article>";
                           break;
                        }
                     }
            ?>
         </section>
         <header>
            <h1>Dzienniczek</h1>
         </header>
         <main>
            <nav>
               <ul class='menu'>
                  <li>
                     <a href='index.php'>Oceny</a>
                  </li>
                  <li>
                     <a href='#'>Wiadomości</a>
                  </li>
               </ul>
            </nav>
            <?php  
                  require_once('templates/pages/'.$page.'.php');
            ?>
         </main>
         <footer>
               <h4>Dzienniczek szkolny na potrzeby CKU 2022</h4>
         </footer>
      </div>
   </body>
</html>