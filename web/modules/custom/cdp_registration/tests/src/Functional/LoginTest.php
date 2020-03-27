<?php

namespace Drupal\Tests\cdp_registration\Functional;

use Drupal\Core\Url;
use Drupal\Tests\BrowserTestBase;
use Drupal\user\Entity\User;

/**
 * Testi user login.
 *
 * @group cdp_registration
 * @package Drupal\Tests\cdp_registration\Functional
 */
class LoginTest extends BrowserTestBase {
  /**
   * {@inheritdoc}
   */
  protected $defaultTheme = 'seven';

  /**
   * The modules to load to run the test.
   *
   * @var array
   */
  public static $modules = [
    'user',
  ];

  /**
   * {@inheritDoc}
   */
  protected function setUp() {
    parent::setUp();
  }


  /**
   * Test for the login form.
   */
  public function testLogin() {
    $user = $this->drupalCreateUser();
    $this->drupalLogin($user);
  }





}
