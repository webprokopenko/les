<?

    class Market extends Mysql{
        function getCompany($id_company){
            $query_test = $this->fetch_one("SELECT name_company FROM company WHERE id_company='$id_company'");
            return $query_test['name_company'];
        }
        function getCountry($id_country){
            $country=$this->fetch_one("SELECT name_country FROM country WHERE id_country='$id_country'");
            return $country['name_country'];
        }
        function getCategory($id_category){
            $category=$this->fetch_one("SELECT name_category FROM prod_category WHERE id_category='$id_category'");
            return $category['name_category'];
        }
        function getListCategory(){
            $query2=$this->fetch_array("SELECT * FROM prod_category");
            $list_category='';
            foreach ($query2 as $query){
                $list_category.="<option value='".$query['id_category']."'>".$query['name_category']."</option>";
            }
            return $list_category;
        }
        function getListCountry(){
            $query2=$this->fetch_array("SELECT * FROM country");
            $list_country='';
            foreach ($query2 as $query){
                $list_country.="<option value='".$query['id_country']."'>".$query['name_country']."</option>";
            }
            return $list_country;
        }
        function getTelCompany($id_company){
            $tel_company=$this->fetch_one("SELECT tel FROM company WHERE id_company='$id_company'");
            return $tel_company['tel'];
        }
        function getBodyMarket($type){
            $query_test = $this->fetch_array("SELECT * FROM market_tovar_q WHERE id_type_action='$type'");
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
    }
?>