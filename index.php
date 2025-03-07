<?php 
    require_once './inc/db.inc.php'; 
    require_once 'header.php'; 
    require_once 'nav.php';
    
    date_default_timezone_set('Europe/Paris');
    

    $notesPerPage = 2;
    $currentPage = (int) ($_GET['page'] ?? 1);
    $offset = (int) ($currentPage - 1 ) * $notesPerPage;
    $stmt = $pdo->prepare("SELECT * 
                            FROM entries  
                            LIMIT :notesPerPage 
                            OFFSET :offset  ");
    $stmt->bindValue(':notesPerPage', $notesPerPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $resultats  =  $stmt->fetchAll();



    $stmtNbNotes = $pdo->prepare('SELECT COUNT(*) AS `nbNotesTotal` FROM entries');
    $stmtNbNotes->execute();
    $nbNotes = $stmtNbNotes->fetch()['nbNotesTotal'];

    $nbPages = ceil($nbNotes / $notesPerPage);
 


?>


    
    <main class="main">
        <h1>App Diary</h1>
        <section class="container__boxed card__container">


     <?php   
    if((count($resultats)) > 0) {
        
        foreach($resultats as $resultat) :?>
           
            <div class="card">
                
               <?php if(!empty($resultat['image_path'])) :?>
              
                        <img src="<?php echo htmlspecialchars($resultat['image_path']); ?>" alt="Image de " class="card__right card__img">
                <?php else: ?>
                <img src="./images/default.jpg" alt="Image de " class="card__right card__img">
                <?php endif; ?>
                
                <div class="card__left">
                    <p class="card__left__subtitle">
                        <?php  
                            $createdAtExploded = explode('-', $resultat['created_at']);
                       
                            $createdAtTimestamp = mktime(12, 0, 0, $createdAtExploded[1], $createdAtExploded[2], $createdAtExploded[0]);
                            
                           
                            echo htmlspecialchars(date('d-m-Y',$createdAtTimestamp));
                        ?>
                    </p>
                    <h2 class="card__left__title"> <?php  echo htmlspecialchars( $resultat['title']);?></h2>
                    <hr class="card__left__trait">
                    <p class="card__left__text"><?php  echo htmlspecialchars( $resultat['message']);?></p>
                </div>
            </div>
        <?php endforeach;?>
  <?php  } ?>
  

           
    
            <!-- pagination -->
          
             <ul class="card__pagination">
               
                <?php if($currentPage > 1) :?>
                    <li><a href="index.php?<?php echo http_build_query(['page' => ($currentPage - 1)]); ?>">&lt;</a></li>
                <?php endif; ?>

                <?php for($x = 1; $x <= $nbPages; $x++): ?>
                    <li class="<?php if($currentPage === $x):?>pagination__link--active<?php endif;?>"><a 
                            href="index.php?<?php echo http_build_query(['page' =>$x]);?>">
                        <?php echo $x ?>
                    </a></li>
                <?php endfor; ?>
                <?php if($currentPage < $nbPages) :?>
                    <li><a href="index.php?<?php echo http_build_query(['page' => ($currentPage + 1)]); ?>">&gt;</a></li>
                <?php endif; ?>
               
             
             </ul>
        </section>
    </main>
    <?php require_once 'footer.php'; ?>
    

</body>
</html>