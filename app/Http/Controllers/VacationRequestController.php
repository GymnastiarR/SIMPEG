<?php

namespace App\Http\Controllers;

use App\Events\RequestVacation;
use App\Models\VacationRequest;
use App\Http\Requests\StoreVacationRequestRequest;
use App\Http\Requests\UpdateVacationRequestRequest;
use App\Models\Departement;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class VacationRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $builder = VacationRequest::query()->where('user_id', \auth()->id());

        $builder->where(function ($query) use ($request) {
            if ($request->has('status')) {
                if ($request->status == 'pending') {
                    $query->where('first_approval', null)->orWhere('second_approval', null);
                }

                if ($request->status == 'approved') {
                    $query->where('second_approval', \true);
                }

                if ($request->status == 'rejected') {
                    $query->where('second_approval', \false)->orWhere('second_approval', \false);
                }
            }
        });

        $vacationRequests = $builder->paginate(9);

        $departements = Departement::all();

        return view(
            'vacation',
            [
                'vacationRequests' => $vacationRequests,
                'departements' => $departements,
            ]
        );
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
    public function store(StoreVacationRequestRequest $request): RedirectResponse
    {
        $vacationRequest = $request->validated();
        $vacationRequest['user_id'] = \auth()->id();

        $result = VacationRequest::create($vacationRequest);

        event(new RequestVacation($result->departement->first_approver_id, "There is a new vacation request", 'approver.index'));

        return redirect()->back()->with('success', 'Vacation request submitted successfully!');
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
    public function update(UpdateVacationRequestRequest $request, VacationRequest $vacationRequest)
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
