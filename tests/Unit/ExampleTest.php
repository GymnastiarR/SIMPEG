<?php

namespace Tests\Unit;

use App\Events\RequestVacation;
use App\Models\VacationRequest;
use Illuminate\Support\Facades\Event;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_that_true_is_true(): void
    {
        Event::fake();

        // Event::assertDispatched(VacationRequest::class);

        //    VacationRequest::

        $vacationRequest = VacationRequest::create([
            'start_date' => '2021-01-01',
            'end_date' => '2021-01-02',
            'reason' => 'Sick',
        ]);

        Event::assertDispatched(function (RequestVacation $event) use ($vacationRequest) {
            return $event->vacationRequest = $vacationRequest;
        });

        $this->assertTrue(true);
    }
}
