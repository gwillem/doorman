<?php

/**
 *  This file is part of reflar/doorman.
 *
 *  Copyright (c) 2018 ReFlar.
 *
 *  https://reflar.redevs.org
 *
 *  For the full copyright and license information, please view the LICENSE.md
 *  file that was distributed with this source code.
 */

namespace Reflar\Doorman\Listeners;

use Illuminate\Contracts\Events\Dispatcher;
use Flarum\User\Event\Saving;
use Reflar\Doorman\Doorkey;
use Reflar\Doorman\Validators\DoorkeyLoginValidator;

class ValidateDoorkey
{
    protected $validator;

    public function __construct(DoorkeyLoginValidator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param Dispatcher $events
     * @return void
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(Saving::class, [$this, 'validateKey']);
    }

    /**
     * @param Saving $event
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validateKey(Saving $event)
    {
        if (!$event->user->exists) {
             $this->validator->assertValid([
                'reflar-doorkey' => array_get($event->data, 'attributes.reflar-doorkey')
            ]);
        }
    }
}