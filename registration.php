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
    <!--    Подключаем qtip css для qtip2.js - всплывающие подсказки-->
    <link rel="stylesheet" href="bower/qtip2/jquery.qtip.min.css"/>
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
                        Регистрация
                    </li>
                </ul>
            </div>
            <div class="page__row page__middle clearfix">
                <main class="content page__region">
                    <section class="content__block">
                        <div class="wrapp__contact-me">
                            <div class="contact-me-header">
                                <h2 class="contact-me-text">Регистрация компании</h2>
                            </div>
                            <div class="registration__msg">
                            </div>
                            <div class="contact-me-body">
                                <form action="#" id="add_company" class="contact-me-form">
                                    <div class="form-line clearfix">
                                        <div class="form-group name">
                                            <label for="name" class="label">Ваше имя</label>
                                            <input type="text" name="name" id="name" class="input" placeholder="Как к Вам обращаться" qtip-position="left" qtip-content="Вы не ввели Имя">
                                        </div>
                                        <div class="form-group email">
                                            <label for="tel" class="label">Ваша должность</label>
                                            <input type="text" name="dolznost" id="dolznost" class="input" placeholder="Менеджер,бухгалтер" qtip-position="left" qtip-content="Вы не ввели Должность">
                                        </div>
                                    </div>
                                    <div class="form-line clearfix">
                                        <div class="form-group name">
                                            <label for="name" class="label">Email</label>
                                            <input type="email" name="email" id="name" class="input" placeholder="Ваш email" qtip-position="left" qtip-content="Вы не ввели EMAIL">
                                        </div>
                                        <div class="form-group email">
                                            <label for="tel" class="label">Телефон</label>
                                            <input type="tel" name="tel" id="tel" class="input" placeholder="Ваш телефон" qtip-position="left" qtip-content="Вы не ввели Должность">
                                        </div>
                                    </div>
                                    <div class="form-line clearfix">
                                        <div class="form-group name">
                                            <label for="country" class="label">Страна</label>
                                            <input type="text" name="country" id="country" class="input" placeholder="Страна" qtip-position="left" qtip-content="Вы не ввели Страну">
                                        </div>
                                        <div class="form-group email">
                                            <label for="adress" class="label">Адрес</label>
                                            <input type="text" name="adress" id="adress" class="input" placeholder="Ваш телефон" qtip-position="left" qtip-content="Вы не ввели Адрес">
                                        </div>
                                    </div>
                                    <div class="form-line clearfix">
                                        <div class="form-group name">
                                            <label for="pass1" class="label">Пароль</label>
                                            <input type="password" name="pass1" id="pass1" class="input"  qtip-position="left" qtip-content="Вы не ввели Пароль">
                                        </div>
                                        <div class="form-group email">
                                            <label for="pass2" class="label">Повторите пароль</label>
                                            <input type="password" name="pass2" id="pass2" class="input"  qtip-position="left" qtip-content="Вы не ввели Пароль">
                                        </div>
                                    </div>
                                    <div class="form-line clearfix">
                                        <div class="form-group textarea">
                                            <label for="message" class="label">Кратко о Вашей компании</label>
                                            <textarea name="message" id="message" rows="4" class="textarea" placeholder="Кратко чем занимается компания,ваши лучшие стороны" qtip-position="left" qtip-content="Вы не ввели сообщение"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-line clearfix">
                                        <div class="g-recaptcha" data-sitekey="6LcZDwgTAAAAABv1IlcewE2vekMNPaAM1vGsYjdT"></div>
                                    </div>
                                    <div class="form-line clearfix">
                                        <div class="form-group">
                                            <button type="submit" class="btn send">Сохранить</button>
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
                <? require_once("views/module/menu.php") ?>
            </div>
        </div>
        <div class="to-top" id="to-top">Наверх</div>
    </div>
    <? require_once("views/module/footer.php")?>
</div>


<script src='bower/jquery/dist/jquery.js'></script>
<script src="js/jquery.simpleselect.js"></script>
<!--Всплывающие подсказки-->
<script src="bower/qtip2/jquery.qtip.min.js"></script>
<!--Маска ввода-->
<script src="bower/jquery.inputmask/dist/jquery.inputmask.bundle.js"></script>
<!--Скрипт-->
<script src="js/registration.js"></script>


<script src="js/select.js"></script>
<script src='js/catalog-nav.js'></script>
<script src='js/catalog-style.js'></script>
<script src='js/to-top.js'></script>
<script src="js/ajax.js"></script>

</body>
</html>