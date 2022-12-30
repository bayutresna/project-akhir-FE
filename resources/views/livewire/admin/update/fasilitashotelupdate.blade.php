<script>
    Alpine.data("skadi", () => ({
        fasilitas: {nama:'', deskripsi:'', foto:''},
        files: '',
        fasilitases: [],
        fasilitas: [],

        async show(id){
            const data = new FormData()
            const respon = fetch(`http://127.0.0.1:8000/api/fasilitashotel/${id}/show`)
            .then(async (response) => {
            this.fasilitases = await response.json()
            this.fasilitas = this.fasilitases.data
            });
        },

    async update(id){
            let file = this.files[0]
            let fd = new FormData()
            fd.append('foto',file)
            fd.append('nama',this.fasilitas.nama)
            fd.append('deskripsi',this.fasilitas.deskripsi)
            const respon = await fetch(`http://127.0.0.1:8000/api/fasilitashotel/edit/${id}`,{
            method: 'POST',
            body: fd
            })

            window.location.replace('http://127.0.0.1:8001/admin/fasilitashotel')
        },
    }))
</script>
<div x-data="skadi" x-init="show({{$fasilitas_id}})">
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

   {{-- start input deskripsi --}}
<div class="flex justify-center">
    <div class="mb-3 xl:w-96">
      <label for="" class="form-label inline-block mb-2 text-gray-700"
        >Deskripsi</label>
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
        x-model="fasilitas.deskripsi"
        placeholder="Deskripsi Fasilitas"
      />
    </div>
  </div>
  {{-- end input deskripsi --}}

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

  <div class="flex justify-center">

<button class="" type="button" x-on:click="update({{$fasilitas_id}})">Update</button>
</div>
</div>
