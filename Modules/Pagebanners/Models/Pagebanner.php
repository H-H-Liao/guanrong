<?php

namespace TypiCMS\Modules\Pagebanners\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laracasts\Presenter\PresentableTrait;
use Spatie\Translatable\HasTranslations;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\Files\Models\File;
use TypiCMS\Modules\Files\Traits\HasFiles;
use TypiCMS\Modules\History\Traits\Historable;
use TypiCMS\Modules\Pagebanners\Presenters\ModulePresenter;
use Illuminate\Support\Facades\Storage;

class Pagebanner extends Base
{
    use HasFiles;
    use HasTranslations;
    use Historable;
    use PresentableTrait;

    protected $presenter = ModulePresenter::class;

    protected $guarded = [];

    public $translatable = [
        'status',
    ];

    public function getThumbAttribute(): string
    {
        return $this->present()->image(null, 54);
    }


    public function getMobileThumbAttribute(): string
    {
        return Storage::url($this->mobileImage->path ?? '');
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(File::class, 'image_id');
    }

    public function getAllPage()
    {
        return [
                    'about'=>'關於我們',
                    'profile'=>'作品集',
                    'parner'=>'合作夥伴',
                    'qa'=>'常見問題',
                    'news'=>'最新消息',
                    'service'=>'服務項目',
                    'contact'=>'聯絡我們',
                    'error'=>'錯誤頁面',
                ];
    }

    public function getNameAttribute()
    {
        $pages = $this->getAllPage();
        $name = $pages[$this->target];
        return $name;
    }

    public function mobileImage(): BelongsTo
    {
        return $this->belongsTo(File::class, 'mobile_image_id');
    }

    public static function getValue($pageName)
    {
        $item = Pagebanner::published()
                            ->where('target',$pageName)
                            ->first();

        return  $item;
    }

    public static function getImage($pageName)
    {
        $item = Pagebanner::published()
                            ->where('target',$pageName)
                            ->first();

        if(isset($item) && $item->image_id>0){
            return  $item->present()->image();
        }else{
            return '';
        }
    }
}
