<?php

class mysql
{
    var $link, $result, $count;

    function connect($dbhost, $dbusername, $dbpassword, $dbname)
    {
        $this->link = mysql_pconnect($dbhost, $dbusername, $dbpassword);
        mysql_select_db($dbname);
        $query = "set character set cp1251";
        mysql_query($query) or die(mysql_error());

        mysql_query('SET NAMES cp1251');
        mysql_query('set session character_set_server=cp1251');
        mysql_query('set session character_set_database=cp1251');
        mysql_query('set session character_set_connection=cp1251');
        mysql_query('set session character_set_results=cp1251');
        mysql_query('set session character_set_client=cp1251');
    }

    function query($query)
    {
        $this->result = mysql_query($query);
        if($this->result === FALSE)
        {
            echo $query;
            echo("Error SQL");
            exit;
        }
    }

    function fetch_one($query)
    {
        $this->query($query);
        return mysql_fetch_array($this->result);
    }

    function fetch_array($query)
    {
        $this->query($query);
        $row=array();
        while($str = mysql_fetch_array($this->result))
            $row[] = $str;
        $this->count = count($row);
        return $row;
    }

    function insert_id()
    {
        return mysql_insert_id();
    }

    function close()
    {
        mysql_close($this->link);
    }
}

class sql
{
    var $link, $mode;

    function setmode($md=OCI_COMMIT_ON_SUCCESS)
    {
        $mode=$md;
    }

    function connect($login="remote", $password="remote", $sid="criminal")
    {
        $this->link=@ocilogon($login, $password, $sid, 'CL8MSWIN1251');
        if(!$this->link)
        {
            $msg='<br><font color="red">������ ���� ������. ��������� � ���������������.</font><br>';
            echo $msg;
        }
        else
            $this->query("ALTER SESSION SET NLS_DATE_FORMAT = 'dd.mm.yyyy'");
    }

    function fetch_array($query)
    {
        $statement=ociparse($this->link, $query);
        ociexecute($statement);

        $row2=array();
        while(ocifetchinto($statement, $row, OCI_ASSOC))
            $row2[]=$row;

        return $row2;
    }

    function fetch_one($query)
    {
        $statement=ociparse($this->link, $query);
        ociexecute($statement);
        ocifetchinto($statement, $row, OCI_ASSOC);

        return $row;
    }

    function query($query)
    {
        if(empty($this->mode))
            $this->setmode();
        $statement=@ociparse($this->link, $query);
        @ociexecute($statement, $this->mode);
        @ocifreestatement($statement);
    }

    function commit()
    {
        ocicommit($this->link);
    }

    function rollback()
    {
        ocirollback($this->link);
    }
    function logoff()
    {
        OCILogoff($this->link);
    }
}

function is_kst($st)
{
    $dls=substr($st, 0, strlen($st)-3);
    if(($dls==197)||($dls==198)||($dls==199)||($dls==201)||($dls==204)||($dls==205)||($dls==206))
        return false;
    else
        return true;
}

function p_p($value)
{
    if(isset($value))
        $ret=(!empty($value))?$value:'';
    else
        $ret='';

    return $ret;
}


function split_text($tx, $len1, $len2=0, $len3=0, $cstr=0)
{
    $hash=array();
    $i=0;
    $cs=$cstr;
    while(strlen($tx)>0)
    {
        if($i=0)
            $len=$len1;
        else
            $len=($len2==0)?$len1:$len2;

        $hash[count($hash)]=substr($tx, 0, $len);
        $tx=substr($tx, $len, strlen($tx)-$len);
        $i++;
    }
    if($cstr!=0)
    {
        $h2=array();
        if($cs>count($hash))
            $cs=count($hash);
        for($i=0; $i<$cs; $i++)
            $h2[$i]=$hash[$i];
        if($cs==1)
            $h2[count($h2)-1]=substr($h2[count($h2)-1], 0, $len1);
        if($cs>1)
            if($cs==$cstr)
            {
                if($len2!=0)
                    $h2[count($h2)-1]=substr($h2[count($h2)-1], 0, $len2);
            }
            else
            {
                if($len2!=0)
                    $h2[count($h2)-1]=substr($h2[count($h2)-1], 0, $len2);
            }
        $hash=array();
        $hash=$h2;
    }
    return $hash;
}

function get_slv($slv, $value)
{
    global $sql;

    if(!empty($value))
    {
        $row=$sql->fetch_one('SELECT '.$slv.'_TXT FROM '.$slv.'_SLV WHERE '.$slv.'_CODE='.$value);

        if(!empty($row))
            return $row[$slv.'_TXT'];
        else
            return '';
    }
    else
        return '';
}

function get_slv2($slv, $value)
{
    global $sql;

    if(!empty($value))
    {
        $row=$sql->fetch_one("SELECT ".$slv."_UKR FROM ".$slv."_SLV WHERE ".$slv."_CODE='".$value."'");

        if(!empty($row))
            return $row[$slv.'_UKR'];
        else
            return '';
    }
    else
        return '';
}

function access($dostupname)
{
    if(($dostupname=='stat_f1')||($dostupname=='stat_f11')||($dostupname=='stat_f12')||($dostupname=='stat_f2')
        ||($dostupname=='stat_f3')||($dostupname=='stat_f4')||($dostupname=='stat_f6')||($dostupname=='vibor_stat'))
        $dostupname='stat';
    if($dostupname=='adminjrn')
        $dostupname='wadmin';
    if($dostupname=='wapragaiotch')
        $dostupname='wapragai';
    if(($dostupname=='logsusers')||($dostupname=='pages')||($dostupname=='login')||($dostupname=='logout'))
        return true;
    else
    {
        if((isset($_SESSION['users']['access'][$dostupname]))&&($_SESSION['users']['access'][$dostupname]==1))
            return true;
        else
            return false;
    }
}

function setCookies($action='')
{
    global $mysql, $module, $def_fields;

    $userid=$_SESSION['users']['userid'];

    if(!empty($def_fields))
    {
        $row=$mysql->fetch_one('select id from cookies where userid="'.$userid.'" and module="'.$module.'" and action="'.$action.'"');
        if(!empty($row))
            $cookies_id=$row['id'];
        else
        {
            $query='insert into cookies set userid="'.$userid.'", module="'.$module.'", action="'.$action.'"';
            $mysql->query($query);
            $cookies_id=$mysql->insert_id();
        }
        if(!empty($cookies_id))
            foreach($def_fields as $value)
            {
                global $$value;

                $row=$mysql->fetch_one('select id from cookies_value where field="'.$value.'"');
                if(!empty($row))
                    $query='update cookies_value set value="'.$$value.'" where id="'.$row['id'].'"';
                else
                    $query='insert into cookies_value set cookies_id="'.$cookies_id.'", field="'.$value.'", value="'.$$value.'"';
                $mysql->query($query);
            }
    }
}

function getCookies($action='')
{
    global $mysql, $module, $def_fields;

    $userid=$_SESSION['users']['userid'];

    $row=$mysql->fetch_one('select * from cookies where userid="'.$userid.'" and module="'.$module.'" and action="'.$action.'"');
    if(!empty($row))
    {
        $rows2=$mysql->fetch_array('select * from cookies_value where cookies_id="'.$row['id'].'"');
        if(!empty($rows2))
            foreach($rows2 as $row2)
            {
                $field=$row2['field'];
                $value=$row2['value'];

                if(in_array($field, $def_fields))
                {
                    global $$field;

                    $$field=$value;
                }
                else
                    $mysql->query('delete from cookies_value where id="'.$row2['id'].'"');
            }
    }
}

function verifydate($date)
{
    if(eregi('[0-9]',$date))
    {
        list($day, $month, $year)=split("\\.", $date);
        return checkdate($month, $day, $year);
    }
}

function CheckActiveRozisk($fam, $ima, $otc, $datr)
{
    global $sql, $mysql, $data, $module;

    if(!isset($data['roz']))
        $data['roz']=array();

    $find_ukr=0;
    $find_sng=0;
    $find_don=0;
    $query="SELECT * FROM DN_UKR WHERE PRFM ='".$fam."' AND PRIM='".$ima."' AND PROT='".$otc."' AND PRDR='".$datr."' AND UDLN is NULL AND (DPREK IS NULL OR DSNT IS NULL)";
    $i=count($data['roz']);
    $rows=$sql->fetch_array($query);
    if(!empty($rows))
        foreach($rows as $row)
        {
            $find_ukr++;
            $data['roz'][++$i]['fam']=$row['PRFM'];
            $data['roz'][$i]['ima']=$row['PRIM'];
            $data['roz'][$i]['otc']=$row['PROT'];
            $data['roz'][$i]['datr']=$row['PRDR'];
            $addr='';
            if(!empty($row['PRST']))
                $addr.='������ <b>'.$row['PRST'].'</b> ';
            if(!empty($row['PROB']))
                $addr.='������� <b>'.$row['PROB'].'</b> ';
            if(!empty($row['PRRN']))
                $addr.='����� <b>'.$row['PRRN'].'</b> ';
            if(!empty($row['PRNS']))
                $addr.='���������� ����� <b>'.$row['PRNS'].'</b> ';
            $data['roz'][$i]['addr']=trim($addr);
            $data['roz'][$i]['rd']=$row['RD'];
            $data['roz'][$i]['drd']=$row['DRD'];
            $data['roz'][$i]['lost']=$row['LOST'];
            $data['roz'][$i]['cat']=get_slv('CATEGORIA', $row['KAT']);
            if(empty($data['roz'][$i]['cat']))
                $data['roz'][$i]['cat']=$row['KAT'];
            $data['roz'][$i]['mp']=get_slv('MERARZ', $row['MP']);
            if(empty($data['roz'][$i]['mp']))
                $data['roz'][$i]['mp']=$row['MP'];
            $uk='';
            $uk1=get_slv2('UKUKR', $row['UK1']);
            if(empty($uk1))
                $uk1=$row['UK1'];
            if(!empty($uk1))
                $uk.=$uk1.' ';
            $uk1=get_slv2('UKUKR', $row['UK2']);
            if(empty($uk1))
                $uk1=$row['UK2'];
            if(!empty($uk1))
                $uk.=$uk1.' ';
            $uk1=get_slv2('UKUKR', $row['UK3']);
            if(empty($uk1))
                $uk1=$row['UK3'];
            if(!empty($uk1))
                $uk.=$uk1.' ';
            $uk1=get_slv2('UKUKR', $row['UK4']);
            if(empty($uk1))
                $uk1=$row['UK4'];
            if(!empty($uk1))
                $uk.=$uk1.' ';
            $data['roz'][$i]['uk']=trim($uk);
            $data['roz'][$i]['ud']='� <b>'.$row['UD'].'</b> �� <b>'.$row['UDVZ'].'</b>; ��������������: <b>'.$row['UDPR'].'</b>; ���, �����. ��: <b>'.$UDOVD.'</b>';
            $ovs=get_slv('ORGAN', $row['OVD']);
            if(empty($ovs))
                $ovs=$row['OVD'];
            $data['roz'][$i]['ovs']=$ovs;
            $data['roz'][$i]['type']='������ �������';
        }
    $query="SELECT * FROM DN_SNG WHERE PRFM ='".$fam."' AND PRIM='".$ima."' AND PROT='".$otc."' AND PRDR='".$datr."' AND UDLN is NULL AND DZU is NULL";
    $i=count($data['roz']);
    $rows=$sql->fetch_array($query);
    if(!empty($rows))
        foreach($rows as $row)
        {
            $find_sng++;
            $data['roz'][++$i]['fam']=$row['PRFM'];
            $data['roz'][$i]['ima']=$row['PRIM'];
            $data['roz'][$i]['otc']=$row['PROT'];
            $data['roz'][$i]['datr']=$row['PRDR'];
            $addr='';
            if(!empty($row['PRST']))
                $addr.='������ <b>'.$row['PRST'].'</b> ';
            if(!empty($row['PROB']))
                $addr.='������� <b>'.$row['PROB'].'</b> ';
            if(!empty($row['PRRN']))
                $addr.='����� <b>'.$row['PRRN'].'</b> ';
            if(!empty($row['PRNS']))
                $addr.='���������� ����� <b>'.$row['PRNS'].'</b> ';
            $data['roz'][$i]['addr']=trim($addr);
            $data['roz'][$i]['rd']=$row['RD'];
            $data['roz'][$i]['drd']=$row['DRD'];
            $data['roz'][$i]['lost']=$row['LOST'];
            $data['roz'][$i]['cat']=$row['KATTXT'];
            $data['roz'][$i]['mp']=$row['MP'];
            $data['roz'][$i]['uk']=$row['UK'];
            $data['roz'][$i]['ud']='� <b>'.$row['UD'].'</b> �� <b>'.$row['UDVZ'].'</b>; ��������������: <b>'.$row['UDPR'].'</b>; ���, �����. ��: <b>'.$UDOVD.'</b>';
            $data['roz'][$i]['ovs']=$row['OVD'];
            $data['roz'][$i]['type']='������ ���';
        }
    if(!empty($data['roz']))
    {
        if($_SESSION['users']['status']==2)
        {
            $emails=array();
            $emails[0]='lamer@pol05.donec.ua';
            $subject='��������� �������';
            $email='php_server@pol05.donec.ua';
            $rows3=$mysql->fetch_array('SELECT email FROM email_ovd WHERE ovdjr_slv_code="'.$_SESSION['users']['slugjrn'].'"');
            if(!empty($rows3))
                foreach($rows3 as $row3)
                    $emails[count($emails)]=$row3['email'];
            foreach($data['roz'] as $val2)
            {
                $resume=' ��� �������� ����������������� ��������� �� ����� ��� ';
                $message='<p> ��� ������ ������������� WEB-�������� ��� ����� ������� � �������� �������. </p>';
                $message.='<p>&nbsp;<b>'.date('d.m.y � H:i').'</b>&nbsp;���������&nbsp;<b>'.$_SESSION['users']['registered'].' ';
                $message.='('.get_slv('OVDJR', $_SESSION['users']['ovdjrn']).' ';
                $message.='('.get_slv('SLUJR', $_SESSION['users']['slugjrn']).')</b>';
                $message.='<i><b>'.$resume.'</b></i>';
                $message.=' ���������� �������� ���� �� ���� ������ "������ ������������"</p>';
                $message.='<p>� ���������� �������� �����������, ��� �������, ���, �������� � ���� �������� ������������ ���� ��������� ��������� � ����������� � �������:</p>';
                $message.='<p><b>'.$val2['fam'].' '.$val2['ima'].' '.$val2['otc'].' '.$val2['datr'].'</b></p>';
                $message.='<p>��������� ������� - <b>'.$val2['ovs'].'</b> �� <b>'.$val2['rd'].'</b> �� <b>'.$val2['drd'].'</b>';
                $message.=' ������ <b>'.$val2['uk'].'</b> ���� ���������� - <b>'.$val2['mp'].'</b></p>';
                $message.='<p>���������� ��� �������� ��� ������������ ������������ � ������ � ����� � ���� "������ ������������"</p>';
                $message.='<center><a href=" http://101.5.1.245/">��� ����� ������� � �������� �������</a></center>';
                foreach($emails as $toaddr)
                    $res=SendEMail($toaddr, $subject, $email, $message);
            }
        }
        if(strlen($_SESSION['users']['registered'])>25)
            $fio_init=strtoupper(substr($_SESSION['users']['registered'], 0, 25));
        else
            $fio_init=strtoupper($_SESSION['users']['registered']);
        switch($module)
        {
            case 'apragai' : $vzap=203; break;
            default: $vzap=0;
        }
        $cfound=count($data['roz']);
        if($cfound>0)
            $result=2;
        else
            $result=1;
        $query="BEGIN INS_JOURNAL_ZAPROS_UKR (".$_SESSION['users']['ovdjrn'].",".$_SESSION['users']['slugjrn'].",'".$fio_init."',11, 101,";
        $query.=" '".$fam."', '".$ima."' ,'".$otc."', '".$datr."' , NULL, NULL, NULL, NULL,".$result.",".$cfound.", 1";
        $query.=", '".strtoupper($_SESSION['users']['usernamejrn'])."', $vzap, ".$find_don.", ".$find_ukr.", ".$find_sng.", NULL, NULL); END;";
        $sql->query($query);
        $sql->commit();
    }
}

function SendEMail($toaddr, $subject, $email, $message)
{
    $subject="[".$subject."]";
    $content=$message;
    $headers = "Content-type: text/html; charset=windows-1251;\n";
    $headers .= "From: ".$email;
    if(mail($toaddr, $subject, $content, $headers))
    {
        return 0;
    }
    else
    {
        return 1;
    }
}

function StringToScreen($string)
{
    return htmlspecialchars($string);
}

function GetAddressPerson($master, $mainkey, $vadr)
{
    global $sql;

    $row2=$sql->fetch_one('SELECT * FROM ADDRESS WHERE MAINKEY='.$mainkey.' AND MASTER='.$master.' AND VADR='.$vadr);
    $addr='';
    if(!empty($row2))
    {
        if(!empty($row2['STRANA']))
            $addr.=get_slv('STRANA', $row2['STRANA']).' ';
        if(!empty($row2['OBL']))
            $addr.=$row2['OBL'].' ������� ';
        if(!empty($row2['REGION']))
            $addr.=$row2['REGION'].' ����� ';
        if(!empty($row2['VPKT']))
            $addr.=get_slv('VPKT', $row2['VPKT']).' ';
        if(!empty($row2['PKT_NAME']))
            $addr.=$row2['PKT_NAME'].' ';
        if(!empty($row2['VULICA']))
            $addr.=get_slv('VULICA', $row2['VULICA']).' ';
        if(!empty($row2['ULICA_NAME']))
            $addr.=$row2['ULICA_NAME'].' ';
        if(!empty($row2['DOM']))
            $addr.='��� '.$row2['DOM'].' ';
        if(!empty($row2['DDOM']))
            $addr.='/ '.$row2['DDOM'].' ';
        if(!empty($row2['KOR']))
            $addr.=$row2['KOR'].' ';
        if(!empty($row2['KVAR']))
            $addr.='��. '.$row2['KVAR'].' ';
    }

    return trim($addr);
}

function LoadSlv($slv, $value)
{
    global $sql, $data;

    $rows=$sql->fetch_array('SELECT '.$slv.'_TXT, '.$slv.'_UKR, '.$slv.'_CODE FROM '.$slv.'_SLV');
    $i=-1;
    if(!empty($rows))
        foreach($rows as $row)
        {
            $data[$value][++$i]['code']=$row[$slv.'_CODE'];
            $data[$value][$i]['text']=$row[$slv.'_TXT'];
//    $data[$value][$i]['ukr']=$row[$slv.'_UKR'];
        }
}

function LoadSlv2($slv, $value)
{
    global $sql, $data;

    $rows=$sql->fetch_array('SELECT '.$slv.'_TXT, '.$slv.'_CODE FROM '.$slv.'_SLV');
    $i=-1;
    if(!empty($rows))
        foreach($rows as $row)
        {
            $data[$value][++$i]['code']=$row[$slv.'_CODE'];
            $data[$value][$i]['text']=$row[$slv.'_TXT'];
        }
}

?>
