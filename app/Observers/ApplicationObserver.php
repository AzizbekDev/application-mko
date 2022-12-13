<?php

namespace App\Observers;

use App\Models\Application;

class ApplicationObserver
{
    /**
     * Handle the application "created" event.
     *
     * @param  \App\Models\Application  $applicationa
     * @return void
     */
    public function created(Application $application)
    {
        $application->key_app = uniqid($application->id);
        $application->save();
        $application->applicationInfo()->create([
           'serial_number' => $application->serial_number,
           'pin'           => $application->pin,
           'gender'        => extract_passport_gender($application->pin),
           'birth_date'    => extract_passport_birth_date($application->pin)
        ]);
    }

    /**
     * Handle the application "updated" event.
     *
     * @param  \App\Models\Application  $application
     * @return void
     */
    public function updated(Application $application)
    {
        //
    }

    /**
     * Handle the application "deleted" event.
     *
     * @param  \App\Models\Application  $application
     * @return void
     */
    public function deleted(Application $application)
    {
        //
    }

    /**
     * Handle the application "restored" event.
     *
     * @param  \App\Models\Application  $application
     * @return void
     */
    public function restored(Application $application)
    {
        //
    }

    /**
     * Handle the application "force deleted" event.
     *
     * @param  \App\Models\Application  $application
     * @return void
     */
    public function forceDeleted(Application $application)
    {
        //
    }
}
