<?session_start();
require_once('include/config.php');
require_once('class/class.technology.php');

$mysql = new Mysql();
$mysql->connect($host,$user,$pass,$db);
$technology = new Technology();
?>
<!doctype html>
<html lang="ru">
    <?require_once('/views/module/head.php');?>
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
                        Технологии - <b>Продажа</b>
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
                            <a href="#" id="add_technology" class="add_obj-item">
                                Добавить объявление о продаже технологий<br>
                            </a>
                        </div>
                    <?php endif; ?>
                    <ul class="catalog catalog_style_grid list">
                        <?=$technology->getBodyTechnology(2)?>
                    </ul>
                </section>
            </main>
            <? require_once("/views/module/menu.php") ?>
        </div>
        <div class="to-top" id="to-top">Наверх</div>
    </div>
    <? require_once("/views/module/footer.php")?>
</div>
<?php if($_SESSION['user_id']):?>
    <!-- Начало окна добавления продажи -->
    <div class="popup_add_prog" id="modal_technology_sale">
        <div class="popup_prog_header">
            <button type="button" class="close" id="close"></button>
            <div class="prog_header_text">
                Добавить объявление о продаже
            </div>
        </div>
        <div class="popup_prog_body">
            <div class="popup__msg">
            </div>
            <form action="../../ajax/ajax_add_technology_sale.php" class="form"  id="market_technology_send"  method="post" enctype="multipart/form-data">
                <label for="company" class="prog_span">Компания: <b><?=$technology->getCompany($_SESSION['user_id']);?></b></label>
                <label class="prog_span">Категория объявления: <b>Технологии - продажа</b></label>
                <label for="nazvanie" class="prog_span">Описание:</label>
                <textarea name="opisanie"  id="opisanie" rows="4" class="input h_a" placeholder="Описание технологии" qtip-position="left" qtip-content="Вы не ввели описание"></textarea>
                <input type="hidden" name="token" id="token" value="<?=$technology::token()?>"/>
                <div class="prog_row">
                    <button type="submit" class="btn">Добавить объявление о продаже технологий</button>
                </div>
            </form>
        </div>
    </div>
    <!-- конец окна добавления продажи -->
<?php endif; ?>
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
<script src="js/add_technology_sale.js"></script>
<script>
    $("#main").removeClass("catalog-nav__trigger_active catalog-nav__link catalog-nav__link_active").addClass("catalog-nav__trigger catalog-nav__link");
    $("#technology").addClass("catalog-nav__trigger_active catalog-nav__link catalog-nav__link_active");
    $("#technology_ul").addClass("catalog-nav__subnav_opened");
    $("#main_ul").removeClass("catalog-nav__subnav_opened");
</script>
</body>
</html>