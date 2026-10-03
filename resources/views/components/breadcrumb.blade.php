@props(['items' => []])


<div class="mb-2 flex items-center gap-1.5 text-[10px]">

    @foreach ($items as $index => $item)
        @if ($index > 0)
            <i class="ph ph-caret-right text-[10px] text-[#8584b5]"></i>
        @endif

        @if (!empty($item['url']))
            <a href="{{ $item['url'] }}" class="text-[#aaa9d5] transition hover:text-white">
                {{ $item['label'] }}
            </a>
        @else
            <span class="{{ $loop->last ? 'font-semibold text-white' : 'text-[#d6d5ec]' }}">
                {{ $item['label'] }}
            </span>
        @endif
    @endforeach

</div>
