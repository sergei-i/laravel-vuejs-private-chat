<template>
    <div class="card chat-box">
        <div class="card-header">
            <b :class="{'text-danger': blocked}">
                {{ friend.name }}
                <span v-if="blocked">(Blocked)</span>
            </b>
            <a href="" @click.prevent="close">
                <i class="fa fa-times float-right" aria-hidden="true"></i>
            </a>
            <div class="dropdown float-right mr-4">
                <a href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#" @click.prevent="unblock" v-if="blocked">UnBlock</a>
                    <a class="dropdown-item" href="#" @click.prevent="block" v-else>Block</a>
                    <a class="dropdown-item" href="#" @click.prevent="clear">Clear Chat</a>
                </div>
            </div>
        </div>
        <div class="card-body" v-chat-scroll>
            <p class="card-text" v-for="chat in chats" :key="chat.message">
                {{ chat.message }}
            </p>
        </div>
        <form class="card-footer" @submit.prevent="send">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Write your message here..." :disabled="blocked">
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: "MessageComponent",
        props: {
            friend: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                chats: [],
                blocked: false
            }
        },
        methods: {
            send() {

            },
            close() {
                this.$emit('close')
            },
            clear() {
                this.chats = []
            },
            block() {
                this.blocked = true
            },
            unblock() {
                this.blocked = false
            }
        },
        created() {
            this.chats.push({message: 'Heyy'}, {message: 'How are you?'})
        }
    }
</script>

<style scoped>
    .chat-box {
        height: 400px;
    }

    .card-body {
        overflow-y: scroll;
    }
</style>
