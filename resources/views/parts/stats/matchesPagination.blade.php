@if ($matches->lastPage() > 1)
    <div class="flex justify-end items-center my-5">
        @if($matches->currentPage() > 1)
            <a href="{{ $matches->url(($matches->currentPage() - 1)) }}" class="inline-flex items-center py-2 px-4 mr-3 text-sm font-medium bg-white rounded-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                <svg aria-hidden="true" class="mr-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd"></path></svg>
                Previous
            </a>
        @endif
        @if($matches->currentPage() != $matches->lastPage())
            <a href="{{ $matches->url($matches->currentPage() + 1) }}" class="inline-flex items-center py-2 px-4 text-sm font-medium  bg-white rounded-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                Next
                <svg aria-hidden="true" class="ml-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </a>
        @endif
    </div>
@endif
