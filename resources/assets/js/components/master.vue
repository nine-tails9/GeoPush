<template>

    <div class="container">
        <div class="row">
            <div class="col">
                
                <h2>My Chats</h2>
                <hr>
                <my-chats  v-on:change = "run" :withh = "withh"></my-chats>
            </div>
            <div class="col-md-8">
                <new-chat></new-chat>
                <keep-alive>
                <chat-log :withh = "withh" :id = "id" v-show="withh > 0"></chat-log>
                </keep-alive>
                <keep-alive>
                <area-Chat v-show="!withh" :user = "id" :withh = "withh"></area-Chat>
                </keep-alive>
            </div>
        </div>
    </div>

</template>

<script>
    export default{

        props:['id'],
        
        data(){
            
            return {
                messages : [],
                withh : -1,
                myEvent : "areaMessage"

            }
        },
        mounted(){
        
        },

        methods:{
        
            run(id){
                this.withh = id.id;
            }
            
        }
    };

</script>