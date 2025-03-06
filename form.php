<?php require_once 'header.php'; ?>

<?php require_once 'nav.php'; ?>

<main class="main">
    <h1>Contact</h1>
    <form action="" method="POST" class="form__container">
        <div class="form__group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title">
        </div>
        <div class="form__group">
            <label for="date">Date</label>
            <input type="date" name="date" id="date">
        </div>
        <div class="form__group form__group__column">
            <label for="message">Message</label>
            <textarea name="message" id="message" rows="15" cols="33"></textarea>
        </div>

        <button type="submit" class="btn__submit__contact__form">Envoyer</button>
    </form>
</main>
<?php require_once 'footer.php'; ?>

