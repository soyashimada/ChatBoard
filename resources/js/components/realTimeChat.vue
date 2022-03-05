<template>
    <div class="app-content">
        <div class="chat-window" ref="chatWindow">
            <div v-for="(item, post) in posts" :key="post">
                
                <div class="d-flex justify-content-end" v-if="loginuser.id == item.user.id">
                    <div class="card mb-3 w-50">
                        <div class="card-body post-body py-2">
                            <p class="card-title post-content">{{item.message}}</p>
                            <p class="text-muted post-time">{{ format(Date.parse(item.created_at), 'yyyy-MM-dd HH:mm', {locale: jaLocale}) }}</p>
                        </div>
                    </div>
                </div>

                <div class="d-flex" v-else>
                    <div class="col-lg-1 col-2">
                        <a :href="'/profile/' + item.user.id"><img class="w-100" :src="item.user.user_image" alt="user_image" style="border-radius: 50%"></a>
                        <h5 class="text-muted text-center" style="font-size: 15px;">{{item.user.name}}</h5>
                    </div>                 
                    <div class="card mb-3 w-50">                       
                        <div class="card-body post-body py-2">
                            <p class="card-title post-content">{{item.message}}</p>
                            <p class="text-muted post-time">{{ format(Date.parse(item.created_at), 'yyyy-MM-dd HH:mm', {locale: jaLocale}) }}</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="comment-area">          
            <textarea v-model="text" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: calc(100% - 37px)" name="message"></textarea>
            <button @click="postMessage" class="btn btn-primary">Comments</button>   
        </div>
    </div>
</template>

<style scoped>
    .app-content{
        position: relative;
        height: 100%;
    }

    .chat-window{
        overflow: scroll;
        height: 80%;
    }

    .post-content{
        font-size: 1.4rem;
    }

    .post-time{
        font-size: 0.8rem;
        margin-bottom: 0px;
    }

    .comment-area{
        position: absolute;
        bottom: 0px;
        width: 100%;
        height: 20%;
    }
</style>

<script>
    import format from 'date-fns/format'
    import jaLocale from 'date-fns/locale/ja'

    export default {
        name: "real-time-chat",
        props: ["id"],
        data() {
            return {
                format,
                jaLocale,
                posts: [],
                loginuser: [],
                boardid: this.id,
                text: ""
            }
        },
        created() {
            this.fetchMessages();
        },

        mounted() {
            Echo.channel('channel').listen('PostSent', (e) => {
                this.fetchMessages();
            });
        },

        updated() {
            this.scrollToEnd();
        },
        methods: {
            scrollToEnd(){
                this.$nextTick(() => {
                    const chatLog = this.$refs.chatWindow;
                    if (!chatLog) return;
                    chatLog.scrollTop = chatLog.scrollHeight;
                })
            },
            fetchMessages() {
                const url = '/ajax/board/read?id='+ this.boardid;
                axios.get(url).then(response => {
                    this.posts = response.data.posts;
                    this.loginuser = response.data.loginuser;
                })
            },
            postMessage() {
                const url = '/ajax/board/read?id='+ this.boardid;
                axios.post(url, {message: this.text, id: this.boardid}).then(response => {
                    this.text = "";
                })

            }
        }
    }
    
</script>