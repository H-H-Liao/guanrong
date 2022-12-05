<?php

namespace TypiCMS\Modules\Newsitems\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Core\Filters\FilterOr;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Newsitems\Models\Newsitem;

class ApiController extends BaseApiController
{
    public function index(Request $request): LengthAwarePaginator
    {
        $data = QueryBuilder::for(Newsitem::class)
            ->selectFields($request->input('fields.newsitems'))
            ->allowedSorts(['status_translated', 'title_translated','show_date'])
            ->allowedFilters([
                AllowedFilter::custom('title', new FilterOr()),
            ])
            ->allowedIncludes(['image'])
            ->paginate($request->input('per_page'));

        return $data;
    }

    protected function updatePartial(Newsitem $newsitem, Request $request)
    {
        foreach ($request->only('status') as $key => $content) {
            if ($newsitem->isTranslatableAttribute($key)) {
                foreach ($content as $lang => $value) {
                    $newsitem->setTranslation($key, $lang, $value);
                }
            } else {
                $newsitem->{$key} = $content;
            }
        }

        $newsitem->save();
    }

    public function destroy(Newsitem $newsitem)
    {
        $newsitem->delete();
    }
}
