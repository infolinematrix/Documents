<?php

class ImageTest extends TestBase {

    /** @test */
    function it_is_initializable()
    {
        $this->assertInstanceOf(
            'Reactor\Documents\Media\Image',
            new Reactor\Documents\Media\Image()
        );
    }

}