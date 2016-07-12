<?php

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
    });
});
