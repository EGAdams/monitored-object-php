<?php
error_reporting( E_ALL );
echo "including log object factory... <br>";
require_once( "../log-object-factory/LogObjectFactory.php" );
echo "including monitor led... <br>";
require_once( "../monitor-led/MonitorLed.php"     );
echo "including object model <br>";
require_once( "../local-php-api/Model/ObjectModel.php"     );
echo "done requiring object model. <br>";
/** @class MonitoredObject */
class MonitoredObject {
    public function __construct( $config ) {
        echo "creating log objects array... <br>";
        $this->logObjects  = array();
        echo "done creating log objects array. <br>";
        $this->object_view_id = get_class( $this ) . "_" . $config->new_id;
        echo "config->table = $config->table <br>";
        echo "class set to $this->object_view_id creating updater... <br>";
        $this->objectUpdater = new ObjectModel( $config->table );
        echo "done creating updater.";
        $objectInserter                = new ObjectModel( $config->table );
        $this->logObjectfactory        = new LogObjectFactory();
        echo "creating the monitor's led... <br>";
        $this->monitorLed = new MonitorLed( $config );
        if( !$this->monitorLed ) {
            echo "!monitorLed<br>";
        } else {
            echo "monitorLed exists.<br>";
        }
        echo "inserting object... <br>";
        $objectInserter->insertObject( $this->object_view_id, json_encode( $this )); 
    }

    public function logUpdate( $message ) {
        if ( !$this->object_view_id ) { echo "*** ERROR: object needs an id to log. ***"; return; }
        if ( strpos( $message, "ERROR" )) { $this->monitorLed->setFail(); }
        $this->monitorLed->setLedText( $message );
        $logObject = $this->logObjectfactory->createLogObject( $message, $this );
        array_push( $this->logObjects, $logObject );
        echo "number of logObjects: " . sizeof( $this->logObjects ) . "<br>";
        $this->objectUpdater->updateObject( $this->object_view_id, json_encode( $this )); 
    }
    
    public function getMonitorLed()   { return $this->monitorLed;     }
    public function getObjectViewId() { return $this->object_view_id; }
}
