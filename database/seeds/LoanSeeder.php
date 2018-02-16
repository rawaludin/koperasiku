<?php

use Illuminate\Database\Seeder;
use App\LoanRequest;
use App\User;
use App\Loan;
use Carbon\Carbon;
use App\Payment;

class LoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $admin = User::admin()->first();
        foreach (User::member()->get() as $user) {
            $this->makeDraftLoan($user, 3)
                ->makeSubmittedLoan($user, 3)
                ->makeRejectedLoan($user, $admin, 3)
                ->makeOngoingLoan($user, $admin, 2, rand(1,4))
                ->makeCompletedLoan($user, $admin, 2);
        }
    }

    public function makeSubmittedLoan(User $user, $total)
    {
        $faker = Faker\Factory::create();
        while ($total > 0) {
            $date = $faker->dateTimeThisMonth();
            factory(LoanRequest::class)->create([
                'member_id' => $user->id,
                'is_submitted' => true,
                'created_at' => $date
            ]);
            $total--;
        }
        return $this;
    }

    public function makeDraftLoan(User $user, $total)
    {
        $faker = Faker\Factory::create();
        while ($total > 0) {
            $date = $faker->dateTimeThisMonth();
            factory(LoanRequest::class)->create([
                'member_id' => $user->id,
                'is_submitted' => false,
                'created_at' => $date
            ]);
            $total--;
        }
        return $this;
    }

    public function makeRejectedLoan(User $user, User $admin, $total)
    {
        $faker = Faker\Factory::create();
        while ($total > 0) {
            $date = $faker->dateTimeThisYear();
            factory(LoanRequest::class)->create([
                'member_id' => $user->id,
                'is_submitted' => true,
                'created_at' => $date,
                'is_approved' => false,
                'admin_id' => $admin->id
            ]);
            $total--;
        }
        return $this;
    }

    public function makeOngoingLoan(User $user, User $admin, $total, $monthLeftToPay = 0)
    {
        $faker = Faker\Factory::create();
        while ($total > 0) {
            $totalMonth = $faker->randomElement([6,12,18,24]);
            $amountPerMonth = rand(1,4) * 1000000;
            $totalAmount = $amountPerMonth * $totalMonth;
            $totalPaidMonth = $totalMonth - $monthLeftToPay;
            $createDate = Carbon::now()->subMonths($totalPaidMonth);
            // create loan request
            $loanRequest = factory(LoanRequest::class)->create([
                'member_id' => $user->id,
                'is_submitted' => true,
                'is_approved' => true,
                'admin_id' => $admin->id,
                'member_id' => $user->id,
                'amount' => $totalAmount,
                'created_at' => $createDate,
                'updated_at' => $createDate,
                'duration' => $totalMonth
            ]);
            // create loan
            $loan = factory(Loan::class)->create([
                'member_id' => $user->id,
                'admin_id' => $admin->id,
                'duration' => $totalMonth,
                'is_completed' => $monthLeftToPay == 0 ? true : false,
                'monthly_amount' => $amountPerMonth,
                'total_paid' => 0,
                'total_amount' => $loanRequest->amount,
                'created_at' => $createDate,
            ]);
            // pay loan each month
            while ($totalPaidMonth > 0) {
                $paymentDate = Carbon::now()->subMonths($totalPaidMonth);
                factory(Payment::class)->create([
                    'loan_id' => $loan->id,
                    'admin_id' => $admin->id,
                    'created_at' => $paymentDate,
                    'updated_at' => $paymentDate,
                ]);
                $totalPaidMonth--;
            }

            $total--;
        }
        return $this;
    }

    public function makeCompletedLoan(User $user, User $admin, $total)
    {
        return $this->makeOngoingLoan($user, $admin, $total, 0);
    }
}
