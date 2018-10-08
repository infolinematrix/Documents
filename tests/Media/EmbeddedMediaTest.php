<?php


class EmbeddedMediaTest extends TestBase {

    /** @test */
    function it_is_initializable()
    {
        $this->assertInstanceOf(
            'Reactor\Documents\Media\EmbeddedMedia',
            new Reactor\Documents\Media\EmbeddedMedia()
        );
    }

}