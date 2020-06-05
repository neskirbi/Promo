<?php
/**
 * Created by PhpStorm.
 * User: nztr
 * Date: 19/4/2018
 * Time: 10:26
 */
set_include_path(get_include_path() . PATH_SEPARATOR . 'phpseclib');

include('phpseclib/Net/SFTP.php');
$filepath = $_POST['filepath'];
$filename = $_POST['filename'];
$sftp = new Net_SFTP('share.jti.com');
if (!$sftp->login('MVTNESTORP', 'M5PQN8RzR1')) {
    exit('Login Failed');
}
$result = $sftp->put('/3rd_Parties/MexioSharedBI/PROMOTECNICAS/' . $filename, $filepath, NET_SFTP_LOCAL_FILE);
if ($result == 1) {
    http_response_code(200);
} else {
    http_response_code(500);
    print_r($sftp->getSFTPErrors());
}
?>

