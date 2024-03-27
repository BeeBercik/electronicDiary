<section class='show'>

<?php
   $sort = $params['sort'];
   $by = $sort['by'] ?? 'subject';
   $order = $sort['order'] ?? 'asc';

   $gradePage = $params['gradePage'];
   $currentPage = $gradePage['pageNumber'] ?? 1;
   $size = $gradePage['pagesize'] ?? 10;
   $pages = $gradePage['pages'];
   $search = $params['search'] ?? null;

?>

   <section class="formWraper">   
      <form action='index.php' method='GET'>
         <section class="firstForm">
            <div>Sortuj po:</div>
               <label>Przedmiocie: <input name='sortby' type='radio' value='subject' <?php if($by === 'subject'): ?> checked <?php endif; ?>/></label>
               <label>Dacie: <input name='sortby' type='radio' value='created' <?php echo $by === 'created' ? 'checked' : '' ?>></label>

               <div>Kierunek sortowania:</div>
               <label>Rosnąco: <input name='sortorder' type='radio' value='asc' <?php if($order === 'asc'): ?> checked <?php endif; ?>/></label>
                  <label>Malejąco: <input name='sortorder' type='radio' value='desc' <?php if($order === 'desc'): ?> checked <?php endif; ?>/></label>
                  </section>
                  
         <input type='submit' class='gradeButton' value='Zastosuj'/>
         
         <section class='secondForm'>
            <div>Ilość wyświetlanych notatek:</div>
            <label><input type='radio' value=1 name='pagesize' <?php echo $size === 1 ? 'checked' : '' ?>/>1</label>
            <label><input type='radio' value=5 name='pagesize' <?php echo $size === 5 ? 'checked' : '' ?>/>5</label>
            <label><input type='radio' value=10 name='pagesize' <?php echo $size === 10 ? 'checked' : '' ?>/>10</label>
            <label><input type='radio' value=25 name='pagesize' <?php echo $size === 25 ? 'checked' : '' ?>/>25</label>

         <section class="searching">
            <label for="search">Wyszukaj:</label>
            <input type="text" name='search' value=<?php echo $search ? $search : '' ?>>
         </section>
         </section>

      </form>
   </section>

   <table>
      <tr>
         <th class='smaller'>Ocena</th>
         <th>Przedmiot</th>
         <th>Nauczyciel</th>
         <th>Data wystawienia</th>
         <th class='smaller'></th>
      </tr>
      <?php foreach ($params['grades'] ?? [] as $grade) : ?>
        <tr>
            <td class='smaller'><?php echo $grade['grade']."</a>" ?></td>
            <td><?php echo $grade['subject'] ?></td>
            <td><?php echo $grade['teacher'] ?></td>
            <td><?php echo $grade['created'] ?></td>
            <td class='smaller'><?php echo "<a href='?action=show&id={$grade['id']}'>Więcej</a>" ?></td>
         </tr>
      <?php endforeach;?>
   </table>

   <!-- PAGINACJA -->
   <?php 
      $paginationUrl = "&pagesize=$size&sortby=$by&sortorder=$order&search=$search";
   ?>

   <section class="pagination">
         <?php if($currentPage !== 1) : ?>
            <a href="index.php?page=<?php echo $currentPage - 1 . $paginationUrl ?>">
               <button> << </button> 
            </a>
         <?php endif; ?>
      <?php for($i = 1; $i <= $pages; $i++) : ?>
            <a href="index.php?page=<?php echo $i . $paginationUrl ?>">
                 <button> <?php echo $i ?> </button>
               </a>
         <?php endfor; ?>
         <?php if($currentPage < $pages) : ?>
            <a href="index.php?page=<?php echo $currentPage + 1 . $paginationUrl ?>">
                <button> >> </button> 
            </a>
         <?php endif; ?>
      </ul>
   </section>

   <p>
      <a href='?action=create'><button class='gradeButton'>Nowa ocena</button></a>
   </p>
</section>