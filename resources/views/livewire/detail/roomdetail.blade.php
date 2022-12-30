<script>

    Alpine.data("skadi", () => ({

        tipe: [],
        tipekamar:[],

        fasilitas:[],
        fasilitases:[],

        rooms:[],
        room:[],


        kamar: {id_tipe_kamar:'',
                nama:'',
                harga: '',
                jumlah_kamar: '',
                kapasitas: '',
                deskripsi: '',
                },
        listfasilitas: [],
        files:'',

        async show(id){
            const respon = fetch(`http://127.0.0.1:8000/api/kamar/${id}/show`)
            .then(async (response) => {
            this.rooms = await response.json()
            this.kamar = this.rooms.data
            });
        },

        // async getfasilitas(){
        //     const respon = fetch('http://127.0.0.1:8000/api/fasilitas')
        //     .then(async (response) => {
        //     this.fasilitases = await response.json()
        //     this.fasilitas = this.fasilitases.data
        //     });
        // },

        // async gettipekamar(){
        //     const respon = fetch('http://127.0.0.1:8000/api/tipekamar')
        //     .then(async (response) => {
        //     this.tipekamar = await response.json()
        //     this.tipe = this.tipekamar.data
        //     });
        // },
            }))

</script>

<div>

</div>
