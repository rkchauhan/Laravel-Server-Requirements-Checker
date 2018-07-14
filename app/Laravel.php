<?php

/**
* Laravel Server Requirements Checker
*
* This class will check if your server meets the requirements for running the
* Laravel web application framework.
*
* @author Ravikumar Chauhan
* @twitter https://twitter.com/rkchauhan01
* @github https://github.com/rkchauhan
* @version 0.0.1
* @link https://github.com/rkchauhan/laravel-server-requirements-checker
*/

class Laravel
{
	public $version;
	
	private $_versions = ['4.2', '5.0', '5.1', '5.2', '5.3', '5.4', '5.5', '5.6'];
	
	private $_requirements = [];
	
	private $_php_version;
	
	public $version_notice = null;
	
	public function __construct($laravelVersion = null)
    {
		if(!empty($laravelVersion)) {
			$find_version = $this->versionExists($laravelVersion);
				
			if(!$find_version) {
				throw new Exception('Laravel version '. $laravelVersion .' not found.');
			}
		}
		$this->_php_version = phpversion();
		$this->version = (!empty($laravelVersion)) ? $laravelVersion : end($this->_versions);
		$this->setRequirements();
    }
	
	private function data()
	{
		$data = [
			'4.2' => [
				'notice' => 'As of PHP 5.5, some OS distributions may require you to manually install the PHP JSON extension. When using Ubuntu, this can be done via apt-get install php5-json',
				'requirements' => [
					'php' => [
						'versions' => ['>=' => '5.4'],
						'description' => 'PHP >= 5.4'
					],
					'extensions' => [
						['name' => 'MCrypt', 'description' => 'MCrypt PHP Extension']
					]
				]
			],
			'5.0' => [
				'notice' => 'As of PHP 5.5, some OS distributions may require you to manually install the PHP JSON extension. When using Ubuntu, this can be done via apt-get install php5-json',
				'requirements' => [
					'php' => [
						'versions' => ['>=' => '5.4', '<' => '7'],
						'description' => 'PHP >= 5.4, PHP < 7'
					],
					'extensions' => [
						['name' => 'Mcrypt', 'description' => 'Mcrypt PHP Extension'],
						['name' => 'OpenSSL', 'description' => 'OpenSSL PHP Extension'],
						['name' => 'Mbstring', 'description' => 'Mbstring PHP Extension'],
						['name' => 'Tokenizer', 'description' => 'Tokenizer PHP Extension']
					]
				]
			],
			'5.1' => [
				'notice' => null,
				'requirements' => [
					'php' => [
						'versions' => ['>=' => '5.5.9'],
						'description' => 'PHP >= 5.5.9'
					],
					'extensions' => [
						['name' => 'OpenSSL', 'description' => 'OpenSSL PHP Extension'],
						['name' => 'PDO', 'description' => 'PDO PHP Extension'],
						['name' => 'Mbstring', 'description' => 'Mbstring PHP Extension'],
						['name' => 'Tokenizer', 'description' => 'Tokenizer PHP Extension']
					]
				]
			],
			'5.2' => [
				'notice' => null,
				'requirements' => [
					'php' => [
						'versions' => ['>=' => '5.5.9', '<' => '7.2.0'],
						'description' => 'PHP version between 5.5.9 - 7.1.*'
					],
					'extensions' => [
						['name' => 'OpenSSL', 'description' => 'OpenSSL PHP Extension'],
						['name' => 'PDO', 'description' => 'PDO PHP Extension'],
						['name' => 'Mbstring', 'description' => 'Mbstring PHP Extension'],
						['name' => 'Tokenizer', 'description' => 'Tokenizer PHP Extension']
					]
				]
			],
			'5.3' => [
				'notice' => null,
				'requirements' => [
					'php' => [
						'versions' => ['>=' => '5.6.4', '<' => '7.2.0'],
						'description' => 'PHP between 5.6.4 & 7.1.*'
					],
					'extensions' => [
						['name' => 'OpenSSL', 'description' => 'OpenSSL PHP Extension'],
						['name' => 'PDO', 'description' => 'PDO PHP Extension'],
						['name' => 'Mbstring', 'description' => 'Mbstring PHP Extension'],
						['name' => 'Tokenizer', 'description' => 'Tokenizer PHP Extension'],
						['name' => 'XML', 'description' => 'XML PHP Extension']
					]
				]
			],
			'5.4' => [
				'notice' => null,
				'requirements' => [
					'php' => [
						'versions' => ['>=' => '5.6.4'],
						'description' => 'PHP >= 5.6.4'
					],
					'extensions' => [
						['name' => 'OpenSSL', 'description' => 'OpenSSL PHP Extension'],
						['name' => 'PDO', 'description' => 'PDO PHP Extension'],
						['name' => 'Mbstring', 'description' => 'Mbstring PHP Extension'],
						['name' => 'Tokenizer', 'description' => 'Tokenizer PHP Extension'],
						['name' => 'XML', 'description' => 'XML PHP Extension']
					]
				]
			],
			'5.5' => [
				'notice' => null,
				'requirements' => [
					'php' => [
						'versions' => ['>=' => '7.0.0'],
						'description' => 'PHP >= 7.0.0'
					],
					'extensions' => [
						['name' => 'OpenSSL', 'description' => 'OpenSSL PHP Extension'],
						['name' => 'PDO', 'description' => 'PDO PHP Extension'],
						['name' => 'Mbstring', 'description' => 'Mbstring PHP Extension'],
						['name' => 'Tokenizer', 'description' => 'Tokenizer PHP Extension'],
						['name' => 'XML', 'description' => 'XML PHP Extension']
					]
				]
			],
			'5.6' => [
				'notice' => null,
				'requirements' => [
					'php' => [
						'versions' => ['>=' => '7.1.3'],
						'description' => 'PHP >= 7.1.3'
					],
					'extensions' => [
						['name' => 'OpenSSL', 'description' => 'OpenSSL PHP Extension'],
						['name' => 'PDO', 'description' => 'PDO PHP Extension'],
						['name' => 'Mbstring', 'description' => 'Mbstring PHP Extension'],
						['name' => 'Tokenizer', 'description' => 'Tokenizer PHP Extension'],
						['name' => 'XML', 'description' => 'XML PHP Extension'],
						['name' => 'Ctype', 'description' => 'Ctype PHP Extension'],
						['name' => 'JSON', 'description' => 'JSON PHP Extension']
					]
				]
			]
		];
		return $data;
	}
	
	public function versionExists($version)
	{
		return in_array($version, $this->_versions);
	}
	
	public function setRequirements()
	{
		$getData = $this->data();
		$varsion_data = $getData[$this->getVersion()];
		$getRequirements = $varsion_data['requirements'];
		
		$php = $getRequirements['php'];
		$php_versions = $php['versions'];
		$keys = array_keys($php_versions);
		
		if(!empty($varsion_data['notice'])) {
			$this->version_notice = $varsion_data['notice'];
		}
		
		$extensions = $getRequirements['extensions'];
		
		$requirements = [];
		
		if(count($keys) == 2) {
			$compatible_php_version = (version_compare($this->_php_version, $php_versions[$keys[0]], $keys[0]) && version_compare($this->_php_version, $php_versions[$keys[1]], $keys[1]));
		} else {
			$compatible_php_version = version_compare($this->_php_version, $php_versions[$keys[0]], $keys[0]);
		}
		
		array_push($requirements, ['requirement' => $php['description'], 'compatible' => $compatible_php_version]);
		
		foreach($extensions as $extension) {
			if(extension_loaded($extension['name'])) {
				array_push($requirements, ['requirement' => $extension['name'], 'compatible' => true]);
			} else {
				array_push($requirements, ['requirement' => $extension['name'], 'compatible' => false]);
			}
		}
		
		$this->_requirements = $requirements;
	}
	
	public function getRequirements()
	{
		return $this->_requirements;
	}
	
	public function getVersions()
	{
		return $this->_versions;
	}
	
	public function getVersion()
	{	
		return $this->version;
	}
}

?>