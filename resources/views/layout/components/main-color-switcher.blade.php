<!-- BEGIN: Ultra-Wow Color Switcher -->
<div class="fixed bottom-4 right-4 sm:bottom-6 sm:right-6 z-50 rounded-full bg-white/70 border border-slate-200 shadow-[0_6px_20px_rgba(0,0,0,0.15)] backdrop-blur-lg p-2 sm:p-3 flex items-center space-x-2 sm:space-x-2.5 transition-all hover:scale-105 duration-300 ease-in-out ring-1 ring-white/30">
    <!-- Label -->
    <div class="hidden sm:flex items-center space-x-1.5 pr-2.5 border-r border-slate-300 animate-fade-in-down">
        <svg class="w-4 h-4 text-slate-500 drop-shadow" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M12 4v16m8-8H4" />
        </svg>
        <span class="text-xs font-semibold text-slate-700 tracking-wide">Switch Color</span>
    </div>

    <!-- Color Themes -->
    @php
        $themes = [
            ['name' => 'default', 'bg' => 'bg-emerald-900', 'ring' => 'ring-emerald-400'],
            ['name' => 'theme-3', 'bg' => 'bg-cyan-900', 'ring' => 'ring-cyan-400'],
        ];
    @endphp

    @foreach($themes as $theme)
        <a href="{{ route('color-scheme-switcher', ['color_scheme' => $theme['name']]) }}"
           class="w-7 h-7 sm:w-8 sm:h-8 rounded-full {{ $theme['bg'] }} border-2 transition-all duration-300 ease-in-out transform hover:scale-125 hover:ring-4 {{ $color_scheme == $theme['name'] ? $theme['ring'].' ring-offset-2' : 'border-white' }} hover:shadow-[0_0_10px_rgba(0,0,0,0.2)]">
            <span class="sr-only">{{ ucfirst($theme['name']) }}</span>
        </a>
    @endforeach
</div>
<!-- END: Ultra-Wow Color Switcher -->

