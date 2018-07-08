import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)


const state = {
    users: []
}
const mutations = {
    getUsers(state, users){
      state.users = users;
      for(var i = 0; i < users.length; i++){    
                    
            Vue.set(state.users[i], 'cnt', 0);
        }
    },
    activeUser(state, user){
        for(var i = 0; i < state.users.length; i++){
            if(state.users[i] == user){
                state.users[i].cnt = 0;
                break;
                
            }
        }
    },
    unread(state, from){

        for(var i = 0; i < state.users.length; i++){
            if(state.users[i].to == from){
                state.users[i].cnt++;
                
            }
        }
    },
    addUser(state, user){
        for(var i = 0; i < state.users.length; i++){
            if(state.users[i].to == user.to)return;
        }
        user.cnt = 0;
    
        state.users.push(user);
    }
}
const getters = {

    privateChatFind: (state) => (user) =>{

        for(var i = 0; i < state.users.length; i++){

            if(state.users[i].to == user.id)return true;
        }
        return false;
    }
}
export default new Vuex.Store({
    state,
    mutations,
    getters

  
})