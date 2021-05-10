<?php

namespace app\models;

use core\base\Model;

class WSubscribe extends Model {

  public $table = 'w_subscribe';

  public $attributes = [
    'email' => ''
  ];
  
  public $rules = [
    'required' => [
      ['email'],
    ],
    'email' => [
      ['email'],
    ],
  ];

  public function checkUnique() {
    $sql = "SELECT * FROM $this->table WHERE email = ?";
    $candidateEmail = $this->attributes['email'];
    $email = $this->db->query($sql, [$candidateEmail]);

    if ($email) {
      $email = $email[0];
      if ($email['email'] === $candidateEmail) {
        return false;
      }
    }

    return true;
  }
}