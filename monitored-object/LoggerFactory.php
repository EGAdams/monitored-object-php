<?php
require_once( ABSPATH . "wp-content/plugins/MCBA-Wordpress/monitored-object-php/monitored-object/MonitoredObject.php" );
class DoActionMonitor    extends MonitoredObject { public function __construct( $config ) { parent::__construct( $config );}}
class IncRunQueryMonitor extends MonitoredObject { public function __construct( $config ) { parent::__construct( $config );}}
class GetStatusMonitor   extends MonitoredObject { public function __construct( $config ) { parent::__construct( $config );}}
class AdminAjaxMonitor   extends MonitoredObject { public function __construct( $config ) { parent::__construct( $config );}}
class McbaStartupMonitor extends MonitoredObject { public function __construct( $config ) { parent::__construct( $config );}}

class GenericLogger {
    public function __construct( $objectName ) { $this->objectName = $objectName; }
    public function logUpdate(   $message    ) { MCBAUtil::writeLog( $this->objectName, $message );}}

/** @class LoggerFactory */
class LoggerFactory {
    public static function getLogger( $objectName ) {
        try {
            $monitor_configuration_object         = new stdClass();
            $monitor_configuration_object->new_id = '2022';
            $monitor_configuration_object->table  = 'monitored_objects';
            $logger = new $objectName( $monitor_configuration_object );
        } catch( Exception $e ) {
            $logger = new GenericLogger( $objectName );
            $logger->logUpdate( $e->getMessage()); }
            
        return $logger; }
}
?>
