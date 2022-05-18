<template>
    <div class="favorite">
        <i class="fa-heart" :class="{'fa-solid': favorite_status, 'fa-regular': !favorite_status}" @click="onClickFavorite"></i>
        <p class="favorite-num" >{{ favorite_num }}</p>
    </div>
</template>

<style scoped>

    .favorite {
        display: flex;
        align-items: center;
    }

    .fa-heart {
        color: rgb(209, 21, 93);
        font-size: 20px;
        cursor: pointer;
    }

    .favorite-num {
        display: inline-block;
        margin: 0;
        font-size: 15px;
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
    },
    data: function() {
        return {
        }
    },
    methods : {
        onClickFavorite (){
            //クリックイベント
            if(this.favorite_status){
                this.deleteFavoriteData();
            }else{
                this.putFavoriteData();
            }
            this.favorite_status = !this.favorite_status;
        },
        putFavoriteData() {
            let url = 'api/board/favorite/' + this.board_id;
            axios.put(url).then((response) => {
                //お気に入り数のローカルプロパティ更新
                ++ this.favorite_num;
            }).catch(
                
            )
        },
        deleteFavoriteData() {
            let url = 'api/board/favorite/' + this.board_id;
            axios.delete(url).then((response) => {
                //お気に入り数のローカルプロパティ更新
                -- this.favorite_num;
            }).catch(

            )
        }

    }
}

</script>