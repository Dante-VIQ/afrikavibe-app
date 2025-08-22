<div class="w-full min-h-screen bg-gray-200 dark:bg-gray-800 animate-pulse fixed inset-0 z-50">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6 py-10 px-6">
        <div class="space-y-4">
            <div class="h-12 bg-gray-300 dark:bg-gray-700 rounded w-3/4"></div>
            <div class="h-5 bg-gray-300 dark:bg-gray-700 rounded w-5/6"></div>
            <div class="h-5 bg-gray-300 dark:bg-gray-700 rounded w-2/3"></div>
        </div>

        <div class="grid grid-cols-2 gap-3">
            @for($i = 0; $i < 6; $i++)
                <div class="h-48 bg-gray-300 dark:bg-gray-700 rounded-xl"></div>
            @endfor
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 space-y-6 mt-6">
        @for($i = 0; $i < 4; $i++)
            <div class="h-40 bg-gray-300 dark:bg-gray-700 rounded-xl"></div>
        @endfor
    </div>
</div>
