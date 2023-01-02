<script>
    Alpine.data("skadi", () => ({
    show: false,

    room: [],
    rooms: [],

    isload: true,
    token:'',

    user:[],
    users :[],

    files:'',

    order:[],
    orders:[],

    toggle: '0',
    respon: '',

    gettoken(){
        let token = localStorage.getItem('token')
        this.token = token
    },

    getme(){
        fetch('http://127.0.0.1:8000/api/me',{
            method: 'GET',
            headers: {
            'Authorization': `Bearer ${this.token}`
            }
        })
        .then(async (response) => {
            this.users = await response.json()
            this.user = this.users.data

            fetch(`http://127.0.0.1:8000/api/reservasikamar/${this.user.id}/showbyuser`,{
            method:'GET',
            headers: {
            'Authorization': `Bearer ${this.token}`
            }
            })
            .then(async (response) => {
                this.orders = await response.json()
                this.order = this.orders.data
                this.show = true

            });
        })
    },

    async update(id){
            let file = this.files[0]
            // untuk yang update tanpa foto
            if(file != null){
                let fd = new FormData()
                fd.append('bukti_pembayaran',file)
                const respon = await fetch(`http://127.0.0.1:8000/api/reservasikamar/edit/${id}`,{
                method: 'POST',
                headers:{
                    'Authorization' : `Bearer ${this.token}`
                },
                body: fd
                })

                window.location.replace('http://127.0.0.1:8001/historybook')
            }
        
        },

    }))
</script>
<div x-data="skadi" x-init=" gettoken(),getme()">
    @livewire('nav.navbar')
    {{-- <button
    class="justify-center flex px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
    x-on:click='getorder(user.id)'>Show History</button> --}}
    <table x-show='show' class="border-collapse w-full">
        <thead>
            <tr>
                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell"> Tanggal Check-In</th>
                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell"> Kamar </th>
                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Jumlah Kamar</th>
                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Tagihan</th>
                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Status Pembayaran</th>
                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Bukti Pembayaran</th>
                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <template x-for="order in order">
            <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                    <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Tanggal Check-In</span>
                    <span x-text="order.tanggal_cekin"></span>
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
                    <span x-text="order.status_pembayaran"></span>
                </td>
                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                    <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Bukti Pembayaran</span>
                    <img :src="order.bukti_pembayaran" alt="">
                </td>
                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                    <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Aksi</span>
                    {{-- isi tabel --}}
                    <template x-if="order.bukti_pembayaran == null, order.metode_pembayaran == 'Transfer'">
                        <div>
                            <input x-on:change="files = Object.values($event.target.files)" type="file" name="" id="">
                            <button
                            class="justify-right inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                            x-on:click="update(order.id)">Upload</button>
                        </div>
                    </template>
                </td>

            </tr>
            </template>
        </tbody>
    </table>

</div>
