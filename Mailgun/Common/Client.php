<?PHP
namespace Mailgun\Common;
	
require_once 'Globals.php';

use Guzzle\Http\Client as Guzzler;
use Mailgun\Exceptions\NoDomainsConfigured;
use Mailgun\Exceptions\HTTPError;

class Client{

	protected $apiKey;
	protected $domain;
	protected $client;
	protected $debug;
	
	protected $apiEndpoint = API_ENDPOINT;
	protected $apiVersion = API_VERSION;
	protected $apiUser = API_USER;
	protected $sdkVersion = SDK_VERSION;
	protected $sdkUserAgent = SDK_USER_AGENT;

	public function __construct($apiKey, $domain, $debug = false){
		$this->apiKey = $apiKey;
		$this->domain = $domain;
		$this->debug = $debug;
		if($this->debug){
			$this->client = new Guzzler('http://postbin.ryanbigg.com/');
			$this->client->setDefaultOption('exceptions', false);
			$this->client->setUserAgent($this->sdkUserAgent . '/' . $this->sdkVersion);
		}
		else{
			$this->client = new Guzzler('https://' . $this->apiEndpoint . '/' . $this->apiVersion . '/');
			$this->client->setDefaultOption('auth', array ($this->apiUser, $this->apiKey));	
			$this->client->setDefaultOption('exceptions', false);
			$this->client->setUserAgent($this->sdkUserAgent . '/' . $this->sdkVersion);
			$this->validateCredentials();
		}
	}
	
	public function validateCredentials(){
		$url = "domains";
		$data = null;
		$request = $this->client->get($url, array(), $data);
	
		$response = $request->send();
		
		if($response->getStatusCode() == 200){
			$jsonResp = $response ->json();
			foreach ($jsonResp as $key => $value){
			    $object->$key = $value;
			}
			if($object->total_count > 0){
				return true;
			}
			else{
				throw new NoDomainsConfigured("You don't have any domains on your account!");
				return false;
			}
		}
		elseif($response->getStatusCode() == 401){
			//Need to override Guzzle's Error Handling
			throw new HTTPError("Your credentials are incorrect.");
		}
		else{
			throw new HTTPError("An HTTP Error has occurred! Try again.");
			return false;
		}
	}
	
	public function sendMessage($message){
		// This is the grand daddy function to send the message and flush all data from variables. 
		$domain = $this->domain;
		if($this->debug){
			$request = $this->client->post("303980cc", array(), $message);
			$response = $request->send();
		}
		else{
			$request = $this->client->post("$domain/messages", array(), $message);
			$response = $request->send();
		}
		return $response;
		
	}
}

?>