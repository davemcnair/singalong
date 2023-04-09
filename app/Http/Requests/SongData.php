<?php

namespace App\Http\Requests;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class SongData extends Data
{
    public function __construct(
        #[Required]
        public string         $title,

        #[Required]
        public string         $artist,

        #[DataCollectionOf(TagData::class)]
        public DataCollection $tags
    ) {
    }

//    public static function from(mixed ...$payload): static
//    {
//        return parent::from([
//           $payload->title,
//           $payload->artist,
//           $
//        ]);
//    }
}
