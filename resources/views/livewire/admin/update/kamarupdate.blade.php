<script>

    Alpine.data("skadi", () => ({

        tipe: [],
        tipekamar:[],

        fasilitas:[],
        fasilitases:[],

        rooms:[],
        room:[],


        kamar: {id_tipe_kamar:'',
                nama:'',
                harga: '',
                jumlah_kamar: '',
                kapasitas: '',
                deskripsi: '',
                },
        listfasilitas: [],
        files:'',
        
        async show(id){
            const respon = fetch(`http://127.0.0.1:8000/api/kamar/${id}/show`)
            .then(async (response) => {
            this.rooms = await response.json()
            this.kamar = this.rooms.data
            });
        },

        async getfasilitas(){
            const respon = fetch('http://127.0.0.1:8000/api/fasilitas')
            .then(async (response) => {
            this.fasilitases = await response.json()
            this.fasilitas = this.fasilitases.data
            });
        },

        async gettipekamar(){
            const respon = fetch('http://127.0.0.1:8000/api/tipekamar')
            .then(async (response) => {
            this.tipekamar = await response.json()
            this.tipe = this.tipekamar.data
            });
        },

        async update(id){
            let file = this.files[0]
            let fd = new FormData()
            fd.append('id_tipe_kamar',this.kamar.id_tipe_kamar)
            fd.append('nama',this.kamar.nama)
            fd.append('harga',this.kamar.harga)
            fd.append('jumlah_kamar',this.kamar.jumlah_kamar)
            fd.append('kapasitas',this.kamar.kapasitas)
            fd.append('deskripsi',this.kamar.deskripsi)
            fd.append('fasilitas',this.listfasilitas)
            fd.append('foto',file)
            const respon = await fetch(`http://127.0.0.1:8000/api/kamar/edit/${id}`,{
            method: 'POST',
            body: fd
            })
            window.location.replace('http://127.0.0.1:8001/admin/kamar')

        }

            }))

</script>

<div x-data='skadi' x-init=" gettipekamar(), getfasilitas(), show({{$kamar_id}}) " class="modal-body relative p-4">
    <form x-on:submit.prevent="update({{$kamar_id}})">
    <div>
        <h1>Nama Kamar</h1>
        <input x-model="kamar.nama" type="text" class="focus:outline-none border-b w-full pb-2 border-sky-400 placeholder-gray-500 mb-8"  placeholder="Nama Kamar"/>
   </div>
    <div>
        <h1>Harga Kamar</h1>
        <input x-model="kamar.harga" type="number" class="focus:outline-none border-b w-full pb-2 border-sky-400 placeholder-gray-500 mb-8"  placeholder="Harga "/>
   </div>
    <div>
        <h1>Jumlah Kamar</h1>
        <input x-model="kamar.jumlah_kamar" type="number" class="focus:outline-none border-b w-full pb-2 border-sky-400 placeholder-gray-500 mb-8"  placeholder="Jumlah Kamar "/>
   </div>
    <div>
        <h1>Kapasitas Kamar</h1>
        <input x-model="kamar.kapasitas" type="number" class="focus:outline-none border-b w-full pb-2 border-sky-400 placeholder-gray-500 mb-8"  placeholder="Kapasitas "/>
   </div>
   <div>
        <h1>Deskripsi Kamar</h1>
        <textarea x-model="kamar.deskripsi" type="number" class="focus:outline-none border-b w-full pb-2 border-sky-400 placeholder-gray-500 mb-8"  placeholder="Deskripsi "></textarea>
    </div>
   <div class="">
    <label for=""> Tipe Kamar </label>
      <select x-model="kamar.id_tipe_kamar" name="" id="">
        <template x-for="t in tipe">
        <option x-text="t.nama" :value="t.id"></option>
        </template>
      </select>
   </div>
   <br>
   <div class="flex flex-col">
    Fasilitas
    <template x-for="f in fasilitas">
        <div>    
            <label x-text="f.nama" ></label>
            <input x-model="listfasilitas" type="checkbox" class="border-sky-400 " :value="f.id" />
        </div>
    </template>
   </div>

    <input x-on:change="files = Object.values($event.target.files)" type="file" class="upload">
</div>
<div
  class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">

  <button type="submit" 
    class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out ml-1">Update Kamar</button>
</div>
</form>
</div>
