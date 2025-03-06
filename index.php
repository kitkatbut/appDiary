<?php 
    require_once './inc/db.inc.php'; 
    require_once 'header.php'; 
    require_once 'nav.php';

    $stmt = $pdo->prepare("SELECT * FROM entries");
    $stmt->execute();
    $resultats  =  $stmt->fetchAll();

?>


    
    <main class="main">
        <h1>App Diary</h1>
        <section class="container__boxed card__container">


     <?php   
    if((count($resultats)) > 0) {
        foreach($resultats as $resultat) :?>
           
            <div class="card">
                <img src="./images/pexels-tranmautritam-68761.jpg" alt="Homme lisant livre intitulé space encyclopedia" class="card__right card__img">
                <div class="card__left">
                    <p class="card__left__subtitle"><?php  echo htmlspecialchars( $resultat['created_at']);?></p>
                    <h2 class="card__left__title"> <?php  echo htmlspecialchars( $resultat['title']);?></h2>
                    <hr class="card__left__trait">
                    <p class="card__left__text"><?php  echo htmlspecialchars( $resultat['message']);?></p>
                </div>
            </div>
        <?php endforeach;?>
  <?php  } ?>
  

           
    
            <!-- pagination -->
             <ul class="card__pagination">
                <li><a href="#">&lt;</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">&gt;</a></li>
             </ul>
        </section>
    </main>
    <?php require_once 'footer.php'; ?>
    

</body>
</html>