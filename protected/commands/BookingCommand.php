<?php
/**
 */

/**
 * Class BookingCommand
 *
 * @author Niko Wicaksono <wicaksono@nodews.com>
 */
class BookingCommand extends CConsoleCommand
{
    public function actionIndex()
    {
        $date = date('Y-m-d');
        $done = false;
        $bookings = CommBooking::model()->with('br')->findAll('t.stat <> 2');
        foreach($bookings as $booking) {
            echo $booking->name . PHP_EOL;
            foreach($booking->br as $request) {
                if($request->stat == CommBookingRequest::STAT_DONE) {
                    $done = true;
                }
            }

            // kalo status $done nggak berubah, berarti booking close??
            if($done) {
                $booking->stat = CommBooking::STAT_DONE;
                $booking->save(false);
            }
        }
    }
}
