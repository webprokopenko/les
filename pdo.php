<?
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = array(
PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
);
$pdo = new PDO($dsn, $user, $pass, $opt);

function pdoSet($fields, &$values, $source = array()) {
$set = '';
$values = array();
if (!$source) $source = &$_POST;
foreach ($fields as $field) {
if (isset($source[$field])) {
$set.="`".str_replace("`","``",$field)."`". "=:$field, ";
$values[$field] = $source[$field];
}
}
return substr($set, 0, -2);
}
$allowed = array("name_company","name_sotr","dolzn_sotr",'email','tel','country','adress','password','opisanie'); // allowed fields
$sql = "INSERT INTO company SET ".pdoSet($fields,$values);
$stm = $pdo->prepare($sql);
$stm->execute($values);
?>