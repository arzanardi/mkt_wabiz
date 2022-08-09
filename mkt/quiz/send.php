<?php

$result = [
    "success"=>false,
    "value"=>null,
    "message"=>""
];

function split_name($name) {
    $name = trim($name);
    $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
    $first_name = trim( preg_replace('#'.preg_quote($last_name,'#').'#', '', $name ) );
    return array($first_name, $last_name);
}

try {
    if(isset($_REQUEST["nome"], $_REQUEST["telefone"], $_REQUEST["email"])) {
        if($_REQUEST["nome"] != "" && $_REQUEST["telefone"] != "" && $_REQUEST["email"] != "") {

            $apiKey = 'db0cb171-beed-42db-b412-66ecd53662b1';
            $name = split_name($_REQUEST["nome"]);
            $subscriber = null;

            //1 - Tenta incluir o contato
            $curlAddSubscriber = curl_init();

            curl_setopt_array($curlAddSubscriber, array(
            CURLOPT_URL => 'https://backend.botconversa.com.br/api/v1/webhook/subscriber/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
            "phone": "'.$_REQUEST["telefone"].'",
            "first_name": "'.$name[0].'",
            "last_name": "'.$name[1].'"
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json',
                'API-KEY: '.$apiKey
            ),
            ));
            
            $responseAddSubscriber = json_decode(curl_exec($curlAddSubscriber));
            $httpcodeAddSubscriber = curl_getinfo($curlAddSubscriber, CURLINFO_HTTP_CODE);

            curl_close($curlAddSubscriber);

            //2 - Localiza o usuário
            $curlFindSubscriber = curl_init();

            curl_setopt_array($curlFindSubscriber, array(
            CURLOPT_URL => 'https://backend.botconversa.com.br/api/v1/webhook/subscriber/'.$_REQUEST["telefone"].'/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'API-KEY: '.$apiKey
            ),
            ));

            $responseFindSubscriber = json_decode(curl_exec($curlFindSubscriber));
            $httpcodeFindSubscriber = curl_getinfo($curlFindAddSubscriber, CURLINFO_HTTP_CODE);

            curl_close($curlFindSubscriber);

            if($httpcodeFindSubscriber == 200) {
                $subscriber = $responseFindSubscriber;
            }
            
            if($subscriber) {

                //3 - Fecha as conversas em aberto
                $curlCloseConversation = curl_init();

                curl_setopt_array($curlCloseConversation, array(
                CURLOPT_URL => 'https://backend.botconversa.com.br/api/v1/webhook/subscriber/'.$subscriber["id"].'/change_conversation_status/',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>'{
                "open_conversation": false,
                "manager": 0
                }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Accept: application/json',
                    'API-KEY: '.$apiKey
                ),
                ));

                $httpcodeCloseConversation = curl_getinfo($curlCloseConversation, CURLINFO_HTTP_CODE);

                curl_close($curlCloseConversation);

                if($httpcodeCloseConversation == 200) {

                    //4 - Coloca o usuário no fluxo do bot
                    $curlSendToFlow = curl_init();

                    curl_setopt_array($curlSendToFlow, array(
                    CURLOPT_URL => 'https://backend.botconversa.com.br/api/v1/webhook/subscriber/'.$subscriber["id"].'/send_flow/',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS =>'{
                    "flow": 389638
                    }',
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json',
                        'Accept: application/json',
                        'API-KEY: '.$apiKey
                    ),
                    ));

                    $httpcodeSendToFlow = curl_getinfo($curlSendToFlow, CURLINFO_HTTP_CODE);

                    curl_close($curlSendToFlow);

                    if($httpcodeSendToFlow == 200) {
                        $result["success"] = true;
                        $result["message"] = "Conversa iniciada!";
                    }
                }
            }
            else {
                throw new Exception("Não foi possível localizar o contato");
            }
        }
        else {
            throw new Exception("Parâmetros inválidos!");
        }
    }
    else {
        throw new Exception("Parâmetros não encontrados!");
    }
}
catch(Exception $ex) {
    $result["message"] = $ex->getMessage();
}


echo json_encode($result);