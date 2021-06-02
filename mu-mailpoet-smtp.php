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
 * Version:     0.0.1
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

define( 'MU_MAILPOET_SMTP_HOST', apply_filters( 'mu_mailpoet_smtp_host', 'smtp.domain.tld' ) );
define( 'MU_MAILPOET_SMTP_PORT', apply_filters( 'mu_mailpoet_smtp_port', 25 ) ); // 25, 587, and 465 (SSL/TLS)
define( 'MU_MAILPOET_SMTP_ENCRYPTION', apply_filters( 'mu_mailpoet_smtp_encryption', null ) ) ; // null, 'tls' or 'ssl'
define( 'MU_MAILPOET_SMTP_USERNAME', apply_filters( 'mu_mailpoet_smtp_username', 'username' ) );
define( 'MU_MAILPOET_SMTP_PASSWORD', apply_filters( 'mu_mailpoet_smtp_password', 'password' ) );

/**
 * $smtp_transport is a Swift_SmtpTransport object.
 *
 * @link https://swiftmailer.symfony.com/docs/sending.html#the-smtp-transport
 */
add_filter( 'mailpoet_mailer_smtp_transport_agent', function( $smtp_transport ) {
	if ( empty( $smtp_transport->getHost() )) {
		$smtp_transport
			->setHost( MU_MAILPOET_SMTP_HOST ) // default 'localhost'
			->setPort( MU_MAILPOET_SMTP_PORT ) // default 25
			->setEncryption( MU_MAILPOET_SMTP_ENCRYPTION ) // default null
			->setUsername( MU_MAILPOET_SMTP_USERNAME )
			->setPassword( MU_MAILPOET_SMTP_PASSWORD );
	}
	return $smtp_transport;
} );
