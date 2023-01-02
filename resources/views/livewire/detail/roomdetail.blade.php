<script>

    Alpine.data("skadi", () => ({

        rooms:[],
        room:[],

        async get(){
            const respon = fetch(`http://127.0.0.1:8000/api/kamar`)
            .then(async (response) => {
                this.rooms = await response.json()
                this.room = this.rooms.data
            });
        }

    }))

</script>



<div x-data="skadi" x-init="get()">

        <div class="flex flex-wrap gap-9">
            <template x-for="r in room">
                <div class=" max-w-sm rounded overflow-hidden shadow-lg">
                    <img class="w-full" :src="r.foto" >
                    <div class="px-6 py-4">
                      <div x-text="r.nama" class="font-bold text-xl mb-2"></div>
                      <p x-text="r.deskripsi" class="text-gray-700 text-base"></p>
                      <p class="text-gray-700 text-base">Rp. <span x-text="r.harga"></span></p>
                      <p class="text-gray-700 text-base">Jumlah Kamar : <span x-text="r.jumlah_kamar"></span></p>
                    </div>

                    <div class="px-6 pt-4 pb-2">
                      <p class="text-gray-700 text-base"> Daftar Fasilitas</p>
                        <template x-for="fasilitas in r.fasilitas">
                            <div class="flex">
                           <img style="width: 20px; height:20px;" :src="fasilitas.logo" alt="">
                           <span x-text="fasilitas.nama" class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2"></span>
                        </div>
                        </template>
                    </div>
                </div>
            </template>
        </div>



</div>

