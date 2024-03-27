<section class='show'>
   <form class='form' action='#' method='POST'>
      <ul>
         <li>
            <label>Ocena</label>
            <input type='number' name='grade' max=6 min=1/>
         </li>
         <li>
            <label>Przedmiot</label>
            <select name='subject' class='select'>
               <option value='Matematyka'>Matematyka</option>
               <option value='Polski'>Polski</option>
               <option value='Angielski'>Angielski</option>
               <option value='Przyroda'>Przyroda</option>
               <option value='Fizyka'>Fizyka</option> 
            </select>
         </li>
         <li>
            <label>Sposób uzyskania</label>
            <select name='how' class='select'>
               <option value='Sprawdzian'>Sprawdzian</option>
               <option value='Kartkówka'>Kartkówka</option>
               <option value='Odpowiedź ustna'>Odpowiedź ustna</option>
               <option value='Aktywność'>Aktywność</option>
               <option value='Inne'>Inne</option> 
            </select>
         </li>
         <li>
            <label>Nauczyciel</label>
            <input type='txt' name='teacher' class='teacher'/>
         </li>
         <li>
            <input type='submit' value='Dodaj' class='gradeButton'>
         </li>
      </ul>
   </form>
</section>