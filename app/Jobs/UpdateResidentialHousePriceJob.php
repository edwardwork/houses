<?php

namespace App\Jobs;

use App\Models\ResidentialHouse\ResidentialHouse;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateResidentialHousePriceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
        $residentialHouses = ResidentialHouse::query()
            ->with('apartments')
            ->get();

        $residentialHouses->each(function (ResidentialHouse $house) {
            $house->update(['price' => $house->apartments()->min('price')]);
        });
    }
}
