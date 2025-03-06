<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Diary</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link rel="stylesheet" href='css/style.css'>
</head>
<body>

    <header>
        <nav>
            <ul>
            <li>
                <a href="./index.php" class="nav__item nav__brand">
                    <svg viewBox="0 0 60.7863869853 60.7863869853" aria-hidden="true" class="nav__brand-image">
                        <path class="svg__brand" d="m45.589790239,30.3931934927c8.3928407749,0,15.1965967463-6.8037559715,15.1965967463-15.1965967463S53.9826310139,0,45.589790239,0H15.196554313C6.8037135382,0,0,6.8037559715,0,15.1965967463v30.3931934927c0,8.3928407749,6.8037135382,15.1965967463,15.196554313,15.1965967463h30.393235926c8.3928407749,0,15.1965967463-6.8037559715,15.1965967463-15.1965967463s-6.8037559715-15.1965967463-15.1965967463-15.1965967463Z"/>
                    </svg>
                    My Journal
                </a>
            </li>
                    
                    
                <li>
                    <a href="form.php" class="nav__item new__entry__item" aria-hidden="true">
                    <!--<img src="./images/svg/plus.svg" alt="icon plus">-->
                    <svg width="30" height="30" viewBox="0 0 44.4901230052 44.4901230053"class="nav__plus__image">
                    <g class="svg__plus">
                            <circle  cx="22.2450615026" cy="22.2450615026" r="21.2450615026"/>
                            <line  x1="22.2450615026" y1="13.4699274037" x2="22.2450615026" y2="31.0201956015"/>
                            <line  x1="31.0201956015" y1="22.2450658041" x2="13.4699274037" y2="22.2450572011"/>
                        </g>
                    </svg>
                    New Entry</a>
                </li>
            </ul>
        </nav>
    </header>
    
    <main class="main">
        <h1>App Diary</h1>
        <section class="card__container">

            <div class="card">
                <img src="./images/pexels-tranmautritam-68761.jpg" alt="Homme lisant livre intitulé space encyclopedia" class="card__right card__img">
                <div class="card__left">
                    <p class="card__left__subtitle">WEEK 1</p>
                    <h2 class="card__left__title">Lorem impsum</h2>
                    <hr class="card__left__trait">
                    <p class="card__left__text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem dolores consectetur distinctio blanditiis a asperiores. Voluptatem distinctio, suscipit molestias, dignissimos accusamus facere, debitis consequuntur cumque deserunt qui nemo maiores unde?</p>
                </div>
            </div>
            <div class="card">
                <img src="./images/pexels-lumn-167682.jpg" alt="Homme lisant livre intitulé space encyclopedia" class="card__right card__img">
                <div class="card__left">
                    <p class="card__left__subtitle">WEEK 1</p>
                    <h2 class="card__left__title">Lorem impsum</h2>
                    <hr class="card__left__trait">
                    <p class="card__left__text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem dolores consectetur distinctio blanditiis a asperiores. Voluptatem distinctio, suscipit molestias, dignissimos accusamus facere, debitis consequuntur cumque deserunt qui nemo maiores unde?</p>
                </div>
            </div>
            <div class="card">
                <img src="./images/pexels-kaushal-moradiya-2781195.jpg" alt="Homme lisant livre intitulé space encyclopedia" class="card__right card__img">
                <div class="card__left">
                    <p class="card__left__subtitle">WEEK 1</p>
                    <h2 class="card__left__title">Lorem impsum</h2>
                    <hr class="card__left__trait">
                    <p class="card__left__text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem dolores consectetur distinctio blanditiis a asperiores. Voluptatem distinctio, suscipit molestias, dignissimos accusamus facere, debitis consequuntur cumque deserunt qui nemo maiores unde?</p>
                </div>
            </div>
            <div class="card">
                <img src="./images/pexels-canva-studio-3153199.jpg" alt="Homme lisant livre intitulé space encyclopedia" class="card__right card__img">
                <div class="card__left">
                    <p class="card__left__subtitle">WEEK 1</p>
                    <h2 class="card__left__title">Lorem impsum</h2>
                    <hr class="card__left__trait">
                    <p class="card__left__text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem dolores consectetur distinctio blanditiis a asperiores. Voluptatem distinctio, suscipit molestias, dignissimos accusamus facere, debitis consequuntur cumque deserunt qui nemo maiores unde?</p>
                </div>
            </div>
    
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

</body>
</html>