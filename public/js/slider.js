document.addEventListener('DOMContentLoaded', function() {
    // Media data - would come from backend in real app
    const mediaData = [{
            id: 1,
            type: 'image',
            source: 'internal',
            title: 'Mountain Landscape',
            description: 'Breathtaking view of the Alps at sunrise',
            url: 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4',
            thumb: 'https://images.unsplash.com/photo-1506905925346- 21bda4d32df4?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=200&w=300'
        }, {
            id: 2,
            type: 'video',
            source: 'youtube',
            title: 'Ocean Waves',
            description: 'Relaxing ocean waves in 4K resolution',
            url: 'https://www.youtube.com/embed/4gX1vIhR8UI',
            thumb: 'https://i.ytimg.com/vi/4gX1vIhR8UI/hqdefault.jpg'
        },
        {
            id: 3,
            type: 'image',
            source: 'instagram',
            title: 'Desert Adventure',
            description: 'Exploring the Sahara desert on camelback',
            url: 'https://images.unsplash.com/photo-1469854523086-cc02fe5d8800',
            thumb: 'https://images.unsplash.com/photo-1469854523086- cc02fe5d8800?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=200&w=300'
        }, {
            id: 4,
            type: 'video',
            source: 'internal',
            title: 'Forest Walk',
            description: 'Guided tour through the ancient redwood forest',
            url: 'https://www.youtube.com/embed/8xg3vE8Ie_E',
            thumb: 'https://i.ytimg.com/vi/8xg3vE8Ie_E/hqdefault.jpg'
        }, {
            id: 5,
            type: 'image',
            source: 'internal',
            title: 'Northern Lights',
            description: 'Aurora borealis over the Arctic landscape',
            url: 'https://images.unsplash.com/photo-1501555088652-021faa106b9b',
            thumb: 'https://images.unsplash.com/photo-1501555088652- 021faa106b9b?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=200&w=300'
        }
    ];
    const slider = document.getElementById('slider');
    const galleryGrid = document.querySelector('.gallery-grid');
    const currentSlide = document.getElementById('current-slide');
    const totalSlides = document.getElementById('total-slides');
    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');
    const addImageBtn = document.getElementById('addImage');
    const addVideoBtn = document.getElementById('addVideo');
    const togglePanelBtn = document.getElementById('togglePanel');
    const panelContent = document.getElementById('panelContent');
    let currentIndex = 0;
    let isScrolling = false;
    let scrollTimeout;
    // Initialize the gallery
    function initGallery() {
        // Clear existing content
        slider.innerHTML = '';
        galleryGrid.innerHTML = '';
        // Create slider items
        mediaData.forEach((item, index) => {
            const slide = document.createElement('div');
            slide.className = `slide min-w-full h-full relative ${index === 0 ? 'opacity-100' :
'opacity-0'}`;
            const mediaContainer = document.createElement('div');
            mediaContainer.className = 'media-container absolute inset-0 bg-cover bg-center';
            if (item.type === 'image') {
                mediaContainer.style.backgroundImage =
                    `url('${item.url}?auto=format&fit=crop&w=1200')`;
            } else {
                mediaContainer.innerHTML = ` <iframe
src="${item.url}" class="w-full h-full" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope;
picture-in-picture" allowfullscreen>
</iframe>
`;
            }
            const content = document.createElement('div');
            content.className = `slide-content absolute bottom-0 left-0 right-0 bg-gradient-to-t
from-slate-900 to-transparent p-8 ${
index === 0 ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10' }`;
            content.innerHTML = ` <div class="max-w-4xl mx-auto">
<div class="inline-flex items-center px-3 py-1 rounded-full mb-4 ${
item.source === 'internal' ? 'bg-indigo-600' :
item.source === 'youtube' ? 'bg-red-600' :
item.source === 'instagram' ? 'bg-pink-600' : 'bg-blue-600' }">
<span class="text-xs font-bold uppercase">${item.source}</span>
</div>
<h2 class="text-3xl font-bold mb-3">${item.title}</h2>
<p class="text-slate-300">${item.description}</p>
</div>
`;
            slide.appendChild(mediaContainer);
            slide.appendChild(content);
            slider.appendChild(slide);
            // Create grid items
            const gridItem = document.createElement('div');
            gridItem.className = 'cursor-pointer overflow-hidden rounded-lg group';
            gridItem.dataset.index = index;
            gridItem.addEventListener('click', () => goToSlide(index));
            const gridMedia = document.createElement('div');
            gridMedia.className = 'aspect-square bg-cover bg-center group-hover:scale-110
            transition - transform duration - 500 ';
            gridMedia.style.backgroundImage = `url('${item.thumb}')`;
            gridItem.appendChild(gridMedia);
            galleryGrid.appendChild(gridItem);
        });
        totalSlides.textContent = mediaData.length;
        updateSlideCounter();
    }
    // Navigation functions
    function goToSlide(index) {
        if (index < 0) index = mediaData.length - 1;
        if (index >= mediaData.length) index = 0;
        const slides = document.querySelectorAll('.slide');
        const contents = document.querySelectorAll('.slide-content');
        slides.forEach(slide => slide.classList.add('opacity-0'));
        contents.forEach(content => {
            content.classList.remove('opacity-100');
            content.classList.add('opacity-0', 'translate-y-10');
        });
        setTimeout(() => {
            slides[index].classList.remove('opacity-0');
            contents[index].classList.remove('opacity-0', 'translate-y-10');
            contents[index].classList.add('opacity-100', 'translate-y-0');
            currentIndex = index;
            updateSlideCounter();
        }, 50);
    }

    function updateSlideCounter() {
        currentSlide.textContent = currentIndex + 1;
        // Update active state in grid
        const gridItems = document.querySelectorAll('.gallery-grid > div');
        gridItems.forEach((item, index) => {
            if (index === currentIndex) {
                item.classList.add('ring-4', 'ring-indigo-500');
            } else {
                item.classList.remove('ring-4', 'ring-indigo-500');
            }
        });
    }
    // Scroll-based navigation
    window.addEventListener('wheel', function(e) {
        if (isScrolling) return;
        clearTimeout(scrollTimeout);
        isScrolling = true;
        if (e.deltaY > 0) {
            goToSlide(currentIndex + 1);
        } else {
            goToSlide(currentIndex - 1);
        }
        scrollTimeout = setTimeout(function() {
            isScrolling = false;
        }, 800);
    });
    // Button navigation
    prevBtn.addEventListener('click', () => goToSlide(currentIndex - 1));
    nextBtn.addEventListener('click', () => goToSlide(currentIndex + 1));
    // Admin panel functionality
    let panelExpanded = true;
    togglePanelBtn.addEventListener('click', () => {
        panelExpanded = !panelExpanded;
        panelContent.classList.toggle('hidden');
        togglePanelBtn.querySelector('i').classList.toggle('fa-chevron-up');
        togglePanelBtn.querySelector('i').classList.toggle('fa-chevron-down');
    });
    // Simulate adding new media
    addImageBtn.addEventListener('click', () => {
        alert('Admin functionality: Add new image form would open here');
    });
    addVideoBtn.addEventListener('click', () => {
        alert('Admin functionality: Add new video form would open here');
    });
    // Initialize the gallery
    initGallery();
});


