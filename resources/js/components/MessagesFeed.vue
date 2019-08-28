<template>
    <div class="feed" ref="feed">
        <ul v-if="contact">
            <li 
            v-for="(message,index) in messages"
            :key="index"
            :class="`message ${message.to == contact.id ? ' sent' : ' received'}`"
            >
            <div class="text">
                {{ message.text }}
            </div>
            </li>

        </ul>
    </div>
</template>

<script>
import { setTimeout } from 'timers';
    export default {
        props : {
            messages : {

            },
            contact : {
                type : Object
            }
        },
        methods: {
            scrollToBottom(){
                setTimeout(()=>{
                   this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight
                },50);
              
            }
        },
        watch : {
            contact(contact){
              this.scrollToBottom()
            },
            messages(messages){
              this.scrollToBottom()
            }
        }
    }
</script>

<style lang="scss" scoped>
 .feed {
     background : #f0f0f0;
     height: 100%;
     max-height: 470px;
     overflow : scroll;

     ul {
         list-style: none;
         padding : 5px;
         .text {
             max-width: 200px;
             border-radius: 5px;
             padding: 12px;
             display : inline-block;
         }

         li{
             &.message {
                 margin: 10px 0px;
                 width : 100%;

                 &.received {
                     text-align : right;

                     .text {
                         background : #a5b0d1;
                     }
                 }
                  &.sent {
                     text-align : left;

                     .text {
                         background : #9a87cf;
                     }
                 }
             }
         }
     }
 }
 
</style>

