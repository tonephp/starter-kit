<?php

namespace app\controllers;

use app\models\WSubscribe;

class WSubscribeController extends AppController {
    
    public function subscribeAction() {
      if (isAjax()) {
        $dataBody = getRequestData();
        
        $email = $dataBody['email'] ?? null;

        if ($email) {
            $data = [
                'email' => $email
            ];
            $m_wSubscribe = new WSubscribe();
            $m_wSubscribe->load($data);

            $isEmailValid = $m_wSubscribe->validate();

            if (!$isEmailValid) {
                http_response_code(409);
                $res = [
                    'message' => 'Email not valid.'
                ];
            } else {

                $isEmailUnique = $m_wSubscribe->checkUnique();

                if (!$isEmailUnique) {
                    http_response_code(409);
                    $res = [
                        'message' => 'This email is already in use.'
                    ];
                } else if ($isEmailValid) {
                    $m_wSubscribe->save();
    
                    $res = [
                        'message' => 'Success! You subscribed.'
                    ];
                }
            }
            
        } else {
            http_response_code(404);
            $res = [
                'message' => 'Please enter the email.'
            ];
        }
        
        echo json_encode($res);
        die;
      }

      redirect();
    }
}