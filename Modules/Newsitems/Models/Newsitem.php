<?php

namespace TypiCMS\Modules\Newsitems\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laracasts\Presenter\PresentableTrait;
use Spatie\Translatable\HasTranslations;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\Files\Models\File;
use TypiCMS\Modules\Files\Traits\HasFiles;
use TypiCMS\Modules\History\Traits\Historable;
use TypiCMS\Modules\Newsitems\Presenters\ModulePresenter;
use Illuminate\Database\Eloquent\Builder;

class Newsitem extends Base
{
    use HasFiles;
    use HasTranslations;
    use Historable;
    use PresentableTrait;


    protected $presenter = ModulePresenter::class;

    protected $dates = ['show_date','start_date','end_date'];

    protected $guarded = [];

    public $translatable = [
        'title',
        'slug',
        'status',
        'summary',
        'body',
        'in_home',
        //meta
        'meta_title',
        'meta_keywords',
        'meta_description',
        'section1_title',
        'section1_body',
        'section2_title',
        'section2_body',
        'section3_title',
        'section3_body',
        'section4_title',
        'section4_body',
        'link'
    ];

    /**
     * 是否為發佈日期
     */
    public function scopeReleaseDate(Builder $query): Builder
    {
        return $query->where(function($q){
            $q->where(function($query){
                $query->where('start_date','<=',now())
                ->where('end_date','>=',now());
            })->orWhere(function($query){
                $query->where('start_date','<=',now())
                ->where('no_end_date',1);
            });
        });
    }

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
        return route(app()->getLocale()."::newsitem",$this->slug);
    }

    public static function list($number = 10)
    {
        return self::published()->releaseDate()->orderBy('show_date','DESC')->take($number)->get();
    }

    public function last()
    {
       return self::published()->releaseDate()->orderBy('show_date','DESC')->first();
    }
}
