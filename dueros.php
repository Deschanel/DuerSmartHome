<?php
require_once __DIR__.'/homeassistant_conf.php';

class Response{
	
	public $result;
	public $name;
	public $deviceId;
	public $errorCode;
	public $message;
	public $powerstate;
	public function put_query_response($result,$properties,$name,$deviceId,$errorCode,$message) { 
		$this->result = $result;
		$this->name = $name;
		$this->deviceId = $deviceId;
		$this->errorCode = $errorCode;
		$this->message = $message;
		switch($name)
		{
		case "QueryResponse":
			if($properties!="")
			{
				$this->powerstate=$properties;
			}else
			{
		                $this->errorCode = "SERVICE_ERROR";
				$this->message = "No temperature return";
			}
			break;
		case "QueryTemperatureResponse":
			if($properties!="")
			{
				$this->properties=$properties;
			}else
			{
		                $this->errorCode = "SERVICE_ERROR";
				$this->message = "No temperature return";
			}
			break;
		case "QueryPowerstateResponse":
			if($properties!="")
			{
				$this->properties=$properties;
			}else
			{
		                $this->errorCode = "SERVICE_ERROR";
				$this->message = "No powerstate return";
			}
		case "QueryColorResponse":
		        $this->errorCode = "DEVICE_NOT_SUPPORT_FUNCTION";
			$this->message = "not support";
			$this->result = FALSE;
			break;	
		case "QueryHumidityResponse":
			if($properties!="")
			{
				$this->properties=$properties;
			}else
			{
		                $this->errorCode = "SERVICE_ERROR";
				$this->message = "No temperature return";
			}
			break;
		case "QueryPm2.5Response":
			if($properties!="")
			{
				$this->properties=$properties;
			}else
			{
		                $this->errorCode = "SERVICE_ERROR";
				$this->message = "No temperature return";
			}
			break;
		case "QueryBrightnessResponse":
		        $this->errorCode = "DEVICE_NOT_SUPPORT_FUNCTION";
			$this->message = "not support";
			$this->result = FALSE;
			break;	
		case "QueryChannelResponse":
		        $this->errorCode = "DEVICE_NOT_SUPPORT_FUNCTION";
			$this->message = "not support";
			$this->result = FALSE;
			break;	
		case "QueryModeResponse":
		        $this->errorCode = "DEVICE_NOT_SUPPORT_FUNCTION";
			$this->message = "not support";
			$this->result = FALSE;
			break;	
		default:
		        $this->errorCode = "DEVICE_NOT_SUPPORT_FUNCTION";
			$this->message = "not support";
			$this->result = FALSE;
			break;	
		}
		//$this->result->result = $result;
		//$this->result->name = $name;
		//$this->result->deviceId = $deviceId;
		//$this->result->errorCode = $errorCode;
		//$this->result->message = $message;
	} 
		
	public function put_control_response($result,$name,$deviceId,$errorCode,$message) { 
		$this->result = $result;
		$this->name = $name;
		$this->deviceId = $deviceId;
		$this->errorCode = $errorCode;
		$this->message = $message;
		//$this->result->result = $result;
		//$this->result->name = $name;
		//$this->result->deviceId = $deviceId;
		//$this->result->errorCode = $errorCode;
		//$this->result->message = $message;
	} 
	
}

function  Device_control($obj)
{
	$applianceId=$obj->payload->appliance->applianceId;
	$action = '';
	$device_ha = '';
	$name = substr( $obj->header->name, 0, -7);
	$response_name = $name.'Confirmation';
	switch(substr($applianceId, 0, stripos($applianceId,".")))
	{
	case 'switch':
		$device_ha='switch';
		break;
	case 'light':
		$device_ha='light';
		break;
	case 'media_player':
		$device_ha='media_player';
		break;
	default:
		break;
	}
	switch($name)
	{
	case 'TurnOn':
		$action='turn_on';
		break;
	case 'TurnOff':
		$action='turn_off';
		break;
	case 'TimingTurnOn':
		#$action='set_bright';
		break;
	case 'TimingTurnOff':
		#$action='brightness_up';
		break;
	case 'Pause':
		#$action='brightness_down';
		break;
	case 'AdjustUpVolume':
		$action='volume_up';
		break;
	case 'AdjustDownVolume':
		$action='volume_down';
		break;
	case 'SetColor':
		$action='set_color';
		break;
	case 'IncrementBrightnessPercentage':
		$action='brightness_up';
		break;
	case 'DecrementBrightnessPercentage':
		$action='brightness_down';
		break;
	case 'IncrementTemperature':
		$action='temperature_up';
		break;
	case 'DecrementTemperature':
		$action='temperature_down';
		break;
	case 'SetTemperature':
		$action='set_temperature';
		break;
	default:
		break;
	}
	if($action=="" || $device_ha=="")
	{
		$response = new Response();
		$response->put_control_response(False,$response_name, $applianceId,"not support","action or device not support,name:".$name." device:".substr($applianceId,0,stripos($applianceId,".")));
		return $response;
	}
	$post_array = array (
	"entity_id" => $applianceId,
	);
    	$post_string = json_encode($post_array);
    	$opts = array(
		'http' => array(
			'method' => "POST",
        		'header' => "Content-Type: application/json",
        		'content'=> $post_string
            		)
		);
	$context = stream_context_create($opts);
	$http_post = URL."/api/services/".$device_ha."/".$action."?api_password=".PASS;
	$myfile = fopen("code.txt", "w");
	fwrite($myfile, $http_post);
	fclose($myfile);
	error_log($http_post);
	$pdt_response = file_get_contents($http_post, false, $context);
	$response = new Response();
	$response->put_control_response(True,$response_name,$applianceId,"","");	
	return $response;
	
}

function  Device_status($obj)
{
	$applianceId=$obj->payload->appliance->applianceId;
	$action = '';
	$device_ha = '';
	$name = substr( $obj->header->name, 0, -7);
	$response_name = $name.'Confirmation';
	switch(substr($applianceId,0,stripos($applianceId,".")))
	{
	case 'switch':
		$device_ha='switch';
		break;
	case 'light':
		$device_ha='light';
		break;
	case 'media_player':
		$device_ha='media_player';
		break;
	default:
		break;
	}

	switch($name)
	{
	case 'powerstate':
	case 'color':
	case 'temperature':
	case 'windspeed':
	case 'brightness':
	case 'fog':
	case 'humidity':
	case 'pm2.5':
	case 'channel':
	case 'number':
	case 'direction':
	case 'angle':
	case 'anion':
	case 'effluent':
	case 'mode':
	
	default:
		$action = 'states';
	}

	 if($action=="" || $device_ha=="")
        {
                $response = new Response();
		$response->put_query_response(False,"",$response_name,$applianceId,"not support","action or device not support,name:".$name." device:".substr($applianceId,0,stripos($applianceId,".")));
		return $response;
        }
	 
	$query_response = file_get_contents(URL."/api/".$action."/".$applianceId."?api_password=".PASS);
        $state = json_decode($query_response)->state; 	
	error_log($state);
	$response = new Response();
        $response->put_query_response(True,$state,$response_name,$applianceId,"","");
	return $response; 

}
