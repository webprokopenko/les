<?
require_once('class.common.php');
class Partners extends Common{
    function getBodyPartners(){
        $query_test = $this->fetch_array("SELECT * FROM partner  ORDER BY id_partner DESC");
        $body='';
        foreach ($query_test as $array) {
            $body.= "<li class='list__item catalog-item'>".
                "<div class='catalog-item__img-wrapper'>";
            $body.="<img src='img/partners.jpg' class='catalog-item__img' alt='Технологии'>";

            $body.=    "</div><div class='catalog-item__body'>".
                "<div class='catalog-item__name'>";

            $body.= "<a href='#' class='catalog-item__link'>Компания: ";
            $body.= $this->getCompany($array['id_company']);
            $body.=" </a></div>".
                "<div class='field'>".
                "<div class='field__name'>Дата</div>".
                "<div class='field__value'>".$array['data_actuality']."</div></div>".
                "<div class='field'>".
                "<div class='field__name'>Телефон</div>".
                "<div class='field__value'>";
            $body.="<div class='field__value'>".$this->getTelCompany($array['id_company']);
            $body.= "</div></div>".
                "<div class='field'>".
                "<div class='field__name'>Описание технологии</div>".
                "<div class='field__value'>".$array['opisanie_partner']."</div></div>".
                "</div>".
                "</div>".
                "</li>";
        }
        return $body;
    }
    function insertPartners($id_company,$opisanie, $date){
        $insert_market_query = "INSERT INTO partner (id_company,opisanie_partner, data_actuality)";
        $insert_market_query.= " VALUES('$id_company', '$opisanie','$date')";
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