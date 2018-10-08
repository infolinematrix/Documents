<?php


class EmbeddedMediaPresenterTest extends TestBase {

    /** @test */
    function it_is_initializable()
    {
        $this->assertInstanceOf(
            'Reactor\Documents\Presenters\EmbeddedMediaPresenter',
            new Reactor\Documents\Presenters\EmbeddedMediaPresenter('foo')
        );
    }

}