<template>
    <div class="app-content">
        <div class="chat-window" ref="chatWindow">
            <!-- チャットボードの説明 -->
            <div class="d-flex justify-content-end" v-if="board.user_id == loginuser.id">
                <div class="card mb-3 w-75">
                    <div class="card-body board-description-body py-2">
                        <p class=board-description-title>＜作成者コメント＞</p>
                        <p class="card-title board-description-content">{{board.description}}</p>
                        <p class="text-muted board-time">{{ format(Date.parse(board.created_at), 'yyyy-MM-dd HH:mm', {locale: jaLocale}) }}</p>
                    </div>
                </div>
            </div>
            <div class="d-flex" v-else>
                <div class="col-lg-1 col-2">
                    <a :href="'/profile/' + board.user_id"><img class="w-100" :src="board.user.user_image" alt="user_image" style="border-radius: 50%"></a>
                    <p class="board-creator text-muted text-center" style="font-size: 15px;">{{board.user.name}}</p>
                </div>                 
                <div class="card mb-3 w-75">
                    <div class="card-body board-description-body py-2">
                        <p class=board-description-title>＜作成者コメント＞</p>
                        <p class="card-title board-description-content">{{board.description}}</p>
                        <p class="text-muted board-time">{{ format(Date.parse(board.created_at), 'yyyy-MM-dd HH:mm', {locale: jaLocale}) }}</p>
                    </div>
                </div>
            </div>

            <!-- 投稿をログインユーザーのものは右側、他は左側に表示 -->
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
                        <p v-bind:class="[item.user.id == board.user_id ? 'board-creator text-muted text-center' : 'text-muted text-center']" style="font-size: 15px;">{{item.user.name}}</p>
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

    .board-description-title{
        font-weight: bold;
    }

    .board-description-content, .board-description-title{
        font-size: 1.5rem;
    }

    .post-content{
        font-size: 1.4rem;
    }

    .post-time, .board-time{
        font-size: 0.8rem;
        margin-bottom: 0px;
    }

    .board-creator {
        font-weight: bold;
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
        props: ["board_data"],
        data() {
            return {
                format,
                jaLocale,
                posts: [],
                loginuser: [],
                board: this.board_data,
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
                const url = '/api/board/read?id='+ this.board.id;
                axios.get(url).then(response => {
                    this.posts = response.data.posts;
                    this.loginuser = response.data.loginuser;
                })
            },
            postMessage() {
                const url = '/api/board/read?id='+ this.board.id;
                axios.post(url, {message: this.text, id: this.board.id}).then(response => {
                    this.text = "";
                })

            }
        }
    }
    
</script>