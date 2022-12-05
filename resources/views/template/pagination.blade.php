@if ($paginator->lastPage() > 1)
		<!-- Pagination -->
        <div class="row">
            <div class="col-md-12 text-center animate-box" data-animate-effect="fadeInUp">
                <ul class="savoye-pagination-wrap align-center mb-30 mt-60">
                    @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                    <li><a href="{{ $paginator->url($i) }}" class=" {{ ($paginator->currentPage() == $i) ? 'active' : '' }}">{{ $i }}</a></li>
                    @endfor
                </ul>
            </div>
        </div>
@endif
