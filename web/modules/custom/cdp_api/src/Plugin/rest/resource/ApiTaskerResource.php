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
use Drupal\tasker\Entity\Task;
use Drupal\tasker\Entity\TaskInterface;
use Drupal\user\UserInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
/**
 * @RestResource(
 *   id = "cdp_api_tasker",
 *   label = @Translation("Tasker API"),
 *   serialization_class = "Drupal\user\Entity\User",
 *   uri_paths = {
 *     "canonical" = "/api/info/task/{task}",
 *     "https://www.drupal.org/link-relations/create" = "/api/create/task"
 *   }
 * )
 */
class ApiTaskerResource extends ResourceBase {
  use EntityResourceValidationTrait;

  public function get(Task $task = NULL) {

      die();
    $response = new ResourceResponse($task);
    return $response;
  }



  /**
   * Responds to POST requests.
   *
   * @return \Drupal\rest\ResourceResponse
   *   The HTTP response object.
   *
   * @throws \Symfony\Component\HttpKernel\Exception\HttpException
   *   Throws exception expected.
   */

  public function post(Task $task = NULL) {

     if ( strlen($task->getDescription()) > 1000 || empty($task->getDescription())){
      return new ResourceResponse('No description or it is too long');
    } elseif (strlen($task->getTask()) > 50 || empty($task->getTask())) {
      return new ResourceResponse('No title or it is too long');
    } elseif (empty($task->getTaskStatus())) {
      return new ResourceResponse('No task status entered');
    } elseif (  empty($task->getDeadline()) && !is_numeric($task->getDeadline())) {
       return new ResourceResponse('No deadline entered or value not a number');
     }

    $task->save();
    return new ResourceResponse('Task created');

  }

  public function delete(Task $task) {

    die();
    $node_storage = Task::load($task);
//    $node_storage->delete();

    return new ResourceResponse('Task deleted');
  }

  public function patch($task, Request $request) {

    $node_storage = Task::load($task);
    $node_storage->setTask('ssss');
    $node_storage->save();
   $s = $request->getContent();
    die($task .  $s );
  }


}







