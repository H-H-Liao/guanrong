<?php

namespace TypiCMS\Modules\Homeprojects\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Core\Filters\FilterOr;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Homeprojects\Models\Homeproject;

class ApiController extends BaseApiController
{
    public function index(Request $request): LengthAwarePaginator
    {
        $data = QueryBuilder::for(Homeproject::class)
            ->selectFields($request->input('fields.homeprojects'))
            ->allowedSorts(['status_translated', 'title_translated','position'])
            ->allowedFilters([
                AllowedFilter::custom('title', new FilterOr()),
            ])
            ->allowedIncludes(['image'])
            ->paginate($request->input('per_page'));

        return $data;
    }

    protected function updatePartial(Homeproject $homeproject, Request $request)
    {
        foreach ($request->only('status','position') as $key => $content) {
            if ($homeproject->isTranslatableAttribute($key)) {
                foreach ($content as $lang => $value) {
                    $homeproject->setTranslation($key, $lang, $value);
                }
            } else {
                $homeproject->{$key} = $content;
            }
        }

        $homeproject->save();
    }

    public function destroy(Homeproject $homeproject)
    {
        $homeproject->delete();
    }
}
