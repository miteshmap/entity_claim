<?php

/**
 * @file
 * Contains \Drupal\entity_claim\Form\ClaimForm.
 */

namespace Drupal\entity_claim\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Claim edit forms.
 *
 * @ingroup entity_claim
 */
class ClaimForm extends ContentEntityForm {
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\entity_claim\Entity\Claim */
    $form = parent::buildForm($form, $form_state);
    $entity = $this->entity;

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->entity;
    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Claim.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Claim.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.claim.canonical', ['claim' => $entity->id()]);
  }

}
