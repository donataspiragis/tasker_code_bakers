<?php

namespace Drupal\tasker\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\ContentEntityStorageInterface;
use Drupal\Core\Entity\EntityFormBuilderInterface;
use Drupal\tasker\Entity\Task;
use Drupal\tasker\Entity\TaskInterface;
use Drupal\user\UserStorageInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


class TaskerController extends ControllerBase {

  protected $entityFormBuilder;

  public function __construct(EntityFormBuilderInterface $entity_form_builder, ContentEntityStorageInterface $task) {
    $this->entityFormBuilder = $entity_form_builder;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity.form_builder'),
      $container->get('entity_type.manager')->getStorage('task')
    );
  }

  public function timeDeveloper(TaskInterface $task) {
    $content['developers_time_form'] = $this->entityFormBuilder->getForm($task,'time_developer');
    return $content;
  }

  public function timeLead(TaskInterface $task) {
    $content['lead_time_form'] = $this->entityFormBuilder->getForm($task, 'time_lead');
    return $content;
  }

}
