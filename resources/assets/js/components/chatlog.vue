<template>

    <div class="container">
    
        <ul class="list-group">
            <li class="list-group-item"  :class="[message.to==withh?me:'']"  v-for = "message in messages">
                    {{ message.message }}
            </li>    
        </ul>  
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

        props:['withh', 'id'],
        
        data(){
            
            return {
                messages : [],
                newMessage :"",
                a: true,
                me: "list-group-item-dark"

            }
        },
        created(){
               Echo.private('P2Pchat.' + this.id).listen(
                    'messageSent', (e) =>{
                        if(e.message.to == 0)e.message.from = 0;
                        if(e.message.from != this.withh){
                            
                            EventBus.$emit('newMessage', {
                                from: e.message.from
                            });
                            return;
                        }
                        this.messages.push({
                            message: e.message.message,
                            user: e.user,
                            to: e.user.id
                        });
                });


        },
        watch : {

            withh: function(){

                if(this.withh != 0){

                    axios.get('/chat/' + this.withh).then(response =>{
                        this.messages = response.data;
                    });

                }else{
                    EventBus.$emit('clr');
                    this.messages = [];
                    axios.get('/globalChat').then(res =>{

                        for(var i = 0; i < res.data.length; i++)
                            for(var j = res.data[i].length - 1; j >= 0; j--)
                                this.messages.push(res.data[i][j]);

                    });

                }
                
            }

        },

        methods:{

            sendMessage(){

                axios.post('/sendMessage', {
                    message: this.newMessage,
                    to: this.withh,
                });

                this.messages.push({
                    message: this.newMessage,
                })
                this.newMessage = "";
            },
            
        }
    };

</script>