<?php 
    require_once './inc/db.inc.php'; 
    require_once 'header.php'; 
    require_once 'nav.php';
   
    $errors = [];
    $uploadedImagePath = null;
    
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
       
        $title = trim((string) ($_POST['title'] ?? ''));
        $message = trim((string) ($_POST['message'] ?? ''));
        $date = trim((string) ($_POST['date'] ?? ''));
        
        // Validation du titre
        if(empty($title) || strlen($title) < 5 || strlen($title) > 80) {
            $errors['error_title'] = "Le titre doit être compris entre 5 et 80 caractères";
        }
        
        // Validation du message
        if(empty($message) || strlen($message) < 25 || strlen($message) > 500) {
            $errors['error_message'] = "Le message doit être compris entre 25 et 500 caractères";
        }
        
        // Validation de la date
        if(empty($date)) {
            $errors['error_date'] = "Veuillez indiquer une date";
        }
        
        // Traitement de l'image si elle a été envoyée
        if(isset($_FILES['image']) && $_FILES['image']['name'] !== '') {
            $name_fichier_envoye = $_FILES['image']['name'];
            $extension_du_fichier_envoye = strtolower(pathinfo($name_fichier_envoye, PATHINFO_EXTENSION));
            
            if($_FILES['image']['error'] === 0) {
                if($_FILES['image']['size'] < 3000000) {
                    $chemin_pour_upload = __DIR__ . '/imagesArticles';
                    
                    // Vérifier que le dossier existe ou le créer
                    if (!file_exists($chemin_pour_upload)) {
                        mkdir($chemin_pour_upload, 0755, true);
                    }
                    
                    $extensions_autorisees = ['jpg', 'jpeg', 'png'];
                    if(in_array($extension_du_fichier_envoye, $extensions_autorisees)) {
                        // Vérification du type MIME
                        $finfo = finfo_open(FILEINFO_MIME_TYPE);
                        $mime_type = finfo_file($finfo, $_FILES['image']['tmp_name']);
                        finfo_close($finfo);
    
                        $mimes_autorisees = ['image/jpg', 'image/png', 'image/jpeg'];
    
                        if(in_array($mime_type, $mimes_autorisees)) {
                            // Génération d'un nom de fichier unique sans garder le nom original
                            $new_name = uniqid() . time();
                            $nouveau_chemin = $chemin_pour_upload . DIRECTORY_SEPARATOR . $new_name . "." . $extension_du_fichier_envoye;
                            
                            if (move_uploaded_file($_FILES["image"]["tmp_name"], $nouveau_chemin)) {
                                $uploadedImagePath = "imagesArticles/" . $new_name . "." . $extension_du_fichier_envoye;
                            } else {
                                $errors['error_image'] = "Échec lors du déplacement de l'image uploadée";
                            }
                        } else {
                            $errors['error_image'] = "Votre image semble corrompue. Veuillez essayer avec une autre image";
                        }
                    } else {
                        $errors['error_image'] = "L'extension de votre image doit être au format jpg, jpeg ou png";
                    }
                } else {
                    $errors['error_image'] = "Le poids de votre image ne doit pas être supérieur à 3 Mo";
                }
            } else {
                $errors['error_image'] = "Votre image ne peut être chargée. Veuillez réessayer";
            }
        }

        // Insertion en base de données si pas d'erreurs
        if(empty($errors)) {
            try {
                // Ajout du champ image dans la requête si une image a été uploadée
                if ($uploadedImagePath) {
                    $stmt = $pdo->prepare('INSERT INTO entries (`title`, `message`, `created_at`, `image_path`) VALUES (:title, :message, :created_at, :image_path)');
                    $stmt->bindValue(':image_path', $uploadedImagePath, PDO::PARAM_STR);
                } else {
                    $stmt = $pdo->prepare('INSERT INTO entries (`title`, `message`, `created_at`) VALUES (:title, :message, :created_at)');
                }
                
                $stmt->bindValue(':title', $title, PDO::PARAM_STR);
                $stmt->bindValue(':message', $message, PDO::PARAM_STR);
                $stmt->bindValue(':created_at', $date, PDO::PARAM_STR);
                
                if ($stmt->execute()) {
                    // Message de succès
                    $success_message = "Votre message a été envoyé avec succès!";
                }
            } catch(PDOException $e) {
                error_log(date("Y-m-d H:i:s") . " Erreur d'insertion : " . $e->getMessage());
                $errors['database'] = "Une erreur a été rencontrée. Veuillez réessayer plus tard.";
            }
        }
    }
?>

<main class="main">
    <h1>Contact</h1>
    
    <?php if(isset($success_message)): ?>
        <div class="success-message">
            <?php echo $success_message; ?>
        </div>
    <?php endif; ?>
    
    <?php if(isset($errors['database'])): ?>
        <p class="error"><?php echo $errors['database']; ?></p>
    <?php endif; ?>
    
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="form__container" enctype="multipart/form-data">
        <div class="form__group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="<?php echo isset($title) ? htmlspecialchars($title) : ''; ?>">
            <?php if(isset($errors['error_title'])): ?>
                <p class="error"><?php echo $errors['error_title']; ?></p>
            <?php endif; ?>
        </div>
        <div class="form__group">
            <label for="date">Date</label>
            <input type="date" name="date" id="date" value="<?php echo isset($date) ? htmlspecialchars($date) : ''; ?>">
            <?php if(isset($errors['error_date'])): ?>
                <p class="error"><?php echo $errors['error_date']; ?></p>
            <?php endif; ?>
        </div>
        <div class="form__group">
            <label for="image">Image</label>
            <input type="file" name="image" id="image">
            <p class="description">Indication : Votre image doit être au format jpg, jpeg ou png et ne doit pas excéder 3 Mo.</p>
            <?php if(isset($errors['error_image'])): ?>
                <p class="error"><?php echo $errors['error_image']; ?></p>
            <?php endif; ?>
        </div>
        <div class="form__group form__group__column">
            <label for="message">Message</label>
            <textarea name="message" id="message" rows="15" cols="33"><?php echo isset($message) ? htmlspecialchars($message) : ''; ?></textarea>
            <?php if(isset($errors['error_message'])): ?>
                <p class="error"><?php echo $errors['error_message']; ?></p>
            <?php endif; ?>
        </div>

        <button type="submit" class="btn__submit__contact__form" name="submit">Envoyer</button>
    </form>
</main>
<?php require_once 'footer.php'; ?>