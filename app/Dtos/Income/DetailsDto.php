<?php

namespace App\Domains\Accounting\Billings\Dtos\Income;

use App\Domains\Accounting\Billings\Models\BillingIncome;

class DetailsDto
{
    public function __construct(
        public BillingIncome $billing_income,
    )
    {
    }
}