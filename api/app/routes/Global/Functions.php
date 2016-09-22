<?php
if (!defined('SPECIALCONSTANT')) die ("Acceso Denegado");

function get_cabbie_data($cabbie){
    $dataResp = array();
    $dataResp['Cabbie_Id'] = $cabbie->Cabbie_Id;
    $dataResp['Name'] = $cabbie->FirstName . ' ' . $cabbie->LastName;
    $dataResp['Email'] = $cabbie->Email;
    $dataResp['Phone'] = $cabbie->Phone;
    return $dataResp;
}

function verify_encrypt_Password ($Password, $Encrypted_Password, $Salt){

    $hash = base64_encode(sha1($Password . $Salt, true) . $Salt);
    if ($Encrypted_Password == $hash)
        return true;
    return false;
    
};

function encrypt_password ($Password){

    $salt = sha1(rand());
    $salt = substr($salt, 0, 10);
    $encrypted = base64_encode(sha1($Password . $salt, true) . $salt);
    $hash = array("salt" => $salt, "encrypted" => $encrypted);
    return $hash;
    
};

function get_user_data($user){
    $dataResp = array();
    $dataResp['Client_Id'] = $user->Client_Id;
    $dataResp['Name'] = $user->FirstName . ' ' . $user->LastName;
    $dataResp['Email'] = $user->Email;
    $dataResp['Phone'] = $user->Phone;
    return $dataResp;
}