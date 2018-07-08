<template>

    <div class="container">
        
        <ul class="list-group">
            <li class="list-group-item" @click = "area" :class="{active:isActive}">
                Area Chat 
                    <span class="badge badge-primary badge-pill" v-if="unread">
                        {{unread}}
                    </span>


                <span class="badge badge-primary badge-pill" v-if="cnt"> {{ cnt }} </span>
            </li>
            <li class="list-group-item" :class = "{active: withh == user.to}" v-for="user in $store.state.users" @click = "change(user)">
                
                    {{user.name}}
                    <span class="badge badge-primary badge-pill" v-if="user.cnt">{{user.cnt}}</span>
            </li>
        </ul>
    </div>
</template>


<script>
import { EventBus } from '../app.js';

import {mapState} from 'vuex'
    export default{
        props: [

            'withh'
        ],
        data(){
            
            return {
                isActive: false,
                cnt: 0,
                unread: 0,
                id: this.$store.state.id
            }
        },
        created(){

            axios.get('/activeChats').then(response =>{
                this.$store.commit('getUsers', response.data);
                
            });
           

        },
        mounted() {
            EventBus.$on('clr', (res) =>{
                this.unread = 0;
            });
            EventBus.$on('unread', (res)=> {
                this.unread++;
            });
         
            EventBus.$on('newMessage', (data) =>{ 
                if(data.from == 0)this.cnt++;
                else
                this.$store.commit('unread', data.from);

            });

        },
        methods:{

            area(){

                this.isActive = !this.isActive;
                this.cnt = 0;
                this.$emit('change',{

                    id : 0

                });


            },
            change(user){
                this.isActive = false;
                this.$store.commit('activeUser',user);
                this.$emit('change', {

                    id:user.to
                });
            }
            
        }
    };

</script>