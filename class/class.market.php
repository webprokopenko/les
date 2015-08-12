<?
    require_once('class.common.php');
    class Market extends Common{
        function getBodyMarket($type){
            $query_test = $this->fetch_array("SELECT * FROM market_tovar_q WHERE id_type_action='$type' ORDER BY id_market DESC");
            $body='';
            foreach ($query_test as $array) {
                $body.= "<li class='list__item catalog-item'>".
                    "<div class='catalog-item__img-wrapper'>";
                if($array['id_prod_category']==1) $body.= "<img src='img/krugluak.jpg' class='catalog-item__img' alt=''>";
                elseif($array['id_prod_category']==2) $body.= "<img src='img/doska.jpg' class='catalog-item__img' alt=''>";
                elseif ($array['id_prod_category']==3) $body.= "<img src='img/furnitura.jpg' class='catalog-item__img' alt=''>";

                $body.=    "</div><div class='catalog-item__body'>".
                    "<div class='catalog-item__name'>";

                $body.= "<a href='#' class='catalog-item__link'>Компания: ";
                $body.= $this->getCompany($array['id_company']);
                $body.=" </a></div>";
                $body.=        "<div class='catalog-item__specs'>".
                    "<div class='field'>".
                    "<div class='field__name'>Категория</div>".
                    "<div class='field__value'>";
                $body.= $this->getCategory($array['id_prod_category']);
                $body.= "</div>".
                    "</div>".
                    "<div class='field'>".
                    "<div class='field__name'>Цена</div>".
                    "<div class='field__value'>".$array['cena']." грн.</div>".
                    "</div>".
                    "<div class='field'>".
                    "<div class='field__name'>Количество</div>".
                    "<div class='field__value'>".$array['col_vo']." м3</div>".
                    "</div>".
                    "<div class='field'>".
                    "<div class='field__name'>Происхождение</div>";

                $body.= "<div class='field__value'>";
                $body.= $this->getCountry($array['id_country_proish']);
                $body.="</div>".
                    "</div>".
                    "<div class='field'>".
                    "<div class='field__name'>Дата</div>".
                    "<div class='field__value'>".$array['data_actuality']."</div></div>".
                    "<div class='field'>".
                    "<div class='field__name'>Телефон:</div>".
                    "<div class='field__value'>".$this->getTelCompany($array['id_company']);
                $body.= "</div></div>".
                    "</div>".
                    "</div>".
                    "</li>";
            }
            return $body;
        }
        function insertMarket($id_company,$id_prod_category,$id_country_proish,$cena,$col_vo,$data_actuality, $id_type_action){
            $insert_market_query = "INSERT INTO market_tovar_q (id_company, id_prod_category, id_country_proish, cena, col_vo, data_actuality, id_type_action)";
            $insert_market_query.= " VALUES('$id_company', '$id_prod_category', '$id_country_proish', '$cena', '$col_vo', '$data_actuality', '$id_type_action')";
            $result = $this->query($insert_market_query);
            if($result) {
                $data['error'] = 0;
                $data['msg']="Объявление успешно добавлено";
            }
            else {
                $data['error'] = 1;
                $data['msg']="Ошибка!!Обратитесь в службу поддержки";
            }
            return $data;
        }
    }
?>