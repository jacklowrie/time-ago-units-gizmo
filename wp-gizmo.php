<?php
/**
 * WP-Gizmo
 *
 * @package           wp-gizmo
 * @author            Jack Lowrie
 * @license           GPL-3.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       Time Ago Units
 * Plugin URI:        https://wordpress.org/plugins/time-ago-units/
 * Description:       Simple WordPress Plugin changes the date format on posts and pages.
 * Version:           1.0.0
 * Requires at least: 5.0
 * Requires PHP:      7.0
 * Author:            4th Wall Websites
 * Author URI:        https://4thwall.io
 * Text Domain:       time-ago-units
 * License:           GPL v2
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 *
 * Time Ago Units is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Time Ago Units is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with Time Ago Units. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
 */

declare( strict_types = 1 );

require_once( __DIR__ . '/autoloader.php' );
Gizmo_Autoloader::register();

$gizmo = new Gizmo();
$gizmo->init();
