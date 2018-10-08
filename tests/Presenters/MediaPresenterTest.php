<?php


class MediaPresenterTest extends TestBase {

    /** @test */
    function it_is_initializable()
    {
        $this->assertInstanceOf(
            'Reactor\Documents\Presenters\MediaPresenter',
            new Reactor\Documents\Presenters\MediaPresenter('foo')
        );
    }

}