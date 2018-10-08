<?php

class DocumentTest extends TestBase {

    /** @test */
    function it_is_initializable()
    {
        $this->assertInstanceOf(
            'Reactor\Documents\Media\Document',
            new Reactor\Documents\Media\Document()
        );
    }

}