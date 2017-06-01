<?php

/**
 * @file
 * Contains \Drupal\entity_claim\ClaimTypeInterface.
 */

namespace Drupal\entity_claim;

use Drupal\Core\Config\Entity\ConfigEntityInterface;

/**
 * Provides an interface for defining Claim type entities.
 */
interface ClaimTypeInterface extends ConfigEntityInterface {
  // Get Entity of claim type.
  public function getClaimEntity();

  // Get Bundle of claim type.
  public function getClaimEntityBundle();

}
