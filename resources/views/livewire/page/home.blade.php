<div>
    @livewire('nav.navbar')
    {{-- @livewire('carousel.carousel') --}}

    <div class=" py-[50px] flex flex-col text-center">
        <h1 class="font-[700] text-[35px]">Booking kamar mudah bersama booking ges</h1>
        <h5 class="font-[400] text-[25px]">Nikmati momen bersama orang tersayang ditempat yang spesial</h5>
    </div>

    <div class=" py-10 font-[700] text-[35px] text-center  ">
        <h1>Galeri Hotel</h1>

        @livewire('card.fasilitas')

    </div>
    <div class="pt-10">
        @livewire('footer.footer')
    </div>
</div>
