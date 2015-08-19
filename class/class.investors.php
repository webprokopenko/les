<?
require_once('class.common.php');
class Investors extends Common{
    function getBodyInvestors(){
        $query_test = $this->fetch_array("SELECT * FROM investor  ORDER BY id_investor DESC");
        $body='';
        foreach ($query_test as $array) {
            $body.= "<li class='list__item catalog-item'>".
                "<div class='catalog-item__img-wrapper'>";
            $body.="<img src='img/investor.jpg' class='catalog-item__img' alt='Ищу инветора'>";

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
                "<div class='field__name'>Ищу инвестора</div>".
                "<div class='field__value'>".$array['opisanie_investor']."</div></div>".
                "</div>".
                "</div>".
                "</li>";
        }
        return $body;
    }
    function insertInvestors($id_company,$opisanie, $date){
        $insert_market_query = "INSERT INTO investor (id_company,opisanie_investor, data_actuality)";
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