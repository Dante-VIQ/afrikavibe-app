<div class="w-full bg-white rounded-2xl shadow-sm overflow-hidden">
    {{-- Post form --}}
            @livewire('create-header-media-post')
     

    {{-- Alpine.js Media Slider --}}
    @if ($this->headerMedia->isNotEmpty())
        <div class="relative rounded-3xl shadow-lg" x-data="mediaSlider()" x-init="initSlider()">
            <div class="relative overflow-hidden rounded-3xl">
                {{-- Media Slides --}}
                <div class="flex transition-transform duration-300 ease-in-out" x-ref="slider"
                    :style="'transform: translateX(-' + (currentIndex * 100) + '%)'">
                    @foreach ($this->headerMedia as $media)
                        <div class="w-full flex-shrink-0" wire:key="media-{{ $media->id }}">
                            @if ($media->media_type === 'image')
                                @if ($media->media_path)
                                    <img class="img-fluid h-36 max-h-5xl" src="{{ asset($media->media_path) }}" alt="{{ $media->title }}" />
                                @endif
                            @elseif($media->media_type === 'video')
                                <video controls class="w-full h-96 object-cover rounded-3xl">
                                    <source src="{{ asset($media->media_path) }}">
                                    Your browser does not support the video tag.
                                </video>
                            @endif

                            {{-- Overlay Info --}}
                            <div
                                class="absolute bottom-0 bg-gradient-to-t rounded-3xl from-black/70 to-transparent p-4 w-full text-white">
                                <h3 class="font-semibold text-lg">{{ $media->title }}</h3>
                                <p class="text-sm">{{ $media->body }}</p>

                                {{-- Comment Button --}}
                                <button class="mt-2 px-4 py-1 bg-orange-500 rounded-full text-white hover:bg-orange-600"
                                    wire:click="$dispatch('openCommentModal', {
                                  commentableId: {{ $media->id }},
                                    commentableType: 'App\Models\HeaderMedia' })">
                                    💬 Comment
                                    @if ($media->comments_count > 0)
                                        <span class="ml-2 text-xs bg-white/20 px-2 py-0.5 rounded-full">
                                            {{ $media->comments_count }}
                                        </span>
                                    @endif
                                </button>

                                {{-- <livewire:comment-modal /> --}}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Navigation Arrows --}}
            <template x-if="totalSlides > 1">
                <div>
                    {{-- Previous Button --}}
                    <button @click="previous()"
                        class="absolute left-4 top-1/2 transform -translate-y-1/2 z-30 bg-black/50 text-white p-3 rounded-full hover:bg-black/70 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                    </button>

                    {{-- Next Button --}}
                    <button @click="next()"
                        class="absolute right-4 top-1/2 transform -translate-y-1/2 z-30 bg-black/50 text-white p-3 rounded-full hover:bg-black/70 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </button>
                </div>
            </template>

            {{-- Pagination Dots --}}
            <template x-if="totalSlides > 1">
                <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 z-30 flex space-x-2">
                    <template x-for="(_, index) in Array(totalSlides).fill()" :key="index">
                        <button @click="goTo(index)" class="w-3 h-3 rounded-full transition-colors duration-300"
                            :class="currentIndex === index ? 'bg-orange-500' : 'bg-white/50'">
                        </button>
                    </template>
                </div>
            </template>
        </div>
    @else
        <p class="text-gray-500 text-center w-full py-8">No media posts available</p>
    @endif
</div>

<script>
    function mediaSlider() {
        return {
            currentIndex: 0,
            totalSlides: {{ $this->headerMedia->count() }},
            isDragging: false,
            startX: 0,
            currentX: 0,
            dragThreshold: 50,

            initSlider() {
                this.setupTouchEvents();
                this.setupKeyboardEvents();
                // this.startAutoPlay();
            },

            setupTouchEvents() {
                const slider = this.$refs.slider;

                // Touch events for mobile
                slider.addEventListener('touchstart', (e) => {
                    this.startDrag(e.touches[0].clientX);
                }, {
                    passive: true
                });

                slider.addEventListener('touchmove', (e) => {
                    this.drag(e.touches[0].clientX);
                }, {
                    passive: true
                });

                slider.addEventListener('touchend', () => {
                    this.endDrag();
                }, {
                    passive: true
                });

                // Mouse events for desktop
                slider.addEventListener('mousedown', (e) => {
                    this.startDrag(e.clientX);
                    document.addEventListener('mousemove', this.handleMouseMove.bind(this));
                    document.addEventListener('mouseup', this.handleMouseUp.bind(this));
                });
            },

            handleMouseMove(e) {
                this.drag(e.clientX);
            },

            handleMouseUp() {
                this.endDrag();
                document.removeEventListener('mousemove', this.handleMouseMove.bind(this));
                document.removeEventListener('mouseup', this.handleMouseUp.bind(this));
            },

            startDrag(clientX) {
                this.isDragging = true;
                this.startX = clientX;
                this.currentX = clientX;
            },

            drag(clientX) {
                if (!this.isDragging) return;
                this.currentX = clientX;
            },

            endDrag() {
                if (!this.isDragging) return;

                const diffX = this.currentX - this.startX;

                if (Math.abs(diffX) > this.dragThreshold) {
                    if (diffX > 0) {
                        this.previous();
                    } else {
                        this.next();
                    }
                }

                this.isDragging = false;
            },

            setupKeyboardEvents() {
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'ArrowLeft') {
                        this.previous();
                    } else if (e.key === 'ArrowRight') {
                        this.next();
                    }
                });
            },

            startAutoPlay() {
                // Optional: Auto-play functionality
                setInterval(() => {
                    if (this.totalSlides > 1) {
                        this.next();
                    }
                }, 10000); // Change slide every 5 seconds
            },

            next() {
                this.currentIndex = (this.currentIndex + 1) % this.totalSlides;
            },

            previous() {
                this.currentIndex = (this.currentIndex - 1 + this.totalSlides) % this.totalSlides;
            },

            goTo(index) {
                this.currentIndex = index;
            }
        }
    }

    // Initialize when Alpine is ready
    document.addEventListener('alpine:init', () => {
        Alpine.data('mediaSlider', mediaSlider);
    });
</script>
