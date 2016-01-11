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
            'unit' => false,
            'inputCol' => 4
        ]);

        Form::component('bsNumber', 'shared.components.number', [
            'name',
            'label',
            'required' => false,
            'unit' => false,
            'inputCol' => 4
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
            'unit' => false,
            'inputCol' => 4
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
            'type',
            'required' => true,
        ]);

        Form::component('bsDate', 'shared.components.date', [
            'name',
            'label',
            'required' => false,
        ]);

        Form::component('survey', 'shared.sugar.survey', [
            'name' => 'survey',
            'choice'
        ]);

        // Sugar components
        Form::component('playList', 'shared.sugar.playList', ['name', 'playList']);
        Form::component('basin', 'shared.sugar.basin', ['name']);
        Form::component('province', 'shared.sugar.province', ['name']);
        Form::component('clarified', 'shared.sugar.clarified', ['name']);
        Form::component('analogTo', 'shared.sugar.analogTo', ['name']);
        Form::component('analogDistance', 'shared.sugar.analogDistance', ['name']);
        Form::component('shore', 'shared.sugar.shore', ['name']);
        Form::component('terrain', 'shared.sugar.terrain', ['name']);
        Form::component('nearbyField', 'shared.sugar.nearbyField', ['name']);
        Form::component('nearbyInfra', 'shared.sugar.nearbyInfra', ['name']);
        Form::component('remark', 'shared.sugar.remark', ['name', 'required' => false]);
        Form::component('lateMethod', 'shared.sugar.lateMethod', ['name']);
        Form::component('seismicImage', 'shared.sugar.seismicImage', ['name']);
    }
}
