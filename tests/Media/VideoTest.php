<?php


class VideoTest extends TestBase {

    /** @test */
    function it_is_initializable()
    {
        $this->assertInstanceOf(
            'Reactor\Documents\Media\Video',
            new Reactor\Documents\Media\Video()
        );
    }

}