<?php

namespace App\Domains\Accounting\Billings\Dtos\Outcome;

use App\Domains\Accounting\Billings\Models\BillingOutcome;

class DetailsDto
{
    public function __construct(
        public BillingOutcome $billing_outcome,
    )
    {
    }
}