<?php

function globalVisits() {
    $agent = '';
    if(!isset($_SESSION['counted'])){
        $agent = $_SERVER['HTTP_USER_AGENT'];
    }
    $uri = $_SERVER['REQUEST_URI'];
    $user = 'No';
    if(isset($_SERVER['PHP_AUTH_USER'])) $user = $_SERVER['PHP_AUTH_USER'];
    $ip = $_SERVER['REMOTE_ADDR'];
    $ref = "No";
    if(isset($_SERVER['HTTP_REFERER'])) $ref = $_SERVER['HTTP_REFERER'];
    $dtime = date('r');

    $entry_line = "$dtime - IP: $ip | Agent: $agent | URL: $uri | Referrer: $ref | Username: $user \n";
    $fp = fopen("logs.txt", "a");
    fputs($fp, $entry_line);
    fclose($fp);
}

function userVisitsCounter(): array
{
    $pdo = new PDO("sqlite:db/cookdise.db");
    $pdo->setAttribute(PDO::ERRMODE_EXCEPTION, PDO::ATTR_ERRMODE);

    $dateNow = date('Y-m-d');
    $ip = $_SERVER['REMOTE_ADDR'];

    $stmt = $pdo->prepare("SELECT * FROM statistics WHERE date = :dateNow");
    $stmt->execute(array(":dateNow"=>$dateNow));
    $todayStatMas = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!$todayStatMas) {
        $pdo->query("DELETE FROM ips");

        $stmt = $pdo->prepare("INSERT INTO ips (ip_address, count) VALUES(:ip, 1)");
        $stmt->execute(array(':ip'=>$ip));

        $stmt = $pdo->prepare("INSERT INTO statistics (date, hosts, hits) VALUES(:dateNow, 1, 1)");
        $stmt->execute(array(":dateNow"=>$dateNow));
    }
    else {

        $stmt = $pdo->prepare("SELECT * FROM ips WHERE ip_address = :ip");
        $stmt->execute(array(":ip"=>$ip));
        $todayIdsRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if($todayIdsRow) {
            $stmt = $pdo->prepare("UPDATE statistics SET hits = hits + 1 WHERE date = :dateNow");
            $stmt->execute(array(":dateNow"=>$dateNow));

            $stmt = $pdo->prepare("UPDATE ips SET count = count + 1 WHERE ip_address = :ip");
            $stmt->execute(array(":ip"=>$ip));
        }
        else {
            $stmt = $pdo->prepare("INSERT INTO ips (ip_address) VALUES (:ip)");
            $stmt->execute(array(":ip"=>$ip));

            $stmt = $pdo->prepare("UPDATE statistics SET hits = hits + 1, hosts = hosts + 1 WHERE date = :dateNow");
            $stmt->execute(array(":dateNow"=>$dateNow));
        }
    }
    $globalStat = $pdo->query("SELECT * FROM statistics ORDER BY date")->fetchAll(PDO::FETCH_ASSOC);


    $stmt = $pdo->prepare("SELECT count FROM ips WHERE ip_address = :ip");
    $stmt->execute(array(":ip" => $ip));
    $currentUserStat = $stmt->fetch(PDO::FETCH_ASSOC);
    $stat = array(
        "global" => $globalStat,
        "currentUser" => $currentUserStat
    );

    return $stat;
}