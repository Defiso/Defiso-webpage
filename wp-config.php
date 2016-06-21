<?php
/**
 * Baskonfiguration för WordPress.
 *
 * Denna fil används av wp-config.php-genereringsskript under installationen.
 * Du behöver inte använda webbplatsen, du kan kopiera denna fil direkt till
 * "wp-config.php" och fylla i värdena.
 *
 * Denna fil innehåller följande konfigurationer:
 *
 * * Inställningar för MySQL
 * * Säkerhetsnycklar
 * * Tabellprefix för databas
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL-inställningar - MySQL-uppgifter får du från ditt webbhotell ** //
/** Namnet på databasen du vill använda för WordPress */
define('DB_NAME', 'defisomedia');

/** MySQL-databasens användarnamn */
define('DB_USER', 'root');

/** MySQL-databasens lösenord */
define('DB_PASSWORD', 'root');

/** MySQL-server */
define('DB_HOST', 'localhost');

/** Teckenkodning för tabellerna i databasen. */
define('DB_CHARSET', 'utf8');

/** Kollationeringstyp för databasen. Ändra inte om du är osäker. */
define('DB_COLLATE', '');

/**#@+
 * Unika autentiseringsnycklar och salter.
 *
 * Ändra dessa till unika fraser!
 * Du kan generera nycklar med {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Du kan när som helst ändra dessa nycklar för att göra aktiva cookies obrukbara, vilket tvingar alla användare att logga in på nytt.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Y[SM:wE_n7~]C:oS=|P+jwfo-!<ih-n8+cJ]oi@f~1+5J$Gd!Z5^io<@{gemEhu[');
define('SECURE_AUTH_KEY',  'i IHs!}!W.sCT{1Q*}R__^66k=Zm-5_O3Dxz@|3W6M4Ce|/nI:Dz_`TNT41#L3W_');
define('LOGGED_IN_KEY',    'oy.roJPP[vnGZ(b>BC3!1.4w7Pqc>%TR{X~Xop*RTF$NDR2p[e)wRdLHGW!l]K/0');
define('NONCE_KEY',        'dyj1-}HJY|V2OBm7a8bm<*K=y=0^(6O .^7N3q<OD`V{_*}#@N6++^+U+v(8xJIA');
define('AUTH_SALT',        '$wUp18He-Xlnt?tea&qrLX2 vy2H)$?K&M>|&@oSDi-9Tvy]sj5:5 t]mci *#<N');
define('SECURE_AUTH_SALT', 'y---pKVqWrOnxI(rTT@i%yDx]Eqa!MWF8L-Gu:eBVRw-+b.$YLRIPHIK|[{$K4Sr');
define('LOGGED_IN_SALT',   'at?p3#kJP)(Mw~jP8A2V4M82gs*h&o~Mh&vRdqmDCYO:x)`tkxi!<PVoWvf[:_rK');
define('NONCE_SALT',       '-v++vZAe1!z1fnBvCilf6Npmb!]p{|1?at%xOR#04&sEb,`oi}~#=Y+y-Ndz)mH[');

/**#@-*/

/**
 * Tabellprefix för WordPress Databasen.
 *
 * Du kan ha flera installationer i samma databas om du ger varje installation ett unikt
 * prefix. Endast siffror, bokstäver och understreck!
 */
$table_prefix  = 'dm_';

/** 
 * För utvecklare: WordPress felsökningsläge. 
 * 
 * Ändra detta till true för att aktivera meddelanden under utveckling. 
 * Det är rekommderat att man som tilläggsskapare och temaskapare använder WP_DEBUG 
 * i sin utvecklingsmiljö. 
 *
 * För information om andra konstanter som kan användas för felsökning, 
 * se dokumentationen. 
 * 
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */ 
define('WP_DEBUG', true);

/* Det var allt, sluta redigera här! Blogga på. */

/** Absoluta sökväg till WordPress-katalogen. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Anger WordPress-värden och inkluderade filer. */
require_once(ABSPATH . 'wp-settings.php');