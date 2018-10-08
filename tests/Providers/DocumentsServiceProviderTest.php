<?php

class DocumentsServiceProviderTest extends TestBase {

    /** @test */
    function it_registers_upload_service()
    {
        $this->assertInstanceOf(
            'Reactor\Documents\Repositories\DocumentsRepository',
            app()->make('Reactor\Documents\Repositories\DocumentsRepository')
        );
    }

}