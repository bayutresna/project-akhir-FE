
<script>
    Alpine.data("skadi", () => ({
    show: false,
    order: [],
    orders: [],
    toggle: '0',
    respon: '',
    getorder(){
        const respon = fetch('http://127.0.0.1:8000/api/reservasikamar')
        .then(async (response) => {
        this.order = await response.json()
        this.orders = this.order.data
        });
    },

    }))
</script>
<div
x-data ="skadi"
x-init = "getorder()">
<table class="border-collapse w-full">
    <thead>
        <tr>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell"> Check-In</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell"> Penyewa</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell"> Kamar </th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Jumlah Kamar</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Tagihan</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Status Pembayaran</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Bukti Pembayaran</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Status Transaksi</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <template x-for="order in orders">
        <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase"> Check-In</span>
                <span x-text="order.tanggal_cekin"></span>
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase"> Penyewa</span>
                <span x-text="order.user.nama_lengkap"></span>
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800  border border-b text-center block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase"> Kamar</span>
                <span x-text="order.kamar.nama"></span>
            </td>
              <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Jumlah Kamar</span>
                <span x-text="order.jumlah_kamar"></span>
              </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Tagihan</span>
                <span x-text="order.biaya"></span>
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Status Pembayaran</span>
                <template x-if="order.status_pembayaran == false">
                    <span> Belum Lunas</span>
                </template>
                <template x-if="order.status_pembayaran == true">
                    <span> Lunas</span>
                </template>
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Bukti Pembayaran</span>
                <img :src="order.bukti_pembayaran" alt="">
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Status Transaksi</span>
                <span x-text="order.status_transaksi"></span>
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Aksi</span>
                {{-- isi tabel --}}
                <a  class="text-blue-400 hover:text-blue-600 underline">Edit</a>
                <button  class="text-blue-400 hover:text-blue-600 underline pl-6">Remove</button>
            </td>

        </tr>
    </tbody>
</table>
</div>
