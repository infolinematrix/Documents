<?php


class VideoPresenterTest extends TestBase {

    /** @test */
    function it_is_initializable()
    {
        $this->assertInstanceOf(
            'Reactor\Documents\Presenters\VideoPresenter',
            new Reactor\Documents\Presenters\VideoPresenter('foo')
        );
    }

}