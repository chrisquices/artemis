@if ($paginator->hasPages())
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
    <nav class="w-full sm:w-auto ml-auto">
        <ul class="pagination">
            @if ($paginator->onFirstPage())
                <li class="page-item">
                    <a class="page-link" href="#" rel="prev" disabled>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevron-left"
                             class="lucide lucide-chevron-left w-4 h-4" data-lucide="chevron-left">
                            <polyline points="15 18 9 12 15 6"></polyline>
                        </svg>
                    </a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="#" rel="prev" wire:click="previousPage" wire:loading.attr="disabled">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevron-left"
                             class="lucide lucide-chevron-left w-4 h-4" data-lucide="chevron-left">
                            <polyline points="15 18 9 12 15 6"></polyline>
                        </svg>
                    </a>
                </li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item"> <a class="page-link" href="#">{{ $element }}</a> </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active">
                                <a class="page-link" href="#" wire:key="paginator-page-{{ $page }}">{{ $page }}</a>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="#" wire:key="paginator-page-{{ $page }}" wire:click="gotoPage({{ $page }})">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="#" rel="next"  wire:click="nextPage" wire:loading.attr="disabled">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevron-right"
                             class="lucide lucide-chevron-right w-4 h-4" data-lucide="chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="#" disabled>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevron-right"
                             class="lucide lucide-chevron-right w-4 h-4" data-lucide="chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
    </div>
@endif
