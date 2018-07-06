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
            <li class="list-group-item" :class = "{active: withh == user.to}" v-for="user in users" @click = "change(user)">
                
                    {{user.name}}
                    
                    <span class="badge badge-primary badge-pill" v-if="user.cnt">{{user.cnt}}</span>
            </li>
        </ul>
    </div>
</template>


<script>
import { EventBus } from '../app.js';
    export default{
        props: [

            'withh'
        ],
        data(){
            
            return {
                users : [],
                isActive: false,
                cnt: 0,
                unread: 0
            }
        },
        created(){

            axios.get('/activeChats').then(response =>{
                this.users = response.data;
                for(var i = 0; i < this.users.length; i++){    
                    
                    Vue.set(this.users[i], 'cnt', 0);
                }
            });
           

        },
        mounted() {
            EventBus.$on('clr', (res) =>{
                this.unread = 0;
            });
            EventBus.$on('unread', (res)=> {
                this.unread++;
            });
            EventBus.$on('newUser', (data) => {
                
                for(var i = 0; i < this.users.length; i++){
                    if(this.users[i].to == data.to)return;
                }
                this.users.push(data);
            });
            EventBus.$on('newMessage', (data) =>{ 
                
                if(data.from == 0)this.cnt++;
                for(var i = 0; i < this.users.length; i++){
                    if(this.users[i].to == data.from){
                        this.users[i].cnt++;
                        
                    }
                }



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
                for(var i = 0; i < this.users.length; i++){
                    if(this.users[i] == user){
                        this.users[i].cnt = 0;
                        break;
                        
                    }
                }
                this.$emit('change', {

                    id:user.to
                });
            }
            
        }
    };

</script>