<?php declare( strict_types = 1 );
/**
 * MU MailPoet SMTP
 *
 * @package     MU MailPoet SMTP
 * @author      Per Soderlind
 * @copyright   2020 Per Soderlind
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: MU MailPoet SMTP
 * Plugin URI: https://github.com/soderlind/mu-mailpoet-smtp
 * GitHub Plugin URI: https://github.com/soderlind/mu-mailpoet-smtp
 * Description: Set the SMTP transport for MailPoet
 * Version:     0.0.2
 * Author:      Per Soderlind
 * Author URI:  https://soderlind.no
 * Text Domain: mu-mailpoet-smtp
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

namespace Soderlind\Plugin\MailPoet;

if ( ! defined( 'ABSPATH' ) ) {
	wp_die();
}

define( 'MU_MAILPOET_SMTP_HOST',  'smtp.domain.tld' );
define( 'MU_MAILPOET_SMTP_PORT',  25 ); // 25, 587, 465 ...
define( 'MU_MAILPOET_SMTP_ENCRYPTION', null ) ; // null, 'tls' or 'ssl'
define( 'MU_MAILPOET_SMTP_USERNAME', 'username' );
define( 'MU_MAILPOET_SMTP_PASSWORD', 'password' );

/**
 * $smtp_transport is a Swift_SmtpTransport object.
 *
 * @link https://swiftmailer.symfony.com/docs/sending.html#the-smtp-transport
 */
add_filter( 'mailpoet_mailer_smtp_transport_agent', function( $smtp_transport ) {
	if ( empty( $smtp_transport->getHost() )) {
		$smtp_transport
			->setHost( apply_filters( 'mu_mailpoet_smtp_host', MU_MAILPOET_SMTP_HOST ) )
			->setPort( apply_filters( 'mu_mailpoet_smtp_port', MU_MAILPOET_SMTP_PORT ) )
			->setEncryption( apply_filters( 'mu_mailpoet_smtp_encryption', MU_MAILPOET_SMTP_ENCRYPTION ) )
			->setUsername( apply_filters( 'mu_mailpoet_smtp_username', MU_MAILPOET_SMTP_USERNAME ) )
			->setPassword( apply_filters( 'mu_mailpoet_smtp_password', MU_MAILPOET_SMTP_PASSWORD ) );
	}
	return $smtp_transport;
} );
