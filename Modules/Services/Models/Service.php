<?php

namespace TypiCMS\Modules\Services\Models;

use App\HasList;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laracasts\Presenter\PresentableTrait;
use Spatie\Translatable\HasTranslations;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\Files\Models\File;
use TypiCMS\Modules\Files\Traits\HasFiles;
use TypiCMS\Modules\History\Traits\Historable;
use TypiCMS\Modules\Services\Presenters\ModulePresenter;

class Service extends Base
{
    use HasFiles;
    use HasTranslations;
    use Historable;
    use PresentableTrait;
    use HasList;

    protected $presenter = ModulePresenter::class;

    protected $guarded = [];

    public $translatable = [
        'title',
        'slug',
        'status',
        'summary',
        'body',
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];

    public function getThumbAttribute(): string
    {
        return $this->present()->image(null, 54);
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(File::class, 'image_id');
    }

    public function url()
    {
        return route(app()->getLocale()."::service",$this->slug);
    }
}
