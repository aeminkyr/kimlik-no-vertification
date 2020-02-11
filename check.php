<?php 
session_start();
if ($_POST) {
    $name_upper = tr_strtoupper($_POST['name']);
    $lastname_upper = tr_strtoupper($_POST['lastname']);
    $data = array(
        'ssn' => $_POST['ssn'],
        'name'=> $name_upper,
        'lastname' =>$lastname_upper,
        'birthyear'=>$_POST['birthyear'] 
    );
    $sonuc = verify($data);
    if($sonuc=="true"){
        $_SESSION['info'] =true;
        header("Location: index.php");
    }else{
        $_SESSION['info'] =false;
        header("Location: index.php");
    }
}

function tr_strtoupper($text)
{
    $search=array("ç","i","ı","ğ","ö","ş","ü");
    $replace=array("Ç","İ","I","Ğ","Ö","Ş","Ü");
    $text=str_replace($search,$replace,$text);
    $text=strtoupper($text);
    return $text;
}

function verify($data){
    $send = '<?xml version="1.0" encoding="utf-8"?>
    <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
    <soap:Body>
    <TCKimlikNoDogrula xmlns="http://tckimlik.nvi.gov.tr/WS">
    <TCKimlikNo>'.$data["ssn"].'</TCKimlikNo>
    <Ad>'.$data["name"].'</Ad>
    <Soyad>'.$data["lastname"].'</Soyad>
    <DogumYili>'.$data["birthyear"].'</DogumYili>
    </TCKimlikNoDogrula>
    </soap:Body>
    </soap:Envelope>';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,            "https://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx" );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt($ch, CURLOPT_POST,           true );
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POSTFIELDS,    $send);
    curl_setopt($ch, CURLOPT_HTTPHEADER,     array(
        'POST /Service/KPSPublic.asmx HTTP/1.1',
        'Host: tckimlik.nvi.gov.tr',
        'Content-Type: text/xml; charset=utf-8',
        'SOAPAction: "http://tckimlik.nvi.gov.tr/WS/TCKimlikNoDogrula"',
        'Content-Length: '.strlen($send)
    ));
    $gelen = curl_exec($ch);
    curl_close($ch);
    return strip_tags($gelen);
}