<?php

/**
 * @file
 * Contains \Drupal\entity_claim\Entity\Claim.
 */

namespace Drupal\entity_claim\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for Claim entities.
 */
class ClaimViewsData extends EntityViewsData implements EntityViewsDataInterface {
  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['claim']['table']['base'] = array(
      'field' => 'id',
      'title' => $this->t('Claim'),
      'help' => $this->t('The Claim ID.'),
    );

    return $data;
  }

}
