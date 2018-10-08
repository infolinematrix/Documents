<?php

namespace Reactor\Documents\Media;


use Kenarkose\Files\Substitute\Substitutes;

class Audio extends Media {

    use Substitutes;

    /**
     * @var string
     */
    protected $mediaType = 'audio';

    /**
     * Presenter for the model
     *
     * @var string
     */
    protected $presenter = 'Reactor\Documents\Presenters\AudioPresenter';

    /**
     * Substitutable
     *
     * @param bool
     */
    protected $substitutable = true;

}