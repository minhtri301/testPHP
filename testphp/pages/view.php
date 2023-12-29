<?php
session_start();

$id = $_GET['id'];

$apiUrl = "https://evaluation-technique.lundimatin.biz/api/clients/$id";

$options = array(
    CURLOPT_URL => $apiUrl,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => array(
        'Authorization: Basic ' . base64_encode(':' . $_SESSION['token']),
    ),
);

$ch = curl_init();
curl_setopt_array($ch, $options);

$response = curl_exec($ch);

$responseData = json_decode($response, true);

$client = $responseData['datas'];

curl_close($ch);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="../styles/index.css">

</head>
<body>
<header class="p-1 bg-primary text-center">
    <h1 class="d-flex container justify-content-start"><a href="index.php" class="text-light text-decoration-none">Rechercher un contact</a></h1>
</header>

<div class="user-list pt-5">
    <div class="container">
        <div class="container-title d-flex align-items-center p-2 justify-content-between">
            <h1><?php echo $client['nom'] ?></h1>
            <a href="edit.php?id=<?php echo $id ?>" class="btn btn-primary">Editer</a>
        </div>
        <div class="container-search">
            <form action="" method="post">
                <div class="form-field view-content">
                    <h5 class="px-5">Prenom & NOM</h5>
                    <p><?php echo $client['nom'] ?></p>
                </div>
                <div class="form-field view-content">
                    <h5 class="px-5">Telephone</h5>
                    <p><?php echo $client['tel'] ?></p>
                </div>
                <div class="form-field view-content">
                    <h5 class="px-5">Email</h5>
                    <p><?php echo $client['email'] ?></p>
                </div>
                <div class="form-field view-content">
                    <h5 class="px-5">Adresse</h5>
                    <p><?php echo $client['adresse'] ?></p>
                </div>
            </form>
        </div>
    </div>
</div>
</body>


</html>