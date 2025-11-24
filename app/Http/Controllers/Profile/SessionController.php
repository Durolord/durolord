<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\LogoutOtherSessionsRequest;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class SessionController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LogoutOtherSessionsRequest $request, StatefulGuard $guard): RedirectResponse
    {
        $guard->logoutOtherDevices($request->validated('password'));

        $this->deleteOtherSessions($request);

        $request->session()->regenerate();

        return back()->with('status', 'sessions-terminated');
    }

    private function deleteOtherSessions(LogoutOtherSessionsRequest $request): void
    {
        if (config('session.driver') !== 'database') {
            return;
        }

        $connection = config('session.connection');
        $table = config('session.table', 'sessions');

        DB::connection($connection)
            ->table($table)
            ->where('user_id', $request->user()->getAuthIdentifier())
            ->where('id', '!=', $request->session()->getId())
            ->delete();
    }
}
