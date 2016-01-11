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

        Form::component('bsNumber', 'shared.components.number', [
            'name',
            'label',
            'required' => false,
            'unit' => false
        ]);

        Form::component('bsTextarea', 'shared.components.textarea', [
            'name',
            'label',
            'required' => false,
            'rows' => 4
        ]);

        Form::component('bsSelect', 'shared.components.select', [
            'name',
            'label',
            'choice',
            'required' => false,
            'unit' => false
        ]);

        Form::component('twoSelect', 'shared.components.twoSelect', [
            'label',
            'nameA',
            'choiceA',
            'requiredA' => false,
            'unitA' => false,
            'nameB',
            'choiceB',
            'requiredB' => false,
            'unitB' => false,
        ]);

        Form::component('coord', 'shared.components.coordinate', [
            'name',
            'label',
            'required' => true,
        ]);

        // Sugar components
        Form::component('basin', 'shared.sugar.basin', ['name' => 'basin_name']);
        Form::component('province', 'shared.sugar.province', ['name' => 'province_name']);
        Form::component('analogTo', 'shared.sugar.analogTo', ['name' => 'analog_to']);
        Form::component('analogDistance', 'shared.sugar.analogDistance', ['name' => 'analog_distance']);
        Form::component('shore', 'shared.sugar.shore', ['name' => 'shore']);
        Form::component('terrain', 'shared.sugar.terrain', ['name' => 'terrain']);
        Form::component('nearbyField', 'shared.sugar.nearbyField', ['name' => 'nearby_field']);
        Form::component('nearbyInfra', 'shared.sugar.nearbyInfra', ['name' => 'nearby_infra']);
        Form::component('remark', 'shared.sugar.remark', ['name' => 'remark']);
    }
}
