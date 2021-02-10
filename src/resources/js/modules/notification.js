import feNotification from './components/notification.vue';
window.ready(()=>{
    document.querySelectorAll(".fenotification-container").forEach((elm)=>{
        let ins= window.Vue.createApp({components:{feNotification}});
        ins.mount(elm);
        window.vueApps.push(ins);
    });
});