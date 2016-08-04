<?php

use Mockarena\ExpectedCall;

describe(ExpectedCall::class, function () {
    beforeEach(function () {
        $this->call = new ExpectedCall();
    });

    describe('callMatches()', function () {
        it('should return true of the arguments array exactly matches the passed array', function () {
            $this->call->setArguments([1, 2, 3]);
            expect($this->call->callMatches([1, 2, 3]))->to->be->true();
            expect($this->call->callMatches([1, 2, 4]))->to->be->false();
            expect($this->call->callMatches(['asdf']))->to->be->false();
        });
    });
});
