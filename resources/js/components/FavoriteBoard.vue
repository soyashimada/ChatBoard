<template>
    <div class="favorite">
        <i class="fa-heart" :class="{'fa-solid': isActive, 'fa-regular': !isActive}" @click="onClickFavorite"></i>
        <p class="favorite-num" >{{ favoriteNum }}</p>
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
            favoriteNum: this.favorite_num,
            isActive: this.favorite_status,
            boardId: this.board_id
        }
    },
    methods : {
        onClickFavorite (){
            //クリックイベント
            if(this.isActive){
                this.deleteFavoriteData();
            }else{
                this.putFavoriteData();
            }
            this.isActive = !this.isActive;
        },
        putFavoriteData() {
            let url = 'api/board/favorite/' + this.boardId;
            axios.put(url).then((response) => {
                //お気に入り数のローカルプロパティ更新
                ++ this.favoriteNum;
            }).catch(
                
            )
        },
        deleteFavoriteData() {
            let url = 'api/board/favorite/' + this.boardId;
            axios.delete(url).then((response) => {
                //お気に入り数のローカルプロパティ更新
                -- this.favoriteNum;
            }).catch(

            )
        }

    }
}

</script>