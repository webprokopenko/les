<?
require_once('class.mysql.php');
Class Common extends Mysql{
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
    function getStatusEquipment($id_equipment){
        $status_equipment=$this->fetch_one("SELECT name_status_equipment FROM status_equipment_slv WHERE id_status_equipment='$id_equipment'");
        return $status_equipment['name_status_equipment'];
    }
    function getListStatusEquipment(){
        $query2=$this->fetch_array("SELECT * FROM status_equipment_slv");
        $list_status_equipment='';
        foreach ($query2 as $query){
            $list_status_equipment.="<option value='".$query['id_status_equipment']."'>".$query['name_status_equipment']."</option>";
        }
        return $list_status_equipment;
    }
    static function token(){
        $_SESSION['token'] = md5(uniqid(mt_rand(), true));
        return $_SESSION['token'];
    }
}
?>