<section class='show'>
   <article class='form'>
      <header>Szczegóły oceny</header>
      <?php $grade = $params['grade'] ?? null; ?>
      <?php if($grade) : ?>
         <ul>
            <li> <span>Id:</span> <?php echo $grade['id'] ?> </li>
            <li> <span>Ocena:</span> <?php echo $grade['grade'] ?> </li>
            <li> <span>Przedmiot:</span> <?php echo $grade['subject'] ?> </li>
            <li> <span>Nauczyciel:</span> <?php echo $grade['teacher'] ?> </li> 
            <li> <span>Sposób uzyskania:</span> <?php echo $grade['how'] ?> </li>
            <li> <span>Utworzona:</span> <?php echo $grade['created'] ?> </li>
            <li>
               <a href='index.php'><button class='gradeButton'>Wróć</button></a>
               <a href="?action=edit&id=<?php echo $grade['id'] ?>"><button class='gradeButton'>Edytuj</button></a>
               <a href="?action=delete&id=<?php echo $grade['id'] ?>"><button class='gradeButton' >Usuń</button></a>
         </li>
         </ul>
      <?php endif; ?>
   </article>
</section>  
