<x-layouts.app.sidebar :title="$title ?? null">
    <flux:main>
        @include('partials.toast')
        
        {{ $slot }}
    </flux:main>
</x-layouts.app.sidebar>
