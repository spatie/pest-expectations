<?php

use Illuminate\Console\Scheduling\CallbackEvent;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Support\Facades\Schedule;
use Spatie\PestExpectations\Tests\TestSupport\Scheduled\CommandClass;
use Spatie\PestExpectations\Tests\TestSupport\Scheduled\InvokableClass;
use Spatie\PestExpectations\Tests\TestSupport\Scheduled\JobClass;

describe('call', function () {
    it('can assert a class is scheduled by passing a cron expression', function () {
        Schedule::call(InvokableClass::class)->hourly();
        expect(InvokableClass::class)->toBeScheduled('0 * * * *');
    });

    it('can use a callback to assert anything on a scheduled class', function () {
        Schedule::call(InvokableClass::class)->hourly();

        expect(InvokableClass::class)->toBeScheduled(function (CallbackEvent $event) {
            expect($event->getExpression())->toBe('0 * * * *');
            expect($event->getSummaryForDisplay())->toBe(InvokableClass::class);
        });
    });
});

describe('command', function () {
    it('can assert a command is scheduled by passing a cron expression', function () {
        Schedule::command(CommandClass::class)->daily();
        expect(CommandClass::class)->toBeScheduled('0 0 * * *');
    });

    it('can use a callback to assert anything on a scheduled command', function () {
        Schedule::command(CommandClass::class)->daily()->description('Foo');

        expect(CommandClass::class)->toBeScheduled(function (Event $event) {
            expect($event->getExpression())->toBe('0 0 * * *');
            expect($event->getSummaryForDisplay())->toBe('Foo');
        });
    });
});

describe('job', function () {
    it('can assert a job is scheduled by passing a cron expression', function () {
        Schedule::job(JobClass::class)->daily();
        expect(JobClass::class)->toBeScheduled('0 0 * * *');
    });

    it('can use a callback to assert anything on a scheduled job', function () {
        Schedule::job(JobClass::class)->daily();

        expect(JobClass::class)->toBeScheduled(function (Event $event) {
            expect($event->getExpression())->toBe('0 0 * * *');
            expect($event->getSummaryForDisplay())->toBe(JobClass::class);
        });
    });
});
