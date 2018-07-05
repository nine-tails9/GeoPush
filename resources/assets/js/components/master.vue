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
                <chat-log :withh = "withh" :id = "id"></chat-log>
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
                withh : 1

            }
        },
        mounted: function() {
            this.$getLocation()
            .then(coordinates => {
                console.log(coordinates);
            });
            
        },
        methods:{

            run(id){
                this.withh = id.id;
            }
            
        }
    };

</script>