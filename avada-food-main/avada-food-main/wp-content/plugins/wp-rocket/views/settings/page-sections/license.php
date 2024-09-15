<?php
/**
 * License section template.
 *
 * @since 3.0
 *
 * @param array {
 *     Section arguments.
 *
 *     @type string $id    Page section identifier.
 *     @type string $title Page section title.
 * }
 */

defined( 'ABSPATH' ) || exit;

?>

<div class="wpr-fieldsContainer">
	<div class="wpr-fieldsContainer-fieldset wpr-fieldsContainer-fieldset--split">
		<?php $this->render_settings_sections( $data['id'] ); ?>
	</div>
</div>
