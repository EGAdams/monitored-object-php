<?php
/** @class LoggerFactory */

require_once( ABSPATH . "wp-content/plugins/MCBA-Wordpress/monitored-object-php/monitored-object/MonitoredObject.php" );

class DoActionMonitor extends MonitoredObject {
    public function __construct( $config ) { parent::__construct( $config );}}

class IncRunQueryMonitor extends MonitoredObject {
    public function __construct( $config ) { parent::__construct( $config );}}

class GetStatusMonitor extends MonitoredObject {
    public function __construct( $config ) { parent::__construct( $config );}}

class AdminAjaxMonitor extends MonitoredObject {
    public function __construct($config  ) { parent::__construct( $config );}}
    

class LoggerFactory {
    public static function getLogger( $objectName ) {
        
        if ( $objectName == "DoActionMonitor" ) {
            $monitor_configuration_object = new stdClass();
            $monitor_configuration_object->new_id = '2022';
            $monitor_configuration_object->table = 'monitored_objects';
            return new DoActionMonitor( $monitor_configuration_object );

        } elseif ( $objectName == "IncRunQueryMonitor" ) {
            $monitor_configuration_object = new stdClass();
            $monitor_configuration_object->new_id = '2022';
            $monitor_configuration_object->table = 'monitored_objects';
            return new IncRunQueryMonitor( $monitor_configuration_object );

        } elseif ( $objectName == "GetStatusMonitor" ) {
            $monitor_configuration_object = new stdClass();
            $monitor_configuration_object->new_id = '2022';
            $monitor_configuration_object->table = 'monitored_objects';
            return new GetStatusMonitor( $monitor_configuration_object );

        } elseif ( $objectName == "AdminAjaxMonitor" ) {
            $monitor_configuration_object = new stdClass();
            $monitor_configuration_object->new_id = '2022';
            $monitor_configuration_object->table = 'monitored_objects';
            return new AdminAjaxMonitor( $monitor_configuration_object );

        } else { return new Error( $objectName ); }}
}
?>
