<script>
    Alpine.data("skadi", () => ({
        show: false,
        pict: [],
        pictures: [],
        toggle: '0',
        respon: '',

        getpict(){

            const respon = fetch('http://127.0.0.1:8000/api/galeri')
            .then(async (response) => {
            this.pict = await response.json()
            this.pictures = this.pict.data
            });
        }
        }))
</script>

<div x-data="skadi" x-init="getpict()" id="carouselExampleSlidesOnly" class="carousel slide relative" data-bs-ride="carousel">

    <div class="carousel-inner relative w-full overflow-hidden ">
        <template x-for="picture in pictures">
        <div class="carousel-item active relative float-left w-full">
        <img
        :src="picture.foto"
          class="block w-full"
        />
      </div>
    </template>
    </div>
  </div>
