<section class='show'>
   <?php
      $grade = $params['grade'];
   ?>
   <?php if(!empty($grade)) : ?>
   <form class='form' action='' method='POST'>
      <ul>
         <input type='hidden'name='id' value="<?php echo $grade['id'] ?>"/>
         <li>
            <label>Ocena</span></label>
            <input type='number' name='grade' max=6 min=1  value="<?php echo $grade['grade'] ?>"/>
         </li>
         <li>
            <label>Przedmiot</label>
            <select name='subject' class='select' value="<?php echo $grade['subject'] ?>">
               <option value='Matematyka'>Matematyka</option>
               <option value='Polski' <?php if($grade['subject'] === 'Polski') echo 'selected'?>>Polski</option>
               <option value='Angielski' <?php if($grade['subject'] === 'Angielski') echo 'selected'?>>Angielski</option>
               <option value='Przyroda' <?php if($grade['subject'] === 'Przyroda') echo 'selected'?>>Przyroda</option>
               <option value='Fizyka' <?php if($grade['subject'] === 'Fizyka') echo 'selected'?>>Fizyka</option> 
            </select>
         </li>
         <li>
            <label>Sposób uzyskania</label>
            <select name='how' class='select'>
               <option value='Sprawdzian' <?php if($grade['how'] === 'Sprawdzian') : ?> selected <?php endif; ?>>Sprawdzian</option>
               <option value='Kartkówka' <?php if($grade['how'] === 'Kartkówka') : ?> selected <?php endif; ?>>Kartkówka</option>
               <option value='Odpowiedź ustna' <?php if($grade['how'] === 'Odpowiedź ustna') : ?> selected <?php endif; ?>>Odpowiedź ustna</option>
               <option value='Aktywność' <?php if($grade['how'] === 'Aktywność') : ?> selected <?php endif; ?>>Aktywność</option>
               <option value='Inne' <?php if($grade['how'] === 'Inne') : ?> selected <?php endif; ?>>Inne</option> 
            </select>
         </li>
         <li>
            <label>Nauczyciel</label>
            <input type='txt' name='teacher' class='teacher' value="<?php echo $grade['teacher'] ?>"/>
         </li>
         <li>
            <input type='submit' value='Zmień' class='gradeButton'>
         </li>
      </ul>
   </form>
   <?php else : ?>
      <div>
         Brak danych do wyświetlenia
      </div>
   <?php endif; ?>
</section>