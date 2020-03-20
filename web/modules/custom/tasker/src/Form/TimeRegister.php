<?php
namespace Drupal\tasker\Form;
use Drupal\Core\Entity\ContentEntityForm;
use Drupal\tasker\Entity\Task;
use Drupal\tasker\Entity\Tasks;
use Drupal\Core\Form\FormStateInterface;
use Drupal\user\Entity\User;
use Drupal\user\UserInterface;
use GuzzleHttp\Psr7\Response;

class TimeRegister extends ContentEntityForm {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'time_field_form';
  }
  /**
   * {@inheritdoc}
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   */
  public function form(array $form, FormStateInterface $form_state) {
    $this->entity = Task::load($this->entity->id());
    return parent::form($form, $form_state);
  }
  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {

    $account = $this->entity;
    $account->save();



    if( in_array('techlead', \Drupal::currentUser()->getRoles() )) {
    $form_state->setRedirect('view.lead_list.page_1');
    }
    elseif (in_array('developer', \Drupal::currentUser()->getRoles() )) {
      $form_state->setRedirect('view.developer_list.page_1');
    }
  }
}
