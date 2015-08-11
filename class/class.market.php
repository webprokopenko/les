<?
    require_once('/../include/config.php');
    class Market{
        function getCompany($id_company){
            //$link = mysql_connect('localhost','root','') or die('Не удалось соединиться: '.mysql_error());
            //mysql_select_db('m1') or die('Не удалось выбрать БД');
            $query2=mysql_query("SELECT name_company FROM company WHERE id_company='$id_company'");
            $company = mysql_result($query2,0);
            return $company;
        }
        function getCountry($id_country){
            $query=mysql_query("SELECT name_country FROM country WHERE id_country='$id_country'");
            $country = mysql_result($query,0);
            return $country;
        }
        function getCategory($id_category){
            $query=mysql_query("SELECT name_category FROM prod_category WHERE id_category='$id_category'");
            $category = mysql_result($query,0);
            return $category;
        }
        function getListCategory(){
            //$link = mysql_connect('localhost','root','') or die('Не удалось соединиться: '.mysql_error());
            //mysql_select_db('m1') or die('Не удалось выбрать БД');
            $query2=mysql_query("SELECT * FROM prod_category")or die ('Запрос не удался'.mysql_error());
            $list_category='';
            while ($doc = mysql_fetch_row($query2))
            {
                $list_category.="<option value='$doc[0]'>$doc[1]</option>";
            }
            return $list_category;
        }
        function getListCountry(){
            //$link = mysql_connect('localhost','root','') or die('Не удалось соединиться: '.mysql_error());
            //mysql_select_db('m1') or die('Не удалось выбрать БД');
            $query2=mysql_query("SELECT * FROM country")or die ('Запрос не удался'.mysql_error());
            $list_country='';
            while ($doc = mysql_fetch_row($query2))
            {
                $list_country.="<option value='$doc[0]'>$doc[1]</option>";
            }
            return $list_country;
        }
        function getTelCompany($id_company){
            //$link = mysql_connect('localhost','root','') or die('Не удалось соединиться: '.mysql_error());
            //mysql_select_db('m1') or die('Не удалось выбрать БД');
            $query2=mysql_query("SELECT tel FROM company WHERE id_company='$id_company'");
            $tel_company = mysql_result($query2,0);
            return $tel_company;
        }
        function getBodyMarketSale(){

            $query="SELECT * FROM market_tovar_q WHERE id_type_action='2' LIMIT 20";
            $result = mysql_query($query) or die ('Запрос не удался'.mysql_error());
            $body_market_sale='';
            while ($doc = mysql_fetch_row($result))
            {
                $body_market_sale.="<li class='list__item catalog-item'>".
                    "<div class='catalog-item__img-wrapper'>";
            if($doc[2]==1) $body_market_sale.= "<img src='img/krugluak.jpg' class='catalog-item__img' alt=''>";
            elseif($doc[2]==2) $body_market_sale.= "<img src='img/doska.jpg' class='catalog-item__img' alt=''>";
            elseif ($doc[2]==3) $body_market_sale.= "<img src='img/furnitura.jpg' class='catalog-item__img' alt=''>";

            $body_market_sale.="</div><div class='catalog-item__body'>".
                "<div class='catalog-item__name'>";

            $body_market_sale.="<a href='#' class='catalog-item__link'>Компания: ";
                //$body_market_sale.= $this->getCompany($doc[0]);
                $body_market_sale.=" </a></div>";
                $body_market_sale.=        "<div class='catalog-item__specs'>".
                $body_market_sale.="<div class='field'>".
                $body_market_sale.="<div class='field__name'>Категория</div>".
                $body_market_sale.="<div class='field__value'>$rosw</div>".
                $body_market_sale.="</div>".
                $body_market_sale.="<div class='field'>".
                $body_market_sale.="<div class='field__name'>Цена</div>".
                $body_market_sale.="<div class='field__value'>$doc[4] грн.</div>".
                $body_market_sale.="</div>".
                $body_market_sale.="<div class='field'>".
                $body_market_sale.="<div class='field__name'>Количество</div>".
                $body_market_sale.="<div class='field__value'>$doc[5] м3</div>".
                $body_market_sale.="</div>".
                $body_market_sale.="<div class='field'>".
                $body_market_sale.="<div class='field__name'>Происхождение</div>";
                $body_market_sale.="<div class='field__value'>--</div>".
                    "</div>".
                    "<div class='field'>".
                    "<div class='field__name'>Дата</div>".
                    "<div class='field__value'>$doc[6]</div></div>".
                    "<div class='field'>".
                    "<div class='field__name'>Телефон:</div>".
                    //"<div class='field__value'>"; echo $this->getTelCompany($doc[0]);
                $body_market_sale.= "</div></div>".
                "</div>".
                "</div>".
                "</li>";
            }
            return $body_market_sale;
        }
    }
?>