<?php

namespace App\Observers;

use App\Events\CompleteRequest;
use App\Events\RegisterRequest;
use App\Events\RequestAccepted;
use App\Models\Request;

class RequestObserver
{
    /**
     * Handle the Request "created" event.
     */
    public function created(Request $request): void
    {
        RegisterRequest::dispatch();
    }

    /**
     * Handle the Request "updated" event.
     */
    public function updated(Request $request): void
    {
        if($request->veterinarian_id !== null){
            RequestAccepted::dispatch();
        }
        if($request->status === 'completed'){
            CompleteRequest::dispatch();
        }
        // Canceled Event
    }

    /**
     * Handle the Request "deleted" event.
     */
    public function deleted(Request $request): void
    {
        //
    }

    /**
     * Handle the Request "restored" event.
     */
    public function restored(Request $request): void
    {
        //
    }

    /**
     * Handle the Request "force deleted" event.
     */
    public function forceDeleted(Request $request): void
    {
        //
    }
}
