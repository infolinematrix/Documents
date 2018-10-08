<?php


class AudioTest extends TestBase {

    /** @test */
    function it_is_initializable()
    {
        $this->assertInstanceOf(
            'Reactor\Documents\Media\Audio',
            new Reactor\Documents\Media\Audio()
        );
    }

}