<?php

require '../config.php';

$method = strtolower($_SERVER['REQUEST_METHOD']);

if ($method == 'get') :

    $id = filter_input(INPUT_GET, 'id');

    if ($id) :
        $sql = $pdo->prepare("SELECT * FROM devsnote WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) :
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            $array['result'] = [
                "id" => $id,
                "title" => $data['title'],
                "body" => $data['body'],
            ];
        else :
            $array['error'] = "ID inexistente";
        endif;

    else :
        $array['error'] = "ID nao enviado";
    endif;

else :
    $array['error'] = "Metodo invalido (Apenas GET)";
endif;

require '../return.php';
