<?php

# insert /api/insert - post (title, body)

require '../config.php';

$method = strtolower($_SERVER['REQUEST_METHOD']);

if ($method == 'post') :

    $title = filter_input(INPUT_POST, 'title');
    $body  = filter_input(INPUT_POST, 'body');

    if ($title && $body) :
        $sql = $pdo->prepare("INSERT INTO devsnote SET title = :title, body = :body");
        $sql->bindValue(":title", $title);
        $sql->bindValue(":body", $body);
        $sql->execute();

        if ($sql->rowCount() > 0) :
            $id = $pdo->lastInsertId();
            $array['result'] = [
                "id" => $id,
                "title" => $title,
                "body" => $body,
            ];
        else :
            $array['error'] = "Erro ao inserir o registro";
        endif;

    else :
        $array['error'] = "Dados nao enviados";
    endif;

else :
    $array['error'] = "Metodo invalido (Apenas POST)";
endif;

require '../return.php';

