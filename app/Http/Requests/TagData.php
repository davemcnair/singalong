<?php

namespace App\Http\Requests;

use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;

class TagData extends Data
{

    public function __construct(
        #[Required]
        public string $name
    ) {
    }


}
