<?php

namespace App\Providers;

use App\Models\Admins\Admin;
use App\Models\Articles\Article;
use App\Models\Categories\Category;
use App\Models\Domains\Domain;
use App\Models\StaticContent\Block;
use App\Models\StaticContent\Page;
use App\Models\Tags\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerMorphMap();
    }

    protected function registerMorphMap(): void
    {
        Relation::morphMap(
            [
                User::MORPH_NAME => User::class,
            ]
        );
    }
}
