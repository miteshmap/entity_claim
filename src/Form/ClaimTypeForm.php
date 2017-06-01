<?php

/**
 * @file
 * Contains \Drupal\entity_claim\Form\ClaimTypeForm.
 */

namespace Drupal\entity_claim\Form;

use Drupal\Core\Entity\ContentEntityTypeInterface;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Entity\EntityManagerInterface;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class ClaimTypeForm.
 *
 * @package Drupal\entity_claim\Form
 */
class ClaimTypeForm extends EntityForm {

  /**
   * The Entity manager.
   *
   * @var \Drupal\Core\Entity\EntityManagerInterface
   */
  protected $entityManager;

  /**
   * ClaimTypeForm constructor.
   *
   * @param \Drupal\Core\Entity\EntityManagerInterface $entityManager
   */
  public function __construct(EntityManagerInterface $entityManager) {
    $this->entityManager = $entityManager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity.manager')
    );
  }

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

    /**
     * @todo: make entity & bundle editable on edit form.
     */
    $form['entity'] = array(
      '#type' => 'select',
      '#title' => $this->t('Select Entity Type'),
      '#default_value' => $claim_type->getClaimEntity(),
      '#options' => $this->getAvailaleEntityTypes(),
      '#disabled' => !$claim_type->isNew(),
      '#ajax' => [
        'wrapper' => 'claim-entity-bundle',
        'callback' => '::bundleAjaxCallback'
      ]
    );

    $form['entity_bundle'] = array(
      '#type' => 'select',
      '#title' => $this->t('Bundle'),
      '#options' => [
        '' => $this->t('Select')
      ],
      '#default_value' => $claim_type->getClaimEntityBundle(),
      '#disabled' => !$claim_type->isNew(),
      '#prefix' => '<div id="claim-entity-bundle">',
      '#suffix' => '</div>',
    );

    if ($form_state->getValue('entity') || $claim_type->getClaimEntity()) {
      if ($form_state->getValue('entity')) {
        $entity_type_id = $form_state->getValue('entity');
      }
      elseif ($claim_type->getClaimEntity()) {
        $entity_type_id = $claim_type->getClaimEntity();
      }

      $bundles = $this->entityManager->getBundleInfo($entity_type_id);
      $bundle_options = [];
      $bundle_options[] = $this->t('Select');
      foreach ($bundles as $bundle_id => $bundle) {
        $bundle_options[$bundle_id] = $bundle['label'];
      }
      $form['entity_bundle']['#options'] = $bundle_options;
    }

    return $form;
  }

  /**
   * Get the list of all bundles of given entity type id.
   *
   * @return mixed
   */
  public function bundleAjaxCallback(array $form, FormStateInterface $form_state) {
    return $form['entity_bundle'];
  }

  /**
   *  Get the list of all available Entity type that can be claimed.
   *
   * @return array
   *   Return array of all available entity types.
   */
  private function getAvailaleEntityTypes() {
    $entity_types = $this->entityManager->getDefinitions();
    $bundles = $this->entityManager->getAllBundleInfo();
    $entity_type_list = [];

    // Get all entity types.
    foreach ($entity_types as $entity_type_id => $entity_type) {
      // Get Entity type in the list if it meets the validation.
      //
      // Should be of type content entity, should have bundles & exclude the
      // claim entity type from the list.
      if ($entity_type instanceof ContentEntityTypeInterface && isset($bundles[$entity_type_id]) && $entity_type_id != $this->entity->getEntityTypeId()) {
        $entity_type_list[$entity_type_id] = $entity_type->getLabel() ?: $entity_type_id;
      }
    }

    return $entity_type_list;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state){
    $form_state->setValue('bundle', $form_state->getValue('entity_bundle'));
    parent::submitForm($form, $form_state);
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
