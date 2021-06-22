<html>
<head>
    <title>Форма входа</title>
</head>
<body>
<?php

$login = $_GET['login'];
$password = $_GET['password'];

$data = json_decode(file_get_contents('db.json'));
$num = 0;

for ($i = 0; $i < sizeof($data->usersData); $i++) {
    if($data->usersData[$i]->login === $login) {
        $num = $i;
        break;
    }
}

if(($data->usersData[$num]->login === $login) && ($data->usersData[$num]->password === $password)) {
    $text = $_GET['text'];
    $date = date('Y-m-d H:i:s');
    $messenger = array('login' => $login, 'mess' => $text, 'date' => $date);
    array_push($data->message, $messenger);
    file_put_contents('db.json', json_encode($data));
}
else {
    echo "Вы ввели логин или пароль неверно";
}

$data = json_decode(file_get_contents("db.json"));

for ($i = 0; $i < sizeof($data->message); $i++) {
    echo "----------------------------";
    echo "<br/>";
    echo $data->message[$i]->login;
    echo "<br/>";
    echo $data->message[$i]->mess;
    echo "<br/>";
    echo $data->message[$i]->date;
    echo "<br/>";
}
?>
</body>
</html>