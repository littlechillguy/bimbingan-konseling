<x-app-layout>
    <div class="pt-24 pb-12 px-4 sm:px-6 lg:px-8 bg-gray-50 min-h-screen">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-2xl font-black text-gray-900 mb-8 flex items-center gap-3">
                <span class="p-3 bg-blue-600 rounded-2xl text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                </span>
                Hasil Eksplorasi Minat & Karir Siswa
            </h2>

            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 border-b border-gray-100">
                            <th class="px-6 py-5 text-sm font-bold text-gray-600">Siswa</th>
                            <th class="px-6 py-5 text-sm font-bold text-gray-600">Minat & Hobi</th>
                            <th class="px-6 py-5 text-sm font-bold text-gray-600">Gaya Kerja</th>
                            <th class="px-6 py-5 text-sm font-bold text-gray-600">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($dataKarir as $item)
                        <tr class="hover:bg-blue-50/30 transition-colors">
                            <td class="px-6 py-5">
                                <div class="font-bold text-gray-900">{{ $item->user->name }}</div>
                                <div class="text-xs text-gray-500 italic">{{ $item->user->email }}</div>
                            </td>
                            <td class="px-6 py-5 text-sm text-gray-700">
                                <span class="block font-semibold text-blue-600">{{ $item->pelajaran_favorit }}</span>
                                {{ $item->hobi }}
                            </td>
                            <td class="px-6 py-5">
                                <span class="px-3 py-1 bg-indigo-50 text-indigo-600 rounded-full text-xs font-bold uppercase tracking-wider">
                                    {{ $item->work_style }}
                                </span>
                            </td>
                            <td class="px-6 py-5 text-sm text-gray-500">
                                {{ $item->created_at->diffForHumans() }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-gray-400 font-medium">
                                Belum ada data eksplorasi yang masuk.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>