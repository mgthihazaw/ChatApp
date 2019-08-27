<template>
    <div class="chat-app">
      <Conversation :contact="selectedContact" :messages="messages"> </Conversation>
      <ContactList :contacts="contacts" @selected="startConversationWith"/>
    </div>
</template>

<script>
import Conversation from './Conversation'
import ContactList from './ContactList'
    export default {
        props : {
            user :{
                type : Object
            }
        },
        components:{
            Conversation,
            ContactList
        },
        data(){
           return {
             selectedContact : {},
             messages : [],
             contacts : ''
           }
        },
        methods : {
            startConversationWith(contact){
               axios.get(`/conversation/${contact.id}`)
               .then(response => {
                   this.messages = response.data;
                   this.selectedContact = contact
               })
            }
        },
        created() {
            axios.get('/contacts')
            .then(response => {
                this.contacts = response.data.contacts
            })
        }
    }
</script>
<style  scoped>
 .chat-app {
     display :flex;
 }
</style>
