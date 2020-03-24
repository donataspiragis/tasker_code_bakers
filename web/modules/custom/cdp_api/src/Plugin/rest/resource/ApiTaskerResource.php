<?php
/**
 * @file
 */
namespace Drupal\cdp_api\Plugin\rest\resource;

use Drupal\rest\ModifiedResourceResponse;
use Drupal\Core\Config\ImmutableConfig;
use Drupal\Core\Session\AccountInterface;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\Plugin\rest\resource\EntityResourceAccessTrait;
use Drupal\rest\Plugin\rest\resource\EntityResourceValidationTrait;
use Drupal\rest\ResourceResponse;
use Drupal\tasker\Entity\Task;
use Drupal\tasker\Entity\TaskInterface;
use Drupal\user\UserInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
/**
 * @RestResource(
 *   id = "cdp_api_tasker",
 *   label = @Translation("Tasker API"),
 *   uri_paths = {
 *     "canonical" = "/api/info/task/{task}",
 *     "https://www.drupal.org/link-relations/create" = "/api/create/task"
 *   }
 * )
 */
class ApiTaskerResource extends ResourceBase {
  use EntityResourceValidationTrait;



}







