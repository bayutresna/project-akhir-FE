<script>
    Alpine.data("skadi", () => ({
        show: false,
        pict: [],
        pictures: [],
        toggle: '0',
        respon: '',

        getpict(){
            const respon = fetch('http://127.0.0.1:8000/api/fasilitashotel')
            .then(async (response) => {
            this.pict = await response.json()
            this.pictures = this.pict.data
            });
        }
        }))
</script>

<div class="justify-center flex flex-wrap gap-10" x-data="skadi" x-init="getpict()">
<template x-for="picture in pictures">
<div class="flex justify-center">
    <div class="rounded-lg shadow-lg bg-white max-w-sm">
     <img class="rounded-t-lg" :src="picture.foto" alt=""/>
      <div class="p-6">
        <h5 x-text="picture.nama" class="text-gray-900 text-xl font-medium mb-2"></h5>
        <p x-text="picture.deskripsi" class="text-gray-700 text-base mb-4">
        </p>
      </div>
    </div>
  </div>
</template>

