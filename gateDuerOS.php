<?php
require_once __DIR__.'/dueros.php';
$chars = md5(uniqid(mt_rand(), true));
$uuid  = substr($chars,0,8) . '-';
$uuid .= substr($chars,8,4) . '-';
$uuid .= substr($chars,12,4) . '-';
$uuid .= substr($chars,16,4) . '-';
$uuid .= substr($chars,20,12);

$poststr = file_get_contents("php://input");
$obj = json_decode($poststr);
$messageId = $uuid;
switch($obj->header->namespace){
	case 'DuerOS.ConnectedHome.Discovery':
		$header = array(
			"namespace"           =>    "DuerOS.ConnectedHome.Discovery",
			"name"                       =>    "DiscoverAppliancesResponse",
			"messageId "            =>    $messageId,
			"payloadVersion"  =>    "1"
		);
		//$header = json_encode($tmp);
		$payload = array(
			"discoveredAppliances"  =>  array(
				array(
					"actions"  =>  array("turnOn", "turnOff"),
					"applianceTypes"  => array("LIGHT"),
					"additionalApplianceDetails"  =>  array(),
					"applianceId"  =>  "light.sonoff",
					"friendlyDescription"  =>  "LightDeviceId",
					"friendlyName"  =>  "卧室的灯",
					"isReachable"  =>  true,
					"manufacturerName"  =>  "Nodemcu",
					"modelName"  =>  "fancyLight",
					"version"  =>  "1.0"
				),
				array(
					"actions"  =>  array("turnOn", "turnOff"),
					"applianceTypes"  => array("CURTAIN"),
					"additionalApplianceDetails"  =>  array(),
					"applianceId"  =>  "switch.pump",
					"friendlyDescription" =>  "SwitchDeviceId",
					"friendlyName"  =>  "卧室的窗帘",
					"isReachable"  =>  true,
					"manufacturerName"  =>  "Nodemcu",
					"modelName"  =>  "fancyCurtain",
					"version"  =>  "1.0"
				),
				array(
					"actions"  =>  array("turnOn", "turnOff"),
					"applianceTypes"  => array("LIGHT"),
					"additionalApplianceDetails"  =>  array(),
					"applianceId"  =>  "LlightTwo",
					"friendlyDescription" =>  "LightDeviceId",
					"friendlyName"  =>  "厨房的灯",
					"isReachable"  =>  true,
					"manufacturerName"  =>  "Nodemcu",
					"modelName"  =>  "fancyLight",
					"version"  =>  "1.0"
				)
			)
		);
		//$payload = json_encode($payload);
		$resultStr = json_encode(array("header" => $header, "payload" => $payload));
		break;
	case 'DuerOS.ConnectedHome.Control':
		$result = Device_control($obj);
		if($result->result == "True" ){
			$header = array(
				"namespace"           =>    "DuerOS.ConnectedHome.Control",
				"name"                       =>    $result->name,
				"messageId "            =>    $messageId,
				"payloadVersion"  =>    "1"
			);
			$payload = array();
			$resultStr = json_encode(array("header" => $header, "payload" => $payload));
		}
		break;
	case 'DuerOS.ConnectedHome.Query':
		$result = Device_status($obj);
		if($result->result == "True" ){
			$str = '{
	　　			"header": {
	　　   				 "namespace": "DuerOS.ConnectedHome.Query",
	　　   				 "name": "%s",
	　　   				 "messageId": "%s",
	　　   				 "payloadVersion": "1"
				},
	　　			"payload": {
	　　   				 "%s": {
	　　   				 	"value": %s,
	　　   				 	"scale": "%s"
	　　   				 }
				}
			}';
		}
		$resultStr = sprintf($str,$result->name, $messageId, $result->intention, $result->value, $result->scale);
		break;
	default:
		$resultStr='Nothing return,there is an error~!!';
}
error_log('-------');
error_log('----get-request---');
error_log($poststr);
error_log('----reseponse---');
error_log($resultStr);
echo($resultStr);
