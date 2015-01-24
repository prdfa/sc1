<?php
/**
 * Class Social_Message is a utility class that stores messages comes from social auth operations
 *
 * @author Hüseyin BABAL
 */
class Social_Message
{

    /**
     * @param $message
     * @param $type if 0 => error, 1 => success
     * @param null $code
     * @param null $trace
     * @param null $previous
     */
    public static function setMessage( $message, $type, $code = null, $trace = null, $previous = null ) {
        Social_Auth::session()->set( "sa.message.status"  , $type );
        Social_Auth::session()->set( "sa.message.message" , $message );
        Social_Auth::session()->set( "sa.message.code"    , $code );
        Social_Auth::session()->set( "sa.message.trace"   , $trace );
        Social_Auth::session()->set( "sa.message.previous", $previous );
    }

    /**
     * Clear error
     */
    public static function clearMessage() {
        Social_Auth::session()->deleteByKey( "sa.message.status" );
        Social_Auth::session()->deleteByKey( "sa.message.message" );
        Social_Auth::session()->deleteByKey( "sa.message.code" );
        Social_Auth::session()->deleteByKey( "sa.message.trace" );
        Social_Auth::session()->deleteByKey( "sa.message.previous" );
    }


    public static function hasError() {
        $status = Social_Auth::session()->get( "sa.message.status" );
        return false;
        if ( $status == 0 ) {
            return true;
        } else {
            return false;
        }
    }

    public static function getMessage() {
        return Social_Auth::session()->get( "sa.message.message" );
    }

    public static function getCode() {
        return Social_Auth::session()->get( "sa.message.code" );
    }

    public static function getTrace(){
        return Social_Auth::session()->get( "sa.message.trace" );
    }

    public static function getPrevious() {
        return Social_Auth::session()->get( "sa.message.previous" );
    }
}