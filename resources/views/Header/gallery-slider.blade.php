<div class="slider-container relative h-[70vh] max-h-[700px] rounded-2xl overflow-hidden
            shadow-2xl mb-16">
    <div class="absolute inset-0 flex transition-transform duration-1000" id="slider">
       
                <img src="{{ $header->image ? asset('storage/' . $header->image) : asset('/img/default.png') }} }}" alt="{{ $header->category }}">
        
    </div>
    <div
        class="absolute bottom-6 left-1/2 transform -translate-x-1/2 bg-slate-900/70
                backdrop-blur-sm px-4 py-2 rounded-full flex items-center">
        <span id="current-slide" class="font-bold mr-2">1</span>
        <span class="text-slate-400">/</span>
        <span id="total-slides" class="ml-2">5</span>
    </div>
    <div class="absolute top-6 right-6 flex space-x-3">
        <button
            class="w-10 h-10 rounded-full bg-slate-900/70 backdrop-blur-sm flex items- center justify-center hover:bg-indigo-600 transition"
            id="prev-btn">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button
            class="w-10 h-10 rounded-full bg-slate-900/70 backdrop-blur-sm flex items- center justify-center hover:bg-indigo-600 transition"
            id="next-btn">
            <i class="fas fa-chevron-right"></i>
        </button>
    </div>
    <div
        class="absolute bottom-6 right-6 bg-slate-900/70 backdrop-blur-sm px-3 py-1
                rounded-full text-sm">
        <i class="fas fa-sync-alt mr-2 text-indigo-400"></i>
        <span>Scroll to navigate</span>
    </div>
</div>
