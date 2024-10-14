@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" style="margin: 0 auto; text-align: center; font-size: 1.3rem; color: #333;" class="flex items-center justify-between">
        {{-- <div class="navi flex justify-between flex-1 sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="relative inline-flex items-center px-4 py-2 leading-5 dark:text-#fff">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a style="text-decoration: none; color: #333" href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 leading-5 transition ease-in-out duration-150 dark:text-#fff dark:active:text-#aec4cf">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a style="text-decoration: none; color: #333" href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 ml-3 leading-5 transition ease-in-out duration-150 dark:text-#fff dark:active:text-#aec4cf">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span class="relative inline-flex items-center px-4 py-2 ml-3 leading-5 dark:text-#fff">
                    {!! __('pagination.next') !!}
                </span>
            @endif
        </div> --}}

        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            {{-- <div>
                <p class="leading-5 dark:text-#fff">
                    {!! __('Showing') !!}
                    @if ($paginator->firstItem())
                        <span class="">{{ $paginator->firstItem() }}</span>
                        {!! __('to') !!}
                        <span class="">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    {!! __('of') !!}
                    <span class="">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div> --}}

            <div style="font-size: 1.3rem; color: #333; text-align: center; padding: 1rem;">
                <div class="relative z-0 inline-flex rtl:flex-row-reverse">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                            <span
                            style="padding: 1rem 0; color: #999; margin-right: 1rem;" 
                            class="relative inline-flex items-center border border-spacing-10 border-#aec4cf" aria-hidden="true">
                                {{-- <svg style="width: 3rem; height: 3rem;" class="" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg> --}}
                                <i class="fas fa-chevron-left"></i><span style="font-weight: bold; margin-left: 1rem">Previous</span>
                            </span>
                        </span>
                    @else
                        <a style="font-weight: bold; text-decoration: none; padding: 1rem 0; color:#333;" 
                        onmouseover="this.style.color='#aec4cf';"
                        onmouseout="this.style.color='#333';" href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center focus:z-10 transition ease-in-out duration-150" aria-label="{{ __('pagination.previous') }}">
                            {{-- <svg style="width: 3rem; height: 3rem;" class="" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg> --}}
                            <span
                            style="padding: 1rem 0; margin-right: 1rem;" 
                            class="relative inline-flex items-center border border-spacing-10 border-#aec4cf" aria-hidden="true">
                                {{-- <svg style="width: 3rem; height: 3rem;" class="" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg> --}}
                                <i class="fas fa-chevron-left"></i><span style="margin-left: 1rem">Previous</span>
                            </span>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span style="font-size: 1.3rem; margin-right: 1rem; font-weight:bold; padding: 1rem; border: 0px solid rgba(0, 0, 0, .3); background: #eee; color: #333; border-radius: .5rem;" class="relative inline-flex">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page" style="font-size: 1.3rem; padding: 1rem .6rem 1rem 1rem; margin-right: 1rem; font-weight:bold; border: 0px solid rgba(0, 0, 0, .3); background: #eee; color: #999; border-radius: .5rem;">
                                        <span aria-label="{{ __('Go to page :page', ['page' => $page]) }}" class="relative inline-flex items-center">{{ $page }}</span>
                                    </span>
                                @else
                                    
                                <a style="cursor: pointer; margin-right: 1rem; text-decoration: none; color: #333; background: #eee; font-weight:bold; padding: 1rem .6rem 1rem 1rem; border: 0px solid rgba(0, 0, 0, .3); border-radius: .5rem;"
                                onmouseover="this.style.background='#aec4cf'; this.style.color='#fff';"
                                onmouseout="this.style.background='#eee'; this.style.color='#333';"
                                href="{{ $url }}" class="more relative inline-flex focus:z-10 transition ease-in-out duration-150 dark:text-#fff dark:hover:text-#aec4cf" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                {{ $page }}
                           </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                    
                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a style="text-decoration: none; padding: 1rem 0; color:#333" 
                            onmouseover="this.style.color='#aec4cf';"
                            onmouseout="this.style.color='#333';"
                        href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center focus:z-10 transition ease-in-out duration-150" aria-label="{{ __('pagination.next') }}">
                            <span style="margin-right: 1rem; font-weight: bold;">Next</span><i class="fas fa-chevron-right"></i>
                            {{-- <svg style="width: 3rem; height: 3rem;" class="" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg> --}}
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                            <span style="padding: 1rem 0; color: #999;" 
                            class="relative inline-flex items-center" aria-hidden="true">
                                <span style="margin-right: 1rem; font-weight: bold;">Next</span><i class="fas fa-chevron-right"></i>
                                {{-- <svg style="width: 3rem; height: 3rem" class="" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg> --}}
                            </span>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </nav>
@endif
