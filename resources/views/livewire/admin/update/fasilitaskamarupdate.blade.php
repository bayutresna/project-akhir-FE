<script>
    Alpine.data("skadi", () => ({
        fasilitas: {nama:'', deskripsi:'', foto:''},
        files: '',
        fasilitases: [],
        fasilitas: [],
        token: '',

        gettoken(){
        let token = localStorage.getItem('token')
        this.token = token
        },

        async show(id){
            const data = new FormData()
            const respon = fetch(`http://127.0.0.1:8000/api/fasilitas/${id}/show`,{
                method:'GET',
                headers:{'Authorization' : `Bearer${this.token}`}
            })
            .then(async (response) => {
            this.fasilitases = await response.json()
            this.fasilitas = this.fasilitases.data
            });
        },

    async update(id){
            let file = this.files[0]
            // untuk yang update tanpa foto
            if(file != null){
                let fd = new FormData()
                fd.append('logo',file)
                fd.append('nama',this.fasilitas.nama)
                const respon = await fetch(`http://127.0.0.1:8000/api/fasilitas/edit/${id}`,{
                method: 'POST',
                headers:{
                    'Authorization' : `Bearer ${this.token}`
                },
                body: fd
                })

                window.location.replace('http://127.0.0.1:8001/admin/fasilitaskamar')
            }
            // update dengan foto
            let fd = new FormData()
            // fd.append('foto',file)
            fd.append('nama',this.fasilitas.nama)
            const respon = await fetch(`http://127.0.0.1:8000/api/fasilitas/edit/${id}`,{
            method: 'POST',
            headers:{
                'Authorization' : `Bearer ${this.token}`
            },
            body: fd
            })

            window.location.replace('http://127.0.0.1:8001/admin/fasilitas')
        },
    }))
</script>
<div x-data="skadi" x-init="show({{$fasilitas_id}}), gettoken()">
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
        value=""
      />
    </div>
  </div>
  {{-- end input nama --}}

{{-- input logo --}}
<div class="flex justify-center">
    <div class="mb-3 w-96">
      <label for="formFile" class="form-label inline-block mb-2 text-gray-700">Default file input example</label>
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
{{-- input logo --}}
  <div class="flex justify-center">

<button class="justify-right inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
type="button" x-on:click="update({{$fasilitas_id}})">Update</button>
</div>
{{-- end Form Update --}}
</div>
</div>
</div>
