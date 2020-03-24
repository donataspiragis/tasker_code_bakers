<?php

namespace Drupal\Tests\tasker\Functional;

use Drupal\Tests\BrowserTestBase;

/**
 * Skeleton functional test.
 *
 * @group testing_example
 * @group examples
 */
class FunctionalTest extends BrowserTestBase {
  /**
   * {@inheritdoc}
   */
  protected $defaultTheme = 'stark';

  /**
   * This test method fails, so we can be sure our test is discovered.
   */
  public function testFail() {
    $this->fail('The test runner found our test and failed it. Yay!');
  }

}
