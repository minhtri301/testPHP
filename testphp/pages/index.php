<?php
session_start();

include "../function/auth.php"; 

$_SESSION['token'] = $responseData['datas']['token'];

$apiUrl = "https://evaluation-technique.lundimatin.biz/api/clients?fields=nom,adresse,ville,tel";

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

$datas = $responseData['datas'];

curl_close($ch);

function getFirstKeyword($string) {
    $keyword = explode(' ', $string);
    $chuCaiDauTien = '';

    foreach ($keyword as $keywordn) {
        $chuCaiDauTien .= strtoupper($keywordn[0]);
    }

    return $chuCaiDauTien;
}
?>


<!DOCTYPE html>
<html lang="en">

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>PHP API CRUD opearation - bootstrapfriendly</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="../styles/index.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

</head>

<body>

<header class="p-1 bg-primary text-center">
    <h1 class="d-flex container justify-content-start"><a href="index.php" class="text-light text-decoration-none">Rechercher un contact</a></h1>
</header>

<div class="user-list pt-5">
    <div class="container">
        <div class="container-title d-flex align-items-center p-2">
            <h1>Rechercher d'une fiche de contact</h1>
        </div>
        <div class="container-search">
            <form action="clients" method="post">
                <lable>Renseiger un nom ou une denomination</lable>
                <div class="form-field">
                    <input type="text" class="form-control" name="keyword" id="" placeholder="Nom ou denomination">
                </div>
                <div class="form-field d-flex justify-content-end">
                    <input type="submit" class="btn btn-primary" value="Rechercher" name="create">
                </div>
            </form>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Nom</th>
                    <th scope="col">Adresse</th>
                    <th scope="col">Ville</th>
                    <th scope="col">Telephone</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($datas as $value){ ?>
                <tr>
                <td style="width: 15px;">
                    <div class="image-conainer">
                        <?php echo getFirstKeyword($value['nom']); ?>
                    </div>
                </td>
                <td><?php echo $value['nom'] ?></td>
                <td><?php echo $value['adresse'] ?></td>
                <td><?php echo $value['ville'] ?></td>
                <td><?php echo $value['tel'] ?></td>
                <td>
                    <a class="btn btn-info" href="view.php?id=<?php echo $value['id'] ?>"> <i class="fas fa-search" style="margin-right:5px"></i>Voir</a>
                </td>
                </tr>
            <?php } ?>

            </tbody>
        </table>
    </div>
</div>
</body>

</html>
