<?php
session_start();

// Connexion DB (adapter)

if (isset($_POST['imgData'], $_POST['imgID']) && !empty($_POST['imgData']) && !empty($_POST['imgID'])) {
    $imgData = htmlspecialchars($_POST['imgData']);
    $imgID = htmlspecialchars($_POST['imgID']);

    $imgData = str_replace('data:image/jpeg;base64,', '', $imgData);

    $imgData = base64_decode($imgData);

    // determine the mime type
    $finfo = finfo_open();
    $mimeType = finfo_buffer($finfo, $imgData, FILEINFO_MIME_TYPE);
    echo "MIME Type: $mimeType";

    // print in debug mode
    // echo "Image Data: $imgData, Image ID: $imgID";
    if ($mimeType == "image/jpeg") {
        setlocale(LC_TIME, "fr_FR");
        $imgDate = strftime("%d %b %Y");
        $imgHour = strftime("%Hh%M");
        $imgPath = '../public/users_pictures/' . $imgID . '.jpeg';
        $idUsr = intval($_SESSION['user_profile']['id']);

        $newImg = imagecreatefromstring($imgData);
        imagejpeg(image: $newImg, file: $imgPath);
        imagedestroy($newImg);
        chmod('../public/users_pictures/' . $imgID . '.jpeg', 0777);
    }
    exit;

    // Retirer préfixe
}
?>