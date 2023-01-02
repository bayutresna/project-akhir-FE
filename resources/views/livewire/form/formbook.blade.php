<script>
    Alpine.data("skadi", () => ({
    show: false,
    room: [],
    rooms: [],
    islogin:'',
    isload: false,
    token:'',
    user:[],
    users :[],
    tanggal_cekin: '',
    tanggal_cekout: '',
    // availability:{

    // },
    reservasi:{
        id_user:'',
        id_kamar:'',
        // cekin:'',
        // cekout:'',
        jumlah_kamar:'',
        biaya:'',
        metode_pembayaran:'',
        is_extra_bed :'',

    },
    toggle: '0',
    respon: '',

    cekavailability(){
        let fd = new FormData()
        fd.append('tanggal_cekin',this.tanggal_cekin)
        fd.append('tanggal_cekout',this.tanggal_cekout)
        const respon = fetch('http://127.0.0.1:8000/api/reservasikamar/available',{
            method:'POST',
            headers:{
                'Authorization' : `Bearer ${this.token}`
            },
            body:fd
        })
        .then(async (response) => {
        this.room = await response.json()
        this.rooms = this.room.data
        });
    },

    gettoken(){
        let token = localStorage.getItem('token')
        this.token = token
    },

    getme(){
        fetch('http://127.0.0.1:8000/api/me',{
            method: 'GET',
            headers: {
            'Authorization': `Bearer ${this.token}`
            }
        })
        .then(async (response) => {
            this.users = await response.json()
            this.user = this.users.data
        });
    },

    booking(){

        let fd = new FormData()
        console.log(this.reservasi)
        fd.append('id_kamar',this.reservasi.id_kamar)
        fd.append('id_user',this.user.id)
        fd.append('tanggal_cekin', this.tanggal_cekin)
        fd.append('tanggal_cekout', this.tanggal_cekout)
        fd.append('jumlah_kamar', this.reservasi.jumlah_kamar)
        fd.append('metode_pembayaran', this.reservasi.metode_pembayaran)
        fd.append('is_extra_bed', this.reservasi.is_extra_bed)

        const respon = fetch('http://127.0.0.1:8000/api/reservasikamar/',{
            method:'POST',
            headers:{
                'Authorization' : `Bearer ${this.token}`
            },
            body:fd
        })
        .then(async (response) => {
            window.location.replace('http://127.0.0.1:8001')
        });

    },
        ceklogin()
        {
            const token = localStorage.getItem('token')
            this.islogin = token ? true : false
            if(this.islogin == true){
                this.show = true
            }
            if(this.islogin == false){
                window.location.replace('http://127.0.0.1:8001/login')
            }
        },

        
    }))
</script>


<div x-data="skadi" x-init="gettoken(), ceklogin()">
    <div x-show="show">
    {{-- form availability check --}}
    <div class=" pt-14 pb-14 justify-center flex gap-[15px] ">
        <div class="relative">
            <label for="tanggal_lahir"> Tanggal Cekin</label>
            <input type="date" x-model="tanggal_cekin"  name="tanggal_lahir" class="w-full px-4 mb-3 rounded border py-2">
        </div>
        <div class="relative">
            <label for="tanggal_lahir"> Tanggal Cekout</label>
            <input type="date" x-model="tanggal_cekout" name="tanggal_cekout" class="w-full px-4 mb-3 rounded border py-2">
        </div>
        <button
        class="justify-right inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
        x-on:click="cekavailability(), isload=true, show=true, getme()"> Cek Kamar</button>
    </div>
    {{-- end form availability check --}}

    {{-- untuk show data kamar yang tersedia --}}
    <div class="pb-14" x-show="show">
        <table class="border-collapse w-full">
            <thead>
                <tr>
                    <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Nama Kamar</th>
                    <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Foto</th>
                    <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Harga </th>
                    <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Kapasitas</th>
                    <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Sisa Kamar</th>
                    <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <template x-for="kamar in rooms">
                <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Nama Kamar</span>
                        <span x-text="kamar.nama"></span>
                    </td>
                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Foto</span>
                        <img style="width:100px; height:100px;" :src="kamar.foto" alt="">
                    </td>
                    <td class="w-full lg:w-auto p-3 text-gray-800  border border-b text-center block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Harga</span>
                        <span x-text="kamar.harga"></span>
                    </td>
                      <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Kapasitas</span>
                        <span x-text="kamar.kapasitas"></span>
                      </td>
                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Jumlah Kamar</span>
                        <span x-text="kamar.jumlah_kamar"></span>
                    </td>
                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                        {{-- modal trigger --}}
                        <button type="button"
                            class="justify-right inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                            data-bs-toggle="modal" data-bs-target="#book">
                            Book Kamar Sekarang
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- modal booking --}}
        {{-- modal --}}
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
        id="book" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog relative w-auto pointer-events-none">
            <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                    <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalLabel">
                        Booking Kamar
                    </h5>
                    <button type="button"
                    class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                    data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body relative p-4">
                    {{-- start input Check-in --}}
                    <div class="flex justify-center">
                        <div class="mb-3 xl:w-96">
                            <label for="exampleText0" class="form-label inline-block mb-2 text-gray-700">Tanggal Check-in</label>
                            <input
                            type="date"
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
                            id="tanggal-checkin"
                            x-model="tanggal_cekin"
                            placeholder="Tanggal-Checkin"
                            />
                        </div>
                    </div>
                    {{-- end input Check-in --}}

                    {{-- start input Check-out --}}
                    <div class="flex justify-center">
                        <div class="mb-3 xl:w-96">
                            <label for="exampleText0" class="form-label inline-block mb-2 text-gray-700">Tanggal Check-out</label>
                            <input
                            type="date"
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
                            id="tanggal-checkout"
                            x-model="tanggal_cekout"
                            placeholder="Tanggal Check-out"
                            />
                        </div>
                    </div>
                    {{-- end input Check-Out --}}

                     {{-- start input Kamar --}}
                     <div class="flex justify-center">
                        <div class="mb-3 xl:w-96">
                            <label for="exampleText0" class="form-label inline-block mb-2 text-gray-700">Pilih Kamar</label>
                            <select x-model="reservasi.id_kamar" name="" id="">
                                <option selected value="none">Pilih Salah Satu</option>
                                <template x-for="kamar in rooms">
                                    <template x-if="kamar.jumlah_kamar > 0">
                                        <option x-text="kamar.nama" :value="kamar.id"></option>
                                    </template>
                                </template>
                              </select>
                        </div>
                    </div>
                    {{-- end input Pilihan Kamar --}}

                    {{-- start input Jumlah Kamar --}}
                    <div class="flex justify-center">
                        <div class="mb-3 xl:w-96">
                            <label for="exampleText0" class="form-label inline-block mb-2 text-gray-700">Jumlah Kamar</label>
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
                            id="jumlah-kamar"
                            x-model="reservasi.jumlah_kamar"
                            placeholder="jumlah kamar"
                            />
                        </div>
                    </div>
                    {{-- end input Jumlah Kamar --}}

                     {{-- start input Pilihan Extra Bed --}}
                     <div class="flex justify-center">
                        <div class="mb-3 xl:w-96">
                            <label for="exampleText0" class="form-label inline-block mb-2 text-gray-700">Extra Bed</label>
                            <select x-model="reservasi.is_extra_bed" name="" id="">
                                <option selected  value="none"> Pilih Salah Satu</option>
                                <option  value="0"> Tidak</option>
                                <option  value="1"> Ya </option>
                              </select>
                        </div>
                    </div>
                    {{-- end input Pilihan Extra Bed --}}

                    {{-- start input Metode Pembayaran --}}
                    <div class="flex justify-center">
                        <div class="mb-3 xl:w-96">
                            <label for="exampleText0" class="form-label inline-block mb-2 text-gray-700">Metode Pembayaran</label>
                            <select x-model="reservasi.metode_pembayaran" name="" id="">
                                <option selected  value="0"> Pilih Salah Satu</option>
                                <option  value="Transfer"> Transfer</option>
                                <option  value="Onsite"> Onsite</option>
                              </select>
                        </div>
                    </div>
                    {{-- end input Metode Pembayaran --}}
            </div>
            {{-- end modal body --}}

            {{-- modal footer --}}
            <div class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                <button type="button"
                class="inline-block px-6 py-2.5 bg-purple-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-purple-700 hover:shadow-lg focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-purple-800 active:shadow-lg transition duration-150 ease-in-out"
                data-bs-dismiss="modal">Close</button>
                <button type="button" x-on:click="booking()"
                class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out ml-1">Book</button>
            </div>
            {{-- end modal footer --}}
        </div>
    </div>
</div>
{{-- end of modal --}}
</div>  {{-- div show --}}
</div>
