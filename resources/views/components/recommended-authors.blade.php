<!-- Who to Follow -->
<div class="space-y-6">
    <h3 class="font-ui-label text-ui-label uppercase tracking-widest text-secondary font-bold">{{ $title }}</h3>
    <div class="space-y-4">
        @foreach ($authors as $author)
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <img alt="User" class="w-10 h-10 rounded-full object-cover" src="{{ $author['avatar'] }}" />
                    <div>
                        <p class="font-ui-label text-ui-label font-bold text-on-surface">{{ $author['name'] }}</p>
                        <p class="font-metadata text-metadata text-secondary">{{ $author['username'] }}</p>
                    </div>
                </div>
                <button
                    class="px-3 py-1 border border-on-surface text-on-surface rounded-full font-metadata text-metadata font-bold hover:bg-on-surface hover:text-white transition-all">Follow</button>
            </div>
        @endforeach
    </div>
    <a class="block font-ui-label text-ui-label text-primary font-bold hover:underline" href="#">View all
        recommendations</a>
</div>
