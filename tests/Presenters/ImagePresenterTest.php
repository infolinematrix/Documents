<?php


class ImagePresenterTest extends TestBase {

    /** @test */
    function it_is_initializable()
    {
        $this->assertInstanceOf(
            'Reactor\Documents\Presenters\ImagePresenter',
            new Reactor\Documents\Presenters\ImagePresenter('foo')
        );
    }

}