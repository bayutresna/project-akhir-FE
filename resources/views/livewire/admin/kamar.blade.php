<script>

    Alpine.data("skadi", () => ({

        tipe: [],
        tipekamar:[],

        fasilitas:[],
        fasilitases:[],


        kamar: {id_tipe_kamar:'',
                nama:'',
                harga: '',
                jumlah_kamar: '',
                kapasitas: '',
                deskripsi: '',
                fasilitas: []
                },
        files:'',
        

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

        async add(){
            let file = this.files[0]
            let fd = new FormData()
            fd.append('id_tipe_kamar',this.kamar.id_tipe_kamar)
            fd.append('nama',this.kamar.nama)
            fd.append('harga',this.kamar.harga)
            fd.append('jumlah_kamar',this.kamar.jumlah_kamar)
            fd.append('kapasitas',this.kamar.kapasitas)
            fd.append('deskripsi',this.kamar.deskripsi)
            fd.append('fasilitas',this.kamar.fasilitas)
            fd.append('foto',file)
            const respon = await fetch('http://127.0.0.1:8000/api/kamar',{
            method: 'POST',
            body: fd
            })
            window.location.replace('http://127.0.0.1:8001/admin/kamar')

        },
        async logout(){
            await localStorage.clear()
            window.location.replace('http://127.0.0.1:8001/')
        }
            }))

</script>

  <div x-data="skadi" x-init="gettipekamar(), getfasilitas()" class="">
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
            @livewire('admin.data.kamar')
            <button type="button"
            class="justify-right inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
            data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Tambah Kamar
            </button>
        </div>
      </div>

    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
    id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog relative w-auto pointer-events-none">
      <div
        class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
        <div
          class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
          <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalLabel">
            Tambah Kamar
          </h5>
          <button type="button"
            class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
            data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body relative p-4">
            <form x-on:submit.prevent="add()">
            <div>
                <input x-model="kamar.nama" type="text" class="focus:outline-none border-b w-full pb-2 border-sky-400 placeholder-gray-500"  placeholder="Nama Kamar"/>
           </div>
            <div>
                <input x-model="kamar.harga" type="number" class="focus:outline-none border-b w-full pb-2 border-sky-400 placeholder-gray-500 my-8"  placeholder="Harga "/>
           </div>
            <div>
           <input x-model="kamar.jumlah_kamar" type="number" class="focus:outline-none border-b w-full pb-2 border-sky-400 placeholder-gray-500 mb-8"  placeholder="Jumlah Kamar "/>
           </div>
            <div>
           <input x-model="kamar.kapasitas" type="number" class="focus:outline-none border-b w-full pb-2 border-sky-400 placeholder-gray-500 mb-8"  placeholder="Kapasitas "/>
           </div>
           <div>
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
               <input x-model="kamar.fasilitas" type="checkbox" class="border-sky-400 " :value="f.id" />
            </div>
            </template>
           </div>

            <input x-on:change="files = Object.values($event.target.files)" type="file" class="upload">
        </div>
        <div
          class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
          <button type="button"
            class="inline-block px-6 py-2.5 bg-purple-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-purple-700 hover:shadow-lg focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-purple-800 active:shadow-lg transition duration-150 ease-in-out"
            data-bs-dismiss="modal">Close</button>
          <button type="submit" 
            class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out ml-1">Tambah Kamar</button>
        </div>
    </form>
      </div>
    </div>
    </div>
</div>

