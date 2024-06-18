@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="mt-7 flex items-center justify-center">
        <div class="flex justify-between flex-1 sm:hidden">
            @if ($paginator->onFirstPage())
                <div class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-green-500 bg-white border border-green-300 cursor-default leading-5 rounded-md dark:text-green-600 dark:bg-green-800 dark:border-green-600">
                    {!! __('pagination.previous') !!}
                </div>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-green-700 bg-white border border-green-300 leading-5 rounded-md hover:text-green-500 focus:outline-none focus:ring ring-green-300 focus:border-blue-300 active:bg-green-100 active:text-green-700 transition ease-in-out duration-150 dark:bg-green-800 dark:border-green-600 dark:text-green-300 dark:focus:border-blue-700 dark:active:bg-green-700 dark:active:text-green-300">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-green-700 bg-white border border-green-300 leading-5 rounded-md hover:text-green-500 focus:outline-none focus:ring ring-green-300 focus:border-blue-300 active:bg-green-100 active:text-green-700 transition ease-in-out duration-150 dark:bg-green-800 dark:border-green-600 dark:text-green-300 dark:focus:border-blue-700 dark:active:bg-green-700 dark:active:text-green-300">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <div class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-green-500 bg-white border border-green-300 cursor-default leading-5 rounded-md dark:text-green-600 dark:bg-green-800 dark:border-green-600">
                    {!! __('pagination.next') !!}
                </div>
            @endif
        </div>

        {{-- <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm flex text-green-700 leading-5 dark:text-green-400">
                    {!! __('Showing') !!}
                    @if ($paginator->firstItem())
                        <div class="font-medium">{{ $paginator->firstItem() }}</div>
                        {!! __('to') !!}
                        <div class="font-medium">{{ $paginator->lastItem() }}</div>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    {!! __('of') !!}
                    <div class="font-medium">{{ $paginator->total() }}</div>
                    {!! __('results') !!}
                </p>
            </div> --}}

            <div>
                <div class="relative z-0 inline-flex rtl:flex-row-reverse shadow-sm rounded-md">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <div aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                            <div class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-green-500 bg-white border border-green-300 cursor-default rounded-l-md leading-5 dark:bg-green-800 dark:border-green-600" aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-green-500 bg-white border border-green-300 rounded-l-md leading-5 hover:text-green-400 focus:z-10 focus:outline-none focus:ring ring-green-300 focus:border-blue-300 active:bg-green-100 active:text-green-500 transition ease-in-out duration-150 dark:bg-green-800 dark:border-green-600 dark:active:bg-green-700 dark:focus:border-blue-800" aria-label="{{ __('pagination.previous') }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <div aria-disabled="true">
                                <div class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-green-700 bg-white border border-green-300 cursor-default leading-5 dark:bg-green-800 dark:border-green-600">{{ $element }}</div>
                            </div>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <div aria-current="page">
                                        <div class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-green-500 bg-white border border-green-300 cursor-default leading-5 dark:bg-green-800 dark:border-green-600">{{ $page }}</div>
                                    </div>
                                @else
                                    <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-green-700 bg-white border border-green-300 leading-5 hover:text-green-500 focus:z-10 focus:outline-none focus:ring ring-green-300 focus:border-blue-300 active:bg-green-100 active:text-green-700 transition ease-in-out duration-150 dark:bg-green-800 dark:border-green-600 dark:text-green-400 dark:hover:text-green-300 dark:active:bg-green-700 dark:focus:border-blue-800" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-green-500 bg-white border border-green-300 rounded-r-md leading-5 hover:text-green-400 focus:z-10 focus:outline-none focus:ring ring-green-300 focus:border-blue-300 active:bg-green-100 active:text-green-500 transition ease-in-out duration-150 dark:bg-green-800 dark:border-green-600 dark:active:bg-green-700 dark:focus:border-blue-800" aria-label="{{ __('pagination.next') }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @else
                        <div aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                            <div class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-green-500 bg-white border border-green-300 cursor-default rounded-r-md leading-5 dark:bg-green-800 dark:border-green-600" aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </nav>
@endif
