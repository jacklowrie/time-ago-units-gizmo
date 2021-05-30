<?php
/**
 *
 */
namespace WP_Gizmo\Gizmo;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class GizmoSettings {

	public function __construct() {
		// add Time Ago Units Settings submenu
		add_action( 'admin_menu', [ $this, 'time_ago_units_settings_menu' ] ) );
		add_action( 'admin_init', [ $this, 'time_ago_units_register_settings' ] ) );

	}

	public function time_ago_units_register_settings() {
		register_setting(
			'time_ago_units_options',
			'time_ago_units_options'
		);
		add_settings_section(
			'time_ago_units_section_general',
			'General Settings',
			[ $this, 'time_ago_units_section_callback' ],
			'time_ago_units'
		);
		add_settings_field(
			'time_ago_units_display_type',
			'Time Ago Units Display Units',
			[ $this, 'time_ago_units_settings_callback' ],
			'time_ago_units',
			'time_ago_units_section_general',
			[ 'id' => 'time_ago_units_display_type', 'label' => 'Choose the Time Ago starting unit' ]
		);
	}

	public function time_ago_units_default_settings() {
		return [ 'time_ago_units_display_type' => 'default' ];
	}

	public function time_ago_units_section_callback() {
		echo '<p>General settings for the Time Ago Units Plugin</p>';
	}

	public function time_ago_units_settings_callback( $args ) {
		$options = get_option( 'time_ago_units_options', $this->time_ago_units_default_settings() );

		$id = isset( $args['id'] ) ? $args['id'] : '';
		$label = isset( $args['label'] ) ? $args['label'] : '';

		$selected_option = isset( $options[ $id ] ) ? sanitize_text_field( $options[ $id ] ) : '';

		$select_options = [
			'default'     => 'Default',
			'no_minutes'  => 'No Minutes',
			'no_hours'    => 'No Hours',
			'no_days'     => 'No Days',
			'no_weeks'    => 'No Weeks',
			'no_months'   => 'No Months',
		];

		echo '<select id="time_ago_units_options_' . $id . '" name="time_ago_units_options[' . $id . ']">';

		foreach ( $select_options as $value => $option ) {

			$selected = selected( $selected_option === $value, true, false );

			echo '<option value="' . $value . '"' . $selected . '>' . $option . '</option>';

		}

		echo '</select> <label for="time_ago_units_options_' . $id . '">' . $label . '</label>';
	}

	// this makes the submenu page in the dashboard
	public function time_ago_units_settings_menu() {
		add_submenu_page(
			'options-general.php',
			'Time Ago Units Options',
			'Time Ago Units',
			'manage_options',
			'time_ago_units',
			[ $this, 'time_ago_units_settings_page_html' ]
		);
	}

	// the form on the submenu page in the dashboard (which time_ago_units_settings_menu created)
	public function time_ago_units_settings_page_html() {
		// check user capabilities
		if ( ! current_user_can( 'manage_options' ) ) {
			return 'insufficient privileges';
		}
		?>
		<div class="wrap">
				<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
				<form action="options.php" method="post">
						<?php
						// output security fields for the registered setting "wporg_options"
						settings_fields( 'time_ago_units_options' );
						// output setting sections and their fields
						// (sections are registered for "wporg", each field is registered to a specific section)
						do_settings_sections( 'time_ago_units' );
						// output save settings button
						submit_button( 'Save Settings' );
						?>
				</form>
		</div>
		<?php
	}
}
