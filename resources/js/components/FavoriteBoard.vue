<template>
    <div class="favorite">
        <i class="fa-heart" :style="{'font-size': iconSize+'px'}" :class="{'fa-solid': status, 'fa-regular': !status}" @click.stop="onClickFavorite"></i>
        <p class="favorite-num" :style="{'font-size': fontSize+'px'}">{{ num }}</p>
    </div>
</template>

<style scoped>

    .favorite {
        display: flex;
        align-items: center;
    }

    .fa-heart {
        color: rgb(209, 21, 93);
        cursor: pointer;
        z-index: 2;
    }

    .favorite-num {
        display: inline-block;
        margin: 0;
        color: rgb(209, 21, 93);
        padding-left: 1px;
    }

</style>

<script>

export default {
    name: "FavoriteBoard",
    props: {
        favorite_num: Number,
        favorite_status: Boolean,
        board_id: Number,
        iconSize: {
            type: Number,
            default: 18
        },
        fontSize: {
            type: Number,
            default: 15
        }

    },
    data: function() {
        return {
            num: this.favorite_num,
            status: this.favorite_status,
            id: this.board_id 
        }
    },
    methods : {
        async onClickFavorite (){
            const res = await this.favoriteEvent();
        },
        async favoriteEvent() {
            return new Promise((resolve,reject) => {
                //クリックイベント
                if(this.status){
                    this.status = !this.status;
                    -- this.num;
                    this.deleteFavoriteData().then(response => {
                        resolve(response);
                    }).catch(error => {
                        this.status = !this.status;
                        ++ this.num;
                        reject(error);
                    })
                }else{
                    this.status = !this.status;
                    ++ this.num;
                    this.putFavoriteData().then(response => {
                        resolve(response);
                    }).catch(error => {
                        this.status = !this.status;
                        -- this.num;
                        reject(error);
                    });
                }
            },3000)
        },
        async putFavoriteData() {
            let url = location.origin + '/api/board/favorite/' + this.id;

            return await axios.put(url).then(response => {
                return response;
            }).catch(error => {
                return error;
            })
        },

        async deleteFavoriteData() {
            let url = location.origin + '/api/board/favorite/' + this.id;

            return await axios.delete(url).then(response => {
                return response;
            }).catch(error => {
                return error;
            })
        },
    }
}

</script>