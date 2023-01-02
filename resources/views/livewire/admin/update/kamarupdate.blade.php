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
        token: '',

        gettoken(){
            let token = localStorage.getItem('token')
            this.token = token
        },

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
            if(file != null){
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
                headers:{
                    'Authorization' : `Bearer ${this.token}`
                },
                body: fd
                })
                window.location.replace('http://127.0.0.1:8001/admin/kamar')

            }
            fd.append('id_tipe_kamar',this.kamar.id_tipe_kamar)
            fd.append('nama',this.kamar.nama)
            fd.append('harga',this.kamar.harga)
            fd.append('jumlah_kamar',this.kamar.jumlah_kamar)
            fd.append('kapasitas',this.kamar.kapasitas)
            fd.append('deskripsi',this.kamar.deskripsi)
            fd.append('fasilitas',this.listfasilitas)
            const respon = await fetch(`http://127.0.0.1:8000/api/kamar/edit/${id}`,{
            method: 'POST',
            headers:{
                'Authorization' : `Bearer ${this.token}`
            },
            body: fd
            })
            window.location.replace('http://127.0.0.1:8001/admin/kamar')

        }

    }))

</script>

<div x-data="skadi" x-init="show({{$kamar_id}}), gettoken(), gettipekamar(), getfasilitas() ">
    <div class="min-h-screen flex flex-col flex-auto flex-shrink-0 antialiased bg-white dark:bg-gray-700 text-black dark:text-white">

        <!-- Header -->
        <div class="fixed w-full flex items-center justify-between h-14 text-white z-10">
          <div class="flex items-center justify-start md:justify-center pl-3 w-14 md:w-64 h-14 bg-blue-800 dark:bg-gray-800 border-none">
            <img class="w-7 h-7 md:w-10 md:h-10 mr-2 rounded-md overflow-hidden" src="https://therminic2018.eu/wp-content/uploads/2018/07/dummy-avatar.jpg" />
            <span class="hidden md:block">ADMIN</span>
          </div>
          <div class="flex justify-between items-center h-14 bg-blue-800 dark:bg-gray-800 header-right">
            <div class="bg-transparent rounded flex items-center w-full max-w-xl mr-4 p-2 shadow-sm ">

            </div>
            <ul class="flex items-center">

              <li>
                <div class="block w-px h-6 mx-3 bg-gray-400 dark:bg-gray-700"></div>
              </li>
              <li>
                <button x-on:click="logout()" class="flex items-center mr-4 hover:text-blue-100">
                  <span class="inline-flex mr-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                  </span>
                  Logout
                </button>
              </li>
            </ul>
          </div>
        </div>
        <!-- ./Header -->

        <!-- Sidebar -->
        <div class="fixed flex flex-col top-14 left-0 w-14 hover:w-64 md:w-64 bg-blue-900 dark:bg-gray-900 h-full text-white transition-all duration-300 border-none z-10 sidebar">
          <div class="overflow-y-auto overflow-x-hidden flex flex-col justify-between flex-grow">
            <ul class="flex flex-col py-4 space-y-1">
              <li class="px-5 hidden md:block">
                <div class="flex flex-row items-center h-8">
                  <div class="text-sm font-light tracking-wide text-gray-400 uppercase">Main</div>
                </div>
              </li>
              <li>
                <a  href="{{route('admin')}}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-blue-800 dark:hover:bg-gray-600 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-blue-500 dark:hover:border-gray-800 pr-6">
                  <span class="ml-2 text-sm tracking-wide truncate">Dashboard</span>
                </a>
              </li>
              <li>
                <a href="{{route('admin.kamar')}}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-blue-800 dark:hover:bg-gray-600 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-blue-500 dark:hover:border-gray-800 pr-6">
                  <span class="ml-2 text-sm tracking-wide truncate">Kamar</span>
                </a>
              </li>
              <li>
                <a href="{{route('admin.fasilitashotel')}}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-blue-800 dark:hover:bg-gray-600 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-blue-500 dark:hover:border-gray-800 pr-6">
                  <span class="ml-2 text-sm tracking-wide truncate">Fasilitas Hotel</span>
                </a>
              </li>
              <li>
                <a href="{{route('admin.fasilitaskamar')}}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-blue-800 dark:hover:bg-gray-600 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-blue-500 dark:hover:border-gray-800 pr-6">
                  <span class="ml-2 text-sm tracking-wide truncate">Fasilitas Kamar</span>
                </a>
              </li>
              <li>
                <a href="{{route('admin.galeri')}}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-blue-800 dark:hover:bg-gray-600 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-blue-500 dark:hover:border-gray-800 pr-6">
                  <span class="ml-2 text-sm tracking-wide truncate">Galeri</span>
                </a>
              </li>
              <li class="px-5 hidden md:block">
                <div class="flex flex-row items-center mt-5 h-8">
                </div>
              </li>

            </ul>
          </div>
        </div>
        <!-- ./Sidebar -->
        <div class="h-full ml-14 mt-14 mb-10 md:ml-64">
            {{-- Form Update --}}

            {{-- start input nama kamar --}}
            <div class="flex justify-center">
                <div class="mb-3 xl:w-96">
                    <label for="exampleText0" class="form-label inline-block mb-2 ">Nama Kamar</label>
                    <input
                    type="text"
                    class="
                    form-control
                    block
                    w-full
                    px-3
                    py-1.5
                    text-base
                    font-normal
                    text-gray-700
                    bg-white bg-clip-padding
                    border border-solid border-gray-300
                    rounded
                    transition
                    ease-in-out
                    m-0
                    focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    id="nama"
                    x-model="kamar.nama"
                    placeholder="Nama Kamar"
                    value=""
                    />
                </div>
            </div>
            {{-- end input nama kamar --}}

   
            {{-- start input Harga Kamar --}}

            <div class="flex justify-center">
                <div class="mb-3 xl:w-96">
                    <label for="" class="form-label inline-block mb-2 ">Harga Kamar</label>
                    <input
                    type="text"
                    class="
                    form-control
                    block
                    w-full
                    px-3
                    py-1.5
                    text-base
                    font-normal
                    text-gray-700
                    bg-white bg-clip-padding
                    border border-solid border-gray-300
                    rounded
                    transition
                    ease-in-out
                    m-0
                    focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    id="harga"
                    x-model="kamar.harga"
                    placeholder="Harga Kamar"
                    />
                </div>
            </div>
            {{-- end input Harga Kamar --}}

            {{-- start input Jumlah Kamar --}}
            <div class="flex justify-center">
                <div class="mb-3 xl:w-96">
                    <label for="" class="form-label inline-block mb-2 ">Jumlah Kamar</label>
                    <input
                    type="number"
                    class="
                    form-control
                    block
                    w-full
                    px-3
                    py-1.5
                    text-base
                    font-normal
                    text-gray-700
                    bg-white bg-clip-padding
                    border border-solid border-gray-300
                    rounded
                    transition
                    ease-in-out
                    m-0
                    focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    id="jumlah_kamar"
                    x-model="kamar.jumlah_kamar"
                    placeholder="Jumlah Kamar"
                    />
                </div>
            </div>
            {{-- end input Jumlah Kamar --}}

            {{-- start input Kapasitas Kamar --}}
            <div class="flex justify-center">
                <div class="mb-3 xl:w-96">
                    <label for="" class="form-label inline-block mb-2 ">Kapasitas Kamar</label>
                    <input
                    type="number"
                    class="
                    form-control
                    block
                    w-full
                    px-3
                    py-1.5
                    text-base
                    font-normal
                    text-gray-700
                    bg-white bg-clip-padding
                    border border-solid border-gray-300
                    rounded
                    transition
                    ease-in-out
                    m-0
                    focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    id="kapasitas"
                    x-model="kamar.kapasitas"
                    placeholder="Kapasitas Kamar"
                    />
                </div>
            </div>
            {{-- end input Kapasitas Kamar --}}

            {{-- start input Deskripsi Kamar --}}
            <div class="flex justify-center">
                <div class="mb-3 xl:w-96">
                    <label for="" class="form-label inline-block mb-2 ">Deskripsi Kamar</label>
                    <input
                    type="text"
                    class="
                    form-control
                    block
                    w-full
                    px-3
                    py-1.5
                    text-base
                    font-normal
                    text-gray-700
                    bg-white bg-clip-padding
                    border border-solid border-gray-300
                    rounded
                    transition
                    ease-in-out
                    m-0
                    focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    id="deskripsi"
                    x-model="kamar.deskripsi"
                    placeholder="Deskripsi Kamar"
                    />
                </div>
            </div>
            {{-- end input Deskripsi Kamar --}}

            {{-- start input Tipe Kamar --}}
            <div class="flex justify-center">
                <div class="mb-3 xl:w-96">
                  <select class="form-select appearance-none
                    block
                    w-full
                    px-3
                    py-1.5
                    text-base
                    font-normal
                    text-gray-700
                    bg-white bg-clip-padding bg-no-repeat
                    border border-solid border-gray-300
                    rounded
                    transition
                    ease-in-out
                    m-0
                    focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example"
                    x-model="kamar.id_tipe_kamar">
                    <option selected>Pilih Salah Satu</option>
                    <template x-for="t in tipe">
                        <option  x-text="t.nama" :value="t.id"></option>
                    </template>
                  </select>
                </div>
              </div>
            {{-- end input Tipe Kamar --}}

            {{-- start input Tipe Kamar --}}
            <div class="flex justify-center">
                <div class="mb-3 xl:w-96">
                    <label for="" class="form-label inline-block mb-2 ">Fasilitas Kamar</label>
                    <template x-for="f in fasilitas">
                        <div>
                            <label x-text="f.nama" ></label>
                            <input x-model="listfasilitas" type="checkbox" class="border-sky-400 " :value="f.id" />
                        </div>
                    </template>
                </div>
            </div>
            {{-- end input Tipe Kamar --}}

            <div class="flex justify-center">
                <div class="mb-3 w-96">
                    <label for="formFile" class="form-label inline-block mb-2 ">Foto kamar</label>
                    <input x-on:change="files = Object.values($event.target.files)" class="upload"
                    class="form-control
                    block
                    w-full
                    px-3
                    py-1.5
                    text-base
                    font-normal
                    text-gray-700
                    bg-white bg-clip-padding
                    border border-solid border-gray-300
                    rounded
                    transition
                    ease-in-out
                    m-0
                    focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" type="file" id="formFile">
                </div>
            </div>
            <div class="flex justify-center">
                <button class="justify-right inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out" 
                type="button" x-on:click="update({{$kamar_id}})">Update</button>
            </div>
            {{-- end Form Update --}}
        </div>
</div>
</div>
</div>
