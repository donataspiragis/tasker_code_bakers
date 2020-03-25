<?php

namespace Drupal\Tests\tasker\Unit\Controller;

use Drupal\tasker\Controller\TaskerController;
use Drupal\Tests\UnitTestCase;

/**
 * The class to test TaskController class.
 *
 * @group tasker
 * @package Drupal\tests\tasker\Unit
 */
class ControllerTest extends UnitTestCase {

  /**
   * Test for TaskerController.
   */
  public function testTaskerController() {
    $controller = $this->getMockBuilder(TaskController::class)
      ->disableOriginalConstructor()
      ->getMock();

    $this->assertEquals(TRUE, is_object($controller));
  }

}
