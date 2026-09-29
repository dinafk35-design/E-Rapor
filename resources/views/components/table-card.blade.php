<div class="overflow-hidden rounded-xl bg-white shadow-sm">
    <!-- HEADER TABEL -->
    <div class="flex flex-col gap-4 border-b border-gray-200 px-4 py-4 sm:px-6 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-lg font-bold text-gray-800">
                {{ $title }}
            </h2>
            @if ($subtitle)
                <p class="mt-1 text-sm text-gray-500">
                    {{ $subtitle }}
                </p>
            @endif
        </div>
        @if ($createRoute)
            <div>
                <a href="{{ $createRoute }}"
                    class="inline-flex items-center gap-2 rounded-lg bg-green-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-green-700">
                    <i class="ph ph-plus font-bold"></i>
                    Tambah Data
                </a>
            </div>
        @endif
    </div>

    <!-- RESPONSIVE TABLE -->
    <div class="overflow-x-auto">
        <table class="w-full min-w-[600px] text-left text-sm sm:min-w-[800px]">
            <thead class="bg-gray-50 text-xs uppercase text-gray-600">
                <tr>
                    {{ $thead }}
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                {{ $slot }}
            </tbody>
        </table>
    </div>

    <!-- FOOTER -->
    <div class="flex flex-col gap-3 border-t border-gray-200 px-4 py-4 sm:px-6 sm:flex-row sm:items-center sm:justify-between">
        <p class="text-sm text-gray-500">
            Menampilkan
            <span class="font-semibold text-gray-700">
                {{ $items ? $items->count() : 0 }}
            </span>
            data
        </p>
        <div class="flex gap-2">
            <button type="button"
                class="rounded-lg border border-gray-300 px-3 py-2 text-xs text-gray-600 hover:bg-gray-100 transition sm:px-4 sm:text-sm">
                Sebelumnya
            </button>
            <button type="button" class="rounded-lg bg-blue-600 px-3 py-2 text-xs font-semibold text-white sm:px-4 sm:text-sm">
                1
            </button>
            <button type="button"
                class="rounded-lg border border-gray-300 px-3 py-2 text-xs text-gray-600 hover:bg-gray-100 transition sm:px-4 sm:text-sm">
                Berikutnya
            </button>
        </div>
    </div>
</div>
