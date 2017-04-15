<?php

/**
 * @file
 * Contains \Drupal\entity_claim\Entity\ClaimType.
 */

namespace Drupal\entity_claim\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;
use Drupal\entity_claim\ClaimTypeInterface;

/**
 * Defines the Claim type entity.
 *
 * @ConfigEntityType(
 *   id = "claim_type",
 *   label = @Translation("Claim type"),
 *   handlers = {
 *     "list_builder" = "Drupal\entity_claim\ClaimTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\entity_claim\Form\ClaimTypeForm",
 *       "edit" = "Drupal\entity_claim\Form\ClaimTypeForm",
 *       "delete" = "Drupal\entity_claim\Form\ClaimTypeDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\entity_claim\ClaimTypeHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "claim_type",
 *   admin_permission = "administer site configuration",
 *   bundle_of = "claim",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/claim_type/{claim_type}",
 *     "add-form" = "/admin/structure/claim_type/add",
 *     "edit-form" = "/admin/structure/claim_type/{claim_type}/edit",
 *     "delete-form" = "/admin/structure/claim_type/{claim_type}/delete",
 *     "collection" = "/admin/structure/claim_type"
 *   }
 * )
 */
class ClaimType extends ConfigEntityBundleBase implements ClaimTypeInterface {
  /**
   * The Claim type ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Claim type label.
   *
   * @var string
   */
  protected $label;

}
