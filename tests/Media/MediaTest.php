<?php

class MediaTest extends TestBase {

    /** @test */
    function it_is_initializable()
    {
        $this->assertInstanceOf(
            'Reactor\Documents\Media\Media',
            new Reactor\Documents\Media\Media()
        );
    }

    /** @test */
    function it_checks_if_the_media_is_substitutable()
    {
        $this->assertFalse(
            (new Reactor\Documents\Media\Media)->isSubstitutable()
        );
    }

}