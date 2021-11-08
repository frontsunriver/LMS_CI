<?php
class DataAccess
{
	// @var string hostname
    protected $host = '';
    protected $user = '';
    protected $pass = '';
    protected $name = '';      
	
	function __construct($dotenv){
		$this->host = $dotenv['database.default.hostname'];
        $this->user = $dotenv['database.default.username'];
        $this->pass = $dotenv['database.default.password'];
        $this->name = $dotenv['database.default.database'];
	}

	public function con()
	{
		try 
        {
            // @var string connection string
            $dns = "mysql:host=".$this->host.";dbname=".$this->name.";charset=utf8";

            // Create a new PDO connection
            $pdo = new PDO($dns, $this->user, $this->pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            // Return the pdo
            return $pdo;

        } catch (Exception $e) {

            die($e->getMessage());
        }        
    }
    
    public function executeScalar($sql, $params = '') 
    {        
        if($params != '') 
        {
            $sql = str_replace("?", "%s", $sql);
            $new_params = array();
            $col = array_keys($params);
            $val = array_values($params);
            for ($i = 0; $i < count($params); $i++) {
                if ( $val[$i] == null) {
                    $new_params[] = $col[$i];
                } else {
                    $new_params[] = $this->sanitize($val[$i]);
                }
            }
            $sql = $this->sprintf_array($sql, $new_params);
        }

        $rs = $this->con()->prepare($sql);
        $rs->execute();
        return $rs->fetchColumn();
    }
}
// import lib
require('lib/vendor/autoload.php');
// instance
$dotenv = (Dotenv\Dotenv::createImmutable(__DIR__.'/../'))->load();
// result
$dao = new DataAccess($dotenv);
// config
$pr = $dao->executeScalar('select `cfg_periodo` from `cfg_periodo` where cfg_vicente="S"');
// selected
if ( $pr != '' ) {
    if( (explode("_", $dotenv['database.default.database']))[2] == $pr ) {
        // not change db
    } else {
        // change db
        $dao = new DataAccess([
            'database.default.hostname' => $dotenv['database.default.hostname'],
            'database.default.username' => $dotenv['database.default.username'],
            'database.default.password' => $dotenv['database.default.password'],
            'database.default.database' => $dotenv['database.default.sufixdb'].$pr,
        ]);
    }
}
// define url base
$get_urlbase = $dao->executeScalar('select i.i_url from institucion i where i.i_id="I0001"');