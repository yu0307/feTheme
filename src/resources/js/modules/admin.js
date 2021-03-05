window.ready(()=>{
    document.querySelectorAll('input[name="sb_structure"]').forEach((elm)=>{
        elm.addEventListener('click',function(){
            let tar = document.getElementById('nav-main-left');
            tar.classList.remove('menu-normal','menu-condensed');
            tar.classList.add('menu-'+(this.value||'normal').toLowerCase());
        })
    });

    document.querySelectorAll('input[name="sb_showon"]').forEach((elm)=>{
        elm.addEventListener('click',function(){
            let tar = document.querySelector('.body');
            tar.classList.remove('menu-always','menu-hover');
            tar.classList.add('menu-'+(this.value||'normal').toLowerCase());
        })
    });

    document.querySelectorAll('input[name="tb_location"]').forEach((elm)=>{
        elm.addEventListener('click',function(){
            let tar = document.querySelector('.top-main.nav-bar');
            tar.classList.remove('menu-fixed','menu-fluid');
            tar.classList.add('menu-'+(this.value||'fluid').toLowerCase());
        })
    });

    document.querySelectorAll('input[name="sb_initbh"]').forEach((elm)=>{
        elm.addEventListener('click',function(){
            let tar = document.getElementById('sidebar-left');
            tar.classList.remove('nav-menu-normal','nav-menu-collapsed');
            tar.classList.add('nav-menu-'+(this.value||'normal').toLowerCase());
        })
    });

    document.querySelectorAll('input[name="sb_topdisplay"]').forEach((elm)=>{
        elm.addEventListener('click',function(){
            let tar = document.querySelector('.left-panel .sidebar-top');
            tar.classList.remove('prof-none','prof-mini-profile-image','prof-icon','prof-profile-image');
            tar.classList.add('prof-'+(this.value||'profile-image').replaceAll(' ','-').toLowerCase());
        })
    });

    // $('input:radio[name="page_template"]').on('ifChecked', function () {
    //     switch ($(this).val()) {
    //         case 'Dark 2':
    //             $('body').removeClass('theme-sltd theme-sltl theme-sdtl').addClass('theme-sdtd');
    //             break;
    //         case 'Light 1':
    //             $('body').removeClass('theme-sdtd theme-sltl theme-sdtl').addClass('theme-sltd');
    //             break;
    //         case 'Light 2':
    //             $('body').removeClass('theme-sltd theme-sdtd theme-sdtl').addClass('theme-sltl');
    //             break;
    //         default:
    //             $('body').removeClass('theme-sltd theme-sltl theme-sdtd').addClass('theme-sdtl');
    //     }
    // });

    // $('select[name="page_color"]').on('change', function () {
    //     $('body').removeClass('color-primary color-dark color-red color-green color-orange color-purple color-blue').addClass('color-' + $(this).val().toLowerCase());
    // });

    // $('select[name="page_bgcolor"]').on('change', function () {
    //     $('body').removeClass('bg-clean bg-lighter bg-light-default bg-light-blue bg-light-purple bg-light-dark').addClass('bg-' + $(this).val().toLowerCase());
    // });
});