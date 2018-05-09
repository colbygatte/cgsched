<?php

namespace Tests\Unit;

use App\Exceptions\MultipleShiftAssignmentException;
use App\Shift;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShiftTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function same_shift_cannot_be_assigned_to_employee_on_same_day()
    {
        $this->expectException(MultipleShiftAssignmentException::class);

        $values = create(Shift::class)->getAttributeValues(['definition_id', 'date']);

        create(Shift::class, $values);
    }

    /** @test */
    public function can_assign_multiple_people_to_one_shift()
    {
        $shift = create(Shift::class);

        $shift->users()->attach(create(User::class, [], 2));

        $this->assertCount(2, $shift->users);
    }

    /** @test */
    public function cannot_assign_same_person_twice_to_one_shift()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        $shift = create(Shift::class);

        $user = create(User::class);

        $shift->users()->attach($user);
        $shift->users()->attach($user);
    }
}
