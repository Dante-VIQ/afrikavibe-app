<section class="bg-white py-2 px-4 sm:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mx-auto mb-3 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">

            <h2 class=" hidden text-lg sm:text-2xl font-bold text-green-600 mb-4">
                Agri-Ecotourism Trails
            </h2>
            {{-- <p class="text-gray-600 mb-12 max-w-full">
                Explore Africa’s rich landscapes through farms, forests, and food. These eco-conscious destinations
                offer hands-on experiences in sustainable agriculture, conservation, and local culture.
            </p> --}}
        </div>
        <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-3">
            <!-- Destination Card -->
            <div class="bg-green-50 rounded-2xl shadow-sm overflow-hidden hover:shadow-md transition">
                <img src="{{ asset('/img/women plucking coffee.webp') }}" alt="Nyeri Coffee Farm"
                    class="w-full h-48 object-cover" />
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-green-700 mb-2">Nyeri, Kenya</h3>
                    <p class="text-sm text-gray-700 mb-3">
                        Tour lush coffee farms, learn climate-smart methods, and plant a tree with local cooperatives.
                    </p>
                    <span class="text-sm text-green-600 font-medium">Women-led farms • Coffee tasting • Tree
                        planting</span>
                </div>
            </div>

            <!-- Destination Card -->
            <div class="bg-green-50 rounded-2xl shadow-sm overflow-hidden hover:shadow-md transition">
                <img src="{{ asset('/img/Lake Kivu.jpg') }}" alt="Lake Kivu" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-green-700 mb-2">Lake Kivu, Rwanda</h3>
                    <p class="text-sm text-gray-700 mb-3">
                        Explore organic hillsides, taste banana beer, and discover community composting.
                    </p>
                    <span class="text-sm text-green-600 font-medium">Agro-tour • Food culture • Forest views</span>
                </div>
            </div>

            <!-- Destination Card -->
            <div class="bg-green-50 rounded-2xl shadow-sm overflow-hidden hover:shadow-md transition">
                <img src="{{ asset('/img/Shea Butter.jpg') }}" alt="Northern Ghana Shea" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-green-700 mb-2">Northern Ghana</h3>
                    <p class="text-sm text-gray-700 mb-3">
                        Visit a shea butter co-op and learn how sustainable practices power rural entrepreneurship.
                    </p>
                    <span class="text-sm text-green-600 font-medium">Shea workshops • Women-led • Eco solutions</span>
                </div>
            </div>

            <!-- Add more cards as needed -->
        </div>

        <div class="mt-12 text-center">
            <a href="/destination"
                class="inline-block bg-green-700 text-white px-6 py-3 rounded-full text-sm font-medium hover:bg-green-800 transition">
                Discover More Eco Adventures
            </a>
        </div>
    </div>
</section>
