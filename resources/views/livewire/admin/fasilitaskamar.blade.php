<script>
    Alpine.data("skadi", () => ({

        fasilitas: {nama:'', foto:''},
        files: '',
        token: '',
        show: false,

        user:'',
        users:'',

        ceklogin()
        {
            let token = localStorage.getItem('token')
            this.token = token
            if(this.token == null){
                window.location.replace('http://127.0.0.1:8001/login')
            }
        
            fetch('http://127.0.0.1:8000/api/me',{
                method: 'GET',
                headers: {
                'Authorization': `Bearer ${this.token}`
                }
            })
            .then(async (response) => {
                this.users = await response.json()
                this.user = this.users.data
            
                if(this.user.id_role != 1){
                    window.location.replace('http://127.0.0.1:8001/')
                }
            
                if(this.user.id_role == 1){
                    this.show = true
                }
            })
        
        },

        async add(){
            let file = this.files[0]
            let fd = new FormData()
            fd.append('logo',file)
            fd.append('nama',this.fasilitas.nama)
            const respon = await fetch('http://127.0.0.1:8000/api/fasilitas',{
            method: 'POST',
            headers :{'Authorization' : `Bearer ${this.token}`},
            body: fd
            })
            window.location.replace('http://127.0.0.1:8001/admin/fasilitaskamar')
        },
        async logout(){
            await localStorage.clear()
            window.location.replace('http://127.0.0.1:8001/')
        }
            }))

</script>


<div x-data="skadi" x-show='show' x-init='ceklogin()'>
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
        {{-- modal trigger --}}
        <div class="h-full ml-14 mt-14 mb-10 md:ml-64">
            @livewire('admin.data.fasilitaskamar')
            <button type="button"
            class="justify-right inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
            data-bs-toggle="modal" data-bs-target="#add">
            Tambah Fasilitas Hotel
            </button>
        </div>
    </div>


    {{-- modal --}}
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
        id="add" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog relative w-auto pointer-events-none">
      <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
        <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
          <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalLabel">
            Tambah Fasilitas Kamar
          </h5>
          <button type="button"
            class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
            data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body relative p-4">
            {{-- start input nama --}}
            <div class="flex justify-center">
                <div class="mb-3 xl:w-96">
                  <label for="exampleText0" class="form-label inline-block mb-2 text-gray-700"
                    >Nama</label>
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
                    x-model="fasilitas.nama"
                    placeholder="Nama Fasilitas"
                  />
                </div>
              </div>
              {{-- end input nama --}}

            <input x-on:change="files = Object.values($event.target.files)" type="file" class="upload">
        </div>
        {{-- end modal body --}}
        <div class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
          <button type="button"
            class="inline-block px-6 py-2.5 bg-purple-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-purple-700 hover:shadow-lg focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-purple-800 active:shadow-lg transition duration-150 ease-in-out"
            data-bs-dismiss="modal">Close</button>
          <button type="button" x-on:click="add()"
            class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out ml-1">Tambah Fasilitas Hotel</button>
        </div>
        {{-- end modal footer --}}
      </div>
    </div>
</div>
{{-- end modal --}}

</div>
