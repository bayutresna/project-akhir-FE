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
<div x-data="skadi" x-init="getpict()">
    <div class="flex gap-5 flex-wrap">
        <template x-for="picture in pictures">
            <div class="">
                <div class="rounded-lg shadow-lg bg-white max-w-sm">
                    <img class="rounded-t-lg" :src="picture.foto" alt=""/>
                </div>
            </div>
        </template>
    </div>
</div>
