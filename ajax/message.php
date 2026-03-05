<?
	include("../settings/connect_datebase.php");
    include("./check_token.php");

    $data = checkToken($_COOKIE['token']);

    if(!$data) {
        http_response_code(401);
        exit;
    }

    $IdUser = $data['userId'];
    $Message = $mysqli->real_escape_string($_POST["Message"]);
    $IdPost = $_POST["IdPost"];

    $mysqli->query("INSERT INTO `comments`(`IdUser`, `IdPost`, `Messages`) VALUES ($IdUser, $IdPost, '$Message')");
?>