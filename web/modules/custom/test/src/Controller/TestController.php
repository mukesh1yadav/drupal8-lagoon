<?php

namespace Drupal\test\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class TestController.
 */
class TestController extends ControllerBase {

  /**
   * Hello.
   *
   * @return string
   *   Return Hello string.
   */
  public function hello() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: hello')
    ];
  }

}
