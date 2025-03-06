<?php 
    require_once './inc/db.inc.php'; 
    require_once 'header.php'; 
    require_once 'nav.php';

    $errors = [];
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
       
        $title = trim((string) ($_POST['title'] ?? ''));
        $message = trim((string) ($_POST['message'] ?? ''));
        $message = trim((string) ($_POST['date'] ?? ''));


        if(empty($title) || strlen($title) < 5 || strlen($title) > 80) {
            $errors['error_title'] = "Le titre doit être compris entre 5 et 80 caractères";
        }
        if(empty($message) || strlen($message) < 25 || strlen($message) > 500) {
            $errors['error_message'] = "Le message doit être compris entre 25 et 500 caractères";
        }
        if(empty($date)) {
            $errors['error_date'] = "Veuillez indiquer une date";
        }

        if(empty($errors)) {
            try {

                $stmt = $pdo->prepare('INSERT INTO entries (`title`, `message`,`created_at`) VALUES (:title, :message, :created_at) ');
                $stmt->bindValue(':title', $title, PDO::PARAM_STR);
                $stmt->bindValue(':message', $message, PDO::PARAM_STR);
                $stmt->bindValue(':created_at', $date, PDO::PARAM_STR);
                $stmt->execute();
            }catch(PDOException $e) {
                error_log(date("Y-m-d H:i:s") . "Erreur d'insertion : " . $e->getMessage()); ?>
                    <p class="error">Une erreur a été rencontrée. Veuillez réessayer plus tard.</p>
                <?php
            
                }

        }
    }
?>

<main class="main">
    <h1>Contact</h1>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="form__container">
        <div class="form__group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title">
            <?php if(isset($errors['error_title'])) : ?>
                <p class="error"><?php echo $errors['error_title']; ?></p>
            <?php endif;?>
        </div>
        <div class="form__group">
            <label for="date">Date</label>
            <input type="date" name="date" id="date">
            <?php if(isset($errors['error_date'])) : ?>
                <p class="error"><?php echo $errors['error_date'] ; ?></p>
            <?php endif;?>
            
        </div>
        <div class="form__group form__group__column">
            <label for="message">Message</label>
            <textarea name="message" id="message" rows="15" cols="33"></textarea>
            <?php if(isset($errors['error_title'])) : ?>
                <p class="error"><?php echo $errors['error_message'] ; ?></p>
            <?php endif;?>
        </div>

        <button type="submit" class="btn__submit__contact__form" name="submit">Envoyer</button>
    </form>
</main>
<?php require_once 'footer.php'; ?>

