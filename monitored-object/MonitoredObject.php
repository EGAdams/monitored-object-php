<?php
error_reporting( E_ALL );
require_once( dirname( __DIR__, 1 ) . "/log-object-factory/LogObjectFactory.php" );
require_once( dirname( __DIR__, 1 ) . "/monitor-led/MonitorLed.php"              );
require_once( dirname( __DIR__, 1 ) . "/local-php-api/Model/ObjectModel.php"     );
require_once( dirname( __DIR__, 1 ) . "/local-php-api/FileLogger.php"            );
/** @class MonitoredObject */
class MonitoredObject {
    public function __construct( $config ) {
        $this->logObjects       = array();
        $this->object_view_id   = get_class( $this ) . "_" . $config->new_id;
        $this->objectUpdater    = new ObjectModel( $config->table );
        $objectInserter         = new ObjectModel( $config->table );
        $this->logObjectFactory = new LogObjectFactory(           );
        $this->monitorLed       = new MonitorLed( $config         );
        $objectInserter->insertObject( $this->object_view_id, json_encode( $this )); }

    public function logUpdate( $message ) {
        if ( !$this->object_view_id ) { FileLogger::writeLog( __METHOD__, "*** ERROR: object needs an id to log. ***" ); return; }
        if ( strpos( $message, "ERROR"      ) !== false ) { $this->monitorLed->setFail(    $message ); } elseif
           ( strpos( $message, "finished"   ) !== false ) { $this->monitorLed->setPass(    $message ); } else {
                                                 $this->monitorLed->setLedText( $message ); }
        $logObject = $this->logObjectFactory->createLogObject( $message, $this );
        array_push( $this->logObjects, $logObject );
        $this->objectUpdater->updateObject( $this->object_view_id, json_encode( $this ));
    }
    
    public function getMonitorLed()   { return $this->monitorLed;     }
    public function getObjectViewId() { return $this->object_view_id; }
}
