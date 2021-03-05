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

    document.querySelectorAll('select[name="page_bgcolor"]').forEach((elm)=>{
        elm.addEventListener('change',function(){
            let tar = document.querySelector('.body');
            this.querySelectorAll('option').forEach((elm)=>{
                tar.classList.remove(('main-bg-'+elm.value).replaceAll(' ','-').toLowerCase());
            })
            tar.classList.add('main-bg-'+this.value.replaceAll(' ','-').toLowerCase());
        });
    });

    document.querySelectorAll('input[name="page_template"]').forEach((elm)=>{
        elm.addEventListener('click',function(){
            let tar = document.querySelector('.body');
            document.querySelectorAll('input[name="page_template"]').forEach((elm)=>{
                tar.classList.remove(('theme-'+elm.value).replaceAll(' ','-').toLowerCase());
            });
            tar.classList.add('theme-'+this.value.replaceAll(' ','-').toLowerCase());
        })
    });

    document.querySelectorAll('select[name="page_color"]').forEach((elm)=>{
        elm.addEventListener('change',function(){
            let tar = document.querySelector('.body');
            this.querySelectorAll('option').forEach((elm)=>{
                tar.classList.remove(('theme-'+elm.value).replaceAll(' ','-').toLowerCase());
            })
            tar.classList.add('theme-'+this.value.replaceAll(' ','-').toLowerCase());
        });
    });
});