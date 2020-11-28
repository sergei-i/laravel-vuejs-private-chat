<template>
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">Private Chat App</div>
                    <ul class="list-group">
                        <a href="" v-for="friend in friends" :key="friend.id" @click.prevent="openChat(friend)">
                            <li class="list-group-item">{{ friend.name }}</li>
                        </a>
                    </ul>
                </div>
            </div>

            <div class="col-md-9">
                <div v-for="friend in friends" :key="friend.id" v-if="friend.session">
                    <message-component v-if="friend.session.open" @close="closeChat(friend)" :friend="friend"/>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    import MessageComponent from "./MessageComponent";

    export default {
        components: {MessageComponent},
        data() {
            return {
                friends: []
            }
        },
        methods: {
            closeChat(friend) {
                friend.session.open = false
            },
            getFriends() {
                axios.post('/getFriends').then(res => this.friends = res.data.data)
            },
            openChat(friend) {
                if (friend.session) {
                    this.friends.forEach(fr => {
                        if (fr.session) {
                            fr.session.open = false
                        }
                    })
                    friend.session.open = true
                } else {
                    this.createSession(friend)
                }
            },
            async createSession(friend) {
                axios.post('/session/create', {friend_id: friend.id}).then(res => {
                    friend.session = res.data.data
                    friend.session.open = true
                    this.openChat(friend)
                })
            }
        },
        created() {
            this.getFriends()
        }
    }
</script>
