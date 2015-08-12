<?session_start();
    require_once('include/config.php');
    require_once('class/class.mysql.php');
    require_once('class/class.market.php');

    $mysql = new Mysql();
    $mysql->connect($host,$user,$pass,$db);
    $market = new Market();
?>
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
    <link rel="stylesheet" href="bower/normalize.css/normalize.css" />
    <!-- endbower -->
    <!-- endbuild -->

    <!-- build:css css/style.css -->
    <link rel="stylesheet" href="css/style.css" />
    <!--    Подключаем qtip css для qtip2.js - всплывающие подсказки-->
    <link rel="stylesheet" href="bower/qtip2/jquery.qtip.min.css"/>
    <!-- endbuild -->

    <!-- build:js js/ie8.js -->
    <!--[if lt IE 9]>
    <script src="js/selectivizr.js"></script>
    <script src="bower/html5shiv/dist/html5shiv.js"></script>
    <![endif]-->
    <!-- endbuild -->
</head>
<body>
<div class="page page_sidebar_left page-catalog">
    <? require_once("/views/module/header.php")?>
    <div class="page__wrapper">
        <div class="page__container">
            <div class="page__row clearfix">
                <ul class="breadcrumbs list">
                    <li class="list__item breadcrumbs__item">
                        <a href="index.php" class="breadcrumbs__link">Главная</a>
                    </li>
                    <li class="list__item breadcrumbs__item">
                        Рынок продаж и покупок - Рынок продаж - <b>Покупка</b>
                    </li>
                </ul>
            </div>
            <main class="content page__region">
                <section class="content__block">
                    <?php if (!isset($_SESSION['user_id'])): ?>
                        <div class="join_us">
                            <h3>Хотите БЕСПЛАТНО оставлять свои объявления на нашем сайте - <a href="../../registration.php">регистрируйтесь</a></h3>
                        </div>
                    <? else: ?>
                        <div class="add_obj">
                            <a href="#" id="add_market_buy" class="add_obj-item">
                                Добавить объявление о покупке<br>
                            </a>
                        </div>
                    <?php endif; ?>
                    <ul class="catalog catalog_style_grid list">
                        <? echo $market->getBodyMarket(1);?>
                    </ul>
                </section>
            </main>
            <? require_once("/views/module/menu.php") ?>
        </div>
        <div class="to-top" id="to-top">Наверх</div>
    </div>
    <? require_once("/views/module/footer.php")?>
</div>
<!-- Начало окна добавления продажи -->
<div class="popup_add_prog" id="modal_market_buy">
    <div class="popup_prog_header">
        <button type="button" class="close" id="close"></button>
        <div class="prog_header_text">
            Добавить объявление о покупке
        </div>
    </div>
    <div class="popup_prog_body">
        <div class="popup__msg-buy">
        </div>
        <form action="../../ajax/ajax_add_market_sale.php" class="form"  id="market_buy_send"  method="post">
            <label for="company" class="prog_span">Компания: <b><?=$market->getCompany($_SESSION['user_id']);?></b></label>
            <label class="prog_span">Категория объявления: <b>Рынок продаж и покупок - Покупка</b></label>
            <label for="company" class="prog_span">Категория продукции:</label>
            <select class="select catalog-style__select" name="category_prod" id="category_prod">
                <?=$market->getListCategory()?>
            </select>
            <label for="country" class="prog_span">Категория продукции:</label>
            <select class="select catalog-style__select" name="country_proish" id="country_proish">
                <?=$market->getListCountry()?>
            </select>
            <label for="cena" class="prog_span">Цена</label>
            <input type="text" class="prog_input" placeholder="Введите цену" name="cena" id="cena" qtip-position="left" qtip-content="Вы не ввели цену">
            <label for="pass" class="prog_span">Количество</label>
            <input type="text" class="prog_input" placeholder="Введите количество" name="col_vo" id="col_vo" qtip-position="left" qtip-content="Вы не ввели количество">
            <input type="hidden" name="token" id="token" value="<?=$market::token()?>"/>
            <div class="prog_row">
                <button type="submit" class="btn">Добавить объявление о покупке</button>
            </div>
        </form>
    </div>
</div>
<!-- конец окна добавления продажи -->
<script src='bower/jquery/dist/jquery.js'></script>
<script src="js/jquery.simpleselect.js"></script>
<!--Всплывающие подсказки-->
<script src="bower/qtip2/jquery.qtip.min.js"></script>
<!--Маска ввода-->
<script src="bower/jquery.inputmask/dist/jquery.inputmask.bundle.js"></script>

<script src="js/select.js"></script>
<script src='js/catalog-nav.js'></script>
<script src='js/catalog-style.js'></script>
<script src='js/to-top.js'></script>
<script src="js/ajax.js"></script>

<script src="bower/bpopup/jquery.bpopup.min.js"></script>
<!--Скрипт-->
<script src="js/avtorization.js"></script>
<script src="js/add_market_buy.js"></script>
<script>
    $("#main").removeClass("catalog-nav__trigger_active catalog-nav__link catalog-nav__link_active").addClass("catalog-nav__trigger catalog-nav__link");
    $("#market").addClass("catalog-nav__trigger_active catalog-nav__link catalog-nav__link_active");
    $("#market_ul").addClass("catalog-nav__subnav_opened");
    $("#main_ul").removeClass("catalog-nav__subnav_opened");
</script>
</body>
</html>
<?$mysql->close();?>