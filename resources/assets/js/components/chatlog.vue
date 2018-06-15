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
                        if(e.message.from != this.withh){
                            
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

                axios.get('/chat/' + this.withh).then(response =>{
                    this.messages = response.data;
                });
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