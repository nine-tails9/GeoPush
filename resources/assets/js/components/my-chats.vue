<template>

    <div class="container">
        
        <ul class="list-group">
            <li class="list-group-item" :class = "{active: withh == user.to}" v-for="user in users" @click = "change(user)">
                
                    {{user.name}}
                    <span class="badge badge-primary badge-pill">{{user.cnt}}</span>
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
            EventBus.$on('newUser', (data) => {
                this.users.push(data);
            });
            EventBus.$on('newMessage', (data) =>{ 
            
                for(var i = 0; i < this.users.length; i++){
                    if(this.users[i].to == data.from){
                        this.users[i].cnt++;
                         console.log(this.users[i]);
                        
                    }
                }



            });
        },
        methods:{

            change(user){
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