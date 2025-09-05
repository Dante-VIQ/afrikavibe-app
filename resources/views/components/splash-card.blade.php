<div {{ $attributes->merge(['class' => 'max-w-md mx-auto text-center space-y-4']) }}>
    
    <!-- Splash Masked Image -->
    <div class="splash-mask w-full h-64 rounded-2xl shadow-xl overflow-hidden mx-auto">
        <div class="splash-image"></div>
    </div>

    <!-- Title & Caption -->
    <div class="px-2">
        <h2 class="text-xl font-semibold text-gray-800">{{ $title }}</h2>
        <p class="text-gray-600 text-sm leading-relaxed">{{ $caption }}</p>
    </div>

    <!-- Optional CTA -->
    @if($buttonText && $buttonLink)
        <div class="mt-4">
            <a href="{{ $buttonLink }}" 
               class="inline-block bg-emerald-600 text-white px-4 py-2 rounded-lg shadow hover:bg-emerald-700 transition">
               {{ $buttonText }}
            </a>
        </div>
    @endif

    <style>
        .splash-mask .splash-image {
            width: 100%;
            height: 100%;
            background-image: url('{{ $photo }}');
            background-size: cover;
            background-position: center;

            -webkit-mask-image: url('{{ $mask }}');
            -webkit-mask-repeat: no-repeat;
            -webkit-mask-size: cover;
            -webkit-mask-position: center;

            mask-image: url('{{ $mask }}');
            mask-repeat: no-repeat;
            mask-size: cover;
            mask-position: center;
        }
    </style>
</div>
