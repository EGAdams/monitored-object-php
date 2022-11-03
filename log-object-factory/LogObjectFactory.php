<?php
/**
 * @description
 * creates log objects giving them a unique id, time stamp, 
 * and determined calling method.
 *
 * @class LogObjectFactory
 */
class LogObjectFactory {
    public function __construct() {}

    public function createLogObject( $messageArg, $someObject ) {
        echo "creating log object with message: " . $messageArg . "<br>";
        $time_now = time();
        echo "time_now: ". $time_now . "<br>";
        $random_number = rand( 1, 1000000000000000 );
        echo "random_number: " . $random_number . "<br>";
        $callingMethod = $this->getCallingMethod();
        echo "calling method: " . $callingMethod . "<br>";
        $logObject =  array(
            'timestamp'=> $time_now,
            'id'=> get_class( $someObject ) . "_" . $random_number . '_' . $time_now,
            'message'=> $messageArg,
            'method'=> $callingMethod
        );
         echo "logObject: " . $logObject[ 'timestamp' ] . "<br>";
         echo "logObject: " . $logObject[ 'id'        ] . "<br>";
         echo "logObject: " . $logObject[ 'message'   ] . "<br>";
         echo "logObject: " . $logObject[ 'method'    ] . "<br>";
         return $logObject;
    }
    private function getCallingMethod() {
        $e = new Exception();
        $trace = $e->getTrace();
        // position[ 0 ] would be this function so we ignore it
        // position[ 1 ] would be this function so we ignore it, needs adjusting
        $last_call = $trace[ 1 ][ 'function' ]; // TODO: is this right?
        return $last_call;
    }
}
