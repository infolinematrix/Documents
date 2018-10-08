<?php

namespace Reactor\Documents\Media;


use Kenarkose\Files\Substitute\Substitutes;

class Video extends Media {

    use Substitutes;

    /**
     * @var string
     */
    protected $mediaType = 'video';

    /**
     * Presenter for the model
     *
     * @var string
     */
    protected $presenter = 'Reactor\Documents\Presenters\VideoPresenter';

    /**
     * Substitutable
     *
     * @param bool
     */
    protected $substitutable = true;

}