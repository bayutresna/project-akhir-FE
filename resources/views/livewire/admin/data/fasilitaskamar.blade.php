<script>
    Alpine.data("skadi", () => ({
    show: false,
    facility: [],
    facilities: [],
    toggle: '0',
    respon: '',
    token: '',

    gettoken(){
    let token = localStorage.getItem('token')
    this.token = token
    },

    deletefacility(id){
        const respon = fetch(`http://127.0.0.1:8000/api/fasilitas/delete/${id}`,{
            method: 'POST',
            headers:{
                'Authorization' : `Bearer ${this.token}`
            }
        })
        .then(async (response) => {
            window.location.replace('http://127.0.0.1:8001/admin/fasilitaskamar')
        });
    },

    getfacility(){
        const respon = fetch('http://127.0.0.1:8000/api/fasilitas')
        .then(async (response) => {
        this.facility = await response.json()
        this.facilities = this.facility.data
        });
    }
    }))
</script>
<div
x-data ="skadi"
x-init = "getfacility(), gettoken()">
<table class="border-collapse w-full">
    <thead>
        <tr>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Nama</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Foto</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <template x-for="fasilitas in facilities">
        <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Nama</span>
                <span x-text="fasilitas.nama"></span>
            </td>

            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Foto</span>
                <img style="width: 50px; height:50px;" :src="fasilitas.logo" alt="">
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Aksi</span>
                {{-- isi tabel --}}
                <a :href="`fasilitaskamar/update/${fasilitas.id}`" class="text-blue-400 hover:text-blue-600 underline">Edit</a>
                <button x-on:click="deletefacility(fasilitas.id)" class="text-blue-400 hover:text-blue-600 underline pl-6">Remove</button>
            </td>
        </tr>
    </template>
    </tbody>
</table>
</div>
