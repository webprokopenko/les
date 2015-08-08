<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Каталог | DiamantPivden</title>
    <meta name="description" content="Каталог интернет-магазина ЭпплShop: все виды продукции Apple.">
    <meta name="keywords" content="ЭпплShop, каталог, Apple, интернет-магазин">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png">
    <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/manifest.json">

    <!-- build:css css/vendor.css -->
    <!-- bower:css -->
    <link rel="stylesheet" href="../bower/normalize.css/normalize.css" />
    <!-- endbower -->
    <!-- endbuild -->

    <!-- build:css css/style.css -->
    <link rel="stylesheet" href="../css/style.css" />
    <!-- endbuild -->

    <!-- build:js js/ie8.js -->
    <!--[if lt IE 9]>
    <script src="../js/selectivizr.js"></script>
    <script src="../bower/html5shiv/dist/html5shiv.js"></script>
    <![endif]-->
    <!-- endbuild -->
</head>
<body>
<div class="page page_sidebar_left page-catalog">
    <header class="header">
        <div class="page__container">
            <div class="header__logo-container">
                <div class="header__logo logo">
                    <a href="#" class="logo__link"><img src="../img/logo_les.JPG" alt="DIAMANT PIVDEN LTD" class="logo__img">
                        <span class="logo__text">Diamant Pivden LTD</span>
                    </a>
                </div>
                <div class="header__contacts">
                    <a href="tel:+380933559999" class="header__phone">
                        <span class="header__phone-prefix">+3(8093)</span>
                        <span class="header__phone-number">355 99 99</span>
                    </a>
                    <a href="mailto:liweitaoshi@gmail.com" class="header__email">liweitaoshi@gmail.com</a>
                </div>
            </div>

            <nav class="header__menu">
                <ul class="menu list">
                    <?
                    $link = mysql_connect('localhost','root','') or die('Не удалось соединиться: '.mysql_error());
                    mysql_select_db('m1') or die('Не удалось выбрать БД');

                    $query="SELECT * FROM category";
                    $result = mysql_query($query) or die ('Запрос не удался'.mysql_error());
                    while ($doc = mysql_fetch_row($result)){
                        echo "<li class='list__item menu__item'><a href='#' id='$doc[0]' class='menu__link'>$doc[1]</a></li>";
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </header>

    <div class="page__wrapper">
        <div class="page__container">
            <div class="page__row clearfix">
                <ul class="breadcrumbs list">
                    <li class="list__item breadcrumbs__item">
                        <a href="#" class="breadcrumbs__link">Главная</a>
                    </li>
                    <li class="list__item breadcrumbs__item">
                        Каталог
                    </li>
                </ul>

                <div class="pagination">
                    <ul class="pagination__list list">
                        <li class="list__item pagination__item pagination__item_state_current">1</li>
                        <li class="list__item pagination__item"><a href="#" class="pagination__link">2</a></li>
                        <li class="list__item pagination__item"><a href="#" class="pagination__link">3</a></li>
                        <li class="list__item pagination__item"><a href="#" class="pagination__link">4</a></li>
                        <li class="list__item pagination__item"><a href="#" class="pagination__link">5</a></li>
                        <li class="list__item pagination__item"><a href="#" class="pagination__link">Все</a></li>
                    </ul>
                </div>

                <div class="catalog-style">
                    <form action="">
                        <select name="catalog-style" class="select catalog-style__select">
                            <option value="grid" class="select__option">Сеткой</option>
                            <option value="rows" class="select__option">Линиями</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="page__row page__middle clearfix">
                <main class="content page__region">
                    <section class="content__block">
                        <div class="wrapp__contact-me">
                            <div class="contact-me-header">
                            <h2 class="contact-me-text">У Вас есть вопросы? Напишите мы с Вами свяжемся</h2>
                        </div>
                        <div class="contact-me-body">
                            <form action="#" class="contact-me-form">
                                <div class="form-line clearfix">
                                    <div class="form-group name">
                                        <label for="name" class="label">Ваше имя</label>
                                        <input type="text" name="name" id="name" class="input" placeholder="Как к Вам обращаться" qtip-position="left" qtip-content="Вы не ввели Имя">
                                    </div>
                                    <div class="form-group email">
                                        <label for="tel" class="label">Ваш Телефон</label>
                                        <input type="email" name="email" id="email" class="input" placeholder="Ваш номер телефона" qtip-position="right" qtip-content="Вы не ввели email">
                                    </div>
                                </div>
                                <div class="form-line clearfix">
                                    <div class="form-group textarea">
                                        <label for="message" class="label">Сообщение</label>
                                        <textarea name="message" id="message" rows="4" class="textarea" placeholder="Кратко в чем суть" qtip-position="left" qtip-content="Вы не ввели сообщение"></textarea>
                                    </div>
                                </div>
                                <div class="form-line clearfix">
                                    <div class="g-recaptcha" data-sitekey="6LcZDwgTAAAAABv1IlcewE2vekMNPaAM1vGsYjdT"></div>
                                </div>
                                <div class="form-line clearfix">
                                    <div class="form-group">
                                        <button type="submit" class="btn send">Отправить</button>
                                    </div>
                                    <div class="form-group clear">
                                        <button type="reset" class="btn clear">Очистить</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        </div>
                    </section>
                </main>
                <? require_once("/module/menu.php") ?>
            </div>
        </div>
        <div class="to-top" id="to-top">Наверх</div>
    </div>

    <footer class="footer">
        <div class="footer__inner page__container">
            <div class="footer__logo">
                <a href="#" class="footer__logo-link">ЭпплShop</a>
            </div>

            <div class="page__region">
                <div class="footer__nav">
                    <nav class="footer-nav">
                        <div class="footer-nav__header">О магазине</div>
                        <ul class="footer-nav__list list">
                            <li class="list__item footer-nav__item"><a href="#" class="footer-nav__link">О нас</a></li>
                            <li class="list__item footer-nav__item"><a href="#" class="footer-nav__link">Наши цены</a></li>
                            <li class="list__item footer-nav__item"><a href="#" class="footer-nav__link">Наши скидки</a></li>
                            <li class="list__item footer-nav__item"><a href="#" class="footer-nav__link">Акции</a></li>
                        </ul>
                    </nav>
                    <nav class="footer-nav">
                        <div class="footer-nav__header">Каталог</div>
                        <ul class="footer-nav__list list">
                            <li class="list__item footer-nav__item"><a href="#" class="footer-nav__link">Смартфоны</a></li>
                            <li class="list__item footer-nav__item"><a href="#" class="footer-nav__link">Планшеты</a></li>
                            <li class="list__item footer-nav__item"><a href="#" class="footer-nav__link">Компьютеры</a></li>
                            <li class="list__item footer-nav__item"><a href="#" class="footer-nav__link">Аксессуары</a></li>
                        </ul>
                    </nav>
                    <nav class="footer-nav">
                        <div class="footer-nav__header">Контакты</div>
                        <ul class="footer-nav__list list">
                            <li class="list__item footer-nav__item"><a href="#" class="footer-nav__link">Телефоны</a></li>
                            <li class="list__item footer-nav__item"><a href="#" class="footer-nav__link">Адреса</a></li>
                            <li class="list__item footer-nav__item"><a href="#" class="footer-nav__link">Карта проезда</a></li>
                            <li class="list__item footer-nav__item"><a href="#" class="footer-nav__link">Обратная связь</a></li>
                        </ul>
                    </nav>
                </div>

                <div class="footer__extlinks">
                    <div class="footer__extlinks-row">
                        <ul class="apps list">
                            <li class="list__item apps__item"><a href="#" class="app app_appstore"><span class="app__text">Приложение в App Store</span></a></li>
                            <li class="list__item apps__item"><a href="#" class="app app_gplay"><span class="app__text">Приложение в Google Play</span></a></li>
                        </ul>
                    </div>
                    <div class="footer__extlinks-row">
                        <ul class="socials list">
                            <li class="list__item socials__item"><a href="#" class="social social_vk"><span class="social__text">Вконтакте</span></a></li>
                            <li class="list__item socials__item"><a href="#" class="social social_fb"><span class="social__text">Facebook</span></a></li>
                            <li class="list__item socials__item"><a href="#" class="social social_tw"><span class="social__text">Twitter</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </footer>

</div>

<!-- build:js js/vendor.js -->
<script src='../bower/jquery/dist/jquery.js'></script>
<script src="../js/jquery.simpleselect.js"></script>
<!-- endbuild -->

<!-- build:js js/main.js -->
<script src="../js/select.js"></script>
<script src='../js/catalog-nav.js'></script>
<script src='../js/catalog-style.js'></script>
<script src='../js/to-top.js'></script>
<script src="../js/ajax.js"></script>
<!-- endbuild -->
</body>
</html>