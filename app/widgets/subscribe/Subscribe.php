<?php

namespace app\widgets\subscribe;

use core\base\Widget;

class Subscribe extends Widget {

  protected $template;

  public function __construct() {
    $this->template = __DIR__ . '/templates/form/form.php';
    
    $this->run();
  }

  public function run() {
    echo $this->getHtml();
  }

  protected function getHtml() {
    ob_start();

    require $this->template;

    return ob_get_clean();
  }
}