<?php

namespace App\Providers;

use App\Interfaces\IChurch;
use App\Interfaces\IChurchEvent;
use App\Interfaces\IGroup;
use App\Interfaces\IMember;
use App\Interfaces\IOccupation;
use App\Interfaces\IRelationship;
use App\Interfaces\IWorkplace;
use App\Services\ChurchEventService;
use App\Services\ChurchService;
use App\Services\GroupService;
use App\Services\MemberService;
use App\Services\OccupationService;
use App\Services\RelationshipService;
use App\Services\WorkplaceService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IChurch::class, ChurchService::class);
        $this->app->bind(IChurchEvent::class, ChurchEventService::class);
        $this->app->bind(IGroup::class, GroupService::class);
        $this->app->bind(IMember::class, MemberService::class);
        $this->app->bind(IOccupation::class, OccupationService::class);
        $this->app->bind(IRelationship::class, RelationshipService::class);
        $this->app->bind(IWorkplace::class, WorkplaceService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
