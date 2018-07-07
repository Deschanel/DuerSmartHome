<?php
const URL="URL:8123";
const PASS="password";

const DEVICES = array(
  "discoveredAppliances"  =>  array(
    array(
      "actions"  =>  array("turnOn", "timingTurnOn", "turnOff", "timingTurnOff"),
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
      "actions"  =>  array("turnOn", "timingTurnOn", "turnOff", "timingTurnOff"),
      "applianceTypes"  => array("HUMIDIFIER"),
      "additionalApplianceDetails"  =>  array(),
      "applianceId"  =>  "switch.pump",
      "friendlyDescription" =>  "浇水",
      "friendlyName"  =>  "植物浇水器",
      "isReachable"  =>  true,
      "manufacturerName"  =>  "broadlink",
      "modelName"  =>  "植物浇水器",
      "version"  =>  "1.0"
    ),
    array(
      "actions"  =>  array("turnOn", "timingTurnOn", "turnOff", "timingTurnOff"),
      "applianceTypes"  => array("LIGHT"),
      "additionalApplianceDetails"  =>  array(),
      "applianceId"  =>  "switch.light",
      "friendlyDescription" =>  "补光",
      "friendlyName"  =>  "植物补光器",
      "isReachable"  =>  true,
      "manufacturerName"  =>  "broadlink",
      "modelName"  =>  "植物补光器",
      "version"  =>  "1.0"
    ),
    array(
      "actions"  =>  array("turnOn", "timingTurnOn", "turnOff", "timingTurnOff"),
      "applianceTypes"  => array("HEATER"),
      "additionalApplianceDetails"  =>  array(),
      "applianceId"  =>  "switch.temperature",
      "friendlyDescription" =>  "温度",
      "friendlyName"  =>  "植物调温器",
      "isReachable"  =>  true,
      "manufacturerName"  =>  "broadlink",
      "modelName"  =>  "植物调温器",
      "version"  =>  "1.0"
    ),
    array(
      "actions"  =>  array("getTemperatureReading"),
      "applianceTypes"  => array("AIR_MONITOR"),
      "additionalApplianceDetails"  =>  array(),
      "applianceId"  =>  "sensor.plant_temperature",
      "friendlyDescription" =>  "温度",
      "friendlyName"  =>  "花花草草温度",
      "isReachable"  =>  true,
      "manufacturerName"  =>  "miflora",
      "modelName"  =>  "花花草草温度",
      "version"  =>  "1.0"
    ),
    array(
      "actions"  =>  array("getHumidity"),
      "applianceTypes"  => array("AIR_MONITOR"),
      "additionalApplianceDetails"  =>  array(),
      "applianceId"  =>  "sensor.plant_moisture",
      "friendlyDescription" =>  "湿度",
      "friendlyName"  =>  "花花草草湿度",
      "isReachable"  =>  true,
      "manufacturerName"  =>  "miflora",
      "modelName"  =>  "花花草草湿度",
      "version"  =>  "1.0"
    ),
    array(
      "actions"  =>  array("getWaterQuality"),
      "applianceTypes"  => array("AIR_MONITOR"),
      "additionalApplianceDetails"  =>  array(),
      "applianceId"  =>  "sensor.plant_conductivity",
      "friendlyDescription" =>  "电导率",
      "friendlyName"  =>  "花花草草电导率",
      "isReachable"  =>  true,
      "manufacturerName"  =>  "miflora",
      "modelName"  =>  "花花草草电导率",
      "version"  =>  "1.0"
    ),
    array(
      "actions"  =>  array("getRunningStatus"),
      "applianceTypes"  => array("AIR_MONITOR"),
      "additionalApplianceDetails"  =>  array(),
      "applianceId"  =>  "sensor.plant_battery",
      "friendlyDescription" =>  "电量",
      "friendlyName"  =>  "花花草草电量",
      "isReachable"  =>  true,
      "manufacturerName"  =>  "miflora",
      "modelName"  =>  "花花草草电量",
      "version"  =>  "1.0"
    ),
    array(
      "actions"  =>  array("getTemperatureReading"),
      "applianceTypes"  => array("AIR_MONITOR"),
      "additionalApplianceDetails"  =>  array(),
      "applianceId"  =>  "sensor.temperature",
      "friendlyDescription" =>  "环境温度",
      "friendlyName"  =>  "环境温度",
      "isReachable"  =>  true,
      "manufacturerName"  =>  "nodemcu",
      "modelName"  =>  "环境温度",
      "version"  =>  "1.0"
    ),
    array(
      "actions"  =>  array("turnOn", "timingTurnOn", "turnOff", "timingTurnOff", "setBrightnessPercentage", "setColor"),
      "applianceTypes"  => array("LIGHT"),
      "additionalApplianceDetails"  =>  array("setBrightnessPercentage" => "brightness_pct", "setColor" => "rgb_color"),
      "applianceId"  =>  "light.bed_room_light",
      "friendlyDescription" =>  "彩色灯环",
      "friendlyName"  =>  "彩色灯环",
      "isReachable"  =>  true,
      "manufacturerName"  =>  "nodemcu",
      "modelName"  =>  "彩色灯环",
      "version"  =>  "1.0"
    )
  )
);
?>
