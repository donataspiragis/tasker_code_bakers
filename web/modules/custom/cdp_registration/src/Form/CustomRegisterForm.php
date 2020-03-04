<?php

namespace Drupal\cdp_registration\Form;


use Drupal\Core\Form\FormStateInterface;
use Drupal\user\RegisterForm;

/**
 * Class MainRegisterForm
 *
 * @package Drupal\cdp_registration
 */
class CustomRegisterForm extends RegisterForm {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'cdp_registration_custom';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);
    $form['account']['name']['#access'] = FALSE;
    $form['account']['name']['#value'] = 'new' . user_password();
    $form['#validate'][] = [$this, 'validateMail'];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $form_state->setValue('name', $this->createUserName($form_state->getValue('mail'), $form_state->getStorage()['role']));
    parent::submitForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  protected function actions(array $form, FormStateInterface $form_state) {
    $element = parent::actions($form, $form_state);
    $element['submit']['#value'] = $this->t('Register');
    return $element;
  }

  /**
   * Email validation
   */
  public function validateMail(array &$form, FormStateInterface $form_state) {
    $config = \Drupal::config('cdp_registration.settings');
    $regex = $config->get('email_validator_regex');
    $mail = $form_state->getValue('mail');
    if ($mail !== '' && !preg_match_all($regex, $mail)) {
      $form_state->setError($form['account']['mail'], $this->t('Wrong email adress'));
    }
  }

  /**
   * Creates username
   * @param $name
   * @param $role
   *
   * @return string
   * @return string
   */
  public function createUserName($name, $role) {
    $namer = explode('@', $name);
    $emailco = explode('.',$namer[1]);
    return $namer[0] . '-' . $role . '-' . $emailco[0];
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $storage = $form_state->getStorage();
    if($storage['role']){
      $role_id = $storage['role'];
      $this->entity->set('roles', $role_id);
    }
    parent::save($form, $form_state);
  }
}

