@props(['streak' => 0])

@if ($streak >= 4)
    <span class="inline-flex items-center justify-center text-yellow-400 text-lg ml-2 drop-shadow-[0_0_8px_rgba(250,204,21,0.8)]" title="Mahkota (Juara Bertahan)">
        👑
    </span>
@elseif ($streak == 3)
    <span class="inline-flex items-center text-yellow-400 text-sm ml-2" title="Bintang 3">
        ⭐⭐⭐
    </span>
@elseif ($streak == 2)
    <span class="inline-flex items-center text-yellow-400 text-sm ml-2" title="Bintang 2">
        ⭐⭐
    </span>
@elseif ($streak == 1)
    <span class="inline-flex items-center text-yellow-400 text-sm ml-2" title="Bintang 1">
        ⭐
    </span>
@endif
