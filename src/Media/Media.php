<?php

namespace Reactor\Documents\Media;


use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Intervention\Image\Facades\Image as ImageFacade;
use Kenarkose\Files\Determine\AutoDeterminesType;
use Kenarkose\Ownable\AutoAssociatesOwner;
use Kenarkose\Ownable\Ownable;
use Kenarkose\Sortable\Sortable;
use Kenarkose\Transit\File\File as TransitFile;
use Laracasts\Presenter\PresentableTrait;
use Nicolaslopezj\Searchable\SearchableTrait;

class Media extends TransitFile {

    use Ownable, AutoAssociatesOwner, AutoDeterminesType,
        Sortable, SearchableTrait, PresentableTrait, Translatable;

    /**
     * @var string
     */
    protected $table = 'media';

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 30;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['translations'];

    /**
     * The fillable fields for the model.
     *
     * @var  array
     */
    protected $fillable = [
        'extension', 'mimetype', 'size', 'name', 'path',
        'caption', 'alttext', 'description'
    ];

    /**
     * Translatable
     */
    public $translatedAttributes = ['caption', 'alttext', 'description'];
    public $translationModel = 'Reactor\Documents\Media\MediaTranslation';
    public $translationForeignKey = 'media_id';

    /**
     * Presenter for the model
     *
     * @var string
     */
    protected $presenter = 'Reactor\Documents\Presenters\MediaPresenter';

    /**
     * Sortable columns
     *
     * @var array
     */
    protected $sortableColumns = ['name', 'updated_at', 'created_at'];

    /**
     * Default sortable key
     *
     * @var string
     */
    protected $sortableKey = 'created_at';

    /**
     * Default sortable direction
     *
     * @var string
     */
    protected $sortableDirection = 'desc';

    /**
     * Searchable columns.
     *
     * @var array
     */
    protected $searchable = [
        'columns' => [
            'name'                       => 10,
            'mimetype'                   => 10,
            'media_translations.caption' => 10,
        ],
        'joins'   => [
            'media_translations' => ['media.id', 'media_translations.media_id'],
        ],
    ];

    /**
     * Substitutable
     *
     * @param bool
     */
    protected $substitutable = false;

    /**
     * Boot the model
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($embeddedMedia)
        {
            $embeddedMedia->populateDefaultMetadata();
            $embeddedMedia->compileMetadata();
        });
    }

    /**
     * Populates default metadata
     */
    public function populateDefaultMetadata()
    {
        if ($this->type === 'image')
        {
            $this->setImageMetadata();
        }
    }

    /**
     * Scope for request filter
     *
     * @param Builder $query
     * @param string $type
     * @return Builder
     */
    public function scopeFilteredByType(Builder $query, $type = null)
    {
        $type = is_null($type) ? request('f', 'all') : $type;

        if (in_array($type, ['audio', 'document', 'image', 'video', 'embedded']))
        {
            $query->whereType($type);
        }

        return $query;
    }

    /**
     * Path accessor
     *
     * @param string $value
     * @return string
     */
    public function getPathAttribute($value)
    {
        return $value;
    }

    /**
     * Getter for file path
     *
     * @return string
     */
    public function getFilePath()
    {
        return upload_path($this->getAttribute('path'));
    }

    /**
     * Public url accessor
     *
     * @return string
     */
    public function getPublicURL()
    {
        return uploaded_asset($this->path);
    }

    /**
     * Checks if the media is an image
     *
     * @return bool
     */
    public function isImage()
    {
        return ($this->type === 'image');
    }

    /**
     * Checks if the media is substitutable
     *
     * @return bool
     */
    public function isSubstitutable()
    {
        return $this->substitutable;
    }

    /**
     * Converts model attributes to array
     *
     * @param bool $withImageHTML
     * @return array
     */
    public function toArray($withImageHTML = true)
    {
        return array_merge(parent::toArray(), [
            'thumbnail' => $this->present()->thumbnail
        ]);
    }

    /**
     * Sets the image metadata
     */
    protected function setImageMetadata()
    {
        $image = ImageFacade::make(
            $this->getFilePath()
        );

        $this->setMetadata('width', $image->width());
        $this->setMetadata('height', $image->height());
    }

    /**
     * Summarizes the model
     *
     * @param bool $json
     * @return array
     */
    public function summarize($json = false)
    {
        $attributes = [
            'id' => $this->getKey(),
            'name' => $this->getAttribute('name'),
            'type' => $this->getAttribute('type'),
            'meta' => $this->present()->metaDescription,
            'thumbnail' => $this->present()->thumbnail,
            'preview' => ($this->type === 'image') ? $this->present()->filteredImageWith('rcompact') : ''
        ];

        foreach ($this->translations as $translation)
        {
            $attributes[$translation->locale] = [
                'caption' => $translation->caption,
                'description' => $translation->description,
                'alttext' => $translation->alttext
            ];
        }

        return $json ? json_encode($attributes) : $attributes;
    }

}