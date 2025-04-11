<!-- BEGIN: Mobile Menu -->
<div class="mobile-menu md:hidden">
    <div class="mobile-menu-bar flex items-center justify-between p-4 bg-emerald-900">
        <!-- Replaced left button with static text "IMS" -->
        <span class="text-white font-bold">IMS Portal</span>
        <!-- Right Top Button (Toggler) with label "Apply" -->
        <a href="javascript:;" id="mobile-menu-toggler" role="button" aria-controls="mobile-menu-panel" aria-expanded="false" class="flex items-center">
            <span class="mr-2 text-white font-semibold">Apply</span>
            <i data-feather="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i>
        </a>
    </div>
    <ul class="border-t border-white/[0.08] py-5 hidden">
        @foreach ($side_menu as $menuKey => $menu)
            @if ($menu == 'devider')
                <li class="menu__devider my-6"></li>
            @else
                <li>
                    <a 
                        href="{{ isset($menu['route_name']) ? route($menu['route_name'], $menu['params'] ?? []) : '#' }}" 
                        class="{{ $first_level_active_index == $menuKey ? 'menu menu--active' : 'menu' }}"
                        @if (!isset($menu['route_name'])) onclick="event.preventDefault();" role="button" @endif
                    >
                        <div class="menu__icon">
                            <i data-feather="{{ $menu['icon'] }}"></i>
                        </div>
                        <div class="menu__title">
                            {{ $menu['title'] }}
                            @if (isset($menu['sub_menu']))
                                <i data-feather="chevron-down" class="menu__sub-icon {{ $first_level_active_index == $menuKey ? 'transform rotate-180' : '' }}"></i>
                            @endif
                        </div>
                    </a>
                    @if (isset($menu['sub_menu']))
                        <ul class="{{ $first_level_active_index == $menuKey ? 'menu__sub-open' : '' }}">
                            @foreach ($menu['sub_menu'] as $subMenuKey => $subMenu)
                                <li>
                                    <a 
                                        href="{{ isset($subMenu['route_name']) ? route($subMenu['route_name'], $subMenu['params'] ?? []) : '#' }}" 
                                        class="{{ $second_level_active_index == $subMenuKey ? 'menu menu--active' : 'menu' }}"
                                        @if (!isset($subMenu['route_name'])) onclick="event.preventDefault();" role="button" @endif
                                    >
                                        <div class="menu__icon">
                                            <i data-feather="activity"></i>
                                        </div>
                                        <div class="menu__title">
                                            {{ $subMenu['title'] }}
                                            @if (isset($subMenu['sub_menu']))
                                                <i data-feather="chevron-down" class="menu__sub-icon {{ $second_level_active_index == $subMenuKey ? 'transform rotate-180' : '' }}"></i>
                                            @endif
                                        </div>
                                    </a>
                                    @if (isset($subMenu['sub_menu']))
                                        <ul class="{{ $second_level_active_index == $subMenuKey ? 'menu__sub-open' : '' }}">
                                            @foreach ($subMenu['sub_menu'] as $lastSubMenuKey => $lastSubMenu)
                                                <li>
                                                    <a 
                                                        href="{{ isset($lastSubMenu['route_name']) ? route($lastSubMenu['route_name'], $lastSubMenu['params'] ?? []) : '#' }}" 
                                                        class="{{ $third_level_active_index == $lastSubMenuKey ? 'menu menu--active' : 'menu' }}"
                                                        @if (!isset($lastSubMenu['route_name'])) onclick="event.preventDefault();" role="button" @endif
                                                    >
                                                        <div class="menu__icon">
                                                            <i data-feather="zap"></i>
                                                        </div>
                                                        <div class="menu__title">{{ $lastSubMenu['title'] }}</div>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endif
        @endforeach
    </ul>
</div>
<!-- END: Mobile Menu -->








