<?php

use Mockarena\Mockarena;
use Mockarena\MockFunction;

describe(Mockarena::class, function () {
    beforeEach(function () {
        $this->mockarena = new Mockarena();
    });

    describe('mock()', function () {
        it('should create a function if it does not exist', function () {
            expect(function_exists('foop'))->to->be->false();
            expect(Mockarena::$mocks)->to->be->empty();

            $fn = $this->mockarena->mock('foop');

            expect(function_exists('foop'))->to->be->true();
            expect(Mockarena::$mocks)->not->to->be->empty();

            expect($fn)->to->be->instanceof(MockFunction::class);
        });

        it('should reset an existing mock before returning it', function () {
            $fn = $this->mockarena->mock('foop');
            $fn->calledWith()->willReturn('fooiiuu');

            foop(); foop();

            $fn = $this->mockarena->mock('foop');

            expect($fn)->to->be->instanceof(MockFunction::class);
            expect(Mockarena::$mocks['foop']->calls)->to->be->empty();
            expect(Mockarena::$mocks['foop']->expectedCalls)->to->be->empty();
        });

        it('should throw an exception when attempting to mock a defined, non-mocked function', function () {
            $actual = null;

            try {
                $this->mockarena->mock('fgetcsv');
            } catch (RuntimeException $e) {
                $actual = $e;
            }

            expect($actual)->to->be->instanceof(RuntimeException::class);
        });
    });

    describe('getMock()', function () {
        it('should return the function if it does exist', function () {
            $this->mockarena->mock('flurp');
            $mock = $this->mockarena->getMock('flurp');
            expect($mock)->to->be->instanceof(MockFunction::class);
        });

        it('should return null if it does not exist', function () {
            $mock = $this->mockarena->getMock('gurp');
            expect($mock)->to->be->null();
        });
    });

    describe('forwardCall()', function () {
        it('should call the mock function', function () {
            $fn = $this->mockarena->mock('flargg');
            $this->mockarena->forwardCall('flargg', 1, 2, 10);

            expect($fn->calls)->to->have->length(1);
            expect($fn->calls[0])->to->equal([1, 2, 10]);
        });

        it('should throw an exception if the function was not mocked', function () {
            $actual = null;

            try {
                $this->mockarena->forwardCall('fgetcsv');
            } catch (RuntimeException $e) {
                $actual = $e;
            }

            expect($actual)->to->be->instanceof(RuntimeException::class);
        });
    });
});
