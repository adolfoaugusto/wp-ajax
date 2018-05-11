<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/pt-br:Editando_wp-config.php
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'wp-ajax');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'root');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', '1234');

/** Nome do host do MySQL */
define('DB_HOST', 'localhost');

/** Charset do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8mb4');

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'L;9exwmL$| qA&J1`$W&~DrZg|WtCF<% w}}X!C!?rs92B,n|AtX_?=1>}EOvr[H');
define('SECURE_AUTH_KEY',  '4y`YYH,`*[-0P}ih{NPAP|8I6;;M2r*&8fJm7nF-RM|f%~b&XWY E($fl<?j/|uQ');
define('LOGGED_IN_KEY',    'zX+t[08oCLa+_zh5ny/vAUs)EOwQjGjT^;HOSuPb[7X^)UL(Uy&k{==k%9_Bh+K4');
define('NONCE_KEY',        'F*+GOOe}HK^K;C &Ntrj9ttkwY/YWqc.uHP<?Ev(X0O6;}qeG7lOjMUA. -?||$P');
define('AUTH_SALT',        'N^{`[Ee51y,q<7xV)D?>F5!+Td`e[Z{^[w^yv[T33p?=f9K=hEaO9Bo<Q`u[x=T1');
define('SECURE_AUTH_SALT', '(LI[%#a]Q39{bz~%%vVZ~)ARb!Y[%`/L>x$A&UZ-{Y}5{m!:yX2E>f$,Cd%S$ca_');
define('LOGGED_IN_SALT',   '[{8Up]gX]a v^pb0SV,RDwgLDMP Qq<A?Z;0vn)Fwr6qr[z1>&?^>/?^/0%c|BQ#');
define('NONCE_SALT',       'm3(th_NQ<Cc<1vTkRWff#y^7p?RAZ jXXaxR,e}fg;Z._iU#,slmth5l:;sK2~I/');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix  = 'ajax_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://codex.wordpress.org/pt-br:Depura%C3%A7%C3%A3o_no_WordPress
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */
define('FS_METHOD','direct');
/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Configura as variáveis e arquivos do WordPress. */
require_once(ABSPATH . 'wp-settings.php');
