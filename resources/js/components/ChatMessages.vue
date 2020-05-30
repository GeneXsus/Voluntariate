<template>
    <ul class="chat">
        <li class="left clearfix" v-for="message in messages">
            <div class="chat-body clearfix">
                <div class="header">
                    <strong class="primary-font" v-if="message.user.name">
                       {{  message.user.name}} {{message.user.subname}}
                    </strong>
                    <strong class="primary-font" v-if="message.user.center">
                       {{  message.user.center}}
                    </strong>
                </div>
                <p>
                    {{ message.message }}
                </p>
            </div>
        </li>
    </ul>
</template>

<script>
    export default {
        props: ['messages']
    };
</script>
