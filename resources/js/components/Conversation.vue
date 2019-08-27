<template>
    <div class="conversation">
      <h1>{{ contact.name ? contact.name : 'Select a Contact' }}</h1>
      <MessagesFeed :contact="contact" :messages="messages"></MessagesFeed>
      <MessageComposer @send="sendMessage"></MessageComposer>
    </div>
</template>

<script>
import MessagesFeed from './MessagesFeed';
import MessageComposer from './MessageComposer';

    export default {
        components : {
           MessagesFeed,
           MessageComposer
        },
        props: {
            contact : {
                type : Object,
                default : null
            },
            messages : {
                
            }
        },
        methods: {
            sendMessage(text){
                console.log(text)
            }
        }
    }
</script>
<style lang="scss" scoped>
.conversation {
    flex : 5;
    display : flex;
    flex-direction : column;
    justify-content: space-between;

    h1 {
        font-family: 'Ultra', serif;
        font-size : 15px;
        color: rgb(147, 100, 179);
        padding : 10px;
        margin : 0;
        border-bottom : 1px dashed lightgray;
    }
}

</style>
