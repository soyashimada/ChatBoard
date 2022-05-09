<template>
    <div class="favorite">
        <i class="fa-regular fa-heart" :class="{liked: isActive}" @click="onClickFavorite"></i>
        <p class="favorite-num" >{{ favoriteNum }}</p>
    </div>
</template>

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
            url = 'ajax/board/favorite?id=' + this.boardId;
            axios.put(url).then((response) => {
                //お気に入り数のローカルプロパティ更新
                ++ this.favoriteNum;
            }).catch(
                
            )
        },
        deleteFavoriteData() {
            url = 'ajax/board/favorite?id=' + this.boardId;
            axios.delete(url).then((response) => {
                //お気に入り数のローカルプロパティ更新
                -- this.favoriteNum;
            }).catch(

            )
        }

    }
}

</script>