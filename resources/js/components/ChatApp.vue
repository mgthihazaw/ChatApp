<template>
  <div class="chat-app">
    <Conversation :contact="selectedContact" :messages="messages" @new="saveNewMessage"></Conversation>
    <ContactList :contacts="contacts" @selected="startConversationWith" :activeUser="activeUser" />
  </div>
</template>

<script>
import Conversation from "./Conversation";
import ContactList from "./ContactList";
export default {
  props: {
    user: {
      type: Object
    }
  },
  components: {
    Conversation,
    ContactList
  },
  data() {
    return {
      selectedContact: {},
      messages: [],
      contacts: "",
      activeUser: []
    };
  },
  methods: {
    startConversationWith(contact) {
      axios.get(`/conversation/${contact.id}`).then(response => {
        this.messages = response.data;
        this.selectedContact = contact;
      });
    },
    saveNewMessage(text) {
      this.messages.push(text);
    },
    handleIncoming(message) {
      this.messages.push(message);
    }
  },
  created() {
    axios.get("/contacts").then(response => {
      this.contacts = response.data.contacts;
    });
    console.log(this.user.id);

    Echo.private(`messages.${this.user.id}`).listen("MessageEvent", e => {
      this.handleIncoming(e.message);
    });

    Echo.join(`chat`)
      .here(users => {
        this.activeUser = users;
        console.log(users.length + " Users is Active Now");
        users.forEach(user => {
          console.log(`${user.email}  is Active Now`);
        });
      })
      .joining(user => {
        console.log(`${user.email} is join`)
        if (!this.activeUser.includes(user)) {
          this.activeUser.push(user);
        }
      })
      .leaving(user => {
          console.log(`${user.email} is leave`)
          let userIndex = ''
          this.activeUser.forEach(function(el,index) {
              console.log(el, index)
           if(el.id === user.id) 
           {
               userIndex = index
           }
        });
        this.activeUser.splice(userIndex,1) 
      });
  }
};
</script>
<style  scoped>
.chat-app {
  display: flex;
}
</style>
