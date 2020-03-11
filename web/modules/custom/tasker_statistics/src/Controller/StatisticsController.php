<?php

namespace Drupal\tasker_statistics\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\tasker\Entity\Task;


class StatisticsController extends ControllerBase {

  /**
   * Return item as page content.
   *
   * @return array
   *   Page content array.
   */
  public function renderStatistics() {
    $stats = [];
    $nids = \Drupal::entityQuery('task')->condition('task_developer', \Drupal::currentUser()->id())->execute();
    $total = 0;
    foreach($nids as $nid){
      $data = Task::load($nid);
      if(!empty($data->get('task_deadline')->value) && !empty($data->get('task_time_true')->value)){
        $stats[] = [$data->get('task_deadline')->value, $data->get('task_time_true')->value, $data->get('task_title')->value];
        $total += 1;
      }
    }

    $build['#theme'] = 'tasker_statistics_theme';
    $build['#total'] = $total;
    $build['#attached']['drupalSettings']['statistic'] = $stats;
    $build['#attached']['library'][] = 'tasker_statistics/chart';

    return $build;
  }

}
