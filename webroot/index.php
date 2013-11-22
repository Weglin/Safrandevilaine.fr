<?PHP
$debut = microtime(true);

if (!isset($_SERVER['DOCUMENT_ROOT'])) die;
define('WEBROOT', dirname(__FILE__));
define('ROOT', dirname(WEBROOT));
define('DS', DIRECTORY_SEPARATOR);
define('CORE', ROOT.DS.'core');
define('BASE_URL', dirname(dirname($_SERVER['SCRIPT_NAME'])));
define('_CSS_', BASE_URL.'/webroot/css/');
define('_TPL_', ROOT.DS.'tpl');


require CORE.DS.'includes.php';
new Conf();
new Dispatcher();
if (Conf::$debug>1){
	echo '<div style="position:fixed; bottom:0; background-color:red; color:#fff; line-height:30px; height:30px;left:0; right:0; paddinf-left:10px;">';
	echo 'Page générée en '.round(microtime(true)- $debut, 5).' secondes';
	echo '</div>';
}

?>
