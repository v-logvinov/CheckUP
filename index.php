<?php

use App\CheckUp;

require_once('./vendor/autoload.php');


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$checkUpAppList = null;
try {
    $checkUpApp = new CheckUp($_ENV['MYSQL_DATA'], $_ENV['DB_USER'], $_ENV['PASS']);
    $checkUpAppList  = $checkUpApp->index();
} catch (\PDOException $e) {
    $date = date("Y-m-d H:i:s");
    file_put_contents('./error.log', "Ошибка при подключении к базе данных $date \n",  FILE_APPEND);
};



?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="stylesheet" href="./assets/css/normalize.css">
    <link rel="stylesheet" href="./assets/css/index.css">
    <link rel="shortcut icon" href="./assets/image/LOGO.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans+Caption:wght@400;700&display=swap" rel="stylesheet">

    <title>CheckUP</title>
</head>

<body>
    <header>
        <div class="header__top-line">
            <div class="header__contaner-top container">
                <button class="header__burger burger">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <picture class="header__logo">
                    <source srcset="./assets/image/LOGO-header-mini.png" media="(max-width: 768px)" />
                    <img src="./assets/image/LOGO.png" alt="Логотип">
                </picture>
                <address class="header__adress">
                    <svg class="header__adress-icon" width="14" height="20" viewBox="0 0 14 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.8304 0.615234C3.23672 0.615234 0.312988 3.53897 0.312988 7.13264C0.312988 11.6495 6.83681 19.3652 6.83681 19.3652C6.83681 19.3652 13.3478 11.4274 13.3478 7.13264C13.3478 3.53897 10.4242 0.615234 6.8304 0.615234ZM8.79684 9.04095C8.25461 9.58305 7.54256 9.85416 6.8304 9.85416C6.11835 9.85416 5.40607 9.58305 4.86407 9.04095C3.77975 7.95673 3.77975 6.19251 4.86407 5.10818C5.38913 4.5829 6.08756 4.29359 6.8304 4.29359C7.57323 4.29359 8.27155 4.58301 8.79684 5.10818C9.88116 6.19251 9.88116 7.95673 8.79684 9.04095Z" fill="#E1E1E1" />
                    </svg>
                    <div class="header__city">
                        Ростов-на-Дону
                    </div>
                    <div class="header__street">
                        ул. Ленина, 2Б
                    </div>
                </address>
                <div class="header__tel">
                    <a href="tel:+78630000000">+7(863) 000 00 00</a>
                </div>
                <button class="header__button primary-btn new-client">
                    Записаться на прием
                </button>
            </div>
        </div>
        <div class="header__bottom-line">
            <div class="header__contaner-bottom container">
                <nav class="header__nav nav nav-header">
                    <a href="#" class="nav__item">
                        О клинике
                    </a>
                    <a href="#" class="nav__item">
                        Услуги
                    </a>
                    <a href="#" class="nav__item">
                        Специалисты
                    </a>
                    <a href="#" class="nav__item">
                        Цены
                    </a>
                    <a href="#" class="nav__item">
                        Контакты
                    </a>
                    <button class="primary-btn-2 nav__btn-header new-client">
                        Записаться на прием
                    </button>
                </nav>
            </div>
        </div>
    </header>
    <main>
        <section class="hero">
            <div class="hero__container container">
                <div class="hero__content">
                    <h1 class="hero__title title">
                        Многопрофильная клиника для детей
                        и взрослых
                    </h1>
                    <p class="hero__descr">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua
                    </p>
                </div>
                <img class="hero__image" class="hero__image" src="./assets/image/hero.jpg" alt="">
            </div>
        </section>
        <section class="checkup">
            <div class="checkup__container container">
                <?php if (!empty($checkUpAppList) && count($checkUpAppList) > 0) { ?>

                    <div class="swiper checkup__swiper">

                        <div class="swiper-wrapper">
                            <?php foreach ($checkUpAppList as $check) { ?>

                                <div class="swiper-slide">
                                    <form class="checkup__form">
                                        <div class="checkup__descr">
                                            <h2 class="checkup__title">
                                                Check-UP
                                            </h2>
                                            <p class="checkup__subtitle">
                                                <?php echo  $check['name'] ?>
                                            </p>
                                            <ul class="checkup__list">
                                                <?php $analizes = explode('|', $check['analizes']) ?>
                                                <?php foreach ($analizes as $a) { ?>
                                                    <li class="checkup__item">
                                                        <?php echo $a ?>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                            <div class="checkup__price">
                                                <?php if (intval($check['sale']) > 0) { ?>

                                                    <span class="checkup__new-price">
                                                        <?php echo $check['checkUp_price']  ?>₽
                                                    </span>

                                                    <span class="checkup__old-price">
                                                        <?php echo $check['total_price'] ?>₽
                                                    </span>

                                                <?php } else { ?>
                                                    <span class="checkup__new-price">
                                                        <?php echo $check['checkUp_price']  ?>₽
                                                    </span>
                                                <?php }  ?>
                                            </div>
                                            <div>
                                                <button class="primary-btn mrgb15">
                                                    Записаться
                                                </button>
                                                <button class="secondary-btn">
                                                    Подробнее
                                                </button>
                                            </div>
                                        </div>
                                        <div class="checkup__wrapper">
                                            <img src=".<?php echo $check['img'] ?>" alt="Фото чекапа">
                                        </div>
                                    </form>
                                </div>

                            <?php } ?>

                        </div>
                    </div>

                <?php } ?>
            </div>
            <div class="swiper-nav">
                <button class="swiper-button-prev checkup__pag">
                    <svg width="34" height="18" viewBox="0 0 34 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M32.6718 7.67186H4.54493L9.20426 3.03512C9.72416 2.51768 9.72615 1.67678 9.20871 1.15689C8.69127 0.636925 7.8503 0.635 7.33041 1.15237L0.390691 8.05861C0.390226 8.05901 0.389894 8.05947 0.389496 8.05987C-0.129071 8.57731 -0.130731 9.42093 0.389363 9.94009C0.389828 9.94049 0.39016 9.94095 0.390558 9.94135L7.33028 16.8476C7.85011 17.3649 8.69107 17.3631 9.20858 16.8431C9.72602 16.3232 9.72402 15.4823 9.20413 14.9648L4.54493 10.3281H32.6718C33.4054 10.3281 34 9.7335 34 8.99998C34 8.26646 33.4054 7.67186 32.6718 7.67186Z" fill="#E1E1E1" />
                    </svg>
                </button>
                <div class="swiper-pagination checkup__pag"></div>
                <button class="swiper-button-next checkup__pag">
                    <svg width="34" height="18" viewBox="0 0 34 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.32817 7.67186H29.4551L24.7957 3.03512C24.2758 2.51768 24.2739 1.67678 24.7913 1.15689C25.3087 0.636925 26.1497 0.635 26.6696 1.15237L33.6093 8.05861C33.6098 8.05901 33.6101 8.05947 33.6105 8.05987C34.1291 8.57731 34.1307 9.42093 33.6106 9.94009C33.6102 9.94049 33.6098 9.94095 33.6094 9.94135L26.6697 16.8476C26.1499 17.3649 25.3089 17.3631 24.7914 16.8431C24.274 16.3232 24.276 15.4823 24.7959 14.9648L29.4551 10.3281H1.32817C0.594646 10.3281 4.57764e-05 9.7335 4.57764e-05 8.99998C4.57764e-05 8.26646 0.594646 7.67186 1.32817 7.67186Z" fill="#E1E1E1" />
                    </svg>
                </button>
            </div>
        </section>
    </main>
    <footer class="footer">
        <div class="footer__container container">
            <img class="footer__logo" src="./assets/image/LOGO-footer.png" alt="логотип">
            <nav class="footer__nav">
                <a class="footer__link" href="#">
                    О клинике
                </a>
                <a class="footer__link" href="#">
                    Услуги
                </a>
                <a class="footer__link" href="#">
                    Специалисты
                </a>
                <a class="footer__link" href="#">
                    Цены
                </a>
                <a class="footer__link" href="#">
                    Контакты
                </a>
            </nav>
            <div>
                <a class="footer__social" href="#"><img src="./assets/image/wp.png" alt="ссылка на вотсап"></a>
                <a class="footer__social" href="#"><img src="./assets/image/instagram.png" alt="Ссылка на инстаграм"></a>
                <a class="footer__social" href="#"><img src="./assets/image/telegram.png" alt="Ссылка на телеграм"></a>
            </div>
        </div>
    </footer>
    <div id="modal">
        <form class="modal-form">
            <div>
                <div>Имя</div>
                <input class="form-name" placeholder="Введите ваше имя" required>
            </div>
            <div>
                <div>Телефон</div>
                <input class="form-tel phone-mask" placeholder="Введите ваш телефон" required>
            </div>
            <button class="primary-btn" type="submit">
                Оформить заявку
            </button>
            <button class="secondary-btn close-btn">
                Закрыть
            </button>
            <div class="loaderWrapper">
                <div class="loader">
                </div>
            </div>
        </form>
    </div>
    <script src="https://unpkg.com/imask"></script>
    <script>
        var phoneMask = IMask(
            document.querySelector('.phone-mask'), {
                mask: '+{7}(000)000-00-00'
            });
    </script>
    <script type="module">
        import Swiper from 'https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.esm.browser.min.js'

        const swiper = new Swiper('.swiper', {
            loop: true,

            // If we need pagination
            pagination: {
                el: '.swiper-pagination',
                type: "fraction",
            },

            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });

        document.querySelector('.header__burger').addEventListener('click', (e) => {
            e.currentTarget.classList.toggle('active')
            document.querySelector('.header__bottom-line').classList.toggle('active')
            document.body.classList.toggle('stop-scroll')
        })

        document.querySelectorAll('.new-client').forEach(btn => {
            btn.addEventListener('click', (e) => {
                document.getElementById('modal').classList.toggle('active')
            })
        })

        document.querySelector('.close-btn').addEventListener('click', () => {
            document.getElementById('modal').classList.remove('active')
        })


        document.querySelector('.modal-form').addEventListener('submit', (e) => {
            e.preventDefault()
            const name = document.querySelector('.form-name').value
            const telephone = document.querySelector('.form-tel').value
            document.querySelector('.loaderWrapper').style.display='block'
            fetch('<?php echo $_ENV['URL'] ?>send.php', {
                    method: 'post',
                    body: JSON.stringify({
                        name,
                        telephone
                    }),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(data => data.json())
                .then((res) => {
                    if (res.success) {
                        alert('Заявка успешно отправлена')
                        document.getElementById('modal').classList.remove('active')
                    } else {
                        alert('Заявка не отправлена что то пошло не так!')
                    }
                    document.querySelector('.loaderWrapper').style.display='none'
                })
        })
    </script>

</body>

</html>