<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Form;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\SomeEvent' => [
            'App\Listeners\EventListener',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        Form::component('bsText', 'shared.components.text', [
            'name',
            'label',
            'required' => false,
            'unit' => false
        ]);

        Form::component('bsSelect', 'shared.components.select', [
            'name',
            'label',
            'choice',
            'required' => false,
            'unit' => false
        ]);

        Form::component('basin', 'shared.components.basin', ['name' => 'basin_name']);
        Form::component('province', 'shared.components.province', ['name' => 'province_name']);
        Form::component('analogTo', 'shared.components.analogTo', ['name' => 'analog_to']);
        Form::component('analogDistance', 'shared.components.analogDistance', ['name' => 'analog_distance']);
        Form::component('shore', 'shared.components.shore', ['name' => 'shore']);
        Form::component('terrain', 'shared.components.terrain', ['name' => 'terrain']);
        Form::component('nearbyField', 'shared.components.nearbyField', ['name' => 'nearby_field']);
        Form::component('nearbyInfra', 'shared.components.nearbyInfra', ['name' => 'nearby_infra']);
    }
}
