<?php

namespace Tests\Feature;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AppointmentManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_update_appointment_status(): void
    {
        $user = User::factory()->create();
        $patient = Patient::create(['name' => 'Test Patient', 'phone' => '01000000000']);
        $appointment = Appointment::create([
            'patient_id' => $patient->id,
            'date' => now()->addDay()->toDateString(),
            'time' => '10:00',
        ]);

        $response = $this->actingAs($user)->patch(route('appointments.status', $appointment), [
            'status' => 'confirmed',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('appointments', ['id' => $appointment->id, 'status' => 'confirmed']);
    }

    public function test_appointment_creation_rejects_past_dates(): void
    {
        $user = User::factory()->create();
        $patient = Patient::create(['name' => 'Test Patient', 'phone' => '01000000001']);

        $response = $this->actingAs($user)->post(route('appointments.store'), [
            'patient_id' => $patient->id,
            'date' => now()->subDay()->toDateString(),
            'time' => '10:00',
        ]);

        $response->assertSessionHasErrors('date');
        $this->assertDatabaseCount('appointments', 0);
    }

    public function test_duplicate_appointment_slots_are_rejected(): void
    {
        $user = User::factory()->create();
        $firstPatient = Patient::create(['name' => 'First Patient', 'phone' => '01000000002']);
        $secondPatient = Patient::create(['name' => 'Second Patient', 'phone' => '01000000003']);
        $date = now()->addDay()->toDateString();

        Appointment::create(['patient_id' => $firstPatient->id, 'date' => $date, 'time' => '11:00']);

        $response = $this->actingAs($user)->post(route('appointments.store'), [
            'patient_id' => $secondPatient->id,
            'date' => $date,
            'time' => '11:00',
        ]);

        $response->assertSessionHas('error', 'This time is already booked!');
        $this->assertDatabaseCount('appointments', 1);
    }
}
