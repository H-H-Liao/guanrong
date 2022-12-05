<?php

namespace TypiCMS\Modules\Pages\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Route;
use Laracasts\Presenter\PresentableTrait;
use Spatie\Translatable\HasTranslations;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\Files\Models\File;
use TypiCMS\Modules\Files\Traits\HasFiles;
use TypiCMS\Modules\History\Traits\Historable;
use TypiCMS\Modules\Pages\Presenters\ModulePresenter;
use TypiCMS\Modules\Pages\Traits\SortableSectionTrait;
use Illuminate\Support\Facades\Storage;

class PageSection extends Base
{
    use HasFiles;
    use HasTranslations;
    use Historable;
    use PresentableTrait;
    use SortableSectionTrait;

    protected $presenter = ModulePresenter::class;

    protected $guarded = [];

    public $translatable = [
        'title',
        'slug',
        'status',
        'body',
    ];

    public static  $home_section=[
        'jumbotron' => '幻燈片',
        'about' => '關於我們',
        'project' => '專案介紹',
        'news' => '最新消息',
    ];

    public static $about=[
        'content' => '內容',
        'banner' => '輪播圖片',
    ];

    public function getThumbAttribute(): string
    {
        return $this->present()->image(null, 54);
    }

    public function uri($locale = null): string
    {
        $locale = $locale ?: config('app.locale');
        $uri = $this->page->uri($locale).'#'.$this->position.'-'.$this->translate('slug', $locale);

        return $uri;
    }

    public function editUrl(): string
    {
        $route = 'admin::edit-page_section';
        if (Route::has($route)) {
            return route($route, [$this->page_id, $this->id]);
        }
    }

    public function indexUrl(): string
    {
        $route = 'admin::edit-page';
        if (Route::has($route)) {
            return route($route, $this->page_id);
        }
    }

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(File::class, 'image_id');
    }

    public function getProductThumbAttribute(): string
    {
        return Storage::url($this->mobile_image->path ?? '');
    }

    public function mobile_image(): BelongsTo
    {
        return $this->belongsTo(File::class, 'mobile_image_id');
    }


    public function getAreaAttribute()
    {
        return self::$home_section[$this->section] ?? self::$about[$this->section] ?? '';
    }

    public static function getArea(Page $page)
    {
        if($page->module=='' && $page->template == 'home'){
            return self::$home_section;
        }else  if($page->module=='' && $page->template == 'research-and-development'){
            return self::$about;
        }else{
            return [];
        }

    }
}
