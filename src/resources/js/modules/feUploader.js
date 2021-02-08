import FeUploader from './components/feUploader.vue';
window.ready(()=>{
    document.querySelectorAll(".fe-uploaders").forEach((elm)=>{
        let ins= window.Vue.createApp({components:{FeUploader}});
        ins.mount(elm);
        window.vueApps.push(ins);
    });
});