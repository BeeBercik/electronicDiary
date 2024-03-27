<section class='show'>
   <article class='form'>
      <header style="background-color: #f5427b;">Czy na pewno usunąć poniższą ocenę?</header>
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
               <a href="?action=show&id=<?php echo $grade['id'] ?>"><button class='gradeButton'>Nie</button></a>
               <form action='#' method='POST' class='delete'>
                  <input type='hidden' value=<?php echo $grade['id']?> />
                  <input class='gradeButton' type='submit' value='Tak'/>
               </form>
         </li>
         </ul>

      <?php endif; ?>
   </article>
</section>  
