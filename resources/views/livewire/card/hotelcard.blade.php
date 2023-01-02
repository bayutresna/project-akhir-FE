<script>
    Alpine.data("skadi", () => ({
    show: false,
    room: [],
    rooms: [],
    respon: '',
    getroom(){
        const respon = fetch('http://127.0.0.1:8000/api/kamar')
        .then(async (response) => {
        this.room = await response.json()
        this.rooms = this.room.data
        });
    }
    }))
</script>
<div x-data='skadi' x-init="getroom()">

        <div class="flex flex-wrap gap-10 justify-center">
            <template x-for="r in rooms">
            <div class="rounded-lg shadow-lg bg-white max-w-sm">
                <img class="rounded-t-lg" :src="r.foto" alt=""/>
              </a>
              <div class="p-6">
                <h5 x-text="r.nama" class="text-gray-900 text-xl font-medium mb-2"></h5>
                <p x-text="r.deskripsi" class="text-gray-700 text-base mb-4">
                </p>
                <a :href="`room/detail/${r.id}`" type="button" class=" inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Detail</a>
              </div>
            </div>
        </template>
          </div>

</div>
