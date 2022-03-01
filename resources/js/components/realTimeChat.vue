<template>
    <div class="container" >
        <div v-for="(item, post) in posts" :key="post">
            
            <div class="d-flex justify-content-end" v-if="user.id == item.user.id">
                <div class="card mb-3 w-50">
                    <div class="card-body">
                        <h3 class="card-title" style="font-size: 22px;">{{item.message}}</h3>
                        <h5 class="text-muted" style="font-size: 11px;">{{ format(Date.parse(item.created_at), 'yyyy-MM-dd HH:mm', {locale: jaLocale}) }}</h5>
                    </div>
                </div>
            </div>

            <div v-else>
                <div class="col-lg-1 col-2">
                    <a :href="'/profile/' + item.user.id"><img class="w-100" :src="item.user.user_image" alt="user_image" style="border-radius: 50%"></a>
                    <h5 class="text-muted text-center" style="font-size: 15px;">{{item.user.name}}</h5>
                </div>
                <div class="d-flex">                   
                    <div class="card mb-3 w-50">                       
                        <div class="card-body">
                            <h3 class="card-title" style="font-size: 22px;">{{item.message}}</h3>
                            <h5 class="text-muted" style="font-size: 11px;">{{ format(Date.parse(item.created_at), 'yyyy-MM-dd HH:mm', {locale: jaLocale}) }}</h5>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="container pb-4">            
            <div class="form-floating">
                <textarea v-model="text" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="message"></textarea>
                <button @click="postMessage" class="btn btn-primary">Comments</button>
            </div>
        </div>
    </div>
</template>

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
                user: [],
                boardid: this.id,
                text: ""
            }
        },

        mounted() {
            this.fetchMessages();
            console.log("fetched!");
            Echo.channel('channel').listen('PostSent', (e) => {
                this.fetchMessages();
                console.log("fetched!");
            });
        },

        methods: {
            fetchMessages() {
                const url = '/ajax/board/read?id='+ this.boardid;
                axios.get(url).then(response => {
                    this.posts = response.data.posts;
                    this.user = response.data.user;
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