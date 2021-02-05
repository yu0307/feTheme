function toggleClass(target, className) {
    if (className) {
        target.classList.toggle(className);
    }
}

function toggleControl() {
    if(this.attributes.hasOwnProperty('tg-target')){
        toggleClass(document.querySelector(this.attributes.getNamedItem('tg-target').value),'show');
    }
}

function toggleCollapse(){
    this.querySelector('i.fa-angle-right').classList.toggle('fa-rotate-90');
    toggleClass(this.closest('.collapse-container').querySelector('.collapse'),'show');
}

function scrollControl(event){
    let data = (()=>{
        switch(this.attributes.getNamedItem('data-direction').value){
            case"up":
                return { y : "-=20" };
            case"down":
                return { y : "+=20" };
            case"left":
                return { x : "-=20" };
            case"right":
                return { x : "+=20" };
        }
    })();
    OverlayScrollbars(this.closest(".custom-scroll").querySelector(".scroll-container")).scroll(data,400);
}

function toggleNavButton(e){
    let base = this.getElements().host.closest('.custom-scroll');
    base.querySelectorAll('.scroll-x').forEach((elm)=>{
        if(e.xScrollable) elm.classList.add('show');
        else elm.classList.remove('show');
    });
    base.querySelectorAll('.scroll-y').forEach((elm)=>{
        if(e.yScrollable) elm.classList.add('show');
        else elm.classList.remove('show');
    });
}

function documentReady() {
    document.querySelectorAll('.toggleTarget').forEach((elm)=>{
        elm.addEventListener('click',toggleControl);
    });
    document.querySelectorAll('.collapsible > a').forEach((elm)=>{
        elm.addEventListener('click',toggleCollapse);
    });
    document.querySelectorAll('.custom-scroll').forEach((elm)=>{
        OverlayScrollbars(elm.querySelector('.scroll-container'), { 
            className : "os-theme-dark",
            scrollbars:{autoHide : "leave"},
            sizeAutoCapable:(elm.attributes.getNamedItem('size-auto-capable')?elm.attributes.getNamedItem('size-auto-capable').value:true),
            callbacks:{
                onOverflowChanged:toggleNavButton
            }
        });
        elm.querySelectorAll('.menu-direction-control').forEach((elm)=>{
            elm.addEventListener('click',scrollControl);
        })
    });
}

if (
    document.readyState === "complete" ||
    (document.readyState !== "loading" && !document.documentElement.doScroll)
) {
    documentReady();
} else {
    document.addEventListener("DOMContentLoaded", documentReady);
}

export default {
    toggleClass: toggleClass
}