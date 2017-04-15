<?php

/**
 * @file
 * Contains \Drupal\entity_claim\ClaimInterface.
 */

namespace Drupal\entity_claim;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Claim entities.
 *
 * @ingroup entity_claim
 */
interface ClaimInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {
  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Claim type.
   *
   * @return string
   *   The Claim type.
   */
  public function getType();

  /**
   * Gets the Claim name.
   *
   * @return string
   *   Name of the Claim.
   */
  public function getName();

  /**
   * Sets the Claim name.
   *
   * @param string $name
   *   The Claim name.
   *
   * @return \Drupal\entity_claim\ClaimInterface
   *   The called Claim entity.
   */
  public function setName($name);

  /**
   * Gets the Claim creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Claim.
   */
  public function getCreatedTime();

  /**
   * Sets the Claim creation timestamp.
   *
   * @param int $timestamp
   *   The Claim creation timestamp.
   *
   * @return \Drupal\entity_claim\ClaimInterface
   *   The called Claim entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Claim published status indicator.
   *
   * Unpublished Claim are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Claim is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Claim.
   *
   * @param bool $published
   *   TRUE to set this Claim to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\entity_claim\ClaimInterface
   *   The called Claim entity.
   */
  public function setPublished($published);

}
