<?php

namespace TypiCMS\Modules\Settings\Models;

use Eloquent;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Setting extends Eloquent
{
    protected $fillable = [
        'group_name',
        'key_name',
        'value',
    ];

    public function allToArray(): array
    {
        $config = [];
        try {
            foreach ($this->get() as $object) {
                $key = $object->key_name;
                if ($object->group_name != 'config') {
                    $config[$object->group_name][$key] = $object->value;
                } else {
                    $config[$key] = $object->value;
                }
            }
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        }

        return $config;
    }

    public static function value($key)
    {
        $item = Setting::where('key_name',$key)->first();
        if ($item) {
            if ($item->group_name == 'config') {
                return $item->value ?? '';
            } else {
                $item = Setting::where('key_name',$key)->where('group_name',app()->getLocale())->first();
                if ($item) {
                    return $item->value ?? '';
                }
            }
        }
        return '';
    }

    public static function image($key)
    {
        $item = self::value($key);
        if ($item == "") {
            return asset('img-not-found.png');
        } else {
            return  Storage::url('settings/'.$item);
        }
    }

}
