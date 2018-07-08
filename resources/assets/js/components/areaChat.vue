<template>
    <div class="container">
        
       <div v-for="m in messages">
        {{ m.message }}
        <p @click="privateChat(m.user)">
            {{ m.user.name }}
        </p>    
        
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
import {mapState} from 'vuex';

import {mapGetters} from 'vuex';

import {mapMutations} from 'vuex';
import { EventBus } from '../app.js';
    export default{
        props : ['user', 'withh'],

        data(){

            return{

                newMessage : "",
                nearBy : [],
                messages : [],
        
            
            }
        },
        created(){
            
            Echo.private('NewareaMessage.' + this.user).listen(
                    'areaMessage', (e) =>{
                        if(this.withh != 0)EventBus.$emit('unread');
                        this.messages.push({
                            message: e.message,
                            user: e.user
                            
                        });
                });
        },
        methods: {

            privateChat(user){
                var Nuser = {
                    to: user.id,
                    name: user.name
                };
                if(!this.$store.getters.privateChatFind(user))
                    this.$store.commit('addUser', Nuser);
            },
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
