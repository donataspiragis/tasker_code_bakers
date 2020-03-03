<?php

namespace Drupal\tasker\Plugin\Block;

/**
 * @file
 * Contains \Drupal\tasker\Plugin\Block\CdpCopyright.
 */

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\tasker\Entity\Task;

/**
 *
 * @Block (
 *   id = "task_display",
 *   admin_label = @Translation("Task list"),
 *   category = @Translation("Tasker")
 * )
 */
class TaskDisplay extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
//    $task = Task::loadMultiple();
//    foreach ($task as $value) {
//      $value = $value->toArray();
//      $value = $value['task_title'][0]['value'];
//      dump($value);
//    }
    $arr = [];
    $task = Task::loadMultiple();
        foreach ($task as $key => $value) {
          $value = $value->toArray();
          $value = $value['task_title'][$key]['value'];
          $arr = $value;
        }
    return [
      'task_title' => $arr,
    ];
  }


  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $task = Task::loadMultiple();
    foreach ($task as $key => $value) {
      $value = $value->toArray();
      $value = $value['task_title'][0]['value'];
      $this->configuration['task_title'][] = $value['task_title'][0]['value'];
    }
  }

  /**
   * {@inheritdoc}
   */
  public function build() {


    return [
      '#theme' => 'task_theme',
      '#task_title' => $this->configuration['task_title'],
      '#label_display' => FALSE,
      '#attached' => [
        'library' => [
          'tasker/tasker-global',
        ],
      ],
    ];

  }

}
