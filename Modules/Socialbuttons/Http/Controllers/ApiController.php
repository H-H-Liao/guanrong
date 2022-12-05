<?php

namespace TypiCMS\Modules\Socialbuttons\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Core\Filters\FilterOr;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Socialbuttons\Models\Socialbutton;

class ApiController extends BaseApiController
{
    public function index(Request $request): LengthAwarePaginator
    {
        $data = QueryBuilder::for(Socialbutton::class)
            ->selectFields($request->input('fields.socialbuttons'))
            ->allowedSorts(['status_translated', 'title_translated','position'])
            ->allowedFilters([
                AllowedFilter::custom('title', new FilterOr()),
            ])
            ->allowedIncludes(['image'])
            ->paginate($request->input('per_page'));

        return $data;
    }

    protected function updatePartial(Socialbutton $socialbutton, Request $request)
    {
        foreach ($request->only('status','position') as $key => $content) {
            if ($socialbutton->isTranslatableAttribute($key)) {
                foreach ($content as $lang => $value) {
                    $socialbutton->setTranslation($key, $lang, $value);
                }
            } else {
                $socialbutton->{$key} = $content;
            }
        }

        $socialbutton->save();
    }

    public function destroy(Socialbutton $socialbutton)
    {
        $socialbutton->delete();
    }
}
