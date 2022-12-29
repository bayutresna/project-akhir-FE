{{-- <script>
    Alpine.data("skadi", () => ({
        show: false,
        payload:{email: '',
                password: '',
                nama_lengkap: '',
                alamat: '',
                tanggal_lahir: '',
                kewarganegaraan: '',
                nohp:''},
        users: [],
        toggle: '0',

        register(){
            const data = new FormData()
            var e = document.getElementById("kewarganegaraan")
            var value = e.value
            data.append('email', this.payload.email)
            data.append('password', this.payload.password)
            data.append('nama_lengkap', this.payload.nama_lengkap)
            data.append('alamat', this.payload.alamat)
            data.append('tanggal_lahir', this.payload.tanggal_lahir)
            data.append('kewarganegaraan', value)
            data.append('nohp', this.payload.nohp)

            const response = fetch('http://127.0.0.1:8000/api/register',{
            method: 'POST',
            body: data
            })
            this.users = await response.json()
            console.log(this.users)
            // const token = this.users.
        }
        }))
</script> --}}

<script>
    Alpine.data("skadi", () => ({
        show: false,
        payload:{email: '',
                password: '',
                nama_lengkap: '',
                alamat: '',
                tanggal_lahir: '',
                kewarganegaraan: '',
                nohp:''},
        users: [],
        toggle: '0',
        respon: '',

        async register(){
            const data = new FormData()
            var e = document.getElementById("kewarganegaraan")
            var value = e.value
            data.append('email', this.payload.email)
            data.append('password', this.payload.password)
            data.append('nama_lengkap', this.payload.nama_lengkap)
            data.append('alamat', this.payload.alamat)
            data.append('tanggal_lahir', this.payload.tanggal_lahir)
            data.append('kewarganegaraan', value)
            data.append('nohp', this.payload.nohp)

            const response = await fetch('http://127.0.0.1:8000/api/register',{
            method: 'POST',
            body: data
            });

            window.location.replace('http://127.0.0.1:8001/login')
        }
        }))
</script>
<div x-data="skadi" class="max-w-md px-3 rounded-lg mx-auto overflow-hidden mt-4 bg-white">
<form x-on:submit.prevent="register()">
   	<div class="flex flex-col mt-8 mb-5">
   		<div class="relative">
            <label for="Email"> Email</label>
   			<input type="text" x-model="payload.email" name="email" class="w-full px-4 mb-3 rounded border py-2">
   			</div>
   			<div class="relative items-center">
                <label for="password"> Password </label>
   			<input :type="show ? 'text' : 'password' " x-model="payload.password" name="password" class="w-full px-4 mb-5 rounded border py-2">
   			<button type="button" @click="show = !show" class="absolute inline-block bottom-7 right-5">
	   		    <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
	                 <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
	            </svg>
	            <svg x-show="show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
			      <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
			      <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
			    </svg>
	        </button>
	       </div>

           <div class="relative">
            <label for="nama_lengkap"> Nama Lengkap</label>
            <input type="text" x-model="payload.nama_lengkap" name="nama_lengkap" class="w-full px-4 mb-3 rounded border py-2">
        </div>
        <div class="relative">
            <label for="alamat"> Alamat</label>
            <input type="text" x-model="payload.alamat" name="alamat" class="w-full px-4 mb-3 rounded border py-2">
        </div>
        <div class="relative">
            <label for="tanggal_lahir"> Tanggal Lahir</label>
            <input type="date" x-model="payload.tanggal_lahir" name="tanggal_lahir" class="w-full px-4 mb-3 rounded border py-2">
        </div>

        <div class="relative">
            <label for="tanggal_lahir"> No HP</label>
            <input type="number" x-model="payload.nohp" name="nohp" class="w-full px-4 mb-3 rounded border py-2">
        </div>

        <div class="relative my-3">
            <label for="kewarganegaraan" class="w-full px-4 mb-3 rounded border py-2"> Kewarganegaraan</label>
            <select x-model='payload.kewarganegaraan' name="kewarganegaraan" id="kewarganegaraan">
                <option value="WNI">WNI</option>
                <option value="WNA">WNA</option>
            </select>
        </div>
           <button type="submit" class="py-1 mb-3 px-3 rounded text-white bg-blue-500 shadow-lg shadow-blue-500/50">Register</button>
    </form>

           <div class="pt-[25px] flex">
            <h3> sudah punya akun?</h3>
            <a class="text-blue-500"  href="{{route('formlogin')}}"> gas login!!</a>
           </div>
   	</div>
   </div>
