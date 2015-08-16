<?
require_once('class.common.php');
class Equipment extends Common{
    function getBodyEquipment($type){
        $query_test = $this->fetch_array("SELECT * FROM equipment WHERE id_type_action='$type' ORDER BY id_equipment DESC");
        $body='';
        foreach ($query_test as $array) {
            $body.= "<li class='list__item catalog-item'>".
                "<div class='catalog-item__img-wrapper'>";
            $body.= "<img src='img/equipment.jpg' class='catalog-item__img' alt=''>";

            $body.=    "</div><div class='catalog-item__body'>".
                "<div class='catalog-item__name'>";

            $body.= "<a href='#' class='catalog-item__link'>Компания: ";
            $body.= $this->getCompany($array['id_company']);
            $body.=" </a></div>";
            $body.=        "<div class='catalog-item__specs'>".
                "<div class='field'>".
                "<div class='field__name'>Название</div>".
                "<div class='field__value'>";
            $body.= $array['nazvanie'];
            $body.= "</div>".
                "</div>".
                "<div class='field'>".
                "<div class='field__name'>Модель</div>".
                "<div class='field__value'>".$array['model']."</div>".
                "</div>".
                "<div class='field'>".
                "<div class='field__name'>Состояние</div>".
                "<div class='field__value'>".$this->getStatusEquipment($array['status_equipment'])."</div>".
                "</div>".
                "<div class='field'>".
                "<div class='field__name'>Дата</div>".
                "<div class='field__value'>".$array['data_actuality']."</div></div>".
                "<div class='field'>".
                "<div class='field__name'>Телефон:</div>".
                "<div class='field__value'>";
            $body.="<div class='field__value'>".$this->getTelCompany($array['id_company']);
            $body.= "</div></div>".
                "</div>".
                "</div>".
                "</li>";
        }
        return $body;
    }
    function insertEquipment($id_company,$nazvanie,$model,$status_equipment,$cena,$data_actuality, $id_type_action){
        $insert_market_query = "INSERT INTO equipment (id_company,nazvanie, model, status_equipment,cena, data_actuality, id_type_action)";
        $insert_market_query.= " VALUES('$id_company', '$nazvanie', '$model','$status_equipment' ,'$cena', '$data_actuality', '$id_type_action')";
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