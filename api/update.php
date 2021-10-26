<?php

require '../config.php';

$method = strtolower($_SERVER['REQUEST_METHOD']);

if ($method == 'put') :

    parse_str(file_get_contents("php://input"), $input);
    
    $id    = $input['id'] ?? null;
    $title = $input['title'] ?? null;
    $body  = $input['body'] ?? null;

    $id     = filter_var($id);
    $titile = filter_var($title);
    $body   = filter_var($body);

    if ($id && $title && $body) :
        $sql = $pdo->prepare("UPDATE devsnote SET title = :title, body = :body WHERE id = :id");
        $sql->bindValue(":title", $title);
        $sql->bindValue(":body", $body);
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) :           
            $array['result'] = [
                "id" => $id,
                "title" => $title,
                "body" => $body,
            ];
        else :
            $array['error'] = "ID inexistente";
        endif;

    else :
        $array['error'] = "Dados nao enviados";
    endif;

else :
    $array['error'] = "Metodo invalido (Apenas PUT)";
endif;

require '../return.php';
