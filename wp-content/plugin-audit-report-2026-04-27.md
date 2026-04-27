# WordPress Plugin Audit Report

Date: 2026-04-27  
Scope: Installed plugins in `wp-content/plugins`, active plugin state from DB (`wp_options.active_plugins`), and usage signals from DB/theme.

## Method Used

1. Listed installed plugin directories.
2. Pulled active plugins from database (`wp_options.active_plugins`).
3. Collected plugin usage evidence from:
   - Plugin-specific tables (e.g., Gravity Forms, Redirection).
   - Options and custom post types.
   - Content/module usage in `wp_posts.post_content`.
   - Child theme references in `themes/divi-child`.

## Key Finding

- Installed plugins: **22**
- Active plugins: **22**
- Inactive plugins: **0**

So there are no "already inactive and safe to delete" plugins right now. Any cleanup must be done by **deactivate -> monitor -> delete**.

## Active Plugin Classification

### Keep (strong evidence of active use)

1. `gravityforms/gravityforms.php`
   - Evidence: `wp_gf_*` tables exist, `gf_forms=3`, `gf_entries=10795`.

2. `gravityformsrecaptcha/recaptcha.php`
   - Evidence: Gravity Forms is actively used; recaptcha add-on depends on it.

3. `contact-form-7/wp-contact-form-7.php`
   - Evidence: `wpcf7_contact_form` post type exists (`cf7_forms=1`); child theme has `.wpcf7-*` CSS.

4. `advanced-custom-fields/acf.php`
   - Evidence: `acf-field-group=1`, `acf-field=1`; child theme has ACF-related code.

5. `custom-post-type-ui/custom-post-type-ui.php`
   - Evidence: `cptui_post_types` and `cptui_taxonomies` options are populated (large serialized values).

6. `custom-post-type-permalinks/custom-post-type-permalinks.php`
   - Evidence: CPT permalink-related options exist (`cpt_permalink_options=2`).

7. `seo-by-rank-math/rank-math.php`
   - Evidence: `rank_math_options=56`; child theme uses Rank Math filters.

8. `redirection/redirection.php`
   - Evidence: `redirection_rules=2386`, `redirection_404_logs=1630`; plugin tables exist.

9. `luckywp-table-of-contents/luckywp-table-of-contents.php`
   - Evidence: `lwptoc_mentions=1421`; child theme includes `.lwptoc*` styles.

10. `divi-customblog-module/divi-customblog-module.php`
    - Evidence: content mentions `et_pb_custblog` (`94`), indicates active Divi module use.

11. `ds-before-after-slider/ds-before-after-slider.php`
    - Evidence: content mentions related slider patterns (`115`).

12. `wp-reviews-plugin-for-google/wp-reviews-plugin-for-google.php`
    - Evidence: trustindex mentions in content (`157`).

13. `insert-headers-and-footers/ihaf.php` (WPCode Lite)
    - Evidence: `wpcode` post type has `20` entries; options present.

### Keep for now (likely needed operationally/performance)

14. `wp-optimize/wp-optimize.php`
    - Evidence: plugin options present (`wp_optimize_options=23`).
    - Note: may overlap with other cache/performance tooling; do not remove without cache strategy review.

15. `akismet/akismet.php`
    - Evidence: comment spam exists (`comments_spam=33`), many posts/pages have open comments (`161`).

### Optional/Utility - Removal candidates only after business confirmation

16. `worker/init.php` (ManageWP Worker)
    - Evidence: options exist (`managewp_worker_options=27`).
    - Remove only if ManageWP/GoDaddy Pro dashboard is not used.

17. `simple-history/index.php`
    - Evidence: options present (`simple_history_options=15`).
    - Typically admin logging only; optional if no audit trail needed.

18. `duplicate-post/duplicate-post.php`
    - Evidence: options present (`duplicate_post_options=29`).
    - Editor convenience plugin; optional.

19. `fast-indexing-api/instant-indexing.php`
    - Evidence: minimal option footprint (`instant_indexing_options=1`).
    - Optional; depends on SEO workflow for rapid indexing.

20. `disable-gutenberg/disable-gutenberg.php`
    - Evidence: active, but no dedicated options found.
    - Potentially removable if Gutenberg is acceptable and workflow tested.

21. `speculation-rules/load.php`
    - Evidence: active, no clear option footprint found.
    - Optional performance enhancement; can be tested off.

### Custom/Business-specific plugin (confirm ownership before any change)

22. `divi-modules-table-maker/divi-modules-table-maker.php`
    - Evidence: active; Divi-specific feature plugin.
    - Treat as keep until page/module-level confirmation.

## Immediate Safe Deletion List

- **None** (no inactive plugins found).

## Recommended Cleanup Sequence (safe approach)

1. Staging backup/snapshot first.
2. Candidate batch A (lowest risk): `duplicate-post`, `simple-history`.
3. Candidate batch B: `speculation-rules`, `fast-indexing-api`.
4. Candidate batch C (workflow-impact): `disable-gutenberg`, `worker` (only if unused).
5. After each deactivation batch:
   - Verify frontend critical pages, forms, SEO meta output, redirects.
   - Verify admin workflows (editing, publishing, Divi builder).
   - Wait 24-72h, then delete only if no regressions.

## Notes for Next Phase

- Child theme is `divi-child` (parent `Divi`), and it contains direct Rank Math and ACF-related logic, so plugin removal must consider theme coupling.

