<?php

/**
 * @file
 * Contains \Drupal\entity_claim\Form\ClaimTypeForm.
 */

namespace Drupal\entity_claim\Form;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ClaimTypeForm.
 *
 * @package Drupal\entity_claim\Form
 */
class ClaimTypeForm extends EntityForm {
  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $claim_type = $this->entity;
    $form['label'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $claim_type->label(),
      '#description' => $this->t("Label for the Claim type."),
      '#required' => TRUE,
    );

    $form['id'] = array(
      '#type' => 'machine_name',
      '#default_value' => $claim_type->id(),
      '#machine_name' => array(
        'exists' => '\Drupal\entity_claim\Entity\ClaimType::load',
      ),
      '#disabled' => !$claim_type->isNew(),
    );

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $claim_type = $this->entity;
    $status = $claim_type->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Claim type.', [
          '%label' => $claim_type->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Claim type.', [
          '%label' => $claim_type->label(),
        ]));
    }
    $form_state->setRedirectUrl($claim_type->urlInfo('collection'));
  }

}
