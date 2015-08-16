<?session_start();
require_once('include/config.php');
require_once('class/class.equipment.php');

$mysql = new Mysql();
$mysql->connect($host,$user,$pass,$db);
$equipment = new Equipment();
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
                            Оборудование - <b>Продажа</b>
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
                                <a href="#" id="add_equipment_sales" class="add_obj-item">
                                    Добавить объявление о продаже оборудования<br>
                                </a>
                            </div>
                        <?php endif; ?>
                        <ul class="catalog catalog_style_grid list">
                            <?=$equipment->getBodyEquipment(2)?>
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
    <div class="popup_add_prog" id="modal_equipment_sale">
        <div class="popup_prog_header">
            <button type="button" class="close" id="close"></button>
            <div class="prog_header_text">
                Добавить объявление о продаже
            </div>
        </div>
        <div class="popup_prog_body">
            <div class="popup__msg-sale">
            </div>
            <form action="../../ajax/ajax_add_equipment_sale.php" class="form"  id="market_equipment_send"  method="post" enctype="multipart/form-data">
                <label for="company" class="prog_span">Компания: <b><?=$equipment->getCompany($_SESSION['user_id']);?></b></label>
                <label class="prog_span">Категория объявления: <b>Оборудование - Продажа</b></label>
                <label for="nazvanie" class="prog_span">Название:</label>
                <input type="text" class="prog_input" placeholder="Введите название оборудования" name="nazvanie" id="nazvanie" qtip-position="left" qtip-content="Вы не ввели название оборудования">
                <label for="model" class="prog_span">Модель:</label>
                <input type="text" class="prog_input" placeholder="Введите модель оборудования" name="model" id="model" qtip-position="left" qtip-content="Вы не ввели модель оборудования">
                <label for="model" class="prog_span">Фото оборудования:</label>
                <input type="file" name="foto_equipment" id="foto_equipment"/>
                <label for="status_equipment" class="prog_span">Состояние оборудования:</label>
                <select class="select catalog-style__select" name="status_equipment" id="status_equipment">
                    <?=$equipment->getListStatusEquipment()?>
                </select>
                <label for="cena" class="prog_span">Цена</label>
                <input type="text" class="prog_input" placeholder="Введите цену" name="cena" id="cena" qtip-position="left" qtip-content="Вы не ввели цену">

                <input type="hidden" name="token" id="token" value="<?=$equipment::token()?>"/>
                <div class="prog_row">
                    <button type="submit" class="btn">Добавить объявление о продаже</button>
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
    <script src="bower/jquery-file-upload/js/vendor/jquery.ui.widget.js"></script>
    <script src="bower/jquery-file-upload/js/jquery.iframe-transport.js"></script>
    <script src="bower/jquery-file-upload/js/jquery.fileupload.js"></script>
    <!--Скрипт-->
    <script src="js/avtorization.js"></script>
    <script src="js/add_equipment_sale.js"></script>
    <script>
        $("#main").removeClass("catalog-nav__trigger_active catalog-nav__link catalog-nav__link_active").addClass("catalog-nav__trigger catalog-nav__link");
        $("#equipment").addClass("catalog-nav__trigger_active catalog-nav__link catalog-nav__link_active");
        $("#equipment_ul").addClass("catalog-nav__subnav_opened");
        $("#main_ul").removeClass("catalog-nav__subnav_opened");
    </script>
    </body>
    </html>
<?$mysql->close();?>