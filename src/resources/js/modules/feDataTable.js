import FeDataTable from './components/FeDataTable.vue';
window.ready(()=>{
    document.querySelectorAll(".fe-dataTables").forEach((elm)=>{
        let ins= window.Vue.createApp(FeDataTable);
        ins.mount(elm);
        window.vueApps.push(ins);
    });
});