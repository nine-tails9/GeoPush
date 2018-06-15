<template>

    <div class="container">
        
        <ul class="list-group">
            <li class="list-group-item" :class = "{active: withh == user.to}" v-for="user in users" @click = "change(user)">
                
                    {{user.name}}
                    <span class="badge badge-primary badge-pill">14</span>
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
                isActive: false
            }
        },
        created(){

            axios.get('/activeChats').then(response =>{
                this.users = response.data;
            });

        },
        mounted() {
            EventBus.$on('newUser', (data) => {
                this.users.push(data);
            });
        },
        methods:{

            change(user){
                this.$emit('change', {

                    id:user.to
                });
            }
            
        }
    };

</script>