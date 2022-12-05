<?php

namespace TypiCMS\Modules\Mainservices\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Core\Filters\FilterOr;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Mainservices\Models\Mainservice;

class ApiController extends BaseApiController
{
    public function index(Request $request): LengthAwarePaginator
    {
        $data = QueryBuilder::for(Mainservice::class)
            ->selectFields($request->input('fields.mainservices'))
            ->allowedSorts(['status_translated', 'title_translated','position'])
            ->allowedFilters([
                AllowedFilter::custom('title', new FilterOr()),
            ])
            ->allowedIncludes(['image'])
            ->paginate($request->input('per_page'));

        return $data;
    }

    protected function updatePartial(Mainservice $mainservice, Request $request)
    {
        foreach ($request->only('status','position') as $key => $content) {
            if ($mainservice->isTranslatableAttribute($key)) {
                foreach ($content as $lang => $value) {
                    $mainservice->setTranslation($key, $lang, $value);
                }
            } else {
                $mainservice->{$key} = $content;
            }
        }

        $mainservice->save();
    }

    public function destroy(Mainservice $mainservice)
    {
        $mainservice->delete();
    }
}
