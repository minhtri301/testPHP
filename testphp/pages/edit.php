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

if(!empty($_POST['update'])){

    $updatedData = array(
        'nom' => $_POST['nom'],
        'tel' => $_POST['tel'],
        'email' => $_POST['email'],
        'adresse' => $_POST['adresse'],
        'code_postal' => $_POST['code_postal'],
        'ville' => $_POST['ville'],
    );
    
    $options = array(
        CURLOPT_URL => $apiUrl,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'PUT', 
        CURLOPT_POSTFIELDS => json_encode($updatedData), 
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Basic ' . base64_encode(':' . $_SESSION['token']),
        ),
    );

    $ch = curl_init();
    curl_setopt_array($ch, $options);
    
    curl_close($ch);

    header('Location: ../pages/index.php');
    die();
}

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
            <a href="" class="btn btn-primary">Editer</a>
        </div>
        <div class="container-search">
            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                <lable>EDITION</lable>
                <div class="form-field ">
                    <input type="text" class="form-control" name="nom" value="<?php echo $client['nom'] ?>" required>
                </div>
                <div class="form-field">
                    <input type="number" class="form-control" name="tel" value="<?php echo $client['tel'] ?>" required>
                </div>
                <div class="form-field">
                    <input type="text" class="form-control" name="email" value="<?php echo $client['email'] ?>" required>
                </div>
                <div class="form-field">
                    <input type="text" class="form-control" name="adresse" value="<?php echo $client['adresse'] ?>" required>
                </div>
                <div class="form-field">
                    <input type="text" class="form-control" name="code_postal" value="<?php echo $client['code_postal'] ?>" required>
                </div>
                <div class="form-field">
                    <input type="text" class="form-control" name="ville" value="<?php echo $client['ville'] ?>" required>
                </div>
                <div class="form-field">
                        <a href="index.php" class="btn">Annuler</a>
                        <input type="submit" name="update" class="btn btn-success" value="Enregistrer">
                </div>
            </form>
        </div>
    </div>
</div>
</body>


</html>