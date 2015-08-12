<? session_start();?>
<?php if (!isset($_SESSION['user_id'])): ?>
    <div class="join_us">
        <h3>Хотите БЕСПЛАТНО оставлять свои объявления на нашем сайте - <a href="../../registration.php">регистрируйтесь</a></h3>
    </div>
<? else: ?>
    <div class="add_obj">
        <a href="#" id="add_market_sale" class="add_obj-item">
            Добавить объявление<br>
        </a>
    </div>
<?php endif; ?>