<template>

    <div class="container">

        <div class="form-group">
                    <div class="input-group input-group-md">
                        <div class="icon-addon addon-md">
                            <input type="text" placeholder="Search for User" v-model = "query" class="form-control">
                        </div>
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button" @click="Search" v-if="!loading">Search!</button>
                            <span class="fa fa-loading"></span>
                        </span>
                    </div>
        </div>
        <button class="btn btn-default" @click = "findusers"> New Chat</button>
        <button class="btn btn-success" @click="updateLocation">Get Location</button>
        <hr>
        <ul class="list-group list-group-flush">
            <li class="list-group-item" v-for="user in users">
                {{ user.name }}
                <button class="button is-primary" @click = "newChat(user.id, user.name)">
                    Chat
                </button>
                
            </li> 
        </ul>
    </div>
</template>


<script>    
import { EventBus } from '../app.js';

import {mapMutations} from 'vuex';
    export default{

        data(){
            
            return {
                users : [],
                query : "",
                loading : false,
            }
        },
        methods:{

            updateLocation(){
                
                this.$getLocation()
                    .then(coordinates => {
                    
                    axios.post('/updateLoc', {
                        cor_X : coordinates.lat,
                        cor_Y : coordinates.lng
                    });
                });  



            },
            findusers(){

                axios.get('/findUser').then(response => {
                    this.users = response.data;
                });

            },
            newChat(user, name){
                this.users = "";
                axios.post('/newChat',{
                    to:user,
                    name:name
                });
                
                
                this.$store.commit('addUser', {name:name, to:user});

            },

            Search(){
                this.loading = true;

                axios.get('/search?q=' + this.query).then(response =>{

                    this.users = response.data;
                    this.query = '';

                });

                this.loading = false;

            }
        }
    };

</script>

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