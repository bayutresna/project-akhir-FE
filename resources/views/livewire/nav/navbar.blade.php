<script>
    Alpine.data("skadi", () => ({
        isOpen: false,
        islogin: false,

    //     async logout(){

    //     let token = localStorage.getItem('token');
    //     await fetch('http://127.0.0.1:8000/api/logout',[
    //         header:{'Authorization' : token},    
    //         method: 'POST',
            
    //     ]);

    // },

    async logout(){
        const token = localStorage.getItem('token')
        const respon = await fetch('http://127.0.0.1:8000/api/logout',{
        header:{'Authorization' : token},    
        method: 'POST'
        })
        localStorage.clear()
        window.location.replace('http://127.0.0.1:8001/')
    },

    ceklogin(){
    const token = localStorage.getItem('token')
    this.islogin = token ? true : false
    }

        }))

</script>
<header class="bg-white" x-init="ceklogin()" x-data="skadi">
    <nav class="container mx-auto px-8 py-4 md:flex md:items-center md:justify-between">
      <div class="flex items-center justify-between">
        <a class="text-xl font-bold text-gray-900 md:text-2xl" href="{{route('home')}}">Logo</a>

        <!-- Mobile menu button -->
        <div @click="isOpen = !isOpen" class="flex md:hidden">
          <button type="button" class="text-gray-800 hover:text-gray-400 focus:text-gray-400 focus:outline-none" aria-label="toggle menu">
            <svg viewBox="0 0 24 24" class="h-6 w-6 fill-current">
              <path fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"></path>
            </svg>
          </button>
        </div>
      </div>

      <div :class="isOpen ? 'flex' : 'hidden'" class="mt-2 flex-col space-y-4 md:mt-0 md:flex md:flex-row md:items-center md:space-y-0 md:space-x-10">
        <a class="transform text-gray-800 hover:text-yellow-400" href="{{route('home')}}">Home</a>
        <a class="transform text-gray-800 hover:text-yellow-400" href="{{route('room')}}">Kamar</a>
        <a class="transform text-gray-800 hover:text-yellow-400" href="{{route('fasilitas')}}">Fasilitas</a>
        <a class="transform text-gray-800 hover:text-yellow-400" href="{{route('galeri')}}">Gallery</a>
        <template x-if="islogin">
            <button x-on:click="logout()" class="transform text-gray-800 hover:text-yellow-400" >Logout</button>
        </template>
        <template x-if="!islogin">
            <a href="{{route('login')}}" class="transform text-gray-800 hover:text-yellow-400" >Login</a>
        </template>

        <a class="rounded-2xl border bg-gradient-to-b from-yellow-300 to-yellow-500 px-4 py-2 text-center text-white hover:shadow-xl" href="#">Book Now</a>
      </div>
    </nav>
  </header>
