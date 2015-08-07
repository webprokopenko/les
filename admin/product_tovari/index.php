<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css">
    <!--    Подключаем qtip css для qtip2.js - всплывающие подсказки-->
    <link rel="stylesheet" href="../../bower/qtip2/jquery.qtip.min.css"/>
</head>
<body>
<div class="wrap__tovar">
    <div class="message__group">
        Сообщение от товара
        <div class="message__tovar-init"></div>
    </div>
    <form action="admin/product_tovar/ajax/ajax_add_tovar.php" class="form" id="add_tovar_form" method="post">
        <div class="row__tovar">
            <div class="col__tovar">
                <h3>Добавить товар</h3>
                <div class="wrapp__add-tovar">
                    <div class="t-cell">
                        <span class="span">Название</span>
                        <span class="span">Категория</span>
                        <span class="span">Цена</span>
                        <span class="span">Количество</span>
                        <span class="span">Страна происхождения</span>
                        <span for="data" class="span">Дата</span>
                    </div>
                    <div class="t-cell">
                        <input type="text" name="name_product" id="name_product" class="input" qtip-position="right" qtip-content="Вы не ввели Название">
                        <select name="category_f_k" id="category_f_k" class="input">
                        </select>
                        <input type="text" name="price" id="price" class="input" qtip-position="right" qtip-content="Вы не ввели Цену">
                        <input type="text" name="col_vo" id="col_vo" class="input" qtip-position="right" qtip-content="Вы не ввели Количество">
                        <select name="country_proish" id="country_proish" class="input">
                        </select>
                        <input type="text" name="data_actuality" id="data_actuality" class="input" qtip-position="right" qtip-content="Вы не ввели Дату">
                    </div>
                <input type="submit" value="Добавить товар">
                </div>
            </div>
    </form>
    <div class="col__tovar">
        <h3>Удалить товар</h3>
        <form action="admin/ajax/ajax_del_tovar.php" class="form" id="del_tovar_form" method="post">
            <div class="wrapp__del-tovar-list">
                <select name="del_tovar" id="del_tovar">

                </select>
                <input type="submit" value="Удалить товар"/>
            </div>
        </form>
    </div>
</div>
</div>
<script src="../../bower/jquery/dist/jquery.min.js"></script>
<script src="../../bower/qtip2/jquery.qtip.min.js"></script>
<script src="../../bower/jquery.inputmask/dist/jquery.inputmask.bundle.js"></script>
<script src="js/admin_product_tovari.js"></script>
</body>
</html>