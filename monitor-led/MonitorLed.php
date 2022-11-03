<?php
require( "../monitor-led-class-object/MonitorLedClassObject.php" );
/** @class MonitorLed */
class MonitorLed {
    public function __construct( $configArg ) {
        $this->config         = $configArg;
        $this->ledClassObject = new MonitorLedClassObject();
        $this->ledText        = "ready.";
        $this->RUNNING_COLOR  = "lightyellow";
        $this->PASS_COLOR     = "lightgreen"; 
        $this->FAIL_COLOR     = "#fb6666"; } // lightred is not understood by CSS.

    public function setFail() {
        $this->setLedBackgroundColor( $this->FAIL_COLOR ); 
        $this->setLedTextColor( "white" ); }

    public function setLedBackgroundColor( $newColor ) { $this->ledClassObject->background_color = $newColor; }
    public function setLedTextColor(       $newColor ) { $this->ledClassObject->color            = $newColor; }
    public function setLedText(            $newText  ) { $this->ledText                          = $newText ; }
    public function getColor( $objectState ) {
        $object_state_color = $objectState . "_COLOR";
        echo "getting color $object_state_color <br>";
        return $this->{ $object_state_color };
    }
}
