<template>
    <div class="container" >
        <div v-for="(item, post) in posts" :key="post">
            <div class="d-flex justify-content-end" v-if="user.id == item.user.id">
                <div class="card mb-3 w-50">
                    <div class="card-body">
                        <h3 class="card-title" style="font-size: 22px;">{{item.message}}</h3>
                        <h4 class="card-subtitle text-muted" style="font-size: 16px;">{{item.user.name}}</h4>
                    </div>
                </div>
            </div>
            <div class="d-flex" v-else>
                <div class="card mb-3 w-50">
                    <div class="card-body">
                        <h3 class="card-title" style="font-size: 22px;">{{item.message}}</h3>
                        <h4 class="card-subtitle text-muted" style="font-size: 16px;">{{item.user.name}}</h4>
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
    export default {
        name: "real-time-chat",
        props: ["id"],
        data() {
            return {
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