<template>
    <div class="composer">
        <textarea name="textarea" v-model="message" @keydown.enter="send" placeholder="Enter a message....."></textarea>
    </div>
</template>

<script>
    export default {
        data(){
            return {
               message : ''
            }
        },
        methods:{
            send(){
                if(this.message == ''){
                    return;
                }
                this.$emit('send',this.message);
                this.message = ''
            }
        }
    }
</script>

<style lang="scss" scoped>
 .composer textarea{
     width : 96%;
     margin : 10px;
     resize : none;
     border-radius: 7px;
     border : 1px solid rgb(147, 100, 179);
     padding : 6px;
 }
</style>
