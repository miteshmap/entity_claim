<?php

/**
 * @file
 * Contains \Drupal\entity_claim\ClaimListBuilder.
 */

namespace Drupal\entity_claim;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Claim entities.
 *
 * @ingroup entity_claim
 */
class ClaimListBuilder extends EntityListBuilder {
  use LinkGeneratorTrait;
  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Claim ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\entity_claim\Entity\Claim */
    $row['id'] = $entity->id();
    $row['name'] = $this->l(
      $entity->label(),
      new Url(
        'entity.claim.edit_form', array(
          'claim' => $entity->id(),
        )
      )
    );
    return $row + parent::buildRow($entity);
  }

}
