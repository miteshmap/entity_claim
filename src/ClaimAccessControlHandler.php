<?php

/**
 * @file
 * Contains \Drupal\entity_claim\ClaimAccessControlHandler.
 */

namespace Drupal\entity_claim;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Claim entity.
 *
 * @see \Drupal\entity_claim\Entity\Claim.
 */
class ClaimAccessControlHandler extends EntityAccessControlHandler {
  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\entity_claim\ClaimInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished claim entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published claim entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit claim entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete claim entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add claim entities');
  }

}
