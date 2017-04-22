# Entity Claim
 
Drupal 8 port of [Entity claim](https://www.drupal.org/project/entity_claim) module.
 
## Road Map

### Scope 1
- Create Claim entity type.
  - It should able to select from available entities.
  - and it should able to select From the available bundles of the Entity.
- Create Claim content entity type.
  - User should able to access this page, based on permissions.
  - User will claim for the entity and on approval user will become 
    the author of the entity.Now, 
    We have two cases here.
    - IF user claims for normal Entity.
      - the author of entity will be changed to claimer's uid.
    - If user claims for User/Profile Entity. (**Future Plan**)
      - The user email will be changed to the claimer's required uid.
      - OR the user will be permitted with one time

### Scope 2
- Allow config form in backend to select entity and bundles.
- On Claim entity type, only those entity and bundles will be available to 
  claim.
