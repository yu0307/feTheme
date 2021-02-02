function toggleClass(target, className) {
    if (className) {
        target.classList.toggle(className);
    }
}

function toggleControl(event) {
    if(this.attributes.hasOwnProperty('tg-target')){
        toggleClass(document.querySelector(this.attributes.getNamedItem('tg-target').value),'show');
    }
}

function documentReady() {
    document.querySelectorAll('.toggleTarget').forEach((elm)=>{
        elm.addEventListener('click',toggleControl);
    });
    document.querySelectorAll('.custom-scroll').forEach((elm)=>{
        OverlayScrollbars(elm, { className : "os-theme-dark",scrollbars:{autoHide : "leave"} });
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