<?php

namespace Drupal\Tests\cdp_registration\Functional;

use Drupal\Core\Url;
use Drupal\Tests\BrowserTestBase;

/**
 * Testi user login.
 *
 * @group mail_auth
 * @package Drupal\Tests\mail_auth\Functional
 */
class LoginTest extends BrowserTestBase {

  /**
   * The modules to load to run the test.
   *
   * @var array
   */
  public static $modules = [
    'user',
    'mail_auth',
  ];

  /**
   * {@inheritDoc}
   */
  protected function setUp() {
    parent::setUp();
  }

  /**
   * Test for the drupal login form.
   */
  public function testLogin() {
    $user = $this->drupalCreateUser([], 'testUser');
    $session = $this->assertSession();
    $user_login_form_route = Url::fromRoute('user.login');
    $this->drupalGet($user_login_form_route);
    $session->statusCodeEquals(200);
    $session->fieldExists('name');
  }

}
