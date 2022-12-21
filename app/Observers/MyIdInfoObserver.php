<?php

namespace App\Observers;

use App\Models\MyIdInfo;
use App\Models\Application;

class MyIdInfoObserver
{
    /**
     * Handle the my id info "created" event.
     *
     * @param  \App\Models\MyIdInfo  $myIdInfo
     * @return void
     */
    public function created(MyIdInfo $myIdInfo)
    {
        $application = Application::where([
            'serial_number' => $myIdInfo->pass_data,
            'pin'           => $myIdInfo->pinfl,
            ])->first();
        if($application){
            $application->applicationInfo()->update([
                'fio' => $myIdInfo->full_name
            ]);
        }
    }

    /**
     * Handle the my id info "updated" event.
     *
     * @param  \App\Models\MyIdInfo  $myIdInfo
     * @return void
     */
    public function updated(MyIdInfo $myIdInfo)
    {
        //
    }

    /**
     * Handle the my id info "deleted" event.
     *
     * @param  \App\Models\MyIdInfo  $myIdInfo
     * @return void
     */
    public function deleted(MyIdInfo $myIdInfo)
    {
        //
    }

    /**
     * Handle the my id info "restored" event.
     *
     * @param  \App\Models\MyIdInfo  $myIdInfo
     * @return void
     */
    public function restored(MyIdInfo $myIdInfo)
    {
        //
    }

    /**
     * Handle the my id info "force deleted" event.
     *
     * @param  \App\Models\MyIdInfo  $myIdInfo
     * @return void
     */
    public function forceDeleted(MyIdInfo $myIdInfo)
    {
        //
    }
}
