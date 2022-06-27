<?php

namespace App\Jobs;

use App\Models\ResidentialComplex\ResidentialComplex;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateResidentialComplexPriceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
        $residentialComplexes = ResidentialComplex::query()
            ->with('residentialHouses')
            ->get();

        $residentialComplexes->each(function (ResidentialComplex $complex) {
            $complex->update(['price' => $complex->residentialHouses()->min('price')]);
        });
    }
}
