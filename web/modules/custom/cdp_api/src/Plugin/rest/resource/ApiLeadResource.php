<?php
/**
 * @file
 */
namespace Drupal\cdp_api\Plugin\rest\resource;

use Drupal\Core\Config\ImmutableConfig;
use Drupal\Core\Session\AccountInterface;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\Plugin\rest\resource\EntityResourceAccessTrait;
use Drupal\rest\Plugin\rest\resource\EntityResourceValidationTrait;
use Drupal\rest\ResourceResponse;
use Drupal\user\UserInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
/**
 * @RestResource(
 *   id = "cdp_api_lead",
 *   label = @Translation("Registration API Lead"),
 *   serialization_class = "Drupal\user\Entity\User",
 *   uri_paths = {
 *     "canonical" = "/api/info",
 *     "https://www.drupal.org/link-relations/create" = "/api/register/lead"
 *   }
 * )
 */
class ApiLeadResource extends ResourceBase {
  use EntityResourceValidationTrait;

  /**
   * Responds to POST requests.
   *
   * @return \Drupal\rest\ResourceResponse
   *   The HTTP response object.
   *
   * @throws \Symfony\Component\HttpKernel\Exception\HttpException
   *   Throws exception expected.
   */

  public function post(UserInterface $account = NULL) {
    $users = \Drupal::entityTypeManager()->getStorage('user')->loadByProperties([
      'mail' => $account->getEmail(),
    ]);
    if($users){
      return new ResourceResponse('User with this email already exists.');
    }
    $this->validateMail($account->getEmail());
    $account->setUsername($this->createUserName($account->getEmail(), 'techlead'));
    $account->set("init",$account->getEmail());
    $account->set("roles","techlead");
    $account->save();
    _user_mail_notify('register_pending_approval', $account);
    return new ResourceResponse('User created');
  }


  //  COMEBACK AND MAKE THIS METHOD STATIC TO CREATE METHOD IN ONE PLACE AND NOT COPY IT

  public function createUserName($name, $role) {
    $namer = explode('@', $name);
    $emailco = explode('.',$namer[1]);
    return $namer[0] . '-' . $role . '-' . $emailco[0];
  }

  //  COMEBACK AND MAKE THIS METHOD STATIC TO CREATE METHOD IN ONE PLACE AND NOT COPY IT


  public function validateMail($mail) {
    $config = \Drupal::config('cdp_registration.settings');
    $regex = $config->get('email_validator_regex');
    if ($mail !== '' && !preg_match_all($regex, $mail)) {
      return new ResourceResponse('Wrong email');
    }
  }
}







