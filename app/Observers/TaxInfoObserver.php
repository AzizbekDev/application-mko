<?php

namespace App\Observers;

use App\Models\TaxInfo;
use App\Models\ApplicationInfo;

class TaxInfoObserver
{
    /**
     * Handle the tax info "created" event.
     *
     * @param  \App\Models\TaxInfo  $taxInfo
     * @return void
     */
    public function created(TaxInfo $taxInfo)
    {

    }

    /**
     * Handle the tax info "updated" event.
     *
     * @param  \App\Models\TaxInfo  $taxInfo
     * @return void
     */
    public function updated(TaxInfo $taxInfo)
    {
//        $taxInfo->applicationInfo()->update([
//            'fio' => $taxInfo->name,
//            'inn' => $taxInfo->tin
//        ]);
    }

    /**
     * Handle the tax info "deleted" event.
     *
     * @param  \App\Models\TaxInfo  $taxInfo
     * @return void
     */
    public function deleted(TaxInfo $taxInfo)
    {
        //
    }

    /**
     * Handle the tax info "restored" event.
     *
     * @param  \App\Models\TaxInfo  $taxInfo
     * @return void
     */
    public function restored(TaxInfo $taxInfo)
    {
        //
    }

    /**
     * Handle the tax info "force deleted" event.
     *
     * @param  \App\Models\TaxInfo  $taxInfo
     * @return void
     */
    public function forceDeleted(TaxInfo $taxInfo)
    {
        //
    }
}
