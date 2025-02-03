<?php

namespace App\Http\Controllers;

use App\Events\RequestVacation;
use App\Models\User;
use App\Models\VacationRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ApproverVacationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $vacationRequests = VacationRequest::query()->whereHas('departement', function ($query) use ($request) {
            $query->where(function ($query) use ($request) {
                $query->where('first_approver_id', auth()->id());
                if ($request->has('status')) {
                    if ($request->status == 'pending') {
                        $query->where('first_approval', null);
                    }

                    if ($request->status == 'approved') {
                        $query->where('first_approval', true);
                    }

                    if ($request->status == 'rejected') {
                        $query->where('first_approval', false);
                    }
                }
            })->orWhere(function ($query) use ($request) {
                $query->where('second_approver_id', auth()->id())
                    ->where('first_approval', true);

                if ($request->has('status')) {
                    if ($request->status == 'pending') {
                        $query->where('second_approval', null);
                    }

                    if ($request->status == 'approved') {
                        $query->where('second_approval', true);
                    }

                    if ($request->status == 'rejected') {
                        $query->where('second_approval', false);
                    }
                }
            });
        })->with('departement', 'user')->orderBy('created_at', 'desc')->paginate(9);

        return view('approver', [
            'vacationRequests' => $vacationRequests,
        ]);
    }

    public function approve(Request $request, VacationRequest $vacationRequest)
    {
        $request->validate([
            'status' => 'required|in:approve,reject',
        ]);

        $status = $request->status === 'approve' ? 'approved' : 'rejected';

        if (auth()->id() === $vacationRequest->departement->first_approver_id) {

            $vacationRequest->update([
                'first_approval' => $request->status === 'approve',
                'first_approval_update_at' => now(),
            ]);

            if ($request->status === 'rejected') {
                event(new RequestVacation($vacationRequest->user_id, "Your vacation request has been " . $status, 'vacation.index'));
            } else {
                event(new RequestVacation($vacationRequest->departement->second_approver_id, "There is a new vacation request", 'approver.index'));
            }
        }

        if (auth()->id() === $vacationRequest->departement->second_approver_id) {
            $vacationRequest->update([
                'second_approval' => $request->status === 'approve',
                'second_approval_update_at' => now(),
            ]);

            event(new RequestVacation($vacationRequest->user_id, "Your vacation request has been " . $status, 'vacation.index'));
        }

        return redirect()->back()->with('success', 'Vacation request ' . $status . ' successfully');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(VacationRequest $vacationRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VacationRequest $vacationRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VacationRequest $vacationRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VacationRequest $vacationRequest)
    {
        //
    }
}
