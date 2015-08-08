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
    <!-- endbuild -->

    <!-- build:js js/ie8.js -->
    <!--[if lt IE 9]>
    <script src="js/selectivizr.js"></script>
    <script src="bower/html5shiv/dist/html5shiv.js"></script>
    <![endif]-->
    <!-- endbuild -->
</head>
<body>
<!--    <aside class="korzina">-->
<!--        <div class="count_tov hidden" id="count_tov"></div>-->
<!--    </aside>-->
    <div class="page page_sidebar_left page-catalog">
        <header class="header">
            <div class="page__container">
                <div class="header__logo-container">
                     <div class="header__logo logo">
                         <a href="#" class="logo__link"><img src="img/logo_les.JPG" alt="DIAMANT PIVDEN LTD" class="logo__img">
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
                            while ($doc = mysql_fetch_row($result))
                            {
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
                        <? require_once("/views/module/join_us.php")?>
                        <ul class="catalog catalog_style_grid list">
                            <?
                            $query="SELECT * FROM product_tovari LIMIT 20";
                            $result = mysql_query($query) or die ('Запрос не удался'.mysql_error());
                            while ($doc = mysql_fetch_row($result))
                                {
                                    echo "<li class='list__item catalog-item'>".
                                            "<div class='catalog-item__img-wrapper'>";
                                    if($doc[2]==1) echo "<img src='img/krugluak.jpg' class='catalog-item__img' alt=''>";
                                        elseif($doc[2]==2) echo "<img src='img/doska.jpg' class='catalog-item__img' alt=''>";
                                        elseif ($doc[2]==3) echo "<img src='img/furnitura.jpg' class='catalog-item__img' alt=''>";

                                    echo    "</div><div class='catalog-item__body'>".
                                                "<div class='catalog-item__name'>";
                                    $query1=mysql_query("SELECT name_category FROM prod_category WHERE id_category='$doc[2]'");
                                    $rosw = mysql_result($query1,0);
                                    echo                "<a href='#' class='catalog-item__link'>$doc[1]</a>".
                                                "</div>";
                                    echo        "<div class='catalog-item__specs'>".
                                                    "<div class='field'>".
                                                        "<div class='field__name'>Категория</div>".
                                                        "<div class='field__value'>$rosw</div>".
                                                    "</div>".
                                                    "<div class='field'>".
                                                        "<div class='field__name'>Цена</div>".
                                                        "<div class='field__value'>$doc[3] грн.</div>".
                                                    "</div>".
                                                    "<div class='field'>".
                                                        "<div class='field__name'>Количество</div>".
                                                        "<div class='field__value'>$doc[4] м3</div>".
                                                    "</div>".
                                                    "<div class='field'>".
                                                    "<div class='field__name'>Происхождение</div>".
                                                    "<div class='field__value'>$doc[5]</div>".
                                                "</div>".
                                                "<div class='field'>".
                                                "<div class='field__name'>Дата</div>".
                                                "<div class='field__value'>$doc[6]</div>".
                                                "</div>".
                                            "</div>".
                                        "</div>".
                                    "</li>";
                                }
                            ?>
                        </ul>
                    </section>
                    <section class="content__block page-description">
                        <h2 class="content__block__header page-description__header">Пара слов о магазине</h2>
                        <div class="page-description__body">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor.</p>
                            <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.</p>
                        </div>
                    </section>
                </main>
                <? require_once("views/module/menu.php") ?>
            </div>
        </div>
        <div class="to-top" id="to-top">Наверх</div>
        </div>
        <?require_once("views/module/footer.php");?>
    </div>

    <!-- build:js js/vendor.js -->
    <script src='bower/jquery/dist/jquery.js'></script>
    <script src="js/jquery.simpleselect.js"></script>
    <!-- endbuild -->

    <!-- build:js js/main.js -->
    <script src="js/select.js"></script>
    <script src='js/catalog-nav.js'></script>
    <script src='js/catalog-style.js'></script>
    <script src='js/to-top.js'></script>
    <script src="js/ajax.js"></script>
    <!-- endbuild -->
</body>
</html>