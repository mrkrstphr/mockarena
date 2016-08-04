<?php

use Mockarena\ExpectedCall;
use Mockarena\MockFunction;

describe(MockFunction::class, function () {
    beforeEach(function () {
        $this->function = new MockFunction('vroom');
    });

    describe('call()', function () {
        it('should push a function call onto the call stack', function () {
            $this->function->call(10, 'asdf');
            expect($this->function->calls)->to->have->length(1);
            expect($this->function->calls[0])->to->equal([10, 'asdf']);
        });

        it('should return an expected call return value if one is found', function () {
            $this->function->calledWith(1, 2, 3)->willReturn('test');
            
            $result = $this->function->call(1, 2, 3);
            expect($result)->to->equal('test');

            $result = $this->function->call(1, 3, 5);
            expect($result)->to->be->null();
        });
    });

    describe('calledWith()', function () {
        it('should return an instance of ExpectedCall', function () {
            $call = $this->function->calledWith(1, 2, 3);

            expect($call)->to->be->instanceof(ExpectedCall::class);
            expect($call->getArguments())->to->equal([1, 2, 3]);
        });

        it('should store the expected call', function () {
            $call = $this->function->calledWith(1, 2, 3);
            expect($this->function->expectedCalls)->to->equal([$call]);
        });
    });
});
