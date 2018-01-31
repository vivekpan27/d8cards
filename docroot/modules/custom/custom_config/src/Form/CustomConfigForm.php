<?php

namespace Drupal\custom_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Creates a Custom Config Form.
 */
class CustomConfigForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'custom_config_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function getEditableConfigNames() {
    return [
      'custom_config.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('custom_config.settings');

    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Name'),
      '#default_value' => $config->get('name'),
    ];

    $form['gender'] = [
      '#type' => 'radios',
      '#title' => $this->t('Gender'),
      '#options' => [
        '0' => $this->t('Male'),
        '1' => $this->t('Female'),
        '2' => $this->t('Others'),
      ],
      '#default_value' => $config->get('gender'),
    ];

    $form['language'] = [
      '#type' => 'select',
      '#title' => $this->t('Main Language'),
      '#options' => [
        '1' => $this->t('English'),
        '2' => [
          '2.1' => $this->t('Hindi 1'),
          '2.2' => $this->t('Hindi 2'),
        ],
        '3' => $this->t('Bengali'),
      ],
      '#default_value' => $config->get('language'),
    ];

    // $form['password'] = [
    //   '#type' => 'password',
    //   '#title' => $this->t('Password'),
    //   '#size' => 25,
    // ];

    $form['confirm_password'] = [
      '#type' => 'password_confirm',
      '#title' => $this->t('Password Confirm'),
      '#size' => 25,
    ];

    $form['age'] = [
      '#type' => 'number',
      '#title' => 'Age',
      '#min' => 10,
      '#max' => 100,
      '#size' => 25,
    ];

    $form['link'] = [
      '#type' => 'link',
      '#title' => $this->t('This form link'),
      '#url' =>  Url::fromRoute('custom_config_config_form'),
    ];

    $form['address'] = [
      '#type' => 'textarea',
      '#title' => 'Address',
      '#rows' => '4',
      '#cols' => '10',
      '#resizable' => 'horizontal', //none,vertical,horizontal,both
      '#maxlength' => 200, //max number of chars
    ];

    $form['date'] = [
      '#type' => 'date',
      '#title' => $this->t('Date'),
      '#default_value' => [
        'year' => '2018',
        'month' => '1',
        'date' => '1',
      ],
    ];

    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Email'),
    ];

    $form['color'] = [
      '#type' => 'color',
      '#title' => $this->t('Color'),
      '#default_value' => '#ff0000',
    ];

    $form['days'] = [
      '#type' => 'checkboxes',
      '#title' => 'Days',
      '#options' => [
        '1' => 'Sunday',
        '2' => 'Monday',
        '3' => 'Tuesday',
        '4' => 'Wednesday',
        '5' => 'Thursday',
        '6' => 'Friday',
        '7' => 'Saturday',
      ],
      '#default_value' => '1',
    ];
    // $form['actions'] = ['#type' => 'actions'];
    // $form['actions']['submit'] = [
    //   '#type' => 'submit',
    //   '#title' => $this->t('Submit'),
    // ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    kint($form_state->getValue('color'));
    $this->configFactory->getEditable('custom_config.settings')
    ->set('name', $form_state->getValue('name'))
    ->set('gender', $form_state->getValue('gender'))
    ->set('language', $form_state->getValue('language'))
    ->save();

    parent::submitForm($form, $form_state);
  }

}
