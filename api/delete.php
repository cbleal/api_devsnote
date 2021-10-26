<?php

# delete /api/delete - delete (id)

require '../config.php';

$method = strtolower($_SERVER['REQUEST_METHOD']);

if ($method == 'delete') :

    parse_str(file_get_contents("php://input"), $input);
    
    $id    = $input['id'] ?? null;

    $id     = filter_var($id);   

    if ($id) :
        $sql = $pdo->prepare("DELETE FROM devsnote WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) :           
            $array['result'] = [
                "msg" => "Excluido com sucesso",
            ];
        else :
            $array['error'] = "ID inexistente";
        endif;

    else :
        $array['error'] = "ID nao enviado";
    endif;

else :
    $array['error'] = "Metodo invalido (Apenas DELETE)";
endif;

require '../return.php';
