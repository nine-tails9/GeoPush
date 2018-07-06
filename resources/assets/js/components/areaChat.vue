<template>
    <div class="container">
        
       <div v-for="m in messages">
        {{ m.message }}
        {{unread}}
        </div> 
        <div class="input-group" style="width:70%;">
        <input id="btn-input" type="text" name="message" class="form-control input-sm" placeholder="Type your message here..." v-model="newMessage" @keyup.enter="sendMessage">

        <span class="input-group-btn">
            <button class="btn btn-primary" id="btn-chat" @click="sendMessage">
                Send
            </button>
        </span>
        </div>
    </div>
</template>


<script>

import { EventBus } from '../app.js';
    export default{
        props : ['user', 'withh'],

        data(){

            return{

                newMessage : "",
                nearBy : [],
                messages : [],
                unread: 0
            
            }
        },
        created(){
            
            Echo.private('NewareaMessage.' + this.user).listen(
                    'areaMessage', (e) =>{
                        if(this.withh != 0)EventBus.$emit('unread');
                        this.messages.push({
                            message: e.message
                            
                        });
                });
        },
        methods: {

            sendMessage(){
                let message = this.newMessage;
                axios.post('/areaMessage',{
                    message: this.newMessage,

                });

                this.newMessage = "";

            }
        }
    }
</script>
