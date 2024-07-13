<?php

session_start();
header("Content-Type: text/html; charset=utf-8", true);

if (1 == 1) {

    include '../../includes/config2.php';

    function getBrowser() {
        $u_agent = $_SERVER['HTTP_USER_AGENT'];
        $bname = 'Unknown';
        $platform = 'Unknown';
        $version = "";

        //First get the platform?
        if (preg_match('/linux/i', $u_agent)) {
            $platform = 'linux';
        } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'mac';
        } elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'windows';
        }

        // Next get the name of the useragent yes seperately and for good reason
        if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
            $bname = 'Internet Explorer';
            $ub = "MSIE";
        } elseif (preg_match('/Firefox/i', $u_agent)) {
            $bname = 'Mozilla Firefox';
            $ub = "Firefox";
        } elseif (preg_match('/Chrome/i', $u_agent)) {
            $bname = 'Google Chrome';
            $ub = "Chrome";
        } elseif (preg_match('/Safari/i', $u_agent)) {
            $bname = 'Apple Safari';
            $ub = "Safari";
        } elseif (preg_match('/Opera/i', $u_agent)) {
            $bname = 'Opera';
            $ub = "Opera";
        } elseif (preg_match('/Netscape/i', $u_agent)) {
            $bname = 'Netscape';
            $ub = "Netscape";
        }

        // finally get the correct version number
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) .
                ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {
            // we have no matching number just continue
        }

        // see how many we have
        $i = count($matches['browser']);
        if ($i != 1) {
            //we will have two since we are not using 'other' argument yet
            //see if version is before or after the name
            if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
                $version = $matches['version'][0];
            } else {
                $version = $matches['version'][1];
            }
        } else {
            $version = $matches['version'][0];
        }

        // check if we have a number
        if ($version == null || $version == "") {
            $version = "?";
        }

        return array(
            'userAgent' => $u_agent,
            'name' => $bname,
            'version' => $version,
            'platform' => $platform,
            'pattern' => $pattern
        );
    }

    $hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
// now try it
    //$ua = getBrowser();
    //$yourbrowser = "IP: $hostname; Browser: " . $ua['name'] . " " . $ua['version'] . " on " . $ua['platform'] . " reports: <br >" . $ua['userAgent'];
//  print_r($yourbrowser);

    if ($tipo == "curso") {
        $sql = "SELECT * FROM valida_certificado WHERE cpf='$cpf' AND tipo='$tipo' AND codigo_curso='$codigo_curso'";
    } else if($tipo == "palestrante") {
        $sql = "SELECT * FROM valida_certificado WHERE codigo_curso='$codigo_curso' AND tipo='$tipo' AND cpf='-'";
    } else if($tipo == "voluntario"){
        $sql = "SELECT * FROM valida_certificado WHERE codigo_curso='$codigo_curso' AND tipo='voluntario' AND cpf='$cpf'";
    }else if ($tipo == "bolsista"){
        $sql = "SELECT * FROM valida_certificado WHERE codigo_curso='$codigo_curso' AND tipo='bolsista' AND cpf='$cpf'";
    } else if ($tipo == "orientador"){
        $sql = "SELECT * FROM valida_certificado WHERE codigo_curso='$codigo_curso' AND tipo='orientador' AND cpf='$cpf'";
    }

    $result = mysql_query($sql);
    $cont = mysql_num_rows($result);
    if ($cont == 0) {
        if ($tipo == 'curso') {
            mysql_query("INSERT INTO valida_certificado (cpf, codigo_curso, data, tipo) VALUES ('$cpf','$codigo_curso','" . date('Y-m-d H:i:s') . "', '$tipo')");
        } else if ($tipo == "palestrante"){
            mysql_query("INSERT INTO valida_certificado (cpf, codigo_curso, data, tipo) VALUES ('-', '$codigo_curso', '" . date('Y-m-d H:i:s') . "', '$tipo')");
        } else if ($tipo == "voluntario"){
            mysql_query("INSERT INTO valida_certificado (cpf, codigo_curso, data, tipo) VALUES ('$cpf', '$codigo_curso', '". date('Y-m-d H:i:s') ."', '$tipo')");
        }else if ($tipo == "bolsista"){
            mysql_query("INSERT INTO valida_certificado (cpf, codigo_curso, data, tipo) VALUES ('$cpf', '$codigo_curso', '". date('Y-m-d H:i:s') ."', '$tipo')");
        }else if ($tipo == "orientador"){
            mysql_query("INSERT INTO valida_certificado (cpf, codigo_curso, data, tipo) VALUES ('$cpf', '$codigo_curso', '". date('Y-m-d H:i:s') ."', '$tipo')");
        }

        $codigoCertificado = mysql_insert_id();
    } else {
        $campo = mysql_fetch_array($result);
        $codigoCertificado = $campo[codigo];
    }

//echo $yourbrowser;
    mysql_close($conexao);
}
?>