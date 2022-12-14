<?php

namespace TypiCMS\Modules\Pages\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laracasts\Presenter\PresentableTrait;
use Spatie\Translatable\HasTranslations;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\Files\Models\File;
use TypiCMS\Modules\Files\Traits\HasFiles;
use TypiCMS\Modules\History\Traits\Historable;
use TypiCMS\Modules\Menus\Models\Menulink;
use TypiCMS\Modules\Pages\Presenters\ModulePresenter;
use TypiCMS\NestableCollection;
use TypiCMS\NestableTrait;

class Page extends Base
{
    use HasFiles;
    use HasTranslations;
    use Historable;
    use NestableTrait;
    use PresentableTrait;

    protected $presenter = ModulePresenter::class;

    protected $guarded = [];

    public $translatable = [
        'title',
        'product_title',
        'order_title',
        'slug',
        'uri',
        'status',
        'body',
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];

    public function uri($locale = null): string
    {
        $locale = $locale ?: config('app.locale');
        $uri = $this->translate('uri', $locale);
        if (
            TypiCMS::mainLocale() !== $locale ||
            config('typicms.main_locale_in_url')
        ) {
            $uri = $uri ? $locale.'/'.$uri : $locale;
        }

        return $uri ?: '/';
    }

    public function url()
    {
        return '/'.$this->uri(app()->getLocale());
    }

    public function isHome()
    {
        return (bool) $this->is_home;
    }

    public function isPrivate()
    {
        return (bool) $this->private;
    }

    public function scopeWhereUriIs($query, $uri): Builder
    {
        $field = 'uri';
        if (in_array($field, (array) $this->translatable)) {
            $field .= '->'.config('app.locale');
        }

        return $query->where($field, $uri);
    }

    public function scopeWhereUriIsNot($query, $uri): Builder
    {
        $field = 'uri';
        if (in_array($field, (array) $this->translatable)) {
            $field .= '->'.config('app.locale');
        }

        return $query->where($field, '!=', $uri);
    }

    public function scopeWhereUriIsLike($query, $uri): Builder
    {
        $field = 'uri';
        if (in_array($field, (array) $this->translatable)) {
            $field .= '->'.config('app.locale');
        }

        return $query->where($field, 'LIKE', $uri);
    }

    public function allForSelect(): array
    {
        $pages = $this->order()
            ->get()
            ->nest()
            ->listsFlattened();

        return ['' => ''] + array_map('strip_tags', $pages);
    }

    public function getSubMenu(): NestableCollection
    {
        $rootUriArray = explode('/', $this->uri);
        $uri = $rootUriArray[0];
        if (in_array($uri, locales())) {
            if (isset($rootUriArray[1])) {
                $uri .= '/'.$rootUriArray[1]; // add next part of uri in locale
            }
        }

        $nestedCollection = $this->whereUriIsNot($uri)
            ->orderBy('position', 'asc')
            ->whereUriIsLike($uri.'%')
            ->get()
            ->noCleaning()
            ->nest();

        return $nestedCollection;
    }

    public function sections(): HasMany
    {
        return $this->hasMany(PageSection::class)->published()->orderBy('position', 'ASC');
    }

    public function getSection($section)
    {
        return PageSection::published()->where('page_id',$this->id)->where('section',$section)->first();
    }

    public function publishedSections(): HasMany
    {
        return $this->sections()->published();
    }

    public function menulinks(): HasMany
    {
        return $this->hasMany(Menulink::class);
    }

    public function subpages(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')->order();
    }

    public function publishedSubpages(): HasMany
    {
        return $this->subpages()->published();
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(File::class, 'image_id');
    }

    public static function getPage($pageName)
    {
        $page = Page::where('template',$pageName)
                    ->first();
        if($page && $page->status == 1){
            return $page;
        }else{
            return null;
        }
    }

    public static function getModulePage($pageName)
    {
        $page= Page::where('module',$pageName)->first();
        if($page){
            return $page;
        }else{
            return null;
        }
    }

    public static function getModulePageTitle($pageName)
    {
        $page= Page::where('module',$pageName)->first();
        if($page){
            return $page->title ?? $pageName;
        }else{
            return $pageName;
        }
    }

    public static function getHomeTitle()
    {
        $page=Page::getPage('home');
        return $page->title ?? null;
    }

    public function getModule()
    {
        return $this->getModel()->module ??  $this->getModel()->template;
    }
}
