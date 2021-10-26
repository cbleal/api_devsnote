<?php

# getall /api/getall - get

require '../config.php';

$method = strtolower($_SERVER['REQUEST_METHOD']);

if ($method == 'get') :
    $query = $pdo->query("SELECT * FROM devsnote");

    if ($query->rowCount() > 0) :
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($data as $item) :
            $array['result'][] = [
                'id' => $item['id'],
                'title' => $item['title']
            ];
        endforeach;
    else :
        $array['error'] = "Não existm dados";
    endif;
else :
    $array['error'] = "Metodo invalido (Apenas GET)";
endif;

require '../return.php';
