<?php

namespace TypiCMS\Modules\Parners\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Core\Filters\FilterOr;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Parners\Models\Parner;

class ApiController extends BaseApiController
{
    public function index(Request $request): LengthAwarePaginator
    {
        $data = QueryBuilder::for(Parner::class)
            ->selectFields($request->input('fields.parners'))
            ->allowedSorts(['status_translated', 'title_translated','position'])
            ->allowedFilters([
                AllowedFilter::custom('title', new FilterOr()),
            ])
            ->allowedIncludes(['image'])
            ->paginate($request->input('per_page'));

        return $data;
    }

    protected function updatePartial(Parner $parner, Request $request)
    {
        foreach ($request->only('status','position') as $key => $content) {
            if ($parner->isTranslatableAttribute($key)) {
                foreach ($content as $lang => $value) {
                    $parner->setTranslation($key, $lang, $value);
                }
            } else {
                $parner->{$key} = $content;
            }
        }

        $parner->save();
    }

    public function destroy(Parner $parner)
    {
        $parner->delete();
    }
}
