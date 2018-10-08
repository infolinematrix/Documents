<?php


class AudioPresenterTrait extends TestBase {

    /** @test */
    function it_is_initializable()
    {
        $this->assertInstanceOf(
            'Reactor\Documents\Presenters\AudioPresenter',
            new Reactor\Documents\Presenters\AudioPresenter('foo')
        );
    }

}