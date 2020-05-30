
<template>
    <div class="input-group">
        <input id="btn-input" type="text" name="message" class="form-control input-sm"  required v-model="newMessage" @keyup.enter="sendMessage">


        <button class="btn btn-primary btn-sm" id="btn-chat" @click="sendMessage">
           <i class="fa fa-paper-plane"></i>
        </button>

    </div>
</template>

<script>
    export default {
        props: ['user'],

        data() {
            return {
                newMessage: ''
            }
        },

        methods: {
            sendMessage() {
                if(this.newMessage!=''){
                    this.$emit('messagesent', {
                        user: this.user,
                        message: this.newMessage
                    });

                    this.newMessage = ''
                }

            }
        }
    }
</script>
