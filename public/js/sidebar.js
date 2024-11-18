// fungsi buat kalo nge-hover, bakal ganti img + font color, dan menu yang active efeknya bakal ilang
document.addEventListener('DOMContentLoaded', function(){
    const nav_link = document.querySelectorAll('.nav-link');
    let active_link = document.querySelector('.nav-link.active')
    let active_image = active_link.querySelector('.nav-img')

    const default_images = {
        'beranda':'../assets/sidebar/beranda.svg',
        'kandang_ayam':'../assets/sidebar/kandang_ayam.svg',
        'gudang_telur':'../assets/sidebar/gudang_telur.svg',
        'panen_telur':'../assets/sidebar/panen_telur.svg',
        'penjualan_telur':'../assets/sidebar/penjualan_telur.svg',
        'penjualan_ayam':'../assets/sidebar/penjualan_ayam.svg',
        'vaksinasi_ayam':'../assets/sidebar/vaksinasi_ayam.svg',
        'laporan_ayam':'../assets/sidebar/laporan_ayam.svg',
    }

    function handleHover(event){
        const hovered_link = event.target.closest('.nav-link');
        if (!hovered_link || hovered_link == active_link){
            return;
        }
        const hovered_image = hovered_link.querySelector('.nav-img');
        const hovered_alt = hovered_image.alt.toLowerCase().replace(/\s+/g, '_');

        active_link.style.backgroundColor = '#E59D2A';
        hovered_image.src = `
        ../assets/sidebar/hov_${hovered_alt}.svg`;

    }

    function handleMouseOut(event){
        const hovered_link = event.target.closest('.nav-link');
        const hovered_image = hovered_link.querySelector('.nav-img');
        if(hovered_image == active_image){
            return;
        }
        const hovered_alt = hovered_image.alt.toLowerCase().replace(/\s+/g, '_');
        active_link.style.backgroundColor = '#E59D2A';
        const active_alt = active_image.alt.toLowerCase().replace(/\s+/g, '_');
        hovered_image.src = default_images[hovered_alt];
    }

    nav_link.forEach(link => {
        link.addEventListener('mouseenter', handleHover);
        link.addEventListener('mouseleave', handleMouseOut);
    })
})
document.getElementById('user-id').textContent = Users.id;