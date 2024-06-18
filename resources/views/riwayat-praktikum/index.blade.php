<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Pembayaran') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-4 overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full divide-y w-full divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                No
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama Mahasiswa
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama Praktikum
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Jumlah Bayar
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Bukti Pembayaran
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($riwayat as $index => $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $item->user->nama }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $item->pembayaranPraktikum->jadwalpraktikum->praktikum->nama }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ 'Rp. ' . number_format($item->pembayaranPraktikum->harga, 0, ',', '.') . ' ,-' }}
                            </td> 
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if ($item->status == "Pending")
                                    <span class="btn btn-xs btn-warning">{{ $item->status }}</span>
                                @elseif($item->status == 'Sukses')
                                    <span class="btn btn-xs btn-success">{{ $item->status }}</span>
                                @else
                                    <span class="btn btn-xs btn-error">{{ $item->status }}</span>
                                @endif
                            </td>                      
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <button class="btn btn-outline" onclick="document.getElementById('modal_{{ $item->id }}').showModal()">Lihat Gambar</button>
                                <dialog id="modal_{{ $item->id }}" class="modal">
                                    <div class="modal-box w-full max-w-5xl">
                                        <img src="{{ asset('storage/photos/' . $item->photo) }}" alt="Bukti Pembayaran" class="w-full h-auto object-contain">
                                        <div class="modal-action text-center mt-4">
                                            <button class="btn" onclick="document.getElementById('modal_{{ $item->id }}').close()">Close</button>
                                        </div>
                                    </div>
                                </dialog>
                            </td>
                                               
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 flex gap-3">
                                <form action="{{ route('riwayatpembayaran.updatesukses', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="Sukses">
                                    <button type="button" class="setujuiButton text-green-600 hover:text-green-500">Setujui</button>
                                </form>
                                <form action="{{ route('riwayatpembayaran.updatetolak', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="Ditolak">
                                    <button type="button" class="tolakButton text-red-600 hover:text-red-500">Tolak</button>
                                </form>
                            </td>
                                              
                        </tr>
                        @empty
                        <td colspan="10" class="px-6 py-4 text-center whitespace-nowrap text-sm text-gray-500">
                            DATA JADWAL BELUM ADA
                        </td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- {{ $jadwalpraktikum->links() }} --}}

</x-app-layout>