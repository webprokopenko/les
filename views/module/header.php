<?
require_once("/../../include/config.php");
require_once("/../../class/class.common.php");
$mysql = new Mysql();
$mysql->connect($host, $user, $pass, $db);
$common = new Common();
?>
<header class="header">
    <div class="page__container">
        <div class="header__logo-container">
            <div class="header__logo logo">
                <a href="#" class="logo__link"><img src="../img/logo_les.JPG" alt="DIAMANT PIVDEN LTD" class="logo__img">
                    <span class="logo__text">Diamant Pivden LTD</span>
                    <?php if (!isset($_SESSION['user_id'])): ?>
                        <span><a href="#" id="avtorization">Вход</a></span>
                        <span><a href="registration.php" id="registration">Регистрация</a></span>
                    <? else: ?>
                        <span>Вы авторизованы</span>
                        <span><a href="../../logout.php" id="exit">Выход</a></span>
                    <?php endif; ?>
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
<!-- Начало окна авторизации -->
<div class="popup_add_prog" id="modal">
    <div class="popup_prog_header">
        <button type="button" class="close" id="close"></button>
        <div class="prog_header_text">
            Авторизация
        </div>
    </div>
    <div class="popup_prog_body">
        <div class="popup__msg">
        </div>
        <form action="../../ajax/ajax_avtorization.php" class="form"  id="avtorization_send"  method="post">
            <label for="email" class="prog_span">Логин</label>
            <input type="email" class="prog_input" placeholder="Введите Email" name="login" id="login" qtip-position="left" qtip-content="Вы не ввели логин">
            <label for="pass" class="prog_span">Пароль</label>
            <input type="password" class="prog_input" placeholder="Введите пароль" name="pass" id="pass" qtip-position="left" qtip-content="Вы не ввели пароль">
            <input name="token" id="token" value="<?=$common->token();?>" type="hidden"/>
            <div class="prog_row">
                <button type="submit" class="btn">Вход</button>
            </div>
        </form>
    </div>
</div>
<!-- конец окна авторизации -->