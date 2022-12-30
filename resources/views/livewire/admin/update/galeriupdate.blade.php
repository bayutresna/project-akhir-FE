<script>
    Alpine.data("skadi", () => ({
    show: false,
    galeri: [],
    galeries: [],
    toggle: '0',
    respon: '',
    files:'',

    async update(id){
            let file = this.files[0]
            let fd = new FormData()
            fd.append('foto',file)
            const respon = await fetch(`http://127.0.0.1:8000/api/galeri/edit/${id}`,{
            method: 'POST',
            body: fd
            })

            window.location.replace('http://127.0.0.1:8001/admin/galeri')
        },
    }))
</script>
<div x-data="skadi">
    <label for="foto"> Masukkan Foto</label>

    <input x-on:change="files = Object.values($event.target.files)" type="file" name="" id="">
    <button class="btn" type="button" x-on:click="update({{$picture_id}})">Update</button>

</div>
