<?php
/**
 */

/**
 * Class RequestCommand
 *
 * @author Niko Wicaksono <wicaksono@nodews.com>
 */
class RequestCommand extends CConsoleCommand
{
    public function actionUpdate()
    {
        $requests = CommBookingRequest::model()->with('cb')->findAll('t.stat = 1 AND t.publish_at < NOW()');
        foreach($requests as $request) {
            echo $request->cb->name . PHP_EOL;
            $request->stat = CommBookingRequest::STAT_DONE;
            $request->save(false);
        }
    }
}
