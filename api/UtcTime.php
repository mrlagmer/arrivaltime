<?php
/**
* This class will covert time from UTC to Melb Time
*/

class UtcTime {

    private $timezone;
    private $timeFormat = 'd/m/Y G:i:s';

    function __construct() {
        $this->timezone = new DateTimeZone('Australia/Melbourne');
    }

    function getCurrentTime() {
        $date = new DateTime('now',$this->timezone);
        return $date;
    }

    function timeInFuture($time) {
        $now = $this->getCurrentTime();
        $timeFuture = new DateTime($time,new DateTimeZone('UTC'));
        $timeFuture->setTimezone($this->timezone);

        if($now < $timeFuture) {
            return true;
        }
        return false;
    }

    function convertUTC($timeUTC) {
        $time = new DateTime($timeUTC,new DateTimeZone('UTC'));
        $time->setTimezone($this->timezone);
        $time = $time->format($this->timeFormat);
        return $time;
    }
}
?>
