<template>
    <div class="container"> 
    <ul class="chat">
        <li class="left clearfix" v-for="message in messages">
            <div class="chat-body clearfix">
                <div class="header">
                    <strong class="primary-font">
                        {{ message.user.name }}
                    </strong>
                </div>
                <p>
                    {{ message.message }}
                </p>
            </div>
        </li>
    </ul>
    <div class="input-group" style="width:70%;">
        <input id="btn-input" type="text" name="message" class="form-control input-sm" placeholder="Type your message here..." v-model="newMessage" @keyup.enter="sendMessage">

        <span class="input-group-btn">
            <button class="button is-dark" id="btn-chat" @click="sendMessage">
                Send
            </button>
        </span>
    </div>
    </div>

</template>


<script>
    export default{

        props:['user'],
        data(){

            return {

                messages :[],
                newMessage: ""
            }
        },
        created(){
            this.fetch();
            Echo.private('chat').listen(
                    'messageSent', (e) =>{
                        console.log('data');
                        this.messages.push({
                            message: e.message.message,
                            user: e.user
                        });
                });
            
        },

        methods:{

            fetch(){

                axios.get('/fetch').then(response =>{
                    this.messages = response.data;
                });

             
            },
            sendMessage(){
                axios.post('/sendMessage', {
                    message:this.newMessage,
                    to:0,
                }).then(response => {
                    console.log(response.data);
                });
                this.messages.push({
                    user: this.user,
                    message: this.newMessage
                });
                this.newMessage = '';

            }
        }

    };

</script>

<style>
    <style>
  .chat {
    list-style: none;
    margin: 0;
    padding: 0;
  }

  .chat li {
    margin-bottom: 10px;
    padding-bottom: 5px;
    border-bottom: 1px dotted #B3A9A9;
  }

  .chat li .chat-body p {
    margin: 0;
    color: #777777;
  }

  .panel-body {
    overflow-y: scroll;
    height: 350px;
  }

  ::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
  }

  ::-webkit-scrollbar {
    width: 12px;
    background-color: #F5F5F5;
  }

  ::-webkit-scrollbar-thumb {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: #555;
  }
</style>