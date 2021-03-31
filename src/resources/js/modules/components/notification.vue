<template>
    <div class="p-md-3 p-sm-2 h-100">
        <div class="row h-100 ">
            <div class="col-md-4 col-sm-6 notifications pt-sm-1 pt-md-0 position-relative flex-column d-flex">
                <div class="row mb-sm-1">
                    <div class="col justify-content-between align-items-center d-flex">
                        <h2 style="width:30%" class="c-dark fw-bold fs-md-1 fs-sm-2 text-capitalize d-inline-flex">{{label}}</h2>
                    </div>
                </div>
                <div class="row justify-content-between align-items-center fs-6 mt-sm-2 mt-md-0">
                    <div class="col"></div>
                    <div class="col text-end">
                        <ul class="no-decoration notification-nav mb-0">
                            <li class="px-1">Recent</li>
                        </ul>
                    </div>
                </div>
                <div class="row flex-fill" >
                    <div class="notification-list custom-scroll" ref="notificationList">
                        <div class="scroll-container h-100">
                            <div v-show="loadingList" class="text-center m-auto align-self-center">
                                <h3>Loading</h3>
                                <i class="fas p-0 fa-spinner fa-spin"></i>
                            </div>
                            <div v-show="hasNotifications">
                                <ul v-show="!loadingList" class="py-2 no-decoration">
                                    <li v-for="message in notifications" :key="message.id" class="my-2 p-2 cur-pointer notification-item">
                                        <div class="row align-items-center" @click="load_notification(message.id)">
                                            <div class="col-8 text-capitalize d-flex align-items-center">
                                                <i :class="[message.metaInfo.status=='new' ? 'fa-envelope' : 'fa-envelope-open', 'far fa-lg  me-md-3 me-sm-2']"></i>
                                                <div class="text-truncate d-inline-block text-truncate">{{message.title}}</div>
                                            </div>
                                            <div class="col-4 text-end fs-6 text-muted">{{message.metaInfo.timeStamp}}</div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div v-show="!hasNotifications && !loadingList" >
                                <h3 class="text-center text-capitalize">We have no messages ...</h3>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div v-show="loadingContent" class="col-sm-6 col-md-8">
                <div class="text-center pt-3">
                    <h3 class="fs-5">Loading</h3>
                    <i class="fas p-0 fa-spinner fa-spin"></i>
                </div>
            </div>
            <div v-show="hasNotification && !loadingContent" class="col-sm-6 col-md-8 notification-details px-5 border-start border-light">
                <div class="row notification-title justify-content-between">
                    <h1 class="mb-1 w-100 fw-light fs-md-1 fs-sm-2 text-truncate text-capitalize" :title="notification.title">{{notification.title||"Untitled"}}</h1>
                    <div class="col-4 mb-2">
                        <ul class="no-decoration notification-controls mb-0">
                            <li @click="reset"><i class="border-start c-danger fa-flip-horizontal fa-sign-out-alt fas p-0 ps-2"></i></li>
                            <li @click="remove"><i class="far fa-trash-alt" ></i></li>
                            <li @click="print"><i class="fas fa-print" ></i></li>
                        </ul>
                    </div>
                    <div class="col notification-metainfo text-end mb-2">
                        <ul class="no-decoration mb-0">
                            <li v-if="null!==notification.from.displayName">
                                from: {{notification.from.displayName}}
                            </li>
                            <li v-if="null!==notification.metaInfo.timeStamp">
                                {{notification.metaInfo.timeStamp}}
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="notification-detail p-2" v-html="notification.content">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:'feNotification',
    data(){
        return {
            notification:{
                title:null,
                id:null,
                metaInfo:{
                    timeStamp:null,
                    status:null
                },
                from:{
                    uid:null,
                    displayName:null
                },
                content:null
            },
            notifications:[],
            loadingList:false,
            loadingContent:false
        }
    },
    props:{
        label:{default:'inbox'},
        apiUrl:{default:null},
        mid:{default:null}
    },
    computed:{
        hasNotification(){
            return !(_.isEmpty(this.notification.title)&&_.isEmpty(this.notification.content));
        },
        hasNotifications(){
            return !(_.isEmpty(this.notifications));
        }
    },
    mounted(){
        OverlayScrollbars(this.$refs.notificationList, { 
            className : "os-theme-dark",
            scrollbars:{autoHide : "leave"},
            sizeAutoCapable:true
        });
        this.loadNotifications();
    },
    methods:{
        print(){
            window.print();
        },
        load_notification(mid){
            if(!_.isEmpty(this.apiUrl) && !_.isNull(mid)){
                this.loadingContent=true;
                axios.post(this.apiUrl+'/'+mid).then(response=>{
                    if(response.data) response = response.data;
                    else return ;
                    this.notification={
                        title:(response.subject||'untitled'),
                        id:mid,
                        metaInfo:{
                            timeStamp:(response.send_time||'N/A'),
                            status:'read'
                        },
                        from:{
                            uid:response.sender.id,
                            displayName:(response.sender.name || response.sender.email || 'N/A')
                        },
                        content:response.contents
                    }
                })
                .catch(error=>{
                    window.frameUtil.Notify(error, 'error');
                })
                .then(()=>{
                    this.loadingContent=false;
                });
            }
        },
        loadNotifications(){
            this.notifications=[];
            if(!_.isEmpty(this.apiUrl)){
                this.loadingList=true;
                axios.post(this.apiUrl).then(
                    function (response) {
                        (response.data||{messages:[]}).messages.forEach(message => {
                            this.notifications.push({
                                title:(message.subject||'Untitled'),
                                id:message.id,
                                metaInfo:{
                                    timeStamp:(message.send_time||'N/A'),
                                    status:(message.status||'new')
                                },
                                from:{
                                    uid:message.sender.id,
                                    displayName:(message.sender.name || message.sender.email || 'N/A')
                                },
                                content:(message.contents||'')
                            });
                        });
                    }.bind(this)
                )
                .catch(
                    function (error) {
                        window.frameUtil.Notify(error, 'error');
                    }.bind(this)
                ).then(()=>{
                    this.loadingList=false;
                });
            }
        },
        remove(){
            if(!_.isEmpty(this.apiUrl) && !_.isNull(this.notification.id)){
                this.loadingContent=true;
                axios.post(this.apiUrl+'/remove/'+this.notification.id).then(response=>{
                    if(response.data) response = response.data;
                    window.frameUtil.Notify(response.message, response.status);
                    if(response.status=='success'){
                        this.loadNotifications();
                        this.reset();
                    }
                })
                .catch(error=>{
                    window.frameUtil.Notify(error, 'error');
                })
                .then(()=>{
                    this.loadingContent=false;
                });
            }
        },
        reset(){
            this.notification={
                title:null,
                id:null,
                metaInfo:{
                    timeStamp:null,
                    status:null
                },
                from:{
                    uid:null,
                    displayName:null
                },
                content:null
            };
        }
    }
}
</script>

<style lang="scss">
    .fenotification-container{
        font-family: "Lato", "Open Sans";
        .panel-content{
            height: 100%;
            .notification-nav{
                li{
                    position: relative;
                    display: inline-block;
                    &:before{
                        background: #566473;
                        content: '';
                        height: 0.1rem;
                        left: 0;
                        position: absolute;
                        bottom: -0.1rem;
                        transition: transform 0.3s;
                        width: 100%;
                    }
                }
            }
            .notification-list{
                color: #31373d;
                .text-muted{
                    font-size: 10px !important;
                }
                li.notification-item{
                    &:hover{
                        background: #e1e6ec;
                    }
                }
            }
            .notification-details{
                .notification-title{
                    color: #566473;
                    .notification-metainfo{
                        color: #7e7e7e;
                    }
                    .notification-controls{
                        cursor: pointer;
                    }
                    li{
                        display: inline-block;
                        margin: 0px 5px;
                    }
                }
                .notification-title {
                    min-height: 75px;
                }
            }
            .notification-list, .notification-detail{
                border-top: 2px solid #dfdfdf;
            }
        }
    }
</style>