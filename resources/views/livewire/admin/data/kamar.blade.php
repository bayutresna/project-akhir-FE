<script>
    Alpine.data("skadi", () => ({
    show: false,
    room: [],
    rooms: [],
    toggle: '0',
    respon: '',
    token: '',

    gettoken(){
        let token = localStorage.getItem('token')
        this.token = token
    },
    getroom(){
        const respon = fetch('http://127.0.0.1:8000/api/kamar')
        .then(async (response) => {
        this.room = await response.json()
        this.rooms = this.room.data
        });
    },
    deletekamar(id){
        const respon = fetch(`http://127.0.0.1:8000/api/kamar/delete/${id}`,{
            method: 'POST',
            headers:{
                'Authorization' : `Bearer ${this.token}`
            }
        })
        .then(async (response) => {
            window.location.replace('http://127.0.0.1:8001/admin/kamar')
        });
    },
    }))
</script>
<div
x-data ="skadi"
x-init = "getroom(), gettoken()">
<table class="border-collapse w-full">
    <thead>
        <tr>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Nama Kamar</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Tipe Kamar</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Harga </th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Kapasitas</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Jumlah Kamar</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Deskripsi</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Foto</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <template x-for="kamar in rooms">
        <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Nama Kamar</span>
                <span x-text="kamar.nama"></span>
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Tipe Kamar</span>
                <span x-text="kamar.tipe.nama"></span>
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800  border border-b text-center block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Harga</span>
                <span x-text="kamar.harga"></span>
            </td>
              <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Kapasitas</span>
                <span x-text="kamar.kapasitas"></span>
              </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Jumlah Kamar</span>
                <span x-text="kamar.jumlah_kamar"></span>
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Deskripsi</span>
                <span x-text="kamar.deskripsi"></span>
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Foto</span>
                <img :src="kamar.foto" alt="">
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Aksi</span>
                {{-- isi tabel --}}
                <a :href="`kamar/update/${kamar.id}`" class="text-blue-400 hover:text-blue-600 underline">Edit</a>
                <button x-on:click="deletekamar(kamar.id)" class="text-blue-400 hover:text-blue-600 underline pl-6">Remove</button>
            </td>

        </tr>
    </tbody>
</table>
</div>
