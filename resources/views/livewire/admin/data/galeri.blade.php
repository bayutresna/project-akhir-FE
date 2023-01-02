<script>
    Alpine.data("skadi", () => ({
    show: false,
    galeri: [],
    galeries: [],
    toggle: '0',
    respon: '',
    files:'',

    deletegaleri(id){
        const respon = fetch(`http://127.0.0.1:8000/api/galeri/delete/${id}`,{
            method: 'POST',
            headers:{
                'Authorization' : `Bearer ${this.token}`
            }
        })
        .then(async (response) => {
            window.location.replace('http://127.0.0.1:8001/admin/galeri')
        });
    },

    getgaleri(){
        const respon = fetch('http://127.0.0.1:8000/api/galeri')
        .then(async (response) => {
        this.galeri = await response.json()
        this.galeries = this.galeri.data
        });
    }
    }))
</script>
<div
x-data ="skadi"
x-init = "getgaleri(), gettoken()">
<table class="border-collapse w-full">
    <thead>
        <tr>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Foto</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <template x-for="picture in galeries">
        <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Foto</span>
                <img :src="picture.foto" alt="">
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Aksi</span>
                <a :href="`galeri/update/${picture.id}`" class="text-blue-400 hover:text-blue-600 underline">Edit</a>
                <button x-on:click="deletegaleri(picture.id)" class="text-blue-400 hover:text-blue-600 underline pl-6">Remove</button>
            </td>
        </tr>
        </template>
    </tbody>
</table>
</div>



