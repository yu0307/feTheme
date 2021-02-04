function documentReady() {

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
    
}