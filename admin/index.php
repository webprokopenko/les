<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <div class="wrap__group">
        <div class="message__group">
            Сообщение от групп
            <div class="message__group-init">
            </div>
        </div>
        <div class="main__group">
            <div class="row__group">
                <div class="col__group">
                    <h3>Добавить группу</h3>
                    <div class="wrap__list-group clearfix">
                        <h4>Список групп</h4>
                        <ul class="list__group ">
                        </ul>
                    </div>
                    <div class="wrap__add-group clearfix">
                        <form action="admin/ajax/ajax_add_group.php" class="form" id="add_group" method="post">
                            <label class="label" for="name">Группа
                                <input type="text" class="input-text" placeholder="Введите группу" name="group_name"/>
                            </label>
                            <input type="submit" class="input-submit" value="Добавить"/>
                        </form>
                    </div>
                </div>
                <div class="col__group">
                    <h3>Удалить группу</h3>
                    <form action="admin/ajax/ajax_del_group.php" class="form" id="del_group_form" method="post">
                        <div class="wrapp__del-group-list">
                            <select name="del_group" id="del_group">
                            </select>
                        </div>
                        <div class="wrap__del-group-sub">
                            <input type="submit" value="Удалить группу">
                        </div>
                    </form>
                </div>
                <div class="col__group">
                    <h3>Изменить группу</h3>
                    <form action="admin/ajax/ajax_update_group.php" class="form" id="update_group_form" method="post">
                        <div class="wrapp__del-group-list">
                            <select name="group_id" id="group_id">
                            </select>
                        </div>
                        <div class="wrap__del-group-sub">
                            <input type="text" name="group_name" id="group_name">
                            <input type="submit" value="Изменить группу">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="wrap__tovar">
        <div class="message__group">
            Сообщение от товара
            <div class="message__tovar-init"></div>
        </div>
        <form action="admin/ajax/ajax_add_tovar.php" class="form" id="add_tovar_form" method="post">
            <div class="row__tovar">
                <div class="col__tovar">
                    <h3>Добавить товар</h3>
                    <div class="wrapp__add-tovar">
                        <span for="name_tovar">Название
                            <input type="text" name="name_tovar" id="name_tovar">
                        </span>
                        <span for="articul_tovar">Артикул
                            <input type="text" name="articul_tovar" id="articul_tovar">
                        </span>
                        <span for="option_tovar">Опция
                            <input type="text" name="option_tovar" id="option_tovar">
                        </span>
                        <span for="f_k_color_tovar">Цвет
                            <select name="f_k_color_tovar" id="f_k_color_tovar">
                            </select>
                        </span>
                        <span for="razmer_tovar">Размер
                            <input type="text" name="razmer_tovar" id="razmer_tovar">
                        </span>
                        <span for="ves_tovar">Вес
                            <input type="text" name="ves_tovar" id="ves_tovar">
                        </span>
                        <span class="sp">Цена:
                            <input type="text" name="cena_tovar" id="cena_tovar">
                        </span>
                        <span class="sp">Группа
                            <select name="f_k_category" id="f_k_category">
                                <option value="1">Iphone</option>
                                <option value="2">Lenovo</option>
                                <option value="3">Dell</option>
                                <option value="4">Apple</option>
                                <option value="5">HTC</option>
                            </select>
                        </span>
                        <input type="submit" value="Добавить товар">
                    </div>
                </div>
            </form>
                <div class="col__tovar">
                    <h3>Удалить товар</h3>
                    <form action="admin/ajax/ajax_del_tovar.php" class="form" id="del_tovar_form" method="post">
                        <div class="wrapp__del-tovar-list">
                            <select name="del_tovar" id="del_tovar">
                                <option value="1">Мышка</option>
                                <option value="2">Коврик</option>
                                <option value="3">Клавиатура</option>
                                <option value="4">Кофе</option>
                                <option value="5">Чехол</option>
                            </select>
                            <input type="submit" value="Удалить товар"/>
                        </div>
                    </form>
                </div>
        </div>
    </div>
    <script src="../bower/jquery/dist/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>