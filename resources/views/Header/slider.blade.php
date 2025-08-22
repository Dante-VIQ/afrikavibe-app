<div
    class="admin-panel fixed top-4 right-4 z-50 bg-slate-800/80 backdrop-blur-md rounded-xl
            p-4 shadow-xl border border-slate-700/50 max-w-md w-full">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-xl font-bold text-indigo-300"><i class="fas fa-cog mr-2"></i>Admin
            Controls</h3>
        <button id="togglePanel" class="text-indigo-400 hover:text-indigo-200">
            <i class="fas fa-chevron-up"></i>
        </button>
    </div>
    <div id="panelContent">
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Add New Media</label>
            <div class="flex space-x-2">
                <button id="addImage"
                    class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white py- 2 px-4 rounded-lg transition">
                    <i class="fas fa-image mr-2"></i>Add Image
                </button>
                <button id="addVideo"
                    class="flex-1 bg-purple-600 hover:bg-purple-700 text-white py- 2 px-4 rounded-lg transition">
                    <i class="fas fa-video mr-2"></i>Add Video
                </button>
            </div>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Connect Models</label>
            <div class="flex space-x-2">
                <select class="flex-1 bg-slate-700 border border-slate-600 rounded-lg px-3 py-2 text- sm">
                    <option>Instagram Feed</option>
                    <option>Twitter Media</option>
                    <option>Flickr Photos</option>
                    <option>YouTube Channel</option>
                </select>
                <button class="bg-emerald-600 hover:bg-emerald-700 text-white py-2 px-4 roundedlg transition">
                    <i class="fas fa-link mr-2"></i>Connect
                </button>
            </div>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Connected Models</label>
            <div class="bg-slate-800/50 rounded-lg p-3">
                <div class="flex items-center justify-between mb-2">
                    <div class="flex items-center">
                        <i class="fab fa-instagram text-pink-500 text-xl mr-2"></i>
                        <span>Instagram Feed</span>
                    </div>
                    <button class="text-rose-500 hover:text-rose-300">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="fab fa-youtube text-red-500 text-xl mr-2"></i>
                        <span>YouTube Channel</span>
                    </div>
                    <button class="text-rose-500 hover:text-rose-300">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Content -->
<div class="container mx-auto px-4 py-12 max-w-6xl">
    <header class="text-center mb-16">
        <h1
            class="text-4xl md:text-6xl font-bold mb-6 bg-clip-text text-transparent bg-gradient-to
                    -r from-indigo-400 to-purple-500">
            <i class="fas fa-scroll mr-3"></i>Dynamic Media Gallery
        </h1>
        <p class="text-slate-300 max-w-2xl mx-auto text-lg">
            Scroll to navigate through our media collection. Admins can add images and videos
            directly, or connect external sources like Instagram and YouTube. </p>
    </header>
    <!-- Gallery Controls -->
    <div class="flex flex-wrap justify-between items-center mb-10 p-5 bg-slate-800/50 rounded- xl">
        <div class="flex space-x-3 mb-4 md:mb-0">
            <button class="px-4 py-2 bg-indigo-600 rounded-lg hover:bg-indigo-700 transition">
                <i class="fas fa-images mr-2"></i>All Media
            </button>
            <button class="px-4 py-2 bg-slate-700 rounded-lg hover:bg-slate-600 transition">
                <i class="fas fa-image mr-2"></i>Images
            </button>
            <button class="px-4 py-2 bg-slate-700 rounded-lg hover:bg-slate-600 transition">
                <i class="fas fa-video mr-2"></i>Videos
            </button>
        </div>
        <div class="flex items-center">
            <span class="text-slate-400 mr-3">Sources:</span>
            <div class="flex space-x-2">
                <div
                    class="w-8 h-8 rounded-full bg-gradient-to-br from-fuchsia-500 to-pink-600 flex
                            items-center justify-center">
                    <i class="fab fa-instagram text-xs"></i>
                </div>
                <div
                    class="w-8 h-8 rounded-full bg-gradient-to-br from-red-500 to-amber-500 flex
                            items-center justify-center">
                    <i class="fab fa-youtube text-xs"></i>
                </div>
                <div
                    class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-cyan-400 flex
                        items-center justify-center">
                    <i class="fab fa-twitter text-xs"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- Gallery Slider -->
  
    <!-- Gallery Grid -->
    <div class="mb-20">
        <h2 class="text-2xl font-bold mb-6 flex items-center">
            <i class="fas fa-layer-group mr-3 text-indigo-400"></i>
            Media Collection
        </h2>
        <div class="gallery-grid">
            <!-- Media items will be inserted here by JavaScript -->
        </div>
    </div>
    <!-- External Models -->
    <div class="mb-20">
        <h2 class="text-2xl font-bold mb-6 flex items-center">
            <i class="fas fa-plug mr-3 text-purple-400"></i>
            Connected Models
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-slate-800/50 rounded-xl p-5 border border-slate-700/50">
                <div class="flex items-center mb-4">
                    <div
                        class="w-12 h-12 rounded-full bg-gradient-to-br from-fuchsia-500 to-pink-600
                                flex items-center justify-center mr-3">
                        <i class="fab fa-instagram text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold">Instagram Feed</h3>
                </div>
                <p class="text-slate-400 mb-4">Connected to @travel_world account. Latest 12
                    posts displayed.</p>
                <div class="flex justify-between">
                    <span class="text-emerald-400">Active</span>
                    <span>24 images</span>
                </div>
            </div>
            <div class="bg-slate-800/50 rounded-xl p-5 border border-slate-700/50">
                <div class="flex items-center mb-4">
                    <div
                        class="w-12 h-12 rounded-full bg-gradient-to-br from-red-500 to-amber-500
                        flex items-center justify-center mr-3">
                        <i class="fab fa-youtube text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold">YouTube Channel</h3>
                </div>
                <p class="text-slate-400 mb-4">Connected to Adventure Videos channel. Latest 8
                    videos displayed.</p>
                <div class="flex justify-between">
                    <span class="text-emerald-400">Active</span>
                    <span>8 videos</span>
                </div>
            </div>
            <div class="bg-slate-800/50 rounded-xl p-5 border border-slate-700/50">
                <div class="flex items-center mb-4">
                    <div
                        class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-cyan-400
                                    flex items-center justify-center mr-3">
                        <i class="fab fa-twitter text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold">Twitter Media</h3>
                </div>
                <p class="text-slate-400 mb-4">Not connected. Connect to display media from
                    Twitter account.</p>
                <div class="flex justify-between">
                    <span class="text-amber-400">Inactive</span>
                    <button class="text-indigo-400 hover:text-indigo-300">
                        <i class="fas fa-plus mr-1"></i>Connect
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="text-center py-10 border-t border-slate-800 text-slate-500">
        <div class="flex justify-center space-x-6 mb-4">
            <a href="#" class="hover:text-indigo-400 transition"><i class="fab fainstagram"></i></a>
            <a href="#" class="hover:text-indigo-400 transition"><i class="fab fa-youtube"></i></a>
            <a href="#" class="hover:text-indigo-400 transition"><i class="fab fa-twitter"></i></a>
            <a href="#" class="hover:text-indigo-400 transition"><i class="fab fa- facebook"></i></a>
        </div>
    </footer>
</div>
