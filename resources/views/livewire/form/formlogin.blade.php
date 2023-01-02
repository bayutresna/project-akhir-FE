<script>
    Alpine.data("skadi", () => ({
        show: false,
        payload:{email: '',password: ''},
        users: [],
        toggle: '0',
        respon: '',

        login(){
            const data = new FormData()
            data.append('email', this.payload.email)
            data.append('password', this.payload.password)
            const respon = fetch('http://127.0.0.1:8000/api/login',{
            method: 'POST',
            body: data
            })
            .then(async (response) => {
            this.users = await response.json()
            const user = this.users.data
            localStorage.setItem('token', user.auth.token)
            if(user.user.id_role == '1'){
                window.location.replace('http://127.0.0.1:8001/admin')
            }
            if(user.user.id_role == '2'){
                window.location.replace('http://127.0.0.1:8001/')
            }
            });
        }
        }))
</script>


<div x-data="skadi">
    @livewire('nav.navbar')
<div  class="max-w-md px-3 rounded-lg mx-auto overflow-hidden mt-4 bg-white">

    <form
        x-on:submit.prevent="login()">
   	<div class="flex flex-col mt-8 mb-5">
   		<div class="relative">
            <label for="Email"> Email</label>
   			<input type="text" x-model="payload.email" name="email" class="w-full px-4 mb-3 rounded border py-2">
   			<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute bottom-5 right-5 inline w-6 h-6">
			  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
			</svg>
            {{-- <a href="" class="text-sm text-rigth font-semibold text-blue-500">forgot password?</a> --}}
   			</div>
   			<div class="relative items-center">
                <label for="password"> Password </label>
   			<input :type="show ? 'text' : 'password' " x-model="payload.password" name="password" class="w-full px-4 mb-5 rounded border py-2">
   			<button @click="show = !show" class="absolute inline-block bottom-7 right-5">
	   		<svg x-show="!show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
	             <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
	        </svg>
	        <svg x-show="show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
			  <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
			  <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
			</svg>

	        </button>
	       </div>
           <button  type="submit" class="py-1 mb-3 px-3 rounded text-white bg-blue-500 shadow-lg shadow-blue-500/50">Login</button>
    </form>

           <div class="pt-[25px] flex">
            <h3> belum punya akun?</h3>
            <a class="text-blue-500"  href="{{route('formregister')}}"> bikin dulu yuk</a>
           </div>

        </div>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible mx-auto col-lg-6">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        {{ $errors->first() }}.
    </div>
    @endif

    @livewire('footer.footer')
</div>
